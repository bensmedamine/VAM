<?php

ini_set('error_reporting', 1);
header('Content-type: text/html; charset=utf-8');

set_time_limit(0);
ignore_user_abort(true);

chdir(dirname(dirname(__FILE__)));
define('DRUPAL_ROOT', getcwd());
define('DS', DIRECTORY_SEPARATOR);
require_once './includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

require_once 'tools.php';

$limit = 10;
$compteur = 0; //la limite des annonces à récupérer
$biens = array(
  'Appartement' => 60,
  'Maison' => 62,
  'Riad' => 66,
  'Studio' => 64,
  'Villa' => 65,
);

$lang = 'fr';
$url_racine = 'http://www.marocannonces.com';
$html = file_get_contents('http://www.marocannonces.com/categorie/397/Immobilier-location/Location-vacances.html');

//Pagination
$nbr_pages = parseHTML($html, 'dont <span style="color: #feee3b;">(\d+)<\/span>');
$nbr_pages = ceil($nbr_pages[1][0] / 10);

echo '<pre>';
print_r('<br>');
print_r('Nbr Pages: ' . $nbr_pages);

//pour chaque page
for ($p = 1; $p <= $nbr_pages; $p++) {


  print_r('<br>************************************************************************<br>');
  print_r('Page: ' . $p);

  $url_page = 'http://www.marocannonces.com/categorie/397/Immobilier-location/Location-vacances/' . $p . '.html';
  $html = file_get_contents($url_page);

  print_r('<br>');
  print_r('URL Page: ' . $url_page);

  $urls_annonces = parseHTML($html, '(\/categorie\/397\/Location\-vacances\/annonce\/.*\.html)');
  $urls_annonces = array_unique($urls_annonces[1]);

  print_r('<br>');
  print_r('URLs annonces: ');
  print_r('<br>');
  print_r($urls_annonces);

  //Parcourire les annonces de la page en cours
  foreach ($urls_annonces as $url_annonce) {
    parse_annonce($url_annonce);
  }
}

function parse_annonce($url) {
  global $url_racine;

  print_r('<br>');
  print_r('Url annonce: ' . $url_racine . $url);

  $html = file_get_contents($url_racine . $url);

  //ville
  $ville = parseHTML($html, 'ville_t">(.*)<\/span>');
  $ville = $ville[1][0];
  $ville = explode('/', $ville);
  $ville = trim($ville[0]);

  //annonceur
  $annonceur = parseHTML($html, '<label>Nom.*capitalize;">(.*)<\/span><\/li>');
  $annonceur = trim($annonceur[1][0]);

  //date annonce
  $date_annonce = parseHTML($html, 'Publiée le.*normal;">(.*)<\/span>');
  $date_annonce = strtotime(str_replace('à ', '', trim($date_annonce[1][0])));

  //ref annonce
  $ref_annonce = parseHTML($url, 'annonce\/(\d+)\/');
  $ref_annonce = trim($ref_annonce[1][0]);

  //tél annonceur
  $tel_annonceur = parseHTML($html, 'phone :&nbsp;<\/label>(.*)<\/li>');
  $tel_annonceur = str_replace('-', '', trim($tel_annonceur[1][0]));
  $tel_motif = '/(\d{4})(\d{2})(\d{2})(\d{2})/';
  $tel_replace = '$1 $2 $3 $4';
  $tel_annonceur = preg_replace($tel_motif, $tel_replace, $tel_annonceur);

  //déscription
  $description = parseHTML_si($html, '<div class="box_pad">(.*)<\/div>.*<h2 class="titrePage2"');
  $description = trim($description[1][0]);

  //images
  $images = parseHTML($html, "(user_images\/397\/.*_100\.[a-z]{3,4})");
  $images = $images[1];


  //title
  $title = parseHTML_si($html, '<span class="title" style="text-transform: none;">(.*)&nbsp;&nbsp;');
  $title = (trim($title[1][0]));

  $annonce = array(
    'url' => $url_racine . $url,
    'ref_annonce' => $ref_annonce,
    'ville' => $ville,
    'annonceur' => ucwords($annonceur),
    'tel_annonceur' => $tel_annonceur,
    'date_annonce' => $date_annonce,
    'title' => ucfirst($title),
    'description' => $description,
    'images' => $images,
  );

  $je_cherche_annonce = parseHTML_si($description, '(Je cherche)');
  $je_cherche_annonce = @trim($je_cherche_annonce[1][0]);

  if (!empty($je_cherche_annonce)) {
    $annonce = array();
  }

  save_annonce($annonce);
}

function save_annonce($annonce) {
  global $url_racine, $limit, $compteur, $biens;


  print_r($annonce);



  if (!is_post_exist($annonce['ref_annonce'])) {
    $node = new stdClass();
    $node->title = $annonce['title'];
    $node->language = LANGUAGE_NONE;

    $node->type = 'annonce';
    $node->status = 1;
    node_object_prepare($node);

    $node->created = $annonce['date_annonce'];
    $node->uid = 1;
    //On détermine le type de bien 
    $field_type_du_bien = 60;
    foreach ($biens as $key => $value) {
      $pos = stripos($annonce['title'], $key);
      if ($pos === FALSE) {
        continue;
      }
      else {
        $field_type_du_bien = $biens[$key];
        break;
      }
    }



    $node->field_type_du_bien[LANGUAGE_NONE][0]['tid'] = $field_type_du_bien;
    $node->field_ville[LANGUAGE_NONE][0]['tid'] = current(taxonomy_get_term_by_name($annonce['ville']))->tid;
    $node->field_type_annonceur[LANGUAGE_NONE][0]['tid'] = 57;
    $node->field_description[LANGUAGE_NONE][0]['value'] = $annonce['description'];
    $node->field_vues[LANGUAGE_NONE][0]['value'] = rand(4, 78);
    $node->field_reference[LANGUAGE_NONE][0]['value'] = $annonce['ref_annonce'];
    $node->field_url_externe[LANGUAGE_NONE][0]['value'] = $annonce['url'];
    $node->field_prenom[LANGUAGE_NONE][0]['value'] = $annonce['annonceur'];
    $node->field_tel[LANGUAGE_NONE][0]['value'] = $annonce['tel_annonceur'];


    //Traitement des images
    $i = 0;
    foreach ($annonce['images'] as $image) {
      $url_image = $url_racine . '/' . $image;
      $url_image = str_replace('_100.', '_500.', $url_image);

      $ext = end(explode('.', $image));
      $file_path = DRUPAL_ROOT . DS . 'temp' . DS . slug($annonce['title']) . '.' . $ext;

      crop($url_image, $file_path);

      $file = (object) array(
            "uid" => 1,
            "uri" => $file_path,
            "filemime" => file_get_mimetype($file_path),
            "status" => 1,
            "display" => 1
      );

      $file = file_copy($file, 'public://img_annonces/');
      $node->field_photos[LANGUAGE_NONE][$i] = (array) $file;
      $i++;
    }


    print_r($node);
    echo '<pre>';

    node_save($node);
    $compteur++;
    if ($compteur == $limit || $compteur > $limit) {
      die('THE END OF ' . $limit);
    }
  }

  return true;
}

function is_post_exist($ref) {

  $query = new EntityFieldQuery();
  $entities = $query->entityCondition('entity_type', 'node')
      ->entityCondition('bundle', 'annonce')
      ->fieldCondition('field_reference', 'value', $ref, "=")
      ->execute();

  if (!empty(current($entities['node'])->nid)) {
    return true;
  }

  return false;
}

die('- DEBUG MODE -');


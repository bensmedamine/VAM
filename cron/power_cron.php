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
  
  //$p = 2;

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
  foreach($urls_annonces as $url_annonce) {
    parse_annonce($url_annonce);
  }
  die('bens');
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
  $tel_annonceur = str_replace('-', ' ', trim($tel_annonceur[1][0]));

  //déscription
  $description = parseHTML_si($html, '<div class="box_pad">(.*)<\/div>.*<h2 class="titrePage2"');
  $description = trim($description[1][0]);

  //images
  $images = parseHTML($html, "<img src='(user_images\/397\/.*)\' w.*alt='(.*)' title");
  $images = $images[1];
  
  //title
  $title = parseHTML_si($html, '<span class="title" style="text-transform: none;">(.*)&nbsp;&nbsp;');
  $title = (trim($title[1][0]));

  $annonce = array(
    'url' => $url,
    'ref_annonce' => $ref_annonce,
    'ville' => $ville,
    'annonceur' => $annonceur,
    'tel_annonceur' => $tel_annonceur,
    'date_annonce' => $date_annonce,
    'title' => $title,
    'description' => $description,
    'images' => $images,
  );
  
  $je_cherche_annonce = parseHTML_si($description, '(Je cherche)');
  $je_cherche_annonce = trim($je_cherche_annonce[1][0]);
  
  if (!empty($je_cherche_annonce)) {
    $annonce = array();
  }

  echo '<pre>';
  print_r($annonce);
  echo '</pre>';
}

die('- DEBUG MODE -');

get_post($url[1][0]);

$i = 1;

function get_post($url) {
  global $i;
  $i++;


  if (empty($url)) {
    return;
  }
  $html = file_get_contents($url);
  $data = array();
  //url
  $data['url'] = $url;
  //image
  $img = parseHTML($html, '<meta property="og:image" content="(.*)" \/>');
  $data['img'] = $img[1][0];
  //title
  $img = parseHTML($html, '<meta property="og:title" content="(.*)" \/>');
  $data['title'] = $img[1][0];
  //next
  $img = parseHTML($html, 'href="(.*)" title.*next\-btn');
  $data['next'] = $img[1][0];


  save_data($data);

  if ($i == 7)
    die('DEBUG MODE');

  get_post($data['next']);
}

function save_data($data) {
  global $lang;

  if (!is_post_exist($data['url'])) {
    $node = new stdClass();
    $node->title = $data['title'];
    $node->language = $lang;
    $node->type = 'pb_pic';
    $node->status = 1;
    node_object_prepare($node);

    $node->uid = 1;
    $node->field_source[LANGUAGE_NONE][0]['tid'] = 1;
    $node->field_id_referent[LANGUAGE_NONE][0]['value'] = $data['url'];
    $node->field_categorie[LANGUAGE_NONE][0]['tid'] = 3;
    $node->field_nbr_visites[LANGUAGE_NONE][0]['value'] = rand(48, 300);
    $node->field_nbr_points[LANGUAGE_NONE][0]['value'] = rand(12, 150);
    //File save
    $file_name = end(explode('/', $data['img']));
    $file_path = DRUPAL_ROOT . DS . 'temp' . DS . $file_name;

    $file = fopen($file_path, 'w+');
    fputs($file, file_get_contents($data['img']));
    fclose($file);

    $file_path = 'temp/' . $file_name;

    $file = (object) array(
          "uid" => 1,
          "uri" => $file_path,
          "filemime" => file_get_mimetype($file_path),
          "status" => 1,
          "display" => 1
    );


    $file = file_copy($file, 'public://');
    $node->field_image[LANGUAGE_NONE][0] = (array) $file;

    node_save($node);
  }

  return true;
}

function is_post_exist($url) {
  $query = new EntityFieldQuery();
  $result = $query
      ->entityCondition('entity_type', 'node')
      ->propertyCondition('status', 0)
      ->fieldCondition('field_id_referent', 'value', $url, '=')
      ->execute();

  if (!empty(current($result['node'])->nid)) {
    return true;
  }

  return false;
}

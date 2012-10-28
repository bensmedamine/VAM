<?php
/**
 * @file
 * Default theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all,
 *   or print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct url of the current node.
 * - $display_submitted: Whether submission information should be displayed.
 * - $submitted: Submission information created from $name and $date during
 *   template_preprocess_node().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type, i.e., "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser
 *     listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type, i.e. story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode, e.g. 'full', 'teaser'...
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined, e.g. $node->body becomes $body. When needing to access
 * a field's raw values, developers/themers are strongly encouraged to use these
 * variables. Otherwise they will have to explicitly specify the desired field
 * language, e.g. $node->body['en'], thus overriding any language negotiation
 * rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 */
drupal_add_css(drupal_get_path('theme', 'vam') . '/css/inner.css');
$edit_link = null;
if ($is_admin) {
  $edit_link = '<a class="blue fs-18" href="/node/' . $node->nid . '/edit" target="_blank" > Modifier l\'annonce</a>';
}
?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/fr_FR/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
    
<div id="header-annonce">
  <div class="fs-12">Disponible peduis <?php print format_interval(REQUEST_TIME - $node->created); ?> <span class="blue">Consulter <?php print $node->field_vues['und'][0]['value']; ?> fois</span></div>
</div>
<?php if (count($node->field_photos)): ?>
  <?php
  drupal_add_css(drupal_get_path('theme', 'vam') . '/css/colorbox.css');
  drupal_add_js(drupal_get_path('theme', 'vam') . '/js/jquery.carouFredSel-6.0.2.js');
  drupal_add_js(drupal_get_path('theme', 'vam') . '/js/jquery.colorbox-min.js');
  ?>
  <div class="image_carousel clearboth">
    <div id="foo">
      <?php foreach ($node->field_photos['und'] as $img): ?>
        <?php print l(theme('image_style', array('style_name' => 'thumb_300x150', 'path' => $img['uri'], 'alt' => $node->title)), file_create_url($img['uri']), array('html' => true, 'attributes' => array('title' => $node->title, 'class' => 'group'))); ?>
      <?php endforeach; ?>
    </div>
    <div class="clearboth"></div>
    <p class="slider-navigation"><strong><?php print count($node->field_photos['und']); ?></strong> <img class="count-img" src="/<?php print drupal_get_path('theme', 'vam'); ?>/images/photos.png"> <a class="prev" id="foo_prev" href="#"><span>&larr;</span></a>
      <a class="next" id="foo_next" href="#"><span>| &rarr;</span></a> <small>Cliquez sur l'image pour l'agrandir. </small></p>
  </div>
  <div class="fb-like" data-href="<?php print url('node/' . $node->nid, array('absolute' => TRUE)); ?>" data-send="true" data-layout="button_count" data-width="450" data-show-faces="true" data-action="recommend"></div>
  <?php if (count($node->field_photos['und']) == 1): ?>
    <style type="text/css">
      .image_carousel{background: none;}
    </style>
  <?php endif; ?>
  <script type="text/javascript">
    jQuery(function($){
      $(".group").colorbox({rel:'group'});
      $("#foo").carouFredSel({
        circular    : false,
        infinite    : true,
        auto : true,
        prev : {
          button      : "#foo_prev",
          items       : 1
        },
        next : {
          button      : "#foo_next",
          items       : 1
        }
      });
    });
  </script>
<?php endif; ?>
<div class="clear"><br /></div>
<h2 class="top-20 underline">Déscription du logement <?php print $edit_link; ?></h2>
<div id="property-detail">
  <div class="one_half">
    <ul class="box_text">
      <li><span class="left">Prix nuitée</span><?php print !empty($node->field_prix_nuitee['und'][0]['value']) ? '<span class="blue fs-12">' . $node->field_prix_nuitee['und'][0]['value'] . ' DHS</span>' : 'non disponible'; ?></li>
      <li><span class="left">Superficie</span><?php print !empty($node->field_surface['und'][0]['value']) ? $node->field_surface['und'][0]['value'] . ' m²' : 'non disponible'; ?></li>
      <li><span class="left">Nombre de pièces</span><?php print !empty($node->field_nbr_chambres['und'][0]['value']) ? $node->field_nbr_chambres['und'][0]['value'] : 'non disponible'; ?></li>
    </ul>
  </div>
  <div class="clear"><br /><br /></div>
  <h3 class="desc"><span class="blue"><?php print $node->field_type_du_bien['und'][0]['taxonomy_term']->name; ?></span> pour location vacances à <span class="blue"><?php print $node->field_ville['und'][0]['taxonomy_term']->name; ?></span></h3>
  <p class="fs-12"><?php print str_replace("\n", '<br />', $node->field_description['und'][0]['value']); ?></p>
</div>
<div class="clear"><br /><br /></div>

<h2 class="underline">Annonceur <?php print $node->field_type_annonceur['und'][0]['taxonomy_term']->name; ?></h2>
<p class="fs-18 telephone"><?php print ($node->field_prenom['und'][0]['value']); ?> : <?php print ($node->field_tel['und'][0]['value']); ?></p>
<div class="clear"><br /></div>

<?php /*
  <h2 class="underline">Contacter l'annoceur</h2>
  <form method="post" action="" id="contact-information" />
  <fieldset>
  <ul>
  <li>
  <label>Votre nom et prénom</label><br />
  <input type="text" size="28" />
  </li>
  <li>
  <label>E-mail</label><br />
  <input type="text" size="28" />
  </li>
  </ul>
  <label>Message</label><br />
  <textarea cols="78" rows="3">Bonjour, je suis intéressé par votre offre …</textarea><br />
  <ul>
  <li>
  <label>Preferred Respons Time</label><br />
  <input type="text" size="28" />
  </li>
  <li>
  <label>Preferred Contact Time</label><br />
  <input type="text" size="28" />
  </li>
  </ul>
  <label>Estimated Timeframe for Buying or Selling</label><br />
  <input type="text" size="39" /><br /><br />
  <input type="submit" name="submit" class="button" value="Envoyer ma demande" /><br />
  </fieldset>
  </form>

  <?php if ($edit_link): ?>
  <p class="top-20"><?php print $edit_link; ?></p>
  <?php endif; ?>
  <div class="clear"><br /><br /></div>
 */ ?>

<h2 class="underline">Autres annonces location <?php print strtolower($node->field_type_du_bien['und'][0]['taxonomy_term']->name); ?> à <?php print $node->field_ville['und'][0]['taxonomy_term']->name; ?></h2>
<ul class="four_column_properties last-announcement">
  <li>
    <a title="Studio meublé au maarif" href="/annonce-location-vacances-maroc/casablanca/studio/studio-meuble-au-maarif-0"><img width="184" height="119" alt="Studio meublé au maarif" src="http://vacaumaroc.dev/sites/default/files/styles/thumb_184x119/public/img_annonces/studio-meuble-au-maarif_3.jpg" typeof="foaf:Image"></a>      <h3><a title="Studio meublé au maarif" href="/annonce-location-vacances-maroc/casablanca/studio/studio-meuble-au-maarif-0"><cufon class="cufon cufon-canvas" alt="Studio " style="width: 57px; height: 18px;"><canvas width="71" height="21" style="width: 71px; height: 21px; top: -2px; left: -1px;"></canvas><cufontext>Studio </cufontext></cufon><cufon class="cufon cufon-canvas" alt="meublé " style="width: 66px; height: 18px;"><canvas width="80" height="21" style="width: 80px; height: 21px; top: -2px; left: -1px;"></canvas><cufontext>meublé </cufontext></cufon><cufon class="cufon cufon-canvas" alt="au " style="width: 25px; height: 18px;"><canvas width="39" height="21" style="width: 39px; height: 21px; top: -2px; left: -1px;"></canvas><cufontext>au </cufontext></cufon><cufon class="cufon cufon-canvas" alt="maarif" style="width: 52px; height: 18px;"><canvas width="65" height="21" style="width: 65px; height: 21px; top: -2px; left: -1px;"></canvas><cufontext>maarif</cufontext></cufon></a></h3>
    <ul class="box_text">
      <li><span class="left">Ajouté il y a</span> 1 semaine 8 heures</li>
      <li><span class="left">Ville</span> Casablanca</li>
      <li><span class="left">Logement</span> Studio</li>
    </ul>
  </li>
  <li>
    <a title="Appartement meublé a louer marrakech" href="/annonce-location-vacances-maroc/marrackech/appartement/appartement-meuble-a-louer-marrakech"><img width="184" height="119" alt="Appartement meublé a louer marrakech" src="http://vacaumaroc.dev/sites/default/files/styles/thumb_184x119/public/img_annonces//appartement-meuble-a-louer-marrakech.jpg" typeof="foaf:Image"></a>      <h3><a title="Appartement meublé a louer marrakech" href="/annonce-location-vacances-maroc/marrackech/appartement/appartement-meuble-a-louer-marrakech"><cufon class="cufon cufon-canvas" alt="Appartement " style="width: 110px; height: 18px;"><canvas width="124" height="21" style="width: 124px; height: 21px; top: -2px; left: -1px;"></canvas><cufontext>Appartement </cufontext></cufon><cufon class="cufon cufon-canvas" alt="meublé " style="width: 66px; height: 18px;"><canvas width="80" height="21" style="width: 80px; height: 21px; top: -2px; left: -1px;"></canvas><cufontext>meublé </cufontext></cufon><cufon class="cufon cufon-canvas" alt="a " style="width: 15px; height: 18px;"><canvas width="29" height="21" style="width: 29px; height: 21px; top: -2px; left: -1px;"></canvas><cufontext>a </cufontext></cufon><cufon class="cufon cufon-canvas" alt="louer " style="width: 47px; height: 18px;"><canvas width="61" height="21" style="width: 61px; height: 21px; top: -2px; left: -1px;"></canvas><cufontext>louer </cufontext></cufon><cufon class="cufon cufon-canvas" alt="marrakech" style="width: 84px; height: 18px;"><canvas width="93" height="21" style="width: 93px; height: 21px; top: -2px; left: -1px;"></canvas><cufontext>marrakech</cufontext></cufon></a></h3>
    <ul class="box_text">
      <li><span class="left">Ajouté il y a</span> 1 semaine 8 heures</li>
      <li><span class="left">Ville</span> Marrackech</li>
      <li><span class="left">Logement</span> Appartement</li>
    </ul>
  </li>
  <li>
    <a title="Appartement meublé 250dh à agadir" href="/annonce-location-vacances-maroc/agadir/appartement/appartement-meuble-250dh-a-agadir"><img width="184" height="119" alt="Appartement meublé 250dh à agadir" src="http://vacaumaroc.dev/sites/default/files/styles/thumb_184x119/public/img_annonces//appartement-meuble-250dh-a-agadir.jpg" typeof="foaf:Image"></a>      <h3><a title="Appartement meublé 250dh à agadir" href="/annonce-location-vacances-maroc/agadir/appartement/appartement-meuble-250dh-a-agadir"><cufon class="cufon cufon-canvas" alt="Appartement " style="width: 110px; height: 18px;"><canvas width="124" height="21" style="width: 124px; height: 21px; top: -2px; left: -1px;"></canvas><cufontext>Appartement </cufontext></cufon><cufon class="cufon cufon-canvas" alt="meublé " style="width: 66px; height: 18px;"><canvas width="80" height="21" style="width: 80px; height: 21px; top: -2px; left: -1px;"></canvas><cufontext>meublé </cufontext></cufon><cufon class="cufon cufon-canvas" alt="250dh " style="width: 57px; height: 18px;"><canvas width="71" height="21" style="width: 71px; height: 21px; top: -2px; left: -1px;"></canvas><cufontext>250dh </cufontext></cufon><cufon class="cufon cufon-canvas" alt="à " style="width: 15px; height: 18px;"><canvas width="29" height="21" style="width: 29px; height: 21px; top: -2px; left: -1px;"></canvas><cufontext>à </cufontext></cufon><cufon class="cufon cufon-canvas" alt="agadir" style="width: 51px; height: 18px;"><canvas width="63" height="21" style="width: 63px; height: 21px; top: -2px; left: -1px;"></canvas><cufontext>agadir</cufontext></cufon></a></h3>
    <ul class="box_text">
      <li><span class="left">Ajouté il y a</span> 1 semaine 16 heures</li>
      <li><span class="left">Ville</span> Agadir</li>
      <li><span class="left">Logement</span> Appartement</li>
    </ul>
  </li>
</ul>

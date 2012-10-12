<h1 class="underline top-5"><?php print drupal_get_title(); ?> <span class="fs-15 blue"><?php print $total; ?> annonces trouvées</span></h1>
<?php foreach ($nodes as $key => $node): ?>
  <div id="annonce-<?php print $key; ?>" class="list_properties">
    <div class="title_property2">
      <?php print l('<h2>' . $node->title . '</h2>', 'node/' . $node->nid, array('html' => true, 'attributes' => array('title' => $node->title))); ?><span class="timer">Il y a <?php print format_interval(REQUEST_TIME - $node->created); ?> | <strong><?php print $node->field_vues['und'][0]['value']; ?></strong> vues</span>
    </div><!-- end .title_property2 -->
    <div class="clear"></div>
    <?php $img_uri = @$node->field_photos['und'][0]['uri']; ?>
    <?php
    if (empty($img_uri)) {
      $img_uri = 'public://no-photo.gif';
    }
    ?>
    <div class="list_img"><?php print l(theme('image_style', array('style_name' => 'thumb_131x85', 'path' => ($img_uri), 'alt' => $node->title)), 'node/' . $node->nid, array('html' => true, 'attributes' => array('title' => $node->title))); ?></div>
    <div class="list_text">
      <?php if ($node->field_type_annonceur['und'][0]['tid'] == 58): ?>
        <img src="/<?php print drupal_get_path('theme', 'vam'); ?>/images/content/pp-logo.gif" alt="" class="alignright" />
      <?php endif; ?>
      <strong class="blue"><?php print taxonomy_term_load($node->field_ville['und'][0]['tid'])->name; ?></strong>
      <?php if (!empty($node->field_prix_nuitee)): ?>
      <span class="prix-nuit blue"><span class="fs-15"><?php print $node->field_prix_nuitee['und'][0]['value']; ?> Dhs la nuitée</span></span>
      <?php endif; ?>
      <br />
      <?php print taxonomy_term_load($node->field_type_annonceur['und'][0]['tid'])->name; ?> | <?php print taxonomy_term_load($node->field_type_du_bien['und'][0]['tid'])->name; ?><br />
      <br />
      <?php $description = $node->field_description['und'][0]['value']; ?>
      <?php
      if (strlen($description) > 185) {
        $description = substr($description, 0, 182) . ' ...';
      }
      ?>
  <?php print $description; ?>
    </div><!-- end .list_text -->
    <div class="clear"></div>
  </div><!-- end .list_properties -->
<?php endforeach; ?>
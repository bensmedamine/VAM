<div class="title_featured">
  <h2>Les dernières annonces <span class="blue"><?php print $total; ?> en ligne</span></h2><a href="/locations-vacances-maroc" class="featured fs-12">Voir toutes les annonces locations vacances</a>
</div>
<ul class="four_column_properties last-announcement">
  <?php $i = 0; ?>
  <?php foreach ($nodes as $node): ?>
    <?php $i++; ?>
    <li <?php print $i == 4 || $i == 8 ? 'class="nomargin"' : ''; ?> <?php print $i == 5 ? 'class="clearboth"' : ''; ?>>
      <?php print l(theme('image_style', array('style_name' => 'thumb_184x119', 'path' => ($node->field_photos['und'][0]['uri']), 'alt' => $node->title)), 'node/' . $node->nid, array('html' => true, 'attributes' => array('title' => $node->title))); ?>
      <h3 ><?php print l($node->title, 'node/' . $node->nid, array('html' => true, 'attributes' => array('title' => $node->title))); ?></h3>
      <ul class="box_text">
        <?php /* if (!empty($node->field_prix_nuitee['und'][0]['value'])): ?>
          <li class="transform" style="font-size: 16px; color: #000000; text-align: left !important;"><?php print $node->field_prix_nuitee['und'][0]['value']; ?> DHS la nuitée</li>
        <?php endif; */ ?>
        <li><span class="left">Ajouté il y a</span> <?php print format_interval(REQUEST_TIME - $node->created); ?></li>
        <li><span class="left">Ville</span> <?php print taxonomy_term_load($node->field_ville['und'][0]['tid'])->name; ?></li>
        <li><span class="left">Logement</span> <?php print taxonomy_term_load($node->field_type_du_bien['und'][0]['tid'])->name; ?></li>
      </ul>
    </li>
  <?php endforeach; ?>
</ul>
<!-- BEGIN SLIDE -->
<div id="slider_container">
  <div id="slideshow_navigation">
    <div id="pager"></div>
  </div><!-- end slideshow navigation -->
  <div id="slideshow">  
    <?php foreach ($villes as $ville): ?>
      <?php $ville = taxonomy_term_load($ville->tid); ?>
      <div class="cycle">
        <img src="<?php print file_create_url($ville->field_image['und'][0]['uri']) ?>" alt="Locations vacances <?php print $ville->name; ?>" />
        <div class="farme-slide-text">
          <ul class="slide-text">
            <div class="slider-city"><?php print $ville->name; ?> <span class="blue"><?php print get_count_annonces_par_ville($ville->tid); ?> annonces</span></div>
            <?php $annonces_ville = get_annonces_par_ville($ville->tid, 5); ?>
            <?php foreach ($annonces_ville as $annonce): ?>
            <li class="arrow"><span class="left"><a href="<?php print url('node/'.$annonce->nid); ?>" title="<?php print $annonce->title; ?>"><?php print $annonce->title; ?></a></span>&nbsp;</li>
            <?php endforeach; ?>
          </ul>
          <div class="frame-price">
            <div class="slider-button"><a href="<?php print url('taxonomy/term/' . $ville->tid); ?>" title="Voir toutes les locations vacances <?php print $ville->name; ?>">Voir toutes les locations vacances <?php print $ville->name; ?></a></div>
          </div>
        </div>
      </div><!-- end cycle -->

    <?php endforeach; ?>


  </div><!-- end #slideshow -->
</div><!-- end #slide -->
<!-- END OF SLIDE -->
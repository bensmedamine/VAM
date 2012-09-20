
<div id="top-container">
  <div class="centercolumn">
    <div id="header">
      <div id="logo">
        <h1><a href="/"><img src="/<?php print drupal_get_path('theme', 'vam'); ?>/images/logo.png" alt="Locations vacances au Maroc" /></a></h1>
      </div><!-- end #logo -->
      <div id="navigation">
        <?php print render($page['menu']); ?>
      </div><!-- end #navigation-->
      <div class="clr"></div>
    </div><!-- end #header -->
  </div><!-- end #centercolumn -->
</div><!-- end #top-container -->


<div class="centercolumn">

  <?php print render($page['villes_slider']); ?>

  <div id="maincontent">
    <div id="content" class="full">
      <?php print render($page['accroches']); ?>
      <br class="clear" />
      <br />
      <br />

      <?php print render($page['last_announcements']); ?>

    </div><!-- end #content -->
    <div class="clear"></div>
  </div><!-- end #maincontent -->
</div><!-- end #centercolumn -->


<div id="bottom-container">
  <div class="centercolumn">

    <?php print render($page['vam_footer']); ?>
  </div><!-- end #centercolumn -->

  <div class="clear"></div>


  <div id="vam-footer">
    <div class="centercolumn">
      <div id="copyright"><a href="/" title="Vacaumaroc.com">Vacaumaroc.com</a> © 2012.</div>

      <p style="font-size: 18px;">Vous cherchez une location de vacances au Maroc ?<br />
      <span style="font-size: 15px;">Lorem ipsum dolor sit amet</span></p>
    </div>

  </div>


</div><!-- end #bottom-container -->


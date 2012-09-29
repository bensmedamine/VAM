<div id="footer">
  <div id="footer-left">
    <div class="one_third">
      <ul>
        <li class="widget-container">
          <h2 class="widget-title">Plan du site</h2>
          <ul>
            <li><a href="/" title="Accueil">Accueil</a></li>
            <li><a href="/locations-vacances-maroc" title="Locations vacances au Maroc">Locations vacances</a></li>
            <li><a href="/deposer-une-annonce" title="Déposer une annonce">Déposer une annonce</a></li>
            <li><a href="/inscription" title="Inscription">Inscription</a></li>
            <li><a href="/mon-compte" title="Mon compte">Mon compte</a></li>
            <li><a href="#" title="Contactez-nous">Contactez-nous</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- end #one_fourth -->
    <div class="one_half last">
      <ul>
        <li class="widget-container locations-par-villes">
          <h2 class="widget-title">Top <?php print count($villes); ?> villes destinations vacances au Maroc</h2>
          <ul>
            <?php foreach ($villes as $ville): ?>
              <?php
              /*
                echo '<pre>';
                print_r($ville);
                echo '</pre>';
                die('DEBUG MODE'); */
              ?>
              <?php $name = taxonomy_term_load($ville->tid)->name; ?>
              <li><?php print l($name . ' <span class="count blue">(' . $ville->total . ')</span>', 'taxonomy/term/' . $ville->tid, array('html' => true, 'attributes' => array('title' => $name))); ?></li>
            <?php endforeach; ?>
          </ul>
        </li>
      </ul>
    </div><!-- end #one_fourth -->

  </div><!-- end #footer-left -->
  <div id="footer-right">
    <h2>Suivez-nous sur facebook</h2>
    <img src="/<?php print drupal_get_path('theme', 'vam'); ?>/images/300x250.gif" alt="" />
    <h2>Restez informer sur les nouvelles locations<br /> vacances au Maroc. <span class="blue">Inscription gratuite !</span></h2>
    <form method="get" action="" id="newsLetter" />
    <div><input type="text" class="inputbox" value="Saisissez votre adresse mail..." onblur="if (this.value == ''){this.value = 'Saisissez votre adresse mail...'; }" onfocus="if (this.value == 'Saisissez votre adresse mail...') {this.value = ''; }" /><br />
      <input type="submit" name="submit" class="button" value="Inscription" /></div>
    </form>
  </div><!-- end #footer-right -->
</div><!-- end #footer -->

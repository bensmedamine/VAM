<li class="widget-container widget_categories tableau-de-bord">
  <h2 class="widget-title">Accès rapide</h2>
  <ul>
    <li><a href="/mon-compte" title="Mon compte"><img src="/<?php print $theme_path; ?>/images/user_16.png" style="vertical-align: sub;" /> <span class="fs-12 blue"><?php print $user_name; ?></span></a></li>
    <li><a href="<?php print url('modifier-mes-coordonnees'); ?>" title="Modifier mes coordonnées"><span class="blue">&rarr;</span> Modifier mes coordonnées</a></li>
    <li><a href="#" title="Modifier les coordonnées de Pyxi"><span class="blue">&rarr;</span> Modifier les coordonnées  de Pyxi</a></li>
    <?php if (arg(0) != 'deposer-une-annonce'): ?>
      <li><a href="/deposer-une-annonce" title="Déposer une annonce"><span class="blue">&rarr;</span> Déposer une annonce</a></li>
    <?php endif; ?>
    <?php if (arg(0) != 'annonces-manager'): ?>
      <li><a href="/annonces-manager" title="Mes annones manager"><span class="blue">&rarr;</span> Mes annones manager</a></li>
    <?php endif; ?>
    <li><a href="/user/logout" title="Se déconnecter"><span class="blue">&rarr;</span> Se déconnecter</a></li>
  </ul>
</li>


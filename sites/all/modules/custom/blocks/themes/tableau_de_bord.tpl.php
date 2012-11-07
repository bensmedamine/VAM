<li class="widget-container widget_categories tableau-de-bord">
  <h2 class="widget-title">Accès rapide</h2>
  <ul>
    <li><a href="<?php print url('mon-compte'); ?>" title="Mon compte"><img src="<?php print url($theme_path . '/images/user_16.png') ?>" style="vertical-align: sub;" /> <span class="fs-12 blue"><?php print $user_name; ?></span></a></li>
    <li><a href="<?php print url('modifier-mes-coordonnees'); ?>" title="Modifier mes coordonnées"><span class="blue">&rarr;</span> Modifier mes coordonnées</a></li>
    <?php if ($user->field_type_annonceur[LANGUAGE_NONE][0]['tid'] == 58): ?>
      <li><a href="<?php print url('modifier-informations-agence'); ?>" title="Modifier les informations de <?php print ucfirst($user->field_nom_agence[LANGUAGE_NONE][0]['value']); ?>"><span class="blue">&rarr;</span> Modifier les informations de <?php print ucfirst($user->field_nom_agence[LANGUAGE_NONE][0]['value']); ?></a></li>
    <?php endif; ?>
    <?php if (arg(0) != 'deposer-une-annonce'): ?>
      <li><a href="<?php print url('deposer-une-annonce'); ?>" title="Déposer une annonce"><span class="blue">&rarr;</span> Déposer une annonce</a></li>
    <?php endif; ?>
    <?php if (arg(0) != 'annonces-manager'): ?>
      <li><a href="<?php print url('annonces-manager'); ?>" title="Mes annones manager"><span class="blue">&rarr;</span> Mes annones manager</a></li>
    <?php endif; ?>
    <li><a href="<?php print url('user/logout'); ?>" title="Se déconnecter"><span class="blue">&rarr;</span> Se déconnecter</a></li>
  </ul>
</li>
<li class="widget-container widget_categories tableau-de-bord">
  <h2 class="widget-title">Accès rapide</h2>
  <ul>
    <li><a href="/user/logout" title="Se déconnecter"><span class="blue">&rarr;</span> Se déconnecter</a></li>
    <?php if (arg(0) != 'deposer-une-annonce'): ?>
      <li><a href="/deposer-une-annonce" title="Déposer une annonce"><span class="blue">&rarr;</span> Déposer une annonce</a></li>
    <?php endif; ?>
    <?php if (arg(0) != 'annonces-manager'): ?>
      <li><a href="/annonces-manager" title="Mes annones manager"><span class="blue">&rarr;</span> Mes annones manager</a></li>
    <?php endif; ?>
  </ul>
</li>


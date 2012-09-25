
<?php if (!user_is_logged_in()): ?>
  <p class="fs-12"><strong class="blue">Seuls les membres authentifiés peuvent déposer une annonce !</strong></p>
  <p class="fs-12"><span class="blue">&rarr;</span> Vous avez déjà un compte? veuillez vous authentifier sur la page <a href="/mon-compte" title="Mon compte">Mon compte</a>.</p>
  <p class="fs-12"><span class="blue">&rarr;</span> <strong>Vous n’avez pas encore un compte ?</strong><br /> veuillez vous inscrire en seulement <strong>2</strong> minutes en suivant ce <a href="/inscription" title="Inscription">lien</a>.</p>

<?php else: ?>
  <p>bens prod</p>

<?php endif; ?>

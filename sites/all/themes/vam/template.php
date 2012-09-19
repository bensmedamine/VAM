<?php

/**
 * unset css in vam theme.
 */
function vam_css_alter(&$css) {
  $exclude = array(
    //'misc/ui/jquery.ui.tabs.css' => FALSE,
    'modules/system/system.menus.css' => FALSE,
    'modules/system/system.theme.css' => FALSE,
    'misc/ui/jquery.ui.theme.css' => FALSE,
  );
  $css = array_diff_key($css, $exclude);
}

?>

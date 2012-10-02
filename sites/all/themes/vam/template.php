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
    'modules/comment/comment.css' => FALSE,
    'modules/logintoboggan/logintoboggan.css' => FALSE,
    'modules/ctools/css/ctools.css' => FALSE,
  );
  $css = array_diff_key($css, $exclude);
}

function vam_breadcrumb($variables) {
  $breadcrumb = $variables['breadcrumb'];

  // Adding the title of the current page to the breadcrumb.
  if (arg(0) == 'node') {
    $node = node_load(arg(1));
    if ($node->type == 'annonce') {
      $breadcrumb[] = l('Location vacances', 'locations-vacances-maroc', array('attributes' => array('title' => 'Location vacances Maroc')));
      $breadcrumb[] = taxonomy_term_load($node->field_ville['und'][0]['tid'])->name;
      $breadcrumb[] = taxonomy_term_load($node->field_type_du_bien['und'][0]['tid'])->name;
      $breadcrumb[] = drupal_get_title();
    }
  }

  if (empty($breadcrumb[1])) {
    $breadcrumb[] = drupal_get_title();
  }


  if (!empty($breadcrumb)) {
    // Provide a navigational heading to give context for breadcrumb links to
    // screen-reader users. Make the heading invisible with .element-invisible.
    $last = array_pop($breadcrumb);
    $output = 'Vous êtes ici : ';
    if (!empty($breadcrumb)) {
      $output .= implode(" » ", $breadcrumb);
      $output .= '<span class="last">  » ' . $last . "</span>";
    }
    else {
      $output .= '<span class="last">' . $last . "</span>";
    }

    return $output;
  }
}

function vam_preprocess_html(&$vars) {
  if ($vars['is_front']) {
    //Le module Metatag doit être installé et les champs (title, description et keywords) doivent être renseignés !
    $vars['head_title'] = $vars['page']['content']['metatags']['global:frontpage']['title']['#attached']['metatag_set_preprocess_variable'][1][2]['title'];
    unset($vars['page']['content']['metatags']['global:frontpage']['title']);
    $vars['metatags'] = $vars['page']['content']['metatags']['global:frontpage'];
  }
}

?>

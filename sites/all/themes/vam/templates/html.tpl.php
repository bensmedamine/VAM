<?php
/**
 * @file
 * Default theme implementation to display the basic html structure of a single
 * Drupal page.
 *
 * Variables:
 * - $css: An array of CSS files for the current page.
 * - $language: (object) The language the site is being displayed in.
 *   $language->language contains its textual representation.
 *   $language->dir contains the language direction. It will either be 'ltr' or 'rtl'.
 * - $rdf_namespaces: All the RDF namespace prefixes used in the HTML document.
 * - $grddl_profile: A GRDDL profile allowing agents to extract the RDF data.
 * - $head_title: A modified version of the page title, for use in the TITLE
 *   tag.
 * - $head_title_array: (array) An associative array containing the string parts
 *   that were used to generate the $head_title variable, already prepared to be
 *   output as TITLE tag. The key/value pairs may contain one or more of the
 *   following, depending on conditions:
 *   - title: The title of the current page, if any.
 *   - name: The name of the site.
 *   - slogan: The slogan of the site, if any, and if there is no title.
 * - $head: Markup for the HEAD section (including meta tags, keyword tags, and
 *   so on).
 * - $styles: Style tags necessary to import all CSS files for the page.
 * - $scripts: Script tags necessary to load the JavaScript files and settings
 *   for the page.
 * - $page_top: Initial markup from any modules that have altered the
 *   page. This variable should always be output first, before all other dynamic
 *   content.
 * - $page: The rendered page content.
 * - $page_bottom: Final closing markup from any modules that have altered the
 *   page. This variable should always be output last, after all other dynamic
 *   content.
 * - $classes String of classes that can be used to style contextually through
 *   CSS.
 *
 * @see template_preprocess()
 * @see template_preprocess_html()
 * @see template_process()
 */
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN"
  "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">
<html xmlns:fb="http://www.facebook.com/2008/fbml" xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language; ?>" version="XHTML+RDFa 1.0" dir="<?php print $language->dir; ?>"<?php print $rdf_namespaces; ?>>

  <head profile="<?php print $grddl_profile; ?>">
    <?php print $head; ?>
    <title><?php print $head_title; ?></title>
    <?php print $styles; ?>
    <?php print $scripts; ?>
    <script type="text/javascript">
      Cufon.replace('h1') ('h2') ('h3') ('h4') ('h5') ('h6') ('.slider-button a') ('.slider-city') ('.button') ('#navigation li a', {hover: true});
    </script>
    <script type="text/javascript"> 
      var $jts = jQuery.noConflict();
      $jts(document).ready(function(){ 
        $jts("ul.menu").supersubs({ 
          minWidth		: 9,		// requires em unit.
          maxWidth		: 25,		// requires em unit.
          extraWidth		: 0			// extra width can ensure lines don't sometimes turn over due to slight browser differences in how they round-off values
          // due to slight rounding differences and font-family 
        }).superfish();  // call supersubs first, then superfish, so that subs are 
        // not display:none when measuring. Call before initialising 
        // containing tabs for same reason. 
      }); 
 
    </script>
    <script type="text/javascript">
      var $jts = jQuery.noConflict();
      $jts(document).ready(function(){ 
		
        //Slider  
        $jts('#slideshow').cycle({
          timeout: 5000,  // milliseconds between slide transitions (0 to disable auto advance)
          fx:      'fade', // choose your transition type, ex: fade, scrollUp, shuffle, etc...            
          pager:   '#pager',  // selector for element to use as pager container
          pause:   0,	  // true to enable "pause on hover"
          pauseOnPagerHover: 0 // true to pause when hovering over pager link
        });
      });
    </script>

    <!--[if IE 6]>
    <script src="js/DD_belatedPNG.js"></script>
    <script>
      DD_belatedPNG.fix('img');
    </script>
    
    <![endif]--> 
  </head>
  <body class="<?php print $classes; ?>" <?php print $attributes; ?>>
    <?php print $page_top; ?>
    <?php print $page; ?>
    <?php print $page_bottom; ?>
    <script type="text/javascript"> Cufon.now(); </script> <!-- to fix cufon problems in IE browser -->
  </body>
</html>

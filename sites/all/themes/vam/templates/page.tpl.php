<?php
/**
 * @file
 * Bartik's theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template normally located in the
 * modules/system directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 * - $hide_site_name: TRUE if the site name has been toggled off on the theme
 *   settings page. If hidden, the "element-invisible" class is added to make
 *   the site name visually hidden, but still accessible.
 * - $hide_site_slogan: TRUE if the site slogan has been toggled off on the
 *   theme settings page. If hidden, the "element-invisible" class is added to
 *   make the site slogan visually hidden, but still accessible.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['header']: Items for the header region.
 * - $page['featured']: Items for the featured region.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['triptych_first']: Items for the first triptych.
 * - $page['triptych_middle']: Items for the middle triptych.
 * - $page['triptych_last']: Items for the last triptych.
 * - $page['footer_firstcolumn']: Items for the first footer column.
 * - $page['footer_secondcolumn']: Items for the second footer column.
 * - $page['footer_thirdcolumn']: Items for the third footer column.
 * - $page['footer_fourthcolumn']: Items for the fourth footer column.
 * - $page['footer']: Items for the footer region.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 * @see bartik_process_page()
 * @see html.tpl.php
 */
?>
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
  <?php if ($breadcrumb): ?>
    <div id="breadcrumb"><?php print render($breadcrumb); ?></div>
  <?php endif; ?>
  <div id="maincontent">
    <div id="content">
      <h2 class="underline"><?php print $title; ?></h2>

      <?php print render($page['content']); ?>

      <div class="clear"></div>

    </div><!-- end #content -->

    <div class="sidebar_right">
      <div class="sidebar">
        <ul>				
          <li class="widget-container widget_categories">
            <h2 class="widget-title">Categories</h2>
            <ul>
              <li><a href="#">Resources</a></li>
              <li><a href="#">House Remodeling</a></li>
              <li><a href="#">Luxury Homes</a></li>
              <li><a href="#">Find a Contractor</a></li>
              <li><a href="#">First Time Buyer</a> </li>
              <li><a href="#">Free Moving Quote</a></li>
              <li><a href="#">Gardening</a></li>
              <li><a href="#">Local Constractors</a></li>
              <li><a href="#">Rent and Buy</a></li>

              <li><a href="#">New Homes</a></li>
              <li><a href="#">Apartment Rentals</a></li>
              <li><a href="#">Trend Blogs</a></li>
              <li><a href="#">Assisted Living</a></li>
              <li><a href="#">Property Search</a></li>
              <li><a href="#">Property Status</a></li>
              <li><a href="#">Property Types</a></li>
              <li><a href="#">Open Houses</a></li>
              <li><a href="#">Listing Activity</a></li>
            </ul>
          </li>

          <li class="widget-container widget_categories">
            <h2 class="widget-title">Property Types</h2>
            <ul>
              <li><a href="#">Single Family Home</a></li>
              <li><a href="#">Commercial </a></li>
              <li><a href="#">Condo/TownHome</a></li>
              <li><a href="#">RowHome/Co-Op</a></li>
            </ul>
          </li>

          <li class="widget-container widget_categories">
            <h2 class="widget-title">Property Features</h2>
            <ul>
              <li><a href="#">Any</a></li>
              <li><a href="#">Central Air</a></li>
              <li><a href="#">Carport</a></li>
              <li><a href="#">Dinning Room</a></li>
              <li><a href="#">Fireplace</a> </li>
              <li><a href="#">Swimming Pool</a></li>
              <li><a href="#">Forced Air</a></li>
              <li><a href="#">Garage - 1 or more</a></li>
              <li><a href="#">Hardwood Floors</a></li>
              <li><a href="#">Family Room</a></li>
            </ul>
          </li>

        </ul>
      </div><!-- end #sidebar -->
    </div><!-- end #sidebar_right -->

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
      <?php print render($page['vam_txt_referencement']); ?>
    </div>
  </div>

</div><!-- end #bottom-container -->

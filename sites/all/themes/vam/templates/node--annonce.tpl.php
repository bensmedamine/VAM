<?php
/**
 * @file
 * Default theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all,
 *   or print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct url of the current node.
 * - $display_submitted: Whether submission information should be displayed.
 * - $submitted: Submission information created from $name and $date during
 *   template_preprocess_node().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type, i.e., "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser
 *     listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type, i.e. story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode, e.g. 'full', 'teaser'...
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined, e.g. $node->body becomes $body. When needing to access
 * a field's raw values, developers/themers are strongly encouraged to use these
 * variables. Otherwise they will have to explicitly specify the desired field
 * language, e.g. $node->body['en'], thus overriding any language negotiation
 * rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 */
drupal_add_css(drupal_get_path('theme', 'vam') . '/css/inner.css');
?>

<?php /* echo '<pre>';
  print_r($node->field_photos['und']);
  echo '</pre>';
  die('DEBUG MODE'); */ ?>


<?php /* <div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <?php print $user_picture; ?>

  <?php print render($title_prefix); ?>
  <?php if (!$page): ?>
  <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
  <?php endif; ?>
  <?php print render($title_suffix); ?>

  <?php if ($display_submitted): ?>
  <div class="submitted">
  <?php print $submitted; ?>
  </div>
  <?php endif; ?>

  <div class="content"<?php print $content_attributes; ?>>
  <?php
  // We hide the comments and links now so that we can render them later.
  hide($content['comments']);
  hide($content['links']);
  print render($content);
  ?>
  </div>

  <?php print render($content['links']); ?>

  <?php print render($content['comments']); ?>

  </div> */ ?>





<!-- BEGIN SLIDE -->
<div id="slider_annonces_container">

  <div id="slideshow">  
    <?php foreach ($node->field_photos['und'] as $img): ?>
      <div class="cycle">
        <?php print theme('image_style', array('style_name' => 'thum500x366', 'path' => ($img['uri']), 'alt' => $node->title)); ?>
      </div><!-- end cycle -->
    <?php endforeach; ?>
  </div><!-- end #slideshow -->
  
  <div id="slideshow_navigation">
    <div id=""></div>
  </div><!-- end slideshow navigation -->
</div><!-- end #slide -->
<!-- END OF SLIDE -->







<div class="clear"><br /><br /></div>

<h2 class="underline">Description du logement</h2>
<div id="property-detail">
  <div class="one_half">
    <ul class="box_text">
      <li><span class="left">Prix nuitée	</span>			5 bed</li>
      <li><span class="left">Type de logement</span>			2,700 sq ft</li>
      <li><span class="left">Ville</span>				$ 2,200,000</li>
      <li><span class="left">Nombre de chambres</span>		Single Family Home</li>
      <li><span class="left">Neighbothood	</span>	Not Available</li>
      <li><span class="left">Stories</span>			Not Available</li>
    </ul>	
  </div>
  <div class="one_half last">
    <ul class="box_text">
      <li><span class="left">Baths</span>				7 bath</li>
      <li><span class="left">Lot Size	</span>			0,19 Acres</li>
      <li><span class="left">Price/sqft</span>				$ 688</li>
      <li><span class="left">Year Built</span>				1980</li>
      <li><span class="left">Style</span>					Villa</li>
      <li><span class="left">Garage</span>				2</li>
    </ul>	
  </div>
  <ul class="box_text">
    <li><span class="left">Property Features	</span>	<span class="right">Status: Active, Area: Las Vegas, View, 2 convered parking, Cooling Features, Community Security, Lot Features: Back yard, fenced yard, front yard,wall street, other structural features, Parking Features: Gated, Garage Is Detached, Side by side, Country: Las Vegas, Approximately 6000 acre(s), 7 total full bath(s), Pool Features: Heated, 2 car garage(s), View: Pool View, Lot size is 20 or more acres, Zoning: LAR1, Swimming pool(s), Dinning room, Den,Hardwood floors, Living Room.</span></li>
    <li><span class="left">Fireplace Features</span> <span class="right">Gas Fuel, LOCATION: Living Room, Master Badroom</span></li>
    <li><span class="left">Heating Features</span> <span class="right">HEATING TYPE: Central Furnace, Yes</span></li>
    <li><span class="left">Ex. Construction	</span> <span class="right">Stucco</span></li>
    <li><span class="left">Roofing	</span> <span class="right">Tile</span></li>
    <li><span class="left">Interior Features</span><span class="right">	Built-In Gas Range, Cooktop - Gas, Gas Grill, Microwave, Carpet Flooring, Mixed 					Flooring Materials, Tile Flooring, 220V Throughout, Crown Moldings, High Ceilings (9 Feet+), Hot Tub, Security System - Owned, DINING ROOM/AREA FEATURES: Breakfast Counter / Bar, Country Kitchen, Formal Dining Rm, Living Room, KITCHEN FEATURES: Counter Top, Island, BATHROOM FEATURES: Dual Entry (Jack &amp; Jill) Bath, BEDROOM FEATURES: Master Suite, LAUNDRY LOCATION: 					Inside </span></li>
    <li><span class="left">Exterior Features</span>	<span class="right">Private Spa, Front Sprinkler, Rear Sprinkler, Sprinkler System, Concrete Slab Patio, Deck(s), Enclosed Patio, Porch - Front</span></li>
  </ul>	
</div>

<div class="clear"><br /><br /></div>

<h2 class="underline">Annonceur particulier</h2>
<?php /* <iframe width="620" height="353" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=222+North+Canon+Drive+%23202,+Beverly+Hills+&amp;aq=&amp;sll=34.066623,-118.386612&amp;sspn=0.005022,0.011362&amp;ie=UTF8&amp;hq=&amp;hnear=222+N+Canon+Dr,+Beverly+Hills,+Los+Angeles,+California+90210&amp;ll=34.068423,-118.398505&amp;spn=0.020085,0.045447&amp;z=14&amp;output=embed"></iframe><br /><small><a href="http://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=222+North+Canon+Drive+%23202,+Beverly+Hills+&amp;aq=&amp;sll=34.066623,-118.386612&amp;sspn=0.005022,0.011362&amp;ie=UTF8&amp;hq=&amp;hnear=222+N+Canon+Dr,+Beverly+Hills,+Los+Angeles,+California+90210&amp;ll=34.068423,-118.398505&amp;spn=0.020085,0.045447&amp;z=14" style="color:#0000FF;text-align:left">View Larger Map</a></small> */ ?>

<div class="clear"><br /><br /></div>

<h2 class="underline">Contact Informations</h2>
<form method="post" action="" id="contact-information" />
<fieldset>
  <ul>
    <li>
      <label>My First Name</label><br />
      <input type="text" size="28" />
    </li>
    <li>
      <label>My Last Name</label><br />
      <input type="text" size="28" />
    </li>
  </ul>
  <label>My Email</label><br />
  <input type="text" size="39" /><br />
  <label>My Number (optional)</label><br />
  <input type="text" size="39" /><br />
  <label>Type of Information</label><br />
  <input type="text" size="109" /><br />
  <label>Questions &amp; Comments (optional)</label><br />
  <textarea cols="78" rows="3"> </textarea><br />
  <ul>
    <li>
      <label>Preferred Respons Time</label><br />
      <input type="text" size="28" />
    </li>
    <li>
      <label>Preferred Contact Time</label><br />
      <input type="text" size="28" />
    </li>
  </ul>
  <label>Estimated Timeframe for Buying or Selling</label><br />
  <input type="text" size="39" /><br /><br />
  <input type="submit" name="submit" class="button" value="request more details" /><br />
  <small>We will never share your personal information. <a href="#">Privacy Policy</a></small>
</fieldset>
</form>


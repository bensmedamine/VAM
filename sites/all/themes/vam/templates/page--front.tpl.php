
<div id="top-container">
  <div class="centercolumn">
    <div id="header">
      <div id="logo">
        <a href="/"><img src="/<?php print drupal_get_path('theme', 'vam'); ?>/images/logo.png" alt="" /></a>
      </div><!-- end #logo -->
      <div id="navigation">
        <?php print render($page['menu']); ?>
      </div><!-- end #navigation-->
      <div class="clr"></div>
    </div><!-- end #header -->
  </div><!-- end #centercolumn -->
</div><!-- end #top-container -->


<div class="centercolumn">

  <?php print render($page['villes_slider']); ?>

  <div id="maincontent">
    <div id="content" class="full">
      <ul class="three_column">
        <li>
          <h2 class="underline"><span class="blue">Rentabilisez</span> votre bien !</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut quis ligula velit. Etiam odio quam, lobortis eget porttitor nec, congue in lacus. In venenatis neque a eros laoreet eu placerat erat suscipit. Fusce cursus, erat ut scelerisque condimentum, quam odio ultrices leo. </p>
        </li>
        <li>
          <h2 class="underline">Customer <span class="blue">Features</span></h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut quis ligula velit. Etiam odio quam, lobortis eget porttitor nec, congue in lacus. In venenatis neque a eros laoreet eu placerat erat suscipit. Fusce cursus, erat ut scelerisque condimentum, quam odio ultrices leo. </p>
        </li>
        <li class="nomargin">
          <h2 class="underline">Helpful <span class="blue">Services</span></h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut quis ligula velit. Etiam odio quam, lobortis eget porttitor nec, congue in lacus. In venenatis neque a eros laoreet eu placerat erat suscipit. Fusce cursus, erat ut scelerisque condimentum, quam odio ultrices leo. </p>
        </li>
      </ul>
      <br class="clear" />
      <br />
      <br />
      <div class="title_featured">
        <h2>Featured Home <span class="blue">For Sale</span></h2><a href="property-grid.html" class="featured">all featured home</a>
      </div>

      <ul class="four_column_properties">
        <li>
          <img src="/<?php print drupal_get_path('theme', 'vam'); ?>/images/content/pp-img1.jpg" alt="" />
          <h6><a href="#">4545 Sabadell St<br />
              Las Vegas, NV 89212</a></h6>
          <ul class="box_text">
            <li><span class="left">Beds:</span> 7 bed</li>
            <li><span class="left">Baths:</span> 5 bath</li>
            <li><span class="left">House size:</span> 2,700 Sq Ft</li>
            <li><span class="left">Lot size:</span> 0.19 Acres</li>
          </ul>				
        </li>
        <li>
          <img src="/<?php print drupal_get_path('theme', 'vam'); ?>/images/content/pp-img2.jpg" alt="" />
          <h6><a href="#">8311 Paseo Vista Dr<br />
              Las Vegas, NV 89312</a></h6>
          <ul class="box_text">
            <li><span class="left">Beds:</span> 7 bed</li>
            <li><span class="left">Baths:</span> 5 bath</li>
            <li><span class="left">House size:</span> 2,700 Sq Ft</li>
            <li><span class="left">Lot size:</span> 0.19 Acres</li>
          </ul>				
        </li>
        <li>
          <img src="/<?php print drupal_get_path('theme', 'vam'); ?>/images/content/pp-img3.jpg" alt="" />
          <h6><a href="#">2357 Golden Aster St<br />
              Clermont, FL 3475</a></h6>
          <ul class="box_text">
            <li><span class="left">Beds:</span> 7 bed</li>
            <li><span class="left">Baths:</span> 5 bath</li>
            <li><span class="left">House size:</span> 2,700 Sq Ft</li>
            <li><span class="left">Lot size:</span> 0.19 Acres</li>
          </ul>				
        </li>
        <li class="nomargin">
          <img src="/<?php print drupal_get_path('theme', 'vam'); ?>/images/content/pp-img4.jpg" alt="" />
          <h6><a href="#">1427 Stadium Ave<br />
              Bronx, NY 10567</a></h6>
          <ul class="box_text">
            <li><span class="left">Beds:</span> 7 bed</li>
            <li><span class="left">Baths:</span> 5 bath</li>
            <li><span class="left">House size:</span> 2,700 Sq Ft</li>
            <li><span class="left">Lot size:</span> 0.19 Acres</li>
          </ul>		
        </li>
      </ul>

    </div><!-- end #content -->
    <div class="clear"></div>
  </div><!-- end #maincontent -->
</div><!-- end #centercolumn -->


<div id="bottom-container">
  <div class="centercolumn">

    <div id="footer">
      <div id="footer-left">
        <div class="one_fourth">
          <ul>
            <li class="widget-container">
              <h2 class="widget-title">Company</h2>
              <ul>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Clients</a></li>
                <li><a href="#">Presentation</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- end #one_fourth -->
        <div class="one_fourth">
          <ul>
            <li class="widget-container">
              <h2 class="widget-title">For Clients</h2>
              <ul>
                <li><a href="#">Sign Up </a></li>
                <li><a href="#">Forum</a></li>
                <li><a href="#">Promitions</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- end #one_fourth -->
        <div class="one_fourth">
          <ul>
            <li class="widget-container">
              <h2 class="widget-title">FAQs</h2>
              <ul>
                <li><a href="#">Support </a></li>
                <li><a href="#">FAQs</a></li>
                <li><a href="#">Website</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- end #one_fourth -->
        <div class="one_fourth last">
          <ul>
            <li class="widget-container">
              <h2 class="widget-title">Properties</h2>
              <ul>
                <li><a href="#">Luxury</a></li>
                <li><a href="#">Residental</a></li>
                <li><a href="#">Commercial</a></li>
                <li><a href="#">Hometown</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- end #one_fourth -->
      </div><!-- end #footer-left -->
      <div id="footer-right">
        <h2>NewsLetter Sign Up:</h2>
        <form method="get" action="" id="newsLetter" />
        <div><input type="text" class="inputbox" value="Enter your email here..." onblur="if (this.value == ''){this.value = 'Enter your email here...'; }" onfocus="if (this.value == 'Enter your email here...') {this.value = ''; }" /><br />
          <input type="submit" name="submit" class="button" value="subscribe" /></div>
        </form>
      </div><!-- end #footer-right -->
    </div><!-- end #footer -->
    <div class="clear"></div>
    <div id="copyright">Copyright © 2011 <a href="#">Light House</a>. All Rights Reserved</div>

    <div class="clear"></div>
  </div><!-- end #centercolumn -->

</div><!-- end #bottom-container -->


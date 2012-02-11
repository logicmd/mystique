<?php

/*
 * @template  Mystique
 * @revised   December 20, 2011
 * @author    digitalnature, http://digitalnature.eu
 * @license   GPL, http://www.opensource.org/licenses/gpl-license
 */

// Document footer.
// This is a template part which is displayed on every page of the website.

?>

         </div>
       </div>
       <!-- /main -->

       <?php atom()->action('after_main'); ?>

       <?php if(atom()->MenuExists('footer')): ?>
       <div class="nav nav-footer page-content">
          <?php atom()->Menu($location = 'footer', $class = 'slide-up'); ?>
       </div>
       <?php endif; ?>

       <!-- footer -->
       <div class="shadow-left page-content">
         <div class="shadow-right">

           <div id="footer">

             <?php if(($count = atom()->isAreaActive('footer1')) > 0): // make sure there are visible widgets ?>
             <ul class="blocks count-<?php echo $count; ?> clear-block">
               <?php atom()->Widgets('footer1'); ?>
             </ul>
             <?php endif; ?>

             <div id="copyright">
               <?php echo do_shortcode(atom()->options('footer_content'));  ?>
               <?php if (is_singular()) { ?>
               <script type="text/javascript">
                 (function() {
                   var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                   po.src = 'https://apis.google.com/js/plusone.js';
                   var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                 })();
               </script>
               <?php } ?>               
               <?php wp_footer(); ?>
               <!--[if IE 6]>
               <script type="text/javascript" src="http://letskillie6.googlecode.com/svn/trunk/letskillie6.bilingual.pack.js"></script>
               <![endif]-->
               <!--[if lt IE 9]>
               <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
               <![endif]-->
             </div>
           </div>

         </div>
       </div>
       <!-- /footer -->

       <a class="go-top" href="#page"><?php atom()->te('Go to Top'); ?></a>

     </div>
    <!-- /page-ext -->


    <!-- <?php echo do_shortcode('[load]'); ?> -->

  </div>
  <!-- page -->

  <?php atom()->end(); ?>

</body>
</html>

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
               <!--<?php if (is_singular()) { ?>-->
               <script type="text/javascript">
                 (function() {
                   var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                   po.src = 'https://apis.google.com/js/plusone.js';
                   var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                 })();
               </script>
               <!--<?php } ?>-->               
               <?php wp_footer(); ?>
               <!--[if IE 6]>
               <script type="text/javascript" src="http://letskillie6.googlecode.com/svn/trunk/letskillie6.bilingual.pack.js"></script>
               <![endif]-->
               <!--[if lt IE 9]>
               <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
               <![endif]-->
               
               <!--Snow-->
               <!--<script src="http://logicmd.net/wp-content/themes/mystique-extend/snowfall.min.js"></script>
               <script>
               	if ($(window).height() > $("body").height())
			$("html, body").css("min-height", $(window).height()-50+"px");
			
		snowFall.snow(document.body, {
		  minSize: 1,
		  maxSize:4,
		  round: true,
		  minSpeed: 1,
		  maxSpeed: 2
		});
               </script>-->
               <!--No Baidu Dialog-->
               <script src="http://logicmd.net/wp-content/themes/mystique-extend/jquery.bpopup.min.js"></script>
               <script type="text/javascript">
		;(function($) {
		    $(function() {
		        var url=document.referrer;
		        if ( url && url.search("http://")>-1) {
		            var refurl =  url.match(/:\/\/(.[^/]+)/)[1];
		            if(refurl.indexOf("baidu.com")>-1){
		                $('#nobaidu_dlg').bPopup();
		            }
		        }
		    });
		
		})(jQuery);
		</script>
		
		
		
		<div id="nobaidu_dlg" style="background-color:#fff; border-radius:15px;color:#000;display:none;padding:20px;min-width:450px;min-height:180px;">
		    <!--<span class="bClose" style="cursor:pointer; position:absolute; right:10px;top:5px;">x<span/>-->
		    <img src="http://logicmd.net/wp-content/themes/mystique-extend/images/nobaidu.jpg" align="left">
		     <p style="margin-left:200px;margin-top: 20px; line-height: 30px;">
		     检测到你还在使用百度这个搜索引擎，<br/>
		     做为一个程序员，这是一种自暴自弃！<br/>
		     <br/>
		     </p>
		     <p align="center" style="margin-top:20px;">
		     <b><a href="#">做环保的程序员，从不用百度开始！</a></b>
		     </p>
		</div>
               
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
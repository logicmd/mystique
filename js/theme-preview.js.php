<?php


add_action('wp_footer', 'atom_theme_preview_js');

function atom_theme_preview_js(){
  $app = Atom::app();
  ?>

<script>
  /*<![CDATA[*/

  // 960gs overlay -- used in theme preview mode only
  (function($){
    $.fn.gridOverlay = function(cfg){
      cfg = $.extend({
        columns: 12,
        columnWidth: 60,
        color: '#ccc',
        opacity: 40
      }, cfg);

      var frame = $('<div style="display:none;overflow:hidden;position:absolute;left:0;top:0;width:100%;height:'+(this.height()-40)+'px;z-index: 999;">'),
          grid = $('<div style="position:relative;width:960px;height:100%;margin:0 auto;overflow:hidden;">'),
          trigger = $('<a style="position:fixed;top:140px;left:20px;cursor:pointer;padding:5px;background:red;color:#fff;font-weight:bold;z-index:9999;">GRID</a>');

      trigger.appendTo('#page').click(function(){
        frame.toggle();
      });

      for(var i = 0; i < cfg.columns; i++){ // columns
        grid.append('<div style="width:'+((i != 0) ? 20 : 10)+'px;float:left;height:100%;"></div>');
        grid.append('<div style="width:'+cfg.columnWidth+'px;height:100%;float:left;background:'+cfg.color+';opacity:'+(cfg.opacity/100)+';"></div>');
      }

      return this.each(function(){
        $(this).prepend(frame.prepend(grid));
      });

    };
  })(jQuery);


  jQuery(document).ready(function($){
    $('#page').gridOverlay();

    var current_bg_image = $("<?php echo $app->options('background_image_selector'); ?>").css("background-image");
    pm.bind("background_color", function(data){
      if(data != '000000'){
       $("<?php echo $app->options('background_color_selector'); ?>").css("background-color", '#' + data);
       if(!$('body').hasClass('custom-bg')) $("<?php echo $app->options('background_image_selector'); ?>").css("background-image", "none");
     }else{
       $("<?php echo $app->options('background_color_selector'); ?>").css("background-color", "");
       if(!$('body').hasClass('custom-bg')) $("<?php echo $app->options('background_image_selector'); ?>").css("background-image", current_bg_image);

     }
    });

    pm.bind("color-scheme", function(data){
     $('link#<?php echo ATOM; ?>-core-css, link#<?php echo ATOM; ?>-style-css').attr('disabled', 'disabled'); // we need this so the style unloads from browser memory
     $('link#<?php echo ATOM; ?>-core-css, link#<?php echo ATOM; ?>-style-css').remove();
     if(data != '')
       $('head').append('<link rel="stylesheet" id="<?php echo ATOM; ?>-core-css" href="<?php echo $app->get('theme_url'); ?>/css/core.css" type="text/css" />');
       $('head').append('<link rel="stylesheet" id="<?php echo ATOM; ?>-style-css" href="<?php echo $app->get('theme_url'); ?>/css/style-'+data+'.css" type="text/css" />');
    });

    pm.bind("layout", function(data){
     $('body').attr('class',
            function(i, c){
              return c.replace(/\bc\S+/g, '');
            });
     $("body").addClass(data);
    });

    pm.bind("page_width", function(data){
     $('body').removeClass("fluid fixed");
     $("body").addClass(data);
    });

    pm.bind("page_width_max", function(data){
     data = parseInt(data);
     if(data > 400) $(".page-content").css("max-width", data+'px');
    });

    pm.bind("dimensions", function(data){
     var s = data.sizes.split(';');
     s[0] = parseInt(s[0]);
     s[1] = parseInt(s[1]);
     var unit = data.unit;
     var gs = data.gs;
     switch(data['layout']){
        case 'c1':
          $('#primary-content').css({'width': gs+unit, 'left': '0'});
          $('#mask-1').css({'right': 0});
          $('#mask-2').css({'right': 0});
          break;
        case 'c2left':
          $('#primary-content').css({'width': gs-s[0]+unit, 'left': gs+unit});
          $('#sidebar').css({'width': s[0]+unit, 'left': '0'});
          $('#mask-1').css({'right': gs-s[0]+unit});
          $('#mask-2').css({'right': 0});
          break;
        case 'c2right':
          $('#primary-content').css({'width': gs-(gs-s[0])+unit, 'left': gs-s[0]+unit});
          $('#sidebar').css({'width': gs-s[0]+unit, 'left': gs-s[0]+unit});
          $('#mask-1').css({'right': gs-s[0]+unit});
          $('#mask-2').css({'right': 0});
          break;
        case 'c3':
          $('#primary-content').css({'width': (gs-s[0]-(gs-s[1]))+unit, 'left': gs+unit});
          $('#sidebar').css({'width': s[0]+unit, 'left': gs-s[1]+unit});
          $('#sidebar2').css({'width': gs-s[1]+unit, 'left': (gs-s[0])+unit});
          $('#mask-2').css({'right': gs-s[1]+unit});
          $('#mask-1').css({'right': ((gs-s[0])-(gs-s[1]))+unit});
          break;
        case 'c3left':
          $('#primary-content').css({'width': (gs-s[1])+unit, 'left': (gs+(s[1]-s[0]))+unit});
          $('#sidebar').css({'width': s[0]+unit, 'left': (s[1]-s[0])+unit});
          $('#sidebar2').css({'width': (s[1]-s[0])+unit, 'left': (s[1]-s[0])+unit});
          $('#mask-2').css({'right': (gs-s[1])+unit});
          $('#mask-1').css({'right': (s[1]-s[0])+unit});
          break;
        case 'c3right':
          $('#primary-content').css({'width': s[0]+unit, 'left': ((gs-s[0]-(gs-s[1]))+(gs-s[1]))+unit});
          $('#sidebar').css({'width': (gs-s[0]-(gs-s[1]))+unit, 'left': (gs-s[0])+unit});
          $('#sidebar2').css({'width': (gs-s[1])+unit, 'left': (gs-s[0])+unit});
          $('#mask-2').css({'right': (gs-s[1])+unit});
          $('#mask-1').css({'right': (s[1]-s[0])+unit});
          break;
      }
    });

    pm.bind("logo", function(data){
     $("#logo a img").remove();
     if (data != 'remove')
       $("#logo a").html('<img src="'+data+'" />');
     else $("#logo a").html('<?php echo apply_filters('atom_logo_title', get_bloginfo('name')); ?>');
    });

    pm.bind("background_image", function(data){
     if (data != 'remove'){
       $("<?php echo $app->options('background_image_selector'); ?>").css('background-image', 'url("'+data+'")');
       $("body").removeClass("custom-bg");
     }else{
       $("<?php echo $app->options('background_image_selector'); ?>").css('background-image', 'none');
       $("body").addClass("custom-bg");
     }
    });

    pm.bind("background_gradient", function(data){





/**
 * Converts an RGB color value to HSL. Conversion formula
 * adapted from http://en.wikipedia.org/wiki/HSL_color_space.
 * Assumes r, g, and b are contained in the set [0, 255] and
 * returns h, s, and l in the set [0, 1].
 *
 * @param   Number  r       The red color value
 * @param   Number  g       The green color value
 * @param   Number  b       The blue color value
 * @return  Array           The HSL representation
 */
function HEX2HSL(hexStr){


    var hex = parseInt(hexStr, 16);
    var r = (hex & 0xff0000) >> 16;
    var g = (hex & 0x00ff00) >> 8;
    var b = hex & 0x0000ff;


    r /= 255, g /= 255, b /= 255;
    var max = Math.max(r, g, b), min = Math.min(r, g, b);
    var h, s, l = (max + min) / 2;

    if(max == min){
        h = s = 0; // achromatic
    }else{
        var d = max - min;
        s = l > 0.5 ? d / (2 - max - min) : d / (max + min);
        switch(max){
            case r: h = (g - b) / d + (g < b ? 6 : 0); break;
            case g: h = (b - r) / d + 2; break;
            case b: h = (r - g) / d + 4; break;
        }
        h /= 6;
    }

    return [h, s, l];
}

/**
 * Converts an HSL color value to RGB. Conversion formula
 * adapted from http://en.wikipedia.org/wiki/HSL_color_space.
 * Assumes h, s, and l are contained in the set [0, 1] and
 * returns r, g, and b in the set [0, 255].
 *
 * @param   Number  h       The hue
 * @param   Number  s       The saturation
 * @param   Number  l       The lightness
 * @return  Array           The RGB representation
 */
function HSL2HEX(hsl){
    var r, g, b,
        h = hsl[0],
        s = hsl[1],
        l = hsl[2];

    if(s == 0){
        r = g = b = l; // achromatic
    }else{
        function hue2rgb(p, q, t){
            if(t < 0) t += 1;
            if(t > 1) t -= 1;
            if(t < 1/6) return p + (q - p) * 6 * t;
            if(t < 1/2) return q;
            if(t < 2/3) return p + (q - p) * (2/3 - t) * 6;
            return p;
        }

        var q = l < 0.5 ? l * (1 + s) : l + s - l * s;
        var p = 2 * l - q;
        r = hue2rgb(p, q, h + 1/3);
        g = hue2rgb(p, q, h);
        b = hue2rgb(p, q, h - 1/3);
    }

    return ((1 << 24) + ((r * 255) << 16) + ((g * 255) << 8) + (b * 255)).toString(16).slice(1);
}

     var c2 = data;
     var c1 = HEX2HSL(data);


//     c1[0] = Math.min(Math.max((c1[0] + 0.036), 0), 1);
//     c1[2] = Math.min(Math.max((c1[2] - 0.122), 0), 1);

     c1[0] = c1[0] + 0.036;
     c1[2] = c1[2] - 0.122;

/*
     if(c1[0] >= 1)
       c1[0] = c1[0] - 1;

     if(c1[2] <= 0)
       c1[2] = 1 - Math.abs(c1[2]);
*/
     c1 = HSL2HEX(c1);

      // this is quite weird, we can set multiple values to the same property if we do multiple css() calls :)
      $("<?php echo $app->options('background_gradient_selector'); ?>")
       .css('background-image', '-webkit-gradient(linear, left top, left bottom, from(#' + c1 + '), to(#' + c2 + '))')
       .css('background-image', '-webkit-linear-gradient(#' + c1 + ', #' + c2 + ')')
       .css('background-image', '-moz-linear-gradient(#' + c1 + ', #' + c2 + ')')
       .css('background-image', '-o-linear-gradient(top, #' + c1 + ', #' + c2 + ')')
       .css('background-image', '-khtml-gradient(linear, left top, left bottom, from(#' + c1 + '), to(#' + c2 + '))')
       .css('filter', 'progid:DXImageTransform.Microsoft.gradient(startColorstr=\'#' + c1 + '\', endColorstr=\'#' + c2 + '\', GradientType=0)')
       .css('background-image', 'linear-gradient(#' + c1 + ', #' + c2 + ')');


    });

    $('body a').each(function(){
     var link = $(this).attr('href'); // remove all links to other pages
     if(link && link.indexOf('#') != 0) $(this).attr('href', '#');
    });

    pm({ // notify the parent document that the current document has loaded
     target: parent,
     type: 'themepreview-load',
     data: true
    });

    <?php $app->action('theme_preview'); ?>



  });

  /* ]]> */

</script>

<?php

}

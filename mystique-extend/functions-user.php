<?php 
// Only edit this if you know what you're doing!
/**
* <span class="goog_qs-tidbit goog_qs-tidbit-0">Usage:
* Paste a gist link into a blog post or page and it will be embedded eg:</span>
* https://gist.github.com/2926827
*
* If a gist has multiple files you can select one using a url in the following format:
* https://gist.github.com/2926827?file=embed-gist.php
*/
 
wp_embed_register_handler( 'gist', '/https:\/\/gist\.github\.com\/(\d+)(\?file=.*)?/i', 'wp_embed_handler_gist' );
 
function wp_embed_handler_gist( $matches, $attr, $url, $rawattr ) {
  $embed = sprintf(
  '<script type="text/javascript" src="https://gist.github.com/%1$s.js%2$s"></script>',
     esc_attr($matches[1]),
     esc_attr($matches[2])
  ); 
  return apply_filters( 'embed_gist', $embed, $matches, $attr, $url, $rawattr );
}

?>

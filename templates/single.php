<?php

/*
 * @template  Mystique
 * @revised   December 20, 2011
 * @author    digitalnature, http://digitalnature.eu
 * @license   GPL, http://www.opensource.org/licenses/gpl-license
 */

// Singular template, used to display a single post.
// For custom post types, a template named single-post_type.php will have priority over this one.

?>

<?php atom()->template('header'); ?>

<!-- main content: primary + sidebar(s) -->
<div id="mask-3" class="clear-block">
  <div id="mask-2">
    <div id="mask-1">

      <!-- primary content -->
      <div id="primary-content">
        <div class="blocks clear-block">

          <?php atom()->action('before_primary'); ?>

          <?php if(atom()->options('single_links')): ?>
          <div class="post-links clear-block">
            <div class="alignleft"><?php previous_post_link('&laquo; %link') ?></div>
            <div class="alignright"><?php next_post_link('%link &raquo;') ?></div>
          </div>
          <?php endif; ?>

          <?php atom()->action('before_post'); ?>

          <!-- post content -->
          <div id="post-<?php the_ID(); ?>" <?php post_class('primary'); ?>>

            <?php if(!atom()->post->getMeta('hide_title')): ?>
            <h1 class="title"><?php atom()->post->Title(); ?></h1>
            <?php endif; ?>

            <div class="post-content clear-block">
              <?php the_content(); ?>
            </div>

            <?php atom()->post->pagination(); ?>

            <?php if(atom()->post->getTerms()): ?>
            <div class="post-extra clear-block">
              <div class="post-tags">
                <?php atom()->post->Terms(); ?>
              </div>
            </div>
            <?php endif; ?>

            <?php if(!post_password_required()): ?>
            <div class="post-meta">

                <?php if(atom()->options('single_share')) ?>
              	 <ul class="sub-menu post-shares">
              	 	 <li class="weibo">
              	 	 	 <a href="javascript:void((function(s,d,e,r,l,p,t,z,c){var%20f='http://v.t.sina.com.cn/share/share.php?appkey=696316965&',u=z||d.location,p=['url=',e(u),'&title=',e(t||d.title),'&source=',e(r),'&sourceUrl=',e(l),'&content=',c||'utf-8','&pic=',e(p||'')].join('');function%20a(){if(!window.open([f,p].join(''),'mb',['toolbar=0,status=0,resizable=1,width=440,height=430,left=',(s.width-440)/2,',top=',(s.height-430)/2].join('')))u.href=[f,p].join('');};if(/Firefox/.test(navigator.userAgent))setTimeout(a,0);else%20a();})(screen,document,encodeURIComponent,'logicmd.net','http://logicmd.net','','<?php the_title(); ?> ','<?php the_permalink() ?>','utf-8'));" title="分享到微博">
              	 	 	 	 <span>Weibo</span>
              	 	 	 </a>
              	 	 </li>
              	 	 <li class="renren">
              	 	 	 <a href="javascript:void((function(s,d,e){if(/xiaonei\.com/.test(d.location))return;var%20f='http://share.xiaonei.com/share/buttonshare.do?link=',u=d.location,l=d.title,p=[e(u),'&title=',e(l)].join('');function%20a(){if(!window.open([f,p].join(''),'xnshare',['toolbar=0,status=0,resizable=1,width=626,height=436,left=',(s.width-626)/2,',top=',(s.height-436)/2].join('')))u.href=[f,p].join('');};if(/Firefox/.test(navigator.userAgent))setTimeout(a,0);else%20a();})(screen,document,encodeURIComponent));" title="分享到人人">
              	 	 	 	 <span>Renren</span>
              	 	 	 </a>
              	 	 </li>
              	 	 <li class="qqzone">
              	 	 	 <a href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=<?php the_permalink() ?>" title="分享到QQ空间" target="_blank">
              	 	 	 	 <span>QQZone</span>
              	 	 	 </a>
              	 	 </li>
              	 	 <li class="qqweibo">
              	 	 	 <a href="javascript:void(window.open('http://v.t.qq.com/share/share.php?title='+encodeURI(document.title)+'&url='+encodeURIComponent(window.location)+'&appkey=a75e1c5904c842b7b3aed10213379cca&site=logicmd.net&pic=','转播到腾讯微博', 'width=700, height=680, top=0, left=0, toolbar=no, menubar=no, scrollbars=no, location=yes, resizable=no, status=no'));" title="分享到QQ微博">
              	 	 	 	 <span>QQWeibo</span>
              	 	 	 </a>
              	 	 </li>
              	 </ul>                
                <?php if(atom()->options('single_meta')): ?>
                <div class="details">
                  <p>
                    <?php

                     atom()->te('This entry was posted by %1$s on %2$s at %3$s, and is filed under %4$s. Follow any responses to this post through %5$s.',
                       atom()->post->author->getNameAsLink(),
                       atom()->post->getDate(get_option('date_format')),
                       atom()->post->getDate(get_option('time_format')),
                       atom()->post->getTerms('category', ', '),
                       sprintf('<a href="%s" title="RSS 2.0">RSS 2.0</a>', get_post_comments_feed_link())
                     );

                     if(comments_open() && pings_open())
                       atom()->te('You can <a%1$s>leave a response</a> or <a%2$s>trackback</a> from your own site.', ' href="#commentform"',' href="'.get_trackback_url().'" rel="trackback"');

                     elseif(!comments_open() && pings_open())
                       atom()->te('Responses are currently closed, but you can <a%1$s>trackback</a> from your own site.', ' href="'.get_trackback_url().'" rel="trackback"');

                     elseif(comments_open() && !pings_open())
                       atom()->te('You can skip to the end and leave a response. Pinging is currently not allowed.');

                     elseif(!comments_open() && !pings_open())
                       atom()->te('Both comments and pings are currently closed.');
                    ?>
                  </p>
                </div>
                <?php endif; ?>

            </div>
            <?php endif; ?>

            <?php atom()->controls('post-edit', 'post-print'); ?>

          </div>
          <!-- /post content -->

          <?php atom()->action('after_post'); ?>

          <?php atom()->template('meta'); ?>

          <?php atom()->action('after_primary'); ?>

        </div>
      </div>
      <!-- /primary content -->

      <?php atom()->template('sidebar'); ?>

    </div>
  </div>
</div>
<!-- /main content -->

<?php atom()->template('footer'); ?>

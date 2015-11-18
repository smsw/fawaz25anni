<?php
    // @TODO: To clear out unused custom fields and re-format code.
    // To determine if staging or production
    $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

    global $wp_query;
    get_template_part('templates/head');
    $pageWidth = get_field('full_width');
    $postType = get_post_type( $post );

    // Global backgrounds, non brand pages
    $pageBg = get_field('page_bg');
    $pageBgAttach = get_field('page_bg_attach');

    // Original page backgrounds
    $pageBgOriginal = get_post_meta($post->ID, '_bg_image_value', true);

    // New Brand page backgrounds
    $pageBrandBg = get_field('brand_background_image');
?>
<body
    <?php
	    if ( in_category( 'investor-ownership' ) ) {
		    echo body_class( 'single-portfolio' );
	    }
        if(is_single() ) {
            echo body_class( 'single-page' );
        } else {
	        echo body_class();
        }
    ?>
    style="<?php if($pageBrandBg):?>background-image:url('<?php echo $pageBrandBg['url']; ?>');background-attachment: fixed;<?php elseif($pageBgOriginal != ''):?>background-image:url('<?php echo $pageBgOriginal; ?>');background-attachment: fixed;<?php endif;?>background-size: cover !important;<?php if($pageBgAttach == 'fixed'):?>background-attachment: fixed;<?php endif; ?>">

  <!--[if lt IE 8]>
    <div class="alert alert-warning">
      <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'roots'); ?>
    </div>
  <![endif]-->

  <?php if ( false !== strpos( $url, 'smswmedia' ) ): ?>
  <div class="container-fluid" style="background:orange;color:#fff;position:fixed;top:0;left:0;right:0;z-index:999;">
    <div class="row">
        <div class="col-xs-12 text-center"><h4>Staging Environment - This is not live</h4></div>
    </div>
  </div>
  <?php endif; ?>

  <?php do_action('get_header'); get_template_part('templates/header'); ?>

  <div id="sidebar-wrapper">
      <ul class="list-inline">
          <li><h3 class="title"><?php _e( 'Menu', 'fawazalhokairfashion' ); ?></h3></li>
          <li><a href="#" class="js_close_side_menu" style="display: none"><i class="fa fa-close fa-1x"></i></a></li>
      </ul>
      <?php
      switch ( ICL_LANGUAGE_CODE ) {
          case "ar" :
              wp_nav_menu( array( 'theme_location' => 'primary_navigation', 'menu_class' => 'sidebar-nav ar' ) );
              break;

          default :
              wp_nav_menu( array( 'theme_location' => 'primary_navigation', 'menu_class' => 'sidebar-nav en' ) );
              break;
      }
      ?>
  </div>

  <div id="wrapper-main" class="wrap container-fluid <?php if($pageWidth == 'container'):?> container<?php endif; ?><?php if($postType == 'portfolio'):?> container<?php endif; ?> clearfix" role="document">

    <div class="content row" <?php if(!empty($pageColour)):?>style="background: <?php echo $pageColour;?>"<?php endif;?>>
      <main class="main <?php if ( !is_front_page() ) echo 'container'; ?>" role="main">
        <?php include roots_template_path(); ?>
      </main>
    </div>

  </div>
  <?php if (!is_front_page()) include_once('templates/stickyBarNavigation.php'); ?>
  <?php get_template_part('templates/footer'); ?>
  <?php wp_footer(); ?>
  <script>
      (function (i, s, o, g, r, a, m) {
          i['GoogleAnalyticsObject'] = r;
          i[r] = i[r] || function () {
              (i[r].q = i[r].q || []).push(arguments)
          }, i[r].l = 1 * new Date();
          a = s.createElement(o),
              m = s.getElementsByTagName(o)[0];
          a.async = 1;
          a.src = g;
          m.parentNode.insertBefore(a, m)
      })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

      ga('create', 'UA-33701630-1', 'auto');
      ga('send', 'pageview');
  </script>
</body>
</html>

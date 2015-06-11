<header class="banner navbar navbar-default navbar-static-top <?php if (!is_front_page()) : ?>non-absolute<?php endif; ?>" role="banner">
    <div class="container">
        <div class="navbar-header">

            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span>
                <span class="icon-bar"></span> <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>" title="<?php bloginfo('name'); ?>">
                <img src="<?php echo get_template_directory_uri() . '/assets/images/logo-colour.png' ?>" alt="Fawaz Alhokair Fashion Logo" width="313" height="43" class="hidden-xs">
                <img src="<?php echo get_template_directory_uri() . '/assets/images/logo-mobile.png' ?>" alt="Fawaz Alhokair Fashion Mobile Logo" width="35" height="27" class="visible-xs">
            </a>
        </div>
        <nav class="collapse navbar-collapse" role="navigation">


            <ul class="nav navbar-nav navbar-right list-inline animated-nav">
                <li>
                    <button type="button" class="navbar-toggle collapsed js_toggle_side_menu hidden-xs visible-sm visible-md visible-lg">
                        <span class="menu-text"><?php _e( 'Menu', 'fawazalhokairfashion' ); ?></span> <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
                    </button>
                </li>
            </ul>
        </nav>
    </div>
</header>

<?php if ( ! is_front_page() ) : ?>

    <?php include_once( 'sideBarNavigation.php' ); ?>

<?php endif ?>
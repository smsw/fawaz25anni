<?php $base = get_template_directory_uri(); ?>

<footer>
    <div class="alhokair-partners">
        <div class="container">
            <div class="row text-center">
                <img src="/wp-content/themes/fawazalhokairfashion/assets/images/logo-colour.png" alt="Fawaz Alhokair Fashion Logo" width="313" height="43" class="hidden-xs">
                <h2><?php _e( 'Subsidiaries', 'fawazalhokairfashion' ); ?></h2>
                <ul class="list-inline logos text-center">

                    <li class="col-md-2 col-md-offset-1">
                        <a href="http://www.fg4.biz/" title="FG4" target="_blank">
                            <img src="<?php echo $base . '/assets/images/logos/reversed/fg4.png'; ?>" class="img-responsive" alt="FG4 logo">
                        </a>
                    </li>

                    <li class="col-md-2">
                        <a href="http://www.suiteblanco.com/" title="SuiteBlanco" target="_blank">
                            <img src="<?php echo $base . '/assets/images/logos/reversed/suiteblanco.png'; ?>" class="img-responsive" alt="SuiteBlanco logo">
                        </a>
                    </li>

                    <li class="col-md-2">
                        <a href="http://myincstyle.com" title="INC" target="_blank">
                            <img src="<?php echo $base . '/assets/images/logos/reversed/inc.png'; ?>" class="img-responsive" alt="INC logo">
                        </a>
                    </li>

                    <li class="col-md-2">
                        <a href="http://www.modelsownit.com/" title="Models Own" target="_blank">
                            <img src="<?php echo $base . '/assets/images/logos/reversed/modelsown.png'; ?>" class="img-responsive" alt="ModelsOwn logo">
                        </a>
                    </li>

                    <li class="col-md-2">
                        <a href="http://www.ebdi.uk.com/" title="ebdi designs" target="_blank">
                            <img src="<?php echo $base . '/assets/images/logos/reversed/ebdi-logo.png'; ?>" class="img-responsive" alt="ebdi logo">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="col-xs-12">
            <div class="row">
                <ul class="list-inline circle-stats text-center">
                    <li class="col-xs-12 col-sm-2">
                        <a href="/about" title="About">
                            <div class="circle hidden-xs" style="background-image:url(<?php echo $base . '/assets/images/icons/aboutus.png'; ?>);"></div>
                        </a>
                        <h5><?php _e( 'About Us', 'fawazalhokairfashion' ); ?></h5>
                        <?php wp_nav_menu( array( 'menu' => 'Footer About', 'theme_location' => 'secondary', 'menu_class'=> 'list-unstyled' ) ); ?>
                    </li>

                    <li class="col-xs-12 col-sm-2">
                        <a href="/brands" title="Brands">
                            <div class="circle hidden-xs purple" style="background-image:url(<?php echo $base . '/assets/images/icons/brands.png'; ?>);"></div>
                        </a>

                        <h5><?php _e( 'Brands', 'fawazalhokairfashion' ); ?></h5>
                        <ul class="list-unstyled">
                            <?php
                            $args = array(
                                'post_type' => 'portfolio',
                                'posts_per_page' => 6,
                                'orderby' => 'rand'
                            );
                            $query = new WP_Query($args);
                            $mediaType = get_post_meta($post->ID, '_project_type_value', true);

                            //added before to ensure it gets opened
                            if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>

                                <li>
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </li>

                            <?php endwhile; endif;
                            //make sure open div is closed

                            ?>
                            <li><a href="/brands"><?php _e( 'See All Brands', 'fawazalhokairfashion' ); ?></a></li>
                        </ul>
                    </li>

                    <li class="col-xs-12 col-sm-2">
                        <a href="/investor-relations" title="Investors">
                            <div class="circle hidden-xs" style="background-image:url(<?php echo $base . '/assets/images/icons/investors.png'; ?>);"></div>
                        </a>

                        <h5><?php _e( 'Investors', 'fawazalhokairfashion' ); ?></h5>
                        <?php wp_nav_menu( array( 'menu' => 'Footer Investors', 'theme_location' => 'secondary', 'menu_class'=> 'list-unstyled' ) ); ?>
                    </li>

                    <li class="col-xs-12 col-sm-2">
                        <a href="/news" title="News">
                            <div class="circle hidden-xs purple" style="background-image:url(<?php echo $base . '/assets/images/icons/media.png'; ?>);"></div>
                        </a>

                        <h5><?php _e( 'Media', 'fawazalhokairfashion' ); ?></h5>
                        <?php wp_nav_menu( array( 'menu' => 'Footer Media', 'theme_location' => 'secondary', 'menu_class'=> 'list-unstyled' ) ); ?>
                    </li>

                    <li class="col-xs-12 col-sm-2">
                        <a href="/alhokair-careers" title="Alhokair Careers">
                            <div class="circle hidden-xs" style="background-image:url(<?php echo $base . '/assets/images/icons/careers.png'; ?>);"></div>
                        </a>

                        <h5><?php _e( 'Careers', 'fawazalhokairfashion' ); ?></h5>

                        <ul class="list-unstyled mt-20">
                            <li><a href="/alhokair-careers" title="Alhokair Careers"><?php _e('Alhokair Careers'); ?></a></li>
                        </ul>
                    </li>

                    <li class="col-xs-12 col-sm-2">
                        <a href="/contact" title="Contact">
                            <div class="circle hidden-xs purple" style="background-image:url(<?php echo $base . '/assets/images/icons/contact.png'; ?>);"></div>
                        </a>

                        <h5><?php _e( 'Contact', 'fawazalhokairfashion' ); ?></h5>

                        <ul class="list-unstyled">
                            <li><a href="/contact" title="Get in touch"><?php _e('Get in touch');?></a></li>
                        </ul>
                    </li>
                </ul>
            </div>

            <div class="row clearfix">
                <section class="copyright col-xs-12">
                    <ul class="list-inline text-center">
                        <li><?php _e( 'Copyright', 'fawazalhokairfashion' ); ?> &copy; <?php echo date("Y"); ?> <?php _e( ' Fawaz A. Alhokair & Co.', 'fawazalhokairfashion' ); ?></li>
                    </ul>
                    <?php wp_nav_menu( array( 'menu' => 'Footer Menu', 'theme_location' => 'secondary', 'menu_class'=> 'list-inline text-center' ) ); ?>
                </section>
            </div>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
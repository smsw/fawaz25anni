<?php

/**
 * Clean up the_excerpt()
 */


function roots_excerpt_more($more)
{
    return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'roots') . '</a>';
}

add_filter('excerpt_more', 'roots_excerpt_more');

/**
 * Manage output of wp_title()
 */
function roots_wp_title($title)
{
    if (is_feed()) {
        return $title;
    }

    $title .= get_bloginfo('name');

    return $title;
}

add_filter('wp_title', 'roots_wp_title', 10);


function homeBrandSlider()
{
    ob_start();
    ?>

    <section class="brands hidden-xs">
        <div class="container">
            <div class="row">
                <div id="slider" class="flexslider">
                    <ul class="slides">
                        <?php
                        // Grab the custom field, this returns a post id object
                        $featuredBrandsList = get_field('featured_brands_list');

                        // Empty array for post ids to go into
                        $include_ids = array();

                        // Custom field returns post ID object, loop over
                        foreach ($featuredBrandsList as $k => $v) {
                            // Push post id into array
                            $include_ids[] = $v;
                        }


                        // Set of params for the query, including the id's so we can control.
                        $args = array(
                            'post_type' => 'portfolio',
                            'post_status' => 'publish',
                            'post__in' => $include_ids,
                            'orderby' => 'post__in',
                        );

                        $query = new WP_Query($args);

                        ?>

                        <?php while ($query->have_posts()) : $query->the_post(); ?>
                            <?php

                            // Retrieve advanced custom fields.
                            $logo = get_field('brand_logo', $query->post->ID);
                            $logoBgColour = get_field('brand_colour', $query->post->ID);
                            $brandExcerpt = get_field('post_excerpt', $query->post->ID);
                            ?>

                            <li>
                                <div class="col-xs-12 col-md-6 brand-image"
                                    <?php if ($logoBgColour): ?>style="background-color: <?php echo $logoBgColour; ?>;" <?php endif; ?>>
                                    <?php if ($logo): ?><img src="<?php echo $logo['url']; ?>" alt="brand logo"><?php endif; ?>
                                </div>

                                <div class="col-xs-12 col-md-6 feature">
                                    <a href="<?php echo get_permalink(); ?>">
                                        <?php the_post_thumbnail('large', [
                                            'class' => 'img-responsive',
                                            'alt' => 'Brand image'
                                        ]); ?>
                                    </a>
                                    <div class="caption">
                                        <?php echo $brandExcerpt; ?>

                                        <?php if ( ICL_LANGUAGE_CODE == 'ar' ) {
                                            echo "<a class='arr arrLeft hidden-xs hidden-sm' href='/brand-portfolio'>";
	                                        _e( 'View All Brands', 'fawazalhokairfashion' );
	                                        echo "</a>";
                                        } else {
                                            echo "<a class='arr arrRight hidden-xs hidden-sm' href='/brands'>";
	                                        _e( 'View All Brands', 'fawazalhokairfashion' );
	                                        echo "</a>";
                                        } ?>
                                    </div>
                                </div>
                            </li>
                        <?php endwhile; ?>
                    </ul>

                </div>
            </div>
        </div>
    </section>

    <?php
    return ob_get_clean();
}

function brandHorizontalSlider()
{
    ob_start();
    ?>

    <section id="brands-slider" class="hidden-xs hidden">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="entry">
                        <div id="brands" style="background: none">
                            <ul class="bxslider home-brand-logos">
                                <?php
                                // Retrieve brand logos from homepage.
                                $brandLogos = ( get_field( 'brand_ticker', '2') );

                                // Loop through each and output the logo
                                foreach ( $brandLogos as $k => $v ): ?>
                                <li><img src="<?php echo $v['logo']; ?>" alt="<?php echo $v['Brand Name'];?>"></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    return ob_get_clean();
}

add_shortcode('brandSlider', 'homeBrandSlider');
add_shortcode('brandHozSlider', 'brandHorizontalSlider');


/**
 * Manage Dropdown menu
 */
class photolio_Walker extends Walker_Nav_Menu
{

    function start_lvl(&$output, $depth)
    {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"sub-menu\">\n";
    }

    function end_lvl(&$output, $depth)
    {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }
}


// Register taxonomy
function register_portfolio_taxonomy()
{
    $tax_labels = array(
        'name' => 'Portfolio Type',
        'singular_name' => 'Portfolio Type',
        'search_items' => 'Search Portfolio Types',
        'popular_items' => 'Popular Portfolio Types',
        'all_items' => 'All Portfolio Types',
        'parent_item' => 'Parent Portfolio Type',
        'parent_item_colon' => 'Parent Portfolio Type:',
        'edit_item' => 'Edit Portfolio Type',
        'update_item' => 'Update Portfolio Type',
        'add_new_item' => 'Add New Portfolio Type',
        'new_item_name' => 'New Portfolio Type Name',
        'separate_items_with_commas' => 'Separate portfolio types with commas',
        'add_or_remove_items' => 'Add or remove portfolio types',
        'choose_from_most_used' => 'Choose from the most used portfolio types',
        'menu_name' => 'Portfolio Types'
    );

    register_taxonomy(
        'portfolio-type',
        array('portfolio'),
        array(
            'hierarchical' => true,
            'show_ui' => true,
            'labels' => $tax_labels,
            'public' => true,
            'query_var' => true,
            'label' => 'Portfolio Categories',
            'rewrite' => array('slug' => 'portfolio-type', 'hierarchical' => true)

        )
    );
}

add_action('init', 'register_portfolio_taxonomy');


function custom_css_classes_for_vc_row_and_vc_column($class_string, $tag)
{
    if ($tag == 'vc_row' || $tag == 'vc_row_inner') {
        $class_string = str_replace('vc_row-fluid', 'row-fluid', $class_string);
    }

    return $class_string;
}

// Filter to Replace default css class for vc_row shortcode and vc_column
add_filter('vc_shortcodes_css_class', 'custom_css_classes_for_vc_row_and_vc_column', 10, 2);


/**
 * Sub Menu Footer - Widget location
 */
function sub_menu_footer()
{
    register_sidebar(
      array(
        'name'          => 'Fixed Page Navigation',
        'id'            => 'sub_menu_footer',
        'description'   => 'Display list of pages',
        'class'         => '',
        'before_widget' => '<section class="text-center animated fadeIn quicknav hidden-xs">',
        'after_widget'  => '</section>',
      )
    );
}

add_action('widgets_init', 'sub_menu_footer');



/**
 * Register sidebar widget location for section: Recruitment
 */
function sub_nav_menu_footer()
{
    register_sidebar(
      array(
        'name'          => 'Fixed Page Arrow Navigation',
        'id'            => 'sub_nav_menu_footer',
        'description'   => 'Display list of pages',
        'class'         => '',
        'before_widget' => '',
        'after_widget'  => '',
      )
    );
}

add_action('widgets_init', 'sub_nav_menu_footer');
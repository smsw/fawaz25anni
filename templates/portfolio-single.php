<?php
$post = $wp_query->post;


while (have_posts()) : the_post(); ?>

    <article <?php post_class('investor-faqs'); ?>>

        <div class="row">
            <div class="col-md-6">

                <div class="entry-content">
                    <h1><?php echo get_the_title($post->ID); ?></h1>
                        <?php
                            $terms = get_the_terms( $post->ID, 'portfolio-type' );

                            if ( $terms && ! is_wp_error( $terms ) ) :

                            $portfolio_types_links = array();

                            foreach ( $terms as $term ) {
                                $portfolio_types_links[] = $term->name;
                            }

                            $portfolio_type = join( ", ", $portfolio_types_links );
                            ?>

                            <ul class="list-inline small">
	                            <li><?php _e( 'Category:', 'fawazalhokairfashion' ); ?></li>
                                <li><?php echo $portfolio_type; ?></li>
                            </ul>
                        <?php endif; ?>

                    <?php
                        add_image_size('featured-image', 400, 9999);
                        the_post_thumbnail('featured-image', ['class' => 'hero img-responsive']);
                    ?>

                    <?php the_content(); ?>
                </div>

                <?php if(get_field('brand_statistics')): ?>
                <div class="table-responsive" style="color:#545454">
                    <table class="table">
                        <thead>
                            <tr>
	                            <th><?php _e( 'Country', 'fawazalhokairfashion' ); ?></th>
	                            <th><?php _e( 'Number of Stores', 'fawazalhokairfashion' ); ?></th>
                            </tr>
                        </thead>

                        <tbody>
                        <?php
                            $brand_stats = get_field('brand_statistics');
                            if( have_rows('brand_statistics') ): ?>
                                <?php $count = 0; $rows = 0;?>
                                <?php foreach ($brand_stats as $k): ?>
                                    <?php $count += $k['number_of_stores']; ?>
                                    <tr>
                                    <td><?php echo $k['country']; ?></td>
                                    <td><?php echo $k['number_of_stores']; ?></td>
                                </tr>
                                <?php $rows++; endforeach ; ?>
                            <?php endif;
                        ?>
                        </tbody>
                        <?php if($rows > 1):?>
                        <tfoot>
                            <tr>
	                            <th><?php _e( 'Total Stores', 'fawazalhokairfashion' ); ?></th>
                                <th><?php echo $count; ?></th>
                            </tr>
                        </tfoot>
                        <?php endif;?>
                    </table>
                </div>
                <?php endif; ?>

            </div>
        </div>

    </article>
<?php endwhile; ?>

<style>
    /* temp fix until tables and bad images are cleared from posts */
    .entry-content table {
        display: none;
    }

    p img {
        display: none;
    }
</style>
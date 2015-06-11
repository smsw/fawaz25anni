<div class="row">
    <div class="col-xs-12 col-md-8 col-md-offset-2">
        <?php while (have_posts()) : the_post(); ?>
            <article <?php post_class('clearfix'); ?> style="border-bottom:10px solid lightseagreen; margin-bottom:25px; padding-bottom: 25px; ">
                <header class="clearfix">
                    <h1 class="entry-title" style="text-align: left;margin:0;"><a href="<?php the_permalink(); ?>" title="Read more"><?php the_title(); ?></a></h1>
                </header>
                <div class="entry-content">
                    <?php the_excerpt(); ?>
                    <div class="text-right">
                        <a href="<?php the_permalink(); ?>" class="btn btn-default btn-primary">Read More <i class="fa fa-angle-right"></i> </a>
                    </div>
                </div>

            </article>
        <?php endwhile; ?>
    </div>
</div>
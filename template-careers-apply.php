<?php
/*
Template Name: Careers Apply
*/
?>

<div class="content col-xs-12 col-md-8 col-md-offset-2 careers-apply">
    <main role="main">

        <?php while (have_posts()) : the_post(); ?>
            <?php get_template_part('templates/page', 'header'); ?>
            <?php get_template_part('templates/content', 'page'); ?>
        <?php endwhile; ?>

        <?php require_once('portal/front/careers.php'); ?>
    </main>
    <!-- /.main -->
</div><!-- /.content -->
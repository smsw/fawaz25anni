<?php
/*
Template Name: Careers Apply - New
*/
?>

<div class="content col-md-12">
    <main role="main">

        <?php while (have_posts()) : the_post(); ?>
            <?php get_template_part('templates/page', 'header'); ?>
            <?php get_template_part('templates/content', 'page'); ?>
        <?php endwhile; ?>

        <?php require_once('portal/front/careers_test.php'); ?>
    </main>
    <!-- /.main -->
</div><!-- /.content -->
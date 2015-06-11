<?php
/*
Template Name: Page Template
*/
?>

<div class="content col-sm-8 col-sm-offset-2">
  <main role="main">

    <?php while (have_posts()) : the_post(); ?>
      <?php get_template_part('templates/page', 'header'); ?>
      <?php get_template_part('templates/content', 'page'); ?>
    <?php endwhile; ?>

  </main><!-- /.main -->
</div><!-- /.content -->
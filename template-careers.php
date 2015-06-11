<?php
/*
Template Name: Page Careers
*/
?>

<div class="content careers-listing col-xs-12">
  <main role="main">

    <?php while (have_posts()) : the_post(); ?>
      <?php get_template_part('templates/page', 'header'); ?>
      <?php get_template_part('templates/content', 'page'); ?>
    <?php endwhile; ?>

    <div class="vc_row wpb_row row-fluid">
      <div class="vc_col-sm-12 wpb_column vc_column_container">
        <?php require_once('portal/front/job_board.php'); ?>
      </div>
    </div>
  </main><!-- /.main -->
</div><!-- /.content -->
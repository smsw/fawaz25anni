<?php
/*
    Template Name: Home Template
*/
$base = get_template_directory_uri();
?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/content', 'page'); ?>
<?php endwhile; ?>

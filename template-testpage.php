<?php
/**
 * Template Name: Test Page
 */
?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
  <?php

  $loop = new Carawebs\LamhEile\Loops\Loop();
  $projects = new Carawebs\LamhEile\Loops\Projects();

  //$loop->custom_loop(3);
  echo "<h2>Projects?</h2>";
  $projects->projects_loop(2, true);
  if( ! empty ( $projects->pagination_links ) ): ?>
  <div class="pagination">
    <?= $projects->pagination_links; ?>
  </div>
  <?php endif; ?>

  <?php get_template_part('templates/content', 'page'); ?>
<?php endwhile; ?>

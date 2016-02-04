<?php
?>
<div class="row">
    <div class="col-md-3">
      <a href="<?php the_permalink(); ?>">
        <h3><?php the_title(); ?></h3>
      </a>
      <?php get_template_part('templates/entry-meta'); ?>
    </div>
    <div class="col-md-5">
      <?php echo wp_trim_words( get_the_excerpt(), $num_words = 10, $more = '…' ); ?>
      <p><a href="<?php the_permalink(); ?>">Read More &raquo;</a></p>
      <p>Post Type: <?php echo get_post_type( ) ?></p>
    </div>
  </div>
  <hr>

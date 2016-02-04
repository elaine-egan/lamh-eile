<?php
?>
<div class="row">
  <div class="col-md-3">
    <a href="<?php the_permalink(); ?>">
      <h2><?php the_title(); ?></h2>
    </a>
    <p>this is project-teaser.php</p>
  </div>
  <div class="col-md-5">
    <?php echo wp_trim_words( get_the_excerpt(), $num_words = 10, $more = '…' ); ?>
    <p><a href="<?php the_permalink(); ?>">Read More &raquo;</a></p>
    <p>Post Type: <?php echo get_post_type( ) ?></p>
    <ul><?php echo get_the_term_list( get_the_ID(), 'project-category', '<li class="project-categories">', ', ', '</li>' ) ?></ul>
  </div>
</div>
<hr>

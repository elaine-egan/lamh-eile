<?php
use Carawebs\Castleview\Extras;
$post_ID = get_the_ID();
?>
<div class="col-md-4">
  <a href="<?php the_permalink(); ?>">
    <?= Carawebs\Castleview\Display\Image::featured_image( $post_ID, 'w800' ); ?>
  </a>
  <a href="<?php the_permalink(); ?>">
    <h3><?php the_title(); ?></h3>
  </a>
  <p><?php echo wp_trim_words( get_the_excerpt(), $num_words = 10, $more = '…' ); ?></p>
  <p><a class="btn btn-default btn-md" href="<?php the_permalink(); ?>">Read More &raquo;</a></p>
  <!-- <p><i class="glyphicon glyphicon-tag"></i>&nbsp;<?php echo get_the_term_list( $post_ID, 'project-category', '', ', ', '' ) ?></p> -->
</div>

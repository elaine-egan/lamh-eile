<article <?php post_class(); ?>>
  <header>
    <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php get_template_part('templates/entry-meta'); ?>
  </header>
  <div class="entry-summary">
    <a href="<?php the_permalink(); ?>">
      <?= Carawebs\Castleview\Display\Image::featured_image( get_the_ID(), 'w800', ['bottom-margin'] ); ?>
    </a>
    <?php //the_excerpt(); ?>
    <?php echo wp_trim_words( get_the_excerpt(), $num_words = 50, $more = '…' ); ?>
    <p><a href="<?php the_permalink(); ?>">Read More &raquo;</a></p>
  </div>
</article>

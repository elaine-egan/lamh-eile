<?php
/**
 * Pass in:
 * $title
 * $intro
 * $services_data associative array of 'post_ID', 'the_permalink', 'the_title' for each service.
 */
echo ! empty( $section_style ) ? $section_style : '<div class="section services bg-image">';
?>
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <h2 class="text-center"><?= $title; ?></h2>
        <div class="lead text-center">
          <?= $intro; ?>
        </div>
      </div>
      <?php
      $i = 1;
      foreach( $services_data as $service ) {

        $permalink = $service['the_permalink'];
        // $excerpt = Carawebs\LamhEile\Extras\custom_get_excerpt( $service['post_ID'] );
        $preview = apply_filters( 'the_content', get_post_meta( $service['post_ID'], 'preview_content', true ) );
        $title = $service['the_title'];
        $class = sanitize_title( $title );
        $even = 0 === $i % 2 ? true : false;

        ?>
        <div class="col-md-5<?= true === $even ? ' col-md-offset-1' : null;?>">
          <div class="teaser <?= $class; ?>">
            <a href="<?= $permalink; ?>" class="title text-center">
              <h2><?= $title; ?></h2>
            </a>
            <div class="featured-image">
              <div class="hover-icon">
                <a href="<?= $permalink; ?>" title="<?= $title; ?>">
                  <i class="fa fa-angle-double-right"></i>
                </a>
              </div>
              <a href="<?= $permalink; ?>" title="<?= $title; ?>" class="title">
                <?= Carawebs\LamhEile\Display\Image::featured_image( $service['post_ID'], 'w800' ); ?>
              </a>
            </div>
            <p><?= $preview; ?></p>
            <p><a class="btn btn-default btn-md" href="<?= $permalink; ?>">Read More &raquo;</a></p>
          </div>
        </div>
        <?php

        $i ++;

      }
      ?>
    </div>
  </div>
</div>
<?php

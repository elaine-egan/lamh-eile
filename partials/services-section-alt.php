<?php
/**
 * Pass in:
 * $title
 * $intro
 * $services_data associative array of 'post_ID', 'the_permalink', 'the_title' for each service.
 */
echo ! empty( $section_style ) ? $section_style : '<div class="section services alt bg-image">';
?>
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h2><?= $title; ?></h2>
        <div class="lead">
          <?= $intro; ?>
        </div>
      </div>
    </div>
      <?php
      $i = 1;
      foreach( $services_data as $service ) {

        $permalink = $service['the_permalink'];
        $preview = apply_filters( 'the_content', get_post_meta( $service['post_ID'], 'preview_content', true ) );
        $title = $service['the_title'];
        $class = sanitize_title( $title );
        $even = 0 === $i % 2 ? ' alt-even' : ' alt-odd';

        ?>
        <div class="row<?= $even; ?>">
          <div class="teaser <?= $class; ?>">
            <div class="col-md-4">
              <div class="featured-image">
                <a href="<?= $permalink; ?>" title="<?= $title; ?>" class="title">
                  <?= Carawebs\LamhEile\Display\Image::featured_image( $service['post_ID'], '800landscape' ); ?>
                </a>
              </div>
            </div>
            <div class="col-md-7">
              <div class="teaser-content">
                <a href="<?= $permalink; ?>" class="title">
                  <h3><?= $title; ?></h3>
                </a>
                <p><?= $preview; ?></p>
                <p><a class="btn btn-default btn-md" href="<?= $permalink; ?>">More Info &raquo;</a></p>
              </div>
            </div>
          </div>
        </div>
        <hr>
        <?php

        $i ++;

      }
      ?>
    <!-- </div></div> -->
  </div>
</div>
<?php

<?php
/**
 * Pass in:
 * $title
 * $intro
 * $services_data associative array of 'post_ID', 'the_permalink', 'the_title' for each service.
 */
?>
<div class="section services">
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <h2 class="text-center"><?= $title; ?></h2>
        <div class="lead text-center">
          <?= $intro; ?>
        </div>
      </div>
      <?php
      foreach( $services_data as $service ) {

        $permalink = $service['the_permalink'];
        $excerpt = Carawebs\Castleview\Extras\custom_get_excerpt( $service['post_ID'] );
        $title = $service['the_title'];

        ?>
        <div class="col-md-4">
          <div class="teaser">
            <div class="featured-image">
              <div class="hover-icon">
                <a href="<?= $permalink; ?>" title="<?= $title; ?>">
                  <i class="fa fa-angle-double-right"></i>
                </a>
              </div>
              <a href="<?= $permalink; ?>" title="<?= $title; ?>" class="title">
                <?= Carawebs\Castleview\Display\Image::featured_image( $service['post_ID'], 'w800' ); ?>
              </a>
            </div>
            <a href="<?= $permalink; ?>" class="title">
              <h3><?= $title; ?></h3>
            </a>
            <p><?= $excerpt; ?></p>
            <p><a class="btn btn-default btn-md" href="<?= $permalink; ?>">Read More &raquo;</a></p>
          </div>
        </div>
        <?php

      }
      ?>
    </div>
  </div>
</div>
<?php

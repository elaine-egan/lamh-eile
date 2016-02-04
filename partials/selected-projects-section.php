<?php

if ( ! empty( $section_style ) ) {

  // The opening div for this section, with the required inline styles
  echo $section_style;

}

?>
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <h2 class="text-center"><?= $section_title; ?></h2>
        <div class="lead text-center">
          <?= $section_intro; ?>
        </div>
      </div>
      <?php

      foreach( $projects as $project_ID ) {

        $permalink  = get_the_permalink( $project_ID );
        $excerpt    = Carawebs\Castleview\Extras\custom_get_excerpt( $project_ID );
        $title      = get_the_title( $project_ID );

        ?>
        <div class="col-md-4">
          <div class="teaser">
            <a href="<?= $permalink; ?>" title="<?= $title; ?>">
              <?= Carawebs\Castleview\Display\Image::featured_image( $project_ID, 'w800' ); ?>
            </a>
            <a href="<?= $permalink; ?>">
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
    <hr>
    <div class="row">
      <div class="col-md-12">
        <div class="text-center lead">
          <p>
            Check out all our projects on our project page.
          </p>
          <a href="<?= esc_html(home_url('/projects' ) );?>" class="btn btn-default btn-md">View all Projects &raquo;</a>
        </div>
      </div>
    </div>
  </div>
</div>

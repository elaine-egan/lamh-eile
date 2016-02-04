<?php
echo ! empty( $section_style ) ? $section_style : '<div class="section intro bg-image">';
echo ! empty( $image_opacity ) ? $image_opacity : '<div class="opaque-layer">';
?>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="text-center">
          <h2><?= $title; ?></h2>
          <div class="lead">
            <?= $content; ?>
          </div>
          <?php

          if ( '1' == $include_cta ) {

            echo !empty ( $cta_intro ) ? "<p class='lead'>" . $cta_intro . "</p>" : null;

            echo Carawebs\Castleview\Display\Helpers::click_to_call();

          }
          ?>
        </div>
      </div>
    </div>
  </div>
</div>

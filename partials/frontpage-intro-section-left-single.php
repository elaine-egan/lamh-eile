<?php
/**
 *
 *
 */
echo ! empty( $section_style ) ? $section_style : '<div class="section intro bg-image">';
?>
  <div class="opaque-layer">
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-5">
        <h2><?= $title; ?></h2>
        <div class="lead">
          <?= $content; ?>
          <?= Carawebs\LamhEile\Display\Contact::combined_contact( $button_args ); ?>
        </div>
      </div>
      <div class="col-md-6 col-md-offset-1">
        <?= !empty( $image_HTML ) ? $image_HTML : $carousel; ?>
      </div>
    </div>
  </div>
</div>

<?php
/**
 * Full width intro block with a background image
 */
?>
<div class="section full-width bg-image<?php

  echo !empty( $text_scheme ) ? $text_scheme : null;
  echo !empty( $opacity ) ? $image_opacity : null;

?>" style="margin-left: -15px; margin-right: -15px; background:url('<?= $image['url']; ?>') center center; background-size: cover; padding-top: 80px; padding-bottom: 80px;">
  <div class="opaque-layer"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h2><?= $heading; ?></h2>
        <?php echo get_bloginfo ( 'description' );  ?>
        <?= $content; ?>
      </div>
      <div class="col-md-5 col-md-offset-1">
      </div>
    </div>
  </div>
</div>

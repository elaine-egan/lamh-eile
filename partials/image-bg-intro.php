<?php
/**
 * Full width intro block with a background image
 */
?>
<div class="intro">
  <div class="intro-body bg-image home-intro-image" style="background:url('..<?= $image['url']; ?>') center center; padding-top: 200px; padding-bottom: 300px;">
    <div class="opaque-layer"></div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-4 col-md-offset-1">
          <div class="well">
            <h2 style="text-transform: uppercase;"><?= $heading; ?></h2>
            <div class="intro-content lead">
              <?= $content; ?>
            </div>
            <a href="#internal-main" class="btn btn-circle page-scroll">
              <i class="glyphicon glyphicon-chevron-down"></i>
            </a>
          </div>
        </div>
        <!-- <div class="col-md-4 col-md-offset-2">
          <?php echo Carawebs\Castleview\Display\Helpers::main_CTA(); ?>
        </div> -->
      </div>
    </div>
  </div>
</div>
<!-- <div class="">
  <div class="intro text-center">
    <div class="intro-body bg-image home-intro-image" style="background:url('..<?= $image['url']; ?>') center center; padding-top: 200px; padding-bottom: 300px;">
      <div class="opaque-layer"></div>
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-md-offset-2">
            <div class="well">
              <h2><?= $heading; ?></h2>
              <p><?= $content; ?></p>
              <a href="#internal-main" class="btn btn-circle page-scroll">
                <i class="glyphicon glyphicon-chevron-down"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> -->

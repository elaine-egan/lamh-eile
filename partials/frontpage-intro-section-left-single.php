<?php
/**
 *
 *
 */
?>
<div class="section intro bg-image">
  <div class="opaque-layer">
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h2><?= $title; ?></h2>
        <div class="lead">
          <?= $content; ?>
        </div>
        <?php

        // if ( !empty ( $cta_intro ) && '1' == $cta ) {
        //
        //   echo "<p class='lead'>" . $cta_intro . "</p>";
        //
        // }
        //
        // if ( '1' == $include_cta ) {
        //
        //   echo Carawebs\LamhEile\Display\Helpers::click_to_call();
        //
        // }

        ?>
      </div>
      <div class="col-md-5 col-md-offset-1">
        <?= $image_HTML; ?>
      </div>
    </div>
  </div>
</div>

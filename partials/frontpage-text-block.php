<?php
echo ! empty( $section_style ) ? $section_style : '<div class="section text-block">';
?>
  <div class="container">
    <div class="row">
      <?php
      if( !empty ( $title ) ) {

        ?>
        <div class="col-md-12">
          <h2 class="text-center"><?= $title; ?></h2>
        </div>
        <?php

      }

      ?>
      <div class="col-md-8 col-md-offset-2">
        <div class="intro-content">
          <?= $content; ?>
        </div>
      </div>
    </div>
  </div>
</div>

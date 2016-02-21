<?php
echo ! empty( $section_style ) ? $section_style : '<div class="section bg-image">';
?>
  <div class="container-fluid">
    <div class="row no-gutters">
      <div class="col-md-6">
        <div class="section-content">
          <?= $primary_content; ?>
        </div>
      </div>
      <div class="section-image col-md-6">
        <?= $image_html; ?>
      </div>
    </div>
  </div>
</div>

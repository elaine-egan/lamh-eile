<?php
echo ! empty( $section_style ) ? $section_style : '<div class="section bg-image">';
?>
  <div class="container-fluid">
    <div class="row no-gutters">
      <div class="col-md-6">
        <?= $primary_content; ?>
      </div>
      <div class="col-md-6">
        <?= $secondary_content; ?>
      </div>
    </div>
  </div>
</div>

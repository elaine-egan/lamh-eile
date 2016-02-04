<?php
echo ! empty( $section_style ) ? $section_style : '<div class="section bg-image">';
?>
  <div class="container">
    <div class="row">
      <div class="col-md-5">
        <?= $left_content; ?>
      </div>
      <div class="col-md-5 col-md-offset-2">
        <?= $right_content; ?>
      </div>
    </div>
  </div>
</div>

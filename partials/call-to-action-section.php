<?php
if ( ! empty( $section_style ) ) {

  // The opening div for this section, with the required inline styles
  echo $section_style;

}

?>
  <div class="container">
    <div class="col-md-8 col-md-offset-2">
      <div class="text-center">
        <h2><?= $title; ?></h2>
        <div class="lead"><?= $content; ?></div>
        <?= Carawebs\Castleview\Display\Helpers::click_to_call( null, 'Call' ); ?>
      </div>
    </div>
  </div>
</div>

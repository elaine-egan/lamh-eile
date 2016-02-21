<?php
/**
* Template Name: Front Page Template
*/
while (have_posts()) : the_post();

$flexible_content = new Carawebs\LamhEile\Display\Dynamic( get_the_ID() );

// The flexible layout
$flexible_content->the_flexible_content();

?>
<div class="section map">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div id="map-canvas"></div>
      </div>
    </div>
  </div>
</div>
<?php

endwhile; ?>

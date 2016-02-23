<?php
/**
* Template Name: Front Page Template
*/
use Carawebs\LamhEile\Display;

while (have_posts()) : the_post();

$frontpage = new Display\Frontpage( get_the_ID() );
$frontpage->the_intro();

$flexible_content = new Display\Dynamic( get_the_ID() );


// The flexible layout
$flexible_content->the_flexible_content();

?>

<!-- <div class="section map">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div id="map-canvas"></div>
      </div>
    </div>
  </div>
</div> -->
<?php

endwhile; ?>

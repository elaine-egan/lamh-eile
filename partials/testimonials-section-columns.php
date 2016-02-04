<?php
if ( ! empty( $section_style ) ) {

  // The opening div tag for this section, with the required inline styles
  echo $section_style;

}
?>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2 class="text-center">Testimonials</h2>
        <div class="testimonials-grid">
          <?php
          foreach ( $testimonials as $testimonial ) {

            $image = !empty( $testimonial['image']['url'] ) ? $testimonial['image'] : null;

            ?>
            <div class="testimonial">
              <div class="text-center">
                <?php
                if( ! empty ( $image ) ){
                  echo "<img src='{$testimonial['image']['url']}' class='$image_classes' title='{$testimonial['image']['title']}' alt='{$testimonial['image']['title']}' height='{$testimonial['image']['height']}' width='{$testimonial['image']['width']}'>";
                }
                ?>
                <!-- <h2><?php // $testimonial['short_text']; ?></h2> -->
                <div class="testimonial-content">
                  <?= $testimonial['text']; ?>
                </div>
                <div class="testimonial-footer small">
                  <?= $testimonial['name']; ?>
                  <br>
                  <?= $testimonial['company'] ?>
                </div>
              </div>
            </div>
            <?php

          }
          ?>
          <div class="gridbreak"></div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php

?>
<div class="section">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2 class="text-center">Our Clients</h2>
      </div>
      <div class="clients-grid">
        <?php
        foreach ( $data as $testimonial ) {

          $image = !empty( $testimonial['image']['url'] ) ? $testimonial['image'] : null;

          ?>
          <div class="client">
            <div class="text-center">
              <?php
              if( !empty ( $image ) ){
                echo "<img src='{$testimonial['image']['url']}' class='img-responsive' title='{$testimonial['image']['title']}' alt='{$testimonial['image']['title']}' height='{$testimonial['image']['height']}' width='{$testimonial['image']['width']}'>";
              }
              if( !empty ( $testimonial['short_text'] ) ) {

                ?>
                <div class="testimonial-content">
                  <?= $testimonial['short_text']; ?>
                </div>
                <?php

              }
              ?>
            </div>
          </div>
          <?php

        }
        ?>
        <div class="gridbreak"></div><div class="gridbreak"></div><div class="gridbreak"></div><div class="gridbreak"></div>
      </div>
    </div>
  </div>
</div>

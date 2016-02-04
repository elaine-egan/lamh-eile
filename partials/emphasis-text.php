<?php
/**
 * A HTML section with emphasis text and an optional call to action
 */
?>
<div class="section">
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="lead text-center">
          <?php
          echo $content;

          if( '1' === $include_cta ) {
            ?>
            <div class="topspace">
              <?= $this->cta; ?>
            </div>
            <?php

          }
          ?>
        </div>
      </div>
    </div>
  </div>
</div>

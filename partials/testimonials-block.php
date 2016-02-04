<?php
/**
 * Markup for a Bootstrap 3 slider holding testimonials text
 * Add .slide to #testimonials-carousel for slide transtion
 * Add .carousel-fade for fade transition
 * data-ride="carousel" causes auto play
 */
?>
<div class="well">
  <?php

  foreach( $testimonials as $testimonial ) {

    ?>
  <div class="brick">
    <blockquote>
      <p><?= $testimonial['text'] ; ?></p>
      <footer><?= $testimonial['name'] ; ?></footer>
    </blockquote>
  </div>
  <?php
  }
  ?>
</div>

<?php
/**
* Markup for a Bootstrap 3 slider holding testimonials text
* Add .slide to #testimonials-carousel for slide transtion
* Add .carousel-fade for fade transition
* data-ride="carousel" causes auto play
*/
if ( ! empty( $section_style ) ) {

  // The opening div for this section, with the required inline styles
  echo $section_style;

}

?>
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2 text-center lead">
      <h2>Testimonials</h2>
      <div id="testimonials-carousel" class="testimonials-carousel carousel carousel-fade" data-ride="carousel">
        <div class="carousel-inner">
          <?php
          $i = 0;

          foreach( $testimonials as $testimonial ) {

            ?>
            <div class="item<?= 0 === $i ? ' active' : null ; ?>">
              <blockquote>
                <p><?= $testimonial['text'] ; ?></p>
                <footer><?= $testimonial['name'] ; ?></footer>
              </blockquote>
            </div>
            <?php

            $i ++;

          }
          ?>
        </div>
        <div class="carousel-control-wrap">
          <div class="row">
            <div class="col-xs-4">
              <a class="left" href="#testimonials-carousel" data-slide="prev" title="Previous Testimonial"><i class="glyphicon glyphicon-chevron-left"></i></a>
            </div>
            <div class="col-xs-4">
              <a class="play-pause" id="pause-carousel" title="Pause Testimonials"><i class="glyphicon glyphicon-pause"></i></a>
              <a class="play-pause" id="play-carousel" title="Play Testimonials"><i class="glyphicon glyphicon-play"></i></a>
            </div>
            <div class="col-xs-4">
              <a class="right" href="#testimonials-carousel" data-slide="next" title="Next Testimonial"><i class="glyphicon glyphicon-chevron-right"></i></a></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

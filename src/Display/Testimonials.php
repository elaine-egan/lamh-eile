<?php

namespace Carawebs\LamhEile\Display;

class Testimonials {

  public static function testimonials_data() {

    $data = new \Carawebs\LamhEile\Fetch\PostMeta( get_the_ID() );
    $subfields = ['text' => 'text', 'name' => 'text', 'company' => 'text' ];

    return $data->repeater( 'testimonials', $subfields );

  }

  public static function get_testimonials() {

    return self::testimonials_data();

  }

  /**
   * Build testimonials block for the page template
   *
   * @param  string $mode Determines how the HTML should be structured
   * @return string       HTML markup for testimonials block
   */
  public static function the_testimonials( $mode = 'slider' ) {

    $testimonials = self::testimonials_data();

    ob_start();

    switch ( $mode ) {

      case 'slider':
        include( get_template_directory() . '/partials/testimonials-slider.php');
        break;

      case 'block':
        include( get_template_directory() . '/partials/testimonials-block.php');
        break;

      default:
        # code...
        break;
    }

    echo ob_get_clean();

  }


}

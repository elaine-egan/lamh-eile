<?php

namespace Carawebs\LamhEile\Display;

class Carousel {

  /**
   * Fetch image data that has been stored by means of an ACF repeater field
   *
   * The subfield name is assumed to be 'image'.
   *
   *
   * @param  string $fieldname  The fieldname
   * @param  string $image_size Required image size
   * @return array              Array of image data
   */
  public static function carousel_data( $fieldname, $image_size ) {

    $data = new \Carawebs\LamhEile\Fetch\PostMeta( get_the_ID() );

    $subfields = ['image' => ['image_ID', $image_size], 'description' => 'text' ];

    return $data->repeater( $fieldname, $subfields );

  }

  /**
   * Construct HTML for a Bootstrap 3 carousel
   *
   * @param  string $fieldname  The fieldname
   * @param  string $image_size Required image size
   * @return string             HTML for carousel
   */
  public static function the_carousel( $fieldname = 'carousel', $image_size = 'full', $type = 'background' ) {

    $images = self::carousel_data( $fieldname, $image_size );

    // If there are no images set, go back empty
    // -------------------------------------------------------------------------
    if ( empty( $images ) ) { return; }

    ob_start();

    switch ( $type ) {
      case 'background':
        include_once( get_template_directory() . '/partials/background-image-carousel.php' );
        break;

      case 'basic':
        include_once( get_template_directory() . '/partials/basic-carousel-2.php' );
        break;

      default:
        # code...
        break;
    }

    return ob_get_clean();

  }

}

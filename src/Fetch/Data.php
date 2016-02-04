<?php

namespace Carawebs\LamhEile\Fetch;

/**
 * Abstract class contains core methods for return of Data stored by means of ACF
 *
 * @since      1.0.0
 * @package    LamhEile
 * @subpackage Display
 * @author     David Egan <david@carawebs.com>
 * @link:      http://www.advancedcustomfields.com/
 */
abstract class Data {

  /**
   * Filter/Sanitize data according by type
   *
   * @since 1.0.0
   * @uses esc_html()
   * @uses wp_kses_post()
   * @param  string $content Data to be filtered
   * @param  string $type    Type of data - denotes the filter to use
   * @return string          Filtered data
   */
  static public function filter( $content, $type ){

    $output = '';

    switch( $type ){

      case "OEmbed":

        $output = $content;

        break;

      case "esc_html":

        $output = esc_html( $content );

        break;

      case "the_content":

        $output = apply_filters( 'the_content', $content );

        break;

      case "text":

        $output = esc_html( $content );

        break;

      case "float":

        $output = (float)$content;

        break;

      case "int":

        $output = (int)$content;

        break;

    }

    return wp_kses_post( $output );

  }

  /**
   * Filter and return an image.
   *
   * This static method will return an array of necessary attributes to enable
   * construction of HTML for an image.
   *
   * @since 1.0.0
   * @uses wp_prepare_attachment_for_js()
   * @param  string|integer $image_ID Post ID of the image to be returned
   * @param  array  $meta             An array containing image size
   * @return array  Necessary data to build an image (ID, src, title, height, width, alt)
   */
  static public function image_filter( $image_ID, array $meta ) {

    $image_object = wp_prepare_attachment_for_js( $image_ID );

    $image_size = $meta[1];

    $output = [
      'ID'      => $image_ID,
      'url'     => $image_object['sizes'][$image_size]['url'],
      'title'   => $image_object['title'],
      'height'  => $image_object['sizes'][$image_size]['height'],
      'width'   => $image_object['sizes'][$image_size]['width'],
      'alt'     => $image_object['alt'],
    ];

    return $output;

  }

  /**
   * Return image markup
   *
   * carawebs_class_autoloader('Data');
   * StudentStudio\Fetch\Data::image( 2301, 'thumbnail' );
   *
   * @param  [type] $image_ID   [description]
   * @param  string $image_size [description]
   * @return [type]             [description]
   */
  static public function get_image( $image_ID, $image_size = 'full' ) {

    $image_object = wp_prepare_attachment_for_js( $image_ID );
    $src          = $image_object['sizes'][$image_size]['url'];
    $title        = $image_object['title'];
    $height       = $image_object['sizes'][$image_size]['height'];
    $width        = $image_object['sizes'][$image_size]['width'];
    $alt          = $image_object['alt'];

    $image ="<img src='$src' width='$width' height='$height' title='$title' class='img-responsive'/>";

    return $image;

  }

  static public function the_image( $image_ID, $image_size = 'full' ) {

    echo self::get_image( $image_ID, $image_size );

  }

  /**
   * [repeater description]
   * @param  [type] $post_ID    [description]
   * @param  [type] $field_name [description]
   * @param  array  $subfields  [description]
   * @return [type]             [description]
   */
  static public function acf_repeater( $post_ID, $field_name, array $subfields ) {

    $repeater = get_post_meta( $post_ID, $field_name, true );

    $data = [];

    if( $repeater ) {

      for( $i = 0; $i < $repeater; $i++ ) {

        $row = [];

        foreach( $subfields as $subfield => $type ){

          $rawdata = $field_name . '_' . $i . '_' . $subfield;
          $output = get_post_meta( $post_ID, $rawdata, true );

          if ( is_array( $type ) && 'image_ID' == $type[0] ){

            /**
             * This is an image subfield.
             * $subfield for images is structured [ $subfield => [ 'image_ID', 'size' ] ]
             * $output is the image_ID
             * $type[0] is the string 'image_ID' - to give the data type
             * $type[1] is a string denoting the specified image size to return
             */
            $output = self::image_filter( $output, $type );

          } else {

            $output = self::filter( $output, $type );

          }

          $row[$subfield] = $output;

        }

        $data[] = $row;

      }

      return $data;

    }

  }

}

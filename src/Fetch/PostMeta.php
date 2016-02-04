<?php
namespace Carawebs\LamhEile\Fetch;
//carawebs_class_autoloader('Data');

/**
 * Fetch post meta stored in the postmeta table by means of ACF repeater field
 *
 * @since      1.0.0
 * @package    StudentStudio
 * @subpackage PostMeta
 * @author     David Egan <david@carawebs.com>
 *
 */
class PostMeta extends \Carawebs\LamhEile\Fetch\Data {

  /**
   * [$post_ID description]
   * @var [type]
   */
  public $post_ID;

  /**
   * The image size - used to return the correct image object
   * @var string
   */
  public $image_size;

  /**
   * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
   * @param string|int $post_ID Post ID for fetching metadata
   */
  public function __construct( $post_ID = null ){

    $this->post_ID = $post_ID;
    $this->image_size = 'full';

  }

  /**
   * Fetch data from post_meta table, make sense of ACF repeater field
   *
   * Returns subfield data grouped by "row" into arrays.
   *
   * @param  string $field_name Repeater field name
   * @param  array  $subfields  Array of subfields
   * @param  string $image_size Image size to return
   * @return array  $data       Array of repeater field data, grouped by "row"
   *
   */
  public function repeater( $field_name, array $subfields ) {

    $repeater = get_post_meta( $this->post_ID, $field_name, true );

    $data = [];

    if( $repeater ) {

      for( $i = 0; $i < $repeater; $i++ ) {

        $row = [];

        foreach( $subfields as $subfield => $type ){

          $rawdata = $field_name . '_' . $i . '_' . $subfield;
          $output = get_post_meta( $this->post_ID, $rawdata, true );

          if ( is_array( $type ) && 'image_ID' == $type[0] ){

            /**
             * This is an image subfield.
             * $subfield for images is structured [ $subfield => [ 'image_ID', 'size' ] ]
             * $output is the image_ID
             * $type[0] is the string 'image_ID' - to give the data type
             * $type[1] is a string denoting the specified image size to return
             */
            $output = $this->image_filter( $output, $type );

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

  /**
   * Fetch data from post_meta table
   *
   * @param  string $field_name Repeater field name
   * @param  array  $type       Type of field
   * @return array  $data       Filtered field data
   *
   */
  public static function field_output( $field_name, $type ) {

    $output = get_post_meta( get_the_ID(), $field_name, true );

    if ( is_array( $type ) && 'image_ID' == $type[0] ){

      /**
      * This is an image subfield.
      * $subfield for images is structured [ $subfield => [ 'image_ID', 'size' ] ]
      * $output is the image_ID
      * $type[0] is the string 'image_ID' - to give the data type
      * $type[1] is a string denoting the specified image size to return
      */
      $output = $this->image_filter( $output, $type );

    } else {

      $output = self::filter( $output, $type );

    }

    return $output;

  }

}

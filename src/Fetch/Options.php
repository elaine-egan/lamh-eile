<?php
namespace Carawebs\LamhEile\Fetch;

/**
 * Return options table data, stored by ACF.
 *
 * This class collects, filters and returns field values from the WordPress
 * options table, for Data that has been stored by means of the ACF plugin.
 * Returns single fields and repeater fields. *
 *
 * @since      1.0.0
 * @package    StudentStudio
 * @subpackage Fetch
 * @author     David Egan <david@carawebs.com>
 */
class Options extends Data {

  /**
   * Filter and return a value from the options table.
   *
   * For values stored in the format `'options_' . $field_name`.
   *
   * @since 1.0.0
   * @uses get_option();
   * @param  string $field_name The options table field name
   * @param  string $field_type The field type - to be used in the filter() method
   * @return mixed              The filtered value
   */
  static public function get_option( $field_name, $field_type ){

    $content = get_option( 'options_' . $field_name );

    return self::filter( $content, $field_type );

  }

  /**
   * Pass in an array of ACF field names for data stored in options table.
   *
   * @since 1.0.0
   * @param  array $options An array of field names
   * @return [type]          [description]
   */
  static public function get_ACF_stored_array( $options ){

    $output = [];

    foreach( $options as $field_name => $field_type ){

      $content = get_option( 'options_' . $field_name );

      $output[$field_name] = self::filter( $content, $field_type );

    }

    return $output;

  }

  /**
   * Get and return an options array options table.
   *
   * @since 1.0.0
   * @param  array $options The options field name
   * @return [type]          [description]
   */
  static public function get_options_array( $field_name ) {

    $output = [];
    $options = get_option( $field_name );

    if ( ! is_array( $options ) ) { return; }

    foreach( $options as $key => $value ){

      $output[$key] = self::filter( $value, 'text' );

    }

    return $output;

  }

  /**
   * Get and return an options array options table.
   *
   * @since 1.0.0
   * @param  array $options The options field name
   * @return [type]          [description]
   */
  static public function get_unfiltered_ACF_options_array( $field_name ) {

    return get_option( 'options_' . $field_name );

  }

  /**
   * Fetch data from options table, make sense of ACF repeater field
   *
   * Returns subfield data grouped by "row" into arrays.
   *
   * @param  string $field_name Repeater field name
   * @param  array  $subfields  Array of subfields
   * @param  string $image_size Image size to return
   * @return array  $data       Array of repeater field data, grouped by "row"
   *
   */
  static public function repeater( $repeater_field, $subfields ){

    $repeater = get_option( 'options_' . $repeater_field );

    $data = [];

    if( $repeater ) {

      for( $i = 0; $i < $repeater; $i++ ) {

        foreach( $subfields as $subfield => $field_type ){

          $content = get_option( 'options_' . $repeater_field . '_' . $i . '_' . $subfield );

          $output = self::filter( $content, $field_type );

          $data[$subfield] = $output;

          }

        }

      }

    return $data;

  }

}

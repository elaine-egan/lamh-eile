<?php
namespace Carawebs\LamhEile\Display;

/**
 * Callback functions to define shortcodes
 */
class Shortcodes {

  /**
   * The Call to Action shortcode function
   *
   * Shortcode is registered in `/lib/extras.php`.
   *
   * @param  [type] $atts [description]
   * @return [type]       [description]
   */
  public static function main_CTA_shortcode( $atts ) {

    extract( shortcode_atts( array(
  		'type'   => 'phone',
      'text'   => null,
      'prefix' => null,
  		), $atts )
		);

    return Contact::CTA( $type, $text, $prefix );

  }

  public static function share_this_shortcode( $atts ) {

    extract( shortcode_atts( array(
  		'heading' => null,
  		), $atts )
		);

    return Contact::share_this( $heading );

  }

}

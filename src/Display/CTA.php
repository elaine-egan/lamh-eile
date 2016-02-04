<?php

namespace Carawebs\LamhEile\Display;

class CTA {

  public static function get_cta_data( $fieldname, $type ) {

    $data = new \Carawebs\LamhEile\Fetch\PostMeta( get_the_ID() );

    return $data->field_output( $fieldname, $type );

  }

  public static function the_cta( $fieldname, $type ) {

    $content = self::get_cta_data( $fieldname, $type );
    
    include_once( get_template_directory() . '/partials/call-to-action.php' );

  }

}

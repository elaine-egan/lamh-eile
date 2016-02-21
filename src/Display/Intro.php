<?php

namespace Carawebs\LamhEile\Display;

use Carawebs\LamhEile\Fetch;

class Intro {

  /**
   * Get data from the database
   *
   * @param  string $fieldname The ACF fieldname
   * @param  array  $subfields Array of subfields
   * @return array             Data needed to build the intro block
   */
  public static function get_intro_data( $fieldname, $subfields ) {

    $data = new Fetch\PostMeta( get_the_ID() );

    return $data->repeater( $fieldname, $subfields );

  }

  public static function the_intro( $fieldname, $subfields, $layout = 'left-single' ) {

    $data = self::get_intro_data( $fieldname, $subfields );
    //caradump($data);
    $image        = $data[0]['image'];
    $title        = $data[0]['heading'];
    $content      = $data[0]['content'];
    $text_scheme  = $data[0]['text_colour'];
    $opacity      = $data[0]['image_opacity'];
    $op_colour    = $data[0]['opacity_colour'];
    $layout       = $data[0]['layout'];
    $include_cta  = $data[0]['cta'];
    $cta_intro    = $data[0]['cta_intro'];

    $image_opacity  = self::opaque_inline_style( $opacity, $op_colour );
    $section_style  = self::section_inline_style( $image, $text_scheme );

    if( 'left-single' === $layout ) {

      include_once( get_template_directory() . '/partials/frontpage-intro-section-left-single.php' );

    }

    if ( 'centred' === $layout ) {
      echo "<h2>Centre</h2>";
      include_once( get_template_directory() . '/partials/frontpage-intro-section-centred.php' );

    }

  }

  public static function opaque_inline_style( $opacity = null, $op_colour = null ) {

    if ( null === $opacity ) { return; }

    if ( !empty ( $op_colour ) ) {

      ob_start();
      ?>
      <div class="opaque-layer" style="background-color: <?= $op_colour; ?>; opacity: <?= $opacity; ?>;">

      <?php

      return ob_get_clean();

    }

  }

  public static function section_inline_style( $image = null, $text_scheme = null  ) {

    if ( null === $image ) { return; }

    $fixed = true;

    ob_start();

    ?>
    <div class="section intro full-width bg-image<?php

      echo !empty( $text_scheme ) ? ' ' . $text_scheme : null;

    ?>" style="margin-left: -15px; margin-right: -15px; background:url('<?= $image['url']; ?>') center center<?= true === $fixed ? ' fixed' : null; ?>; background-size: cover;">
    <?php


    return ob_get_clean();

  }

}

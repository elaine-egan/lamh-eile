<?php
namespace Carawebs\LamhEile\Display;

use Carawebs\LamhEile\Loops;
//use Carawebs\LamhEile\Display;

class Frontpage {

  /**
   * The post ID
   * @var [type]
   */
  private $post_ID;

  public $testimonials;

  public $carousel;

  public function __construct( $post_ID ) {

    $this->post_ID = $post_ID;
    $this->set_testimonials();

  }

  public function set_testimonials() {

    $this->testimonials = Testimonials::get_testimonials();

  }

  public function the_testimonials( $mode ) {

    echo Testimonials::the_testimonials( $mode );;

  }

  // public function the_carousel( $fieldname  = 'intro_carousel' ) {
  //
  //   $size       = 'full';
  //   $type       = 'basic';
  //
  //   echo Carousel::the_carousel( $fieldname, $size, $type );
  //
  // }

  public function the_intro() {

    $title        = get_post_meta( $this->post_ID, 'intro_title', true );
    $image_ID     = get_post_meta( $this->post_ID, 'intro_image', true );
    $content      = apply_filters( 'the_content', get_post_meta( $this->post_ID, 'intro_content', true ) );
    $image_HTML   = wp_get_attachment_image( $image_ID, 'large', '', ['class' => 'img-responsive'] );
    $subfields    = ['image', 'text'];
    $carousel     = Carousel::the_carousel( 'intro_carousel', $subfields, 'full', 'basic' );
    $button_args  = [
      'btn_class' => [
        'btn-md',
        'btn-block'
        ]
      ];

    $style          = $this->inline_style_data();
    $section_style  = $this->section_inline_style ( $style['bg_image_ID'], $style['fixed'], $style['bg_colour'], $style['text_colour'], $style['opacity'], 'two-column' );

    ob_start();

    include_once( get_template_directory() . '/partials/frontpage-intro-section-left-single.php' );

    echo ob_get_clean();

  }

  private function inline_style_data () {

    return [
      'bg_image_ID' => get_post_meta( $this->post_ID, 'image', true ),
      'bg_colour'   => get_post_meta( $this->post_ID, 'background_colour', true ),
      'text_colour' => get_post_meta( $this->post_ID, 'text_colour', true ), // 'light_text', 'dark_text', 'default_text'
      'opacity'     => get_post_meta( $this->post_ID, 'image_opacity', true ),
      'fixed'       => '1' === get_post_meta( $this->post_ID, 'fixed_image', true ) ? true : false, // 'fixed' position on background image
    ];

  }

  private function section_inline_style ( $image_ID = null, $fixed, $background_colour, $text_colour, $opacity = null, $class = null ) {

    $style = null;
    $text_scheme = $text_colour;

    // An image has not been set, background colour not set, so return null and don't apply any styles
    if( null === $image_ID && null === $background_colour ) { return; }


    $img_src = wp_get_attachment_image_src( $image_ID, 'full' )[0];

    // removed `margin-left: -15px; margin-right: -15px; ` from the inline style

    ob_start();
    ?>
    <div class="section<?= !empty( $class ) ? ' ' . $class . ' ' : ' '; ?>full-width bg-image<?= !empty( $text_scheme ) ? ' '. $text_scheme : null; ?>" style="background:url('<?= $img_src; ?>') center center<?= true === $fixed ? ' fixed' : null; ?>; background-size: cover;">
      <div class="opaque-layer" <?php
      if ( !empty( $background_colour ) ) {

        echo 'style="background-color: ' . $background_colour . ';';
        echo !empty( $opacity ) ? ' opacity: ' . $opacity . ';"' : '"';

      }

      ?>></div>
      <?php

      return ob_get_clean();

    }

  public function the_call_to_action( $fieldname = 'call_to_action', $type = 'text' ) {

    //echo CTA::the_cta( $fieldname, $type );
  echo Helpers::main_CTA();

  }

  /**
   * Return some projects CPTs
   *
   * Accepts a term (from 'project-category' custom taxonomy) and the number of
   * posts to display. The call to methods in the `Projects()` class can include
   * any `WP_Query` parameters - these will be merged and act to override the
   * custom query.
   *
   * @param  [type] $project_cats    [description]
   * @param  [type] $number_of_posts [description]
   * @return [type]                  [description]
   */
  public function the_projects( $count = '-1', $pagination = false, $term = [] ) {

    $projects = new Loops\Projects();

    $projects_data = $projects->projects_data( $term, $count );

    return $projects->projects_loop( $count, false, $term );

    //$IDs = $projects->project_IDs( ['sea', 'space'] );
    //$objects = $projects->project_objects( ['sea', 'space'] );

  }

}

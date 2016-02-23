<?php
namespace Carawebs\LamhEile\Display;

use Carawebs\LamhEile\Fetch;
use Carawebs\LamhEile\Extras;
use Carawebs\LamhEile\Loops;
/**
*
* Return data for a landing page.
*
*
* @package Carawebs
* @subpackage Display
* @author David Egan <david@carawebs.com>
*
*/
class Dynamic {

  /**
   * Markup for call to action
   * @var string
   */
  private $cta;

  /**
   * Name of the ACF Flexible Content Field
   * @var string
   */
  private $flex_fieldname;

  /**
   * Instantiate the class
   *
   * @param [type] $post_ID [description]
   */
  public function __construct ( $post_ID, $flex_fieldname = 'flexible_content' ) {

    $this->post_ID        = $post_ID;
    $this->flex_fieldname = $flex_fieldname;
    //$this->set_workbook();
    $this->set_cta();

  }

  /**
   * Set the Call to Action
   *
   */
  private function set_cta() {

    //$this->cta = Contact::main_CTA();
    $this->cta = Contact::click_to_call();

  }

  /**
   * Build data for flexible content blocks
   *
   * @return string     $this->flex_fieldname The name of the flexible content field
   */
  public function the_flexible_content () {

    // Array of flexible content
    $rows = get_post_meta( $this->post_ID, $this->flex_fieldname, true );

    if ( !$rows ) { return; }

    $row_data = '';

    foreach( (array)$rows as $count => $subfield) {

      switch ( $subfield ) {

        case 'emphasis_text':

          $row_data .= $this->the_emphasis_text( $count );

          break;

        case 'two_column_section':

          $row_data .= $this->the_two_column_section( $count );

          break;

        case 'text_block':

          $row_data .= $this->the_text_block( $count );

          break;

        case 'featured_projects':

          $row_data .= $this->the_featured_projects( $count );

          break;

        case 'testimonials':

          $row_data .= $this->the_testimonials( $count );

          break;

        case 'clients':

          $row_data .= $this->the_clients( $count );

          break;

        case 'services_section':

          $row_data .= $this->the_services( $count );

          break;

        case 'call_to_action':

          $row_data .= $this->the_call_to_action( $count );

          break;

        case 'intro':

          $row_data .= $this->the_intro( $count );

          break;

        case 'full_width_two_column_section':

          $row_data .= $this->the_full_width_two_column_section( $count );

          break;

      }

    }

    echo $row_data;

  }

  private function the_full_width_two_column_section( $count ) {

    // Get the background styles, and build the opening tag
    // -------------------------------------------------------------------------
    $layout             = get_post_meta( $this->post_ID, $this->flex_fieldname . '_' . $count . '_layout', true );
    $style              = $this->inline_style_data( $count );
    $class              = 'two-column no-section-padding';
    $section_style      = $this->section_inline_style ( $style['bg_image_ID'], $style['fixed'], $style['bg_colour'], $style['text_colour'], $style['opacity'], $class );
    $fg_image_ID        = get_post_meta( $this->post_ID, $this->flex_fieldname . '_' . $count . '_foreground_image', true );
    $primary_content    = get_post_meta( $this->post_ID, $this->flex_fieldname . '_' . $count . '_content_column', true );
    $secondary_content  = get_post_meta( $this->post_ID, $this->flex_fieldname . '_' . $count . '_second_content_column', true );
    $image_html         = wp_get_attachment_image( $fg_image_ID, 'large', '', ['class' => 'img-responsive'] );

    $primary_content    = ! empty( $primary_content ) ? apply_filters( 'the_content', $primary_content ) : null;
    $secondary_content  = ! empty( $secondary_content ) ? apply_filters( 'the_content', $secondary_content ) : null;

    ob_start();

    switch ( $layout ) {
      case 'content-left':
        include( get_template_directory() . '/partials/left-content-column-section.php' );
        break;

      case 'content-right':
        include( get_template_directory() . '/partials/right-content-column-section.php' );
        break;

      case 'content-both':
        include( get_template_directory() . '/partials/two-column-section-full-width.php' );
        break;

      default:
        include( get_template_directory() . '/partials/two-column-section-full-width.php' );
        break;
    }

    return ob_get_clean();

  }

  /**
   * [the_intro description]
   * @param  [type] $count [description]
   * @return [type]        [description]
   */
  private function the_intro( $count ) {

    // Get the background styles, and build the opening tag
    // -------------------------------------------------------------------------
    $style          = $this->inline_style_data( $count );
    $section_style  = $this->section_inline_style ( $style['bg_image_ID'], $style['fixed'], $style['bg_colour'], $style['text_colour'], $style['opacity'], 'intro' );

    $content      = $this->flex_fieldname . '_' . $count . '_content';
    $title        = $this->flex_fieldname . '_' . $count . '_title';

    $content      = apply_filters( 'the_content', get_post_meta( $this->post_ID, $content, true ) );
    $title        = apply_filters( 'the_title', get_post_meta( $this->post_ID, $title, true ) );
    $include_cta  = get_post_meta( $this->post_ID, $this->flex_fieldname . '_' . $count . '_cta', true );
    $cta_intro    = get_post_meta( $this->post_ID, $this->flex_fieldname . '_' . $count . '_cta_intro', true );
    $columns      = get_post_meta( $this->post_ID, $this->flex_fieldname . '_' . $count . '_column_width', true );

    switch ( $columns ) {
      case 'col-md-8':
        $columns .= ' col-md-offset-2';
        break;

      case 'col-md-6':
        $columns .= ' col-md-offset-3';
        break;
    }

    ob_start();
    include( get_template_directory() . '/partials/frontpage-intro-section-centred.php');
    return ob_get_clean();

  }

  private function the_call_to_action( $count ) {

    // Get the background styles, and build the opening tag
    // -------------------------------------------------------------------------
    $style          = $this->inline_style_data( $count );
    $section_style  = $this->section_inline_style ( $style['bg_image_ID'], $style['fixed'], $style['bg_colour'], $style['text_colour'], $style['opacity'], 'call-to-action' );

    $title        = get_post_meta( $this->post_ID, $this->flex_fieldname . '_' . $count . '_title', true );
    $content      = get_post_meta( $this->post_ID, $this->flex_fieldname . '_' . $count . '_text_content', true );
    $type         = get_post_meta( $this->post_ID, $this->flex_fieldname . '_' . $count . '_type', true );

    ob_start();
    include( get_template_directory() . '/partials/call-to-action-section.php');
    return ob_get_clean();

  }

  /**
   * Insert a services section partial
   *
   * @param  string|int $count The flexible field count
   * @return string            HTML markup for the services section
   */
  private function the_services( $count ) {

    $style          = $this->inline_style_data( $count );
    $section_style  = $this->section_inline_style ( $style['bg_image_ID'], $style['fixed'], $style['bg_colour'], $style['text_colour'], $style['opacity'], 'the-services' );


    $title = get_post_meta( $this->post_ID, $this->flex_fieldname . '_' . $count . '_services_title', true );
    $intro = get_post_meta( $this->post_ID, $this->flex_fieldname . '_' . $count . '_services_intro', true );
    $services = new Loops\Services();
    $services_data = $services->services_data();

    ob_start();

    include( get_template_directory() . '/partials/services-section-alt.php');

    return ob_get_clean();

  }

  private function the_featured_projects( $count ) {

    // Get the background styles, and build the opening tag
    // -------------------------------------------------------------------------
    $style          = $this->inline_style_data( $count );
    $section_style  = $this->section_inline_style ( $style['bg_image_ID'], $style['fixed'], $style['bg_colour'], $style['text_colour'], $style['opacity'], 'featured-projects' );

    $projects       = get_post_meta( $this->post_ID, $this->flex_fieldname . '_' . $count . '_projects', true );
    $section_title  = esc_html( get_post_meta( $this->post_ID, $this->flex_fieldname . '_' . $count . '_title', true ) );
    $section_intro  = apply_filters( 'the_content', get_post_meta( $this->post_ID, $this->flex_fieldname . '_' . $count . '_introduction', true ) );

    ob_start();
    include ( get_template_directory() . '/partials/selected-projects-section.php' );
    return ob_get_clean();

  }

  /**
   * Build a testimonials block
   *
   * @param  int        $count      The flexible field placement counter
   * @return string                 Testimonials markup
   *
   */
  private function the_testimonials( $count ) {

    // Get the background styles, and build the opening tag
    // -------------------------------------------------------------------------
    $style          = $this->inline_style_data( $count );
    $section_style  = $this->section_inline_style ( $style['bg_image_ID'], $style['fixed'], $style['bg_colour'], $style['text_colour'], $style['opacity'], 'testimonials' );

    // Fetch field-specific data
    // -------------------------------------------------------------------------
    $fieldname      = $this->flex_fieldname . '_' . $count . '_testimonial';
    $image_style    = get_post_meta( $this->post_ID, $this->flex_fieldname . '_' . $count . '_image_option', true );
    $image_classes  = 'round' === $image_style ? 'img-responsive img-circle' : 'img-responsive';
    $display_option = get_post_meta( $this->post_ID, $this->flex_fieldname . '_' . $count . '_display_option', true );

    $subfields = [

      'text'   => 'text',
      'image'       => ['image_ID','full'],
      'name'        => 'text',
      'company'     => 'text'

    ];

    $testimonials = Fetch\Data::acf_repeater( $this->post_ID, $fieldname, $subfields );

    $test = $this->inline_style_data ( $count );

    if ( 'columns' === $display_option ) {

      ob_start();

        include( get_template_directory() . '/partials/testimonials-section-columns.php' );

      return ob_get_clean();

    } elseif ( 'slider' === $display_option ) {

      ob_start();

        include( get_template_directory() . '/partials/testimonials-slider.php' );

      return ob_get_clean();

    }

  }

  /**
   * Build a clients block
   *
   * @param  int        $count      The flexible field placement counter
   * @return string                 Testimonials markup
   */
  private function the_clients( $count ){

    $fieldname = $this->flex_fieldname . '_' . $count . '_clients';
    $image     = ['image_ID','full'];
    $subfields = [
      'short_text'  => 'text',
      'image'       => $image
    ];

    $data = Fetch\Data::acf_repeater( $this->post_ID, $fieldname, $subfields );
    $client_count = count( $data );

    ob_start();

    include( get_template_directory() . '/partials/clients-section.php' );

    return ob_get_clean();

  }

  /**
   * Build an emphasis text block
   *
   * @param  int         $count      The flexible field placement counter
   * @return string      HTML for emphasis text block
   */
  private function the_emphasis_text( $count ) {

    $field = $this->flex_fieldname . '_' . $count . '_text_content';

    $content = apply_filters( 'the_content', get_post_meta( $this->post_ID, $field, true ) );

    // Call to Action
    $include_cta = get_post_meta( $this->post_ID, $this->flex_fieldname . '_' . $count . '_call_to_action', true );

    ob_start();
    include( get_template_directory() . '/partials/emphasis-text.php' );
    return ob_get_clean();

  }

  private function inline_style_data ( $count ) {

    return [
      'bg_image_ID' => get_post_meta( $this->post_ID, $this->flex_fieldname . '_' . $count . '_image', true ),
      'bg_colour'   => get_post_meta( $this->post_ID, $this->flex_fieldname . '_' . $count . '_background_colour', true ),
      'text_colour' => get_post_meta( $this->post_ID, $this->flex_fieldname . '_' . $count . '_text_colour', true ), // 'light_text', 'dark_text', 'default_text'
      'opacity'     => get_post_meta( $this->post_ID, $this->flex_fieldname . '_' . $count . '_image_opacity', true ),
      'fixed'       => '1' === get_post_meta( $this->post_ID, $this->flex_fieldname . '_' . $count . '_fixed_image', true ) ? true : false, // 'fixed' position on background image
    ];

  }

  private function the_text_block( $count ) {

    // Get the background styles, and build the opening tag
    // -------------------------------------------------------------------------
    $style          = $this->inline_style_data( $count );
    $section_style  = $this->section_inline_style ( $style['bg_image_ID'], $style['fixed'], $style['bg_colour'], $style['text_colour'], $style['opacity'], 'call-to-action' );

    $field = $this->flex_fieldname . '_' . $count . '_text_block';
    $title = $this->flex_fieldname . '_' . $count . '_title';
    $content  = apply_filters( 'the_content', get_post_meta( $this->post_ID, $field, true ) );
    $title    = apply_filters( 'the_title', get_post_meta( $this->post_ID, $title, true ) );

    ob_start();
    include( get_template_directory() . '/partials/frontpage-text-block.php');
    return ob_get_clean();

  }

  private function the_two_column_section( $count ) {

    // Get the background styles, and build the opening tag
    // -------------------------------------------------------------------------
    $style          = $this->inline_style_data( $count );
    $section_style  = $this->section_inline_style ( $style['bg_image_ID'], $style['fixed'], $style['bg_colour'], $style['text_colour'], $style['opacity'], 'two-column' );

    $left_content   = apply_filters( 'the_content', get_post_meta( $this->post_ID, $this->flex_fieldname . '_' . $count . '_left_column_content', true ) );
    $right_content  = apply_filters( 'the_content', get_post_meta( $this->post_ID, $this->flex_fieldname . '_' . $count . '_right_column_content', true ) );

    ob_start();

    include( get_template_directory() . '/partials/two-column-section.php' );

    return ob_get_clean();

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

}

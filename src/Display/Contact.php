<?php
namespace Carawebs\LamhEile\Display;

use Carawebs\LamhEile\Fetch;

/**
 * This class contains helper methods that display contact data
 */
class Contact {

  public static function CTA ( $type, $text = null, $number_prefix = null ) {

    switch ( $type ) {
      case 'phone':
        return self::click_to_call( null, null, $text, $number_prefix );
        break;

      case 'email':
        return self::email_link( $text );
        break;

      default:
        # code...
        break;
    }

  }

  public static function combined_contact( $args ) {

    $email = self::get_email();
    extract( $args );

    $button_class = ! empty( $btn_class ) ? ' ' . implode( " ", $btn_class ) : null;

    ob_start();

    ?>
    <div class="row">
      <div class="col-md-6">
        <?= self::click_to_call( $args ); ?>
      </div>
      <div class="col-md-6">
        <a href="mailto:<?= $email; ?>" class="email btn btn-default<?= $button_class; ?>">
          Email Us
        </a>
      </div>
    </div>
    <hr>
    <?php
    return ob_get_clean();

  }

  /**
   * Build the main call to action
   *
   * @see /partials/main-call-to-action.php
   * @see /partials/click-to-call.php
   *
   * @param  string $button_text Text for a button
   * @param  string $action      Phone or email - phone is default
   * @return string              HTML markup for the call to action
   */
  public static function main_CTA( $button_text = null, $action = 'phone' ) {

    if ( 'phone' === $action ) {

      $number = self::mobile_number();
      $clickable_number = self::call_number( $number );
      $button_text = empty( $button_text ) ? "Click to Call" : $button_text;

      ob_start();

      include( get_template_directory() . '/partials/click-to-call.php');

      return ob_get_clean();

    }

    elseif ( 'email' === $action ) {

      $email = self::email();
      $button_text = empty( $button_text ) ? "Email Us" : $button_text;

      ob_start();

      include( get_template_directory() . '/partials/email-call-to-action.php');

      return ob_get_clean();

    }

  }

  /**
   * Return HTML for social sharing buttons - justified button group
   *
   * @param  string  $heading An optional heading for this block
   * @return string           HTML for the social sharing buttonsAdd basic styles to buttons
   */
  public static function share_this( $heading = null ) {

    ob_start();

    include( get_template_directory() . '/partials/social-buttons-justified.php');

    return ob_get_clean();

  }

  /**
   * [address description]
   * @return [type] [description]
   */
  public static function address() {

    $address = Carawebs\Carawebs\Fetch\Options::get_options_array( 'carawebs_address_data' );

    caradump($address);

  }

  /**
   * Return the registered mobile number for this site
   *
   * This requires the number to be set using the Carawebs Address plugin. The number is
   * stored as `carawebs_address_data['mobile']` in the options table.
   *
   * @return string Mobile number
   */
  public static function mobile_number() {

    $address = Fetch\Options::get_options_array( 'carawebs_address_data' );

    return $address['mobile'];

  }

  public static function get_facebook() {

    return Fetch\Options::get_options_array( 'carawebs_address_data' )['facebook'];

  }

  public static function get_twitter() {

    return Fetch\Options::get_options_array( 'carawebs_address_data' )['twitter'];

  }

  public static function get_email() {

    return Fetch\Options::get_options_array( 'carawebs_address_data' )['email'];

  }

  public static function call_number( $number ) {

    $number = str_replace( ' ', '', $number);
    $number = str_replace( '-', '', $number);
    return $number;

  }

  /**
   * Build and return HTML for a "click to call" button
   *
   * The button displays a number on > medium screen widths. For phone display, a
   * click-to-call button is displayed. This method collects necessary data
   * and outputs it in a partial.
   *
   * This method is hooked onto the `[CTA]` shortcode.
   *
   * @see `/partials/click-to-call.php`
   * @see `/src/Display/Shortcodes::main_CTA_shortcode()`
   * @param  array  $button_settings An array of settings - extracted to $number, $button_text, $prefix, $btn_class
   * @param  string $number       The phone number. If null, fetch the number set by `carawebs-address` plugin
   * @param  string $prefix       The prefix, if necessary
   * @param  string $button_text  Button text, overrides defaults
   * @return string               HTML for a click to call button
   */
  public static function click_to_call( $button_settings = null ) {

    if (! empty( $button_settings ) ) {

      extract( $button_settings );

    }

    $number           = empty( $number ) ? self::mobile_number() : $number;
    $clickable_number = self::call_number( $number );
    $button_text      = empty( $button_text ) ? "Click to Call" : $button_text;
    $prefix           = ! empty( $prefix ) ? $prefix : null;
    $btn_class        = ! empty( $btn_class ) ? ' ' . implode( " ", $btn_class ) : null;

    ob_start();

    include( get_template_directory() . '/partials/click-to-call.php' );

    return ob_get_clean();

  }

  /**
   * Build and return HTML for an email call to action
   *
   * @param  [type] $text [description]
   * @return [type]       [description]
   */
  public static function email_link( $text = null ) {

    $text = empty( $text ) ? "Email Us" : $text;
    $email = self::get_email();

    ob_start();

    ?>
    <a href="mailto:<?= $email; ?>" class="btn btn-default btn-md email">
      <?= $text; ?>
    </a>
    <?php

    return ob_get_clean();

  }

  public static function social_follow( $format = 'inline' ) {

    $facebook = self::get_facebook();
    $twitter = self::get_twitter();
    $email = self::get_email();

    if ( 'inline' === $format ) {

      include( get_template_directory() . '/partials/social-follow.php' );

    } elseif ( 'justified' === $format ) {

      include( get_template_directory() . '/partials/social-follow-justified.php' );

    }

  }

}

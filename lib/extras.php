<?php

namespace Carawebs\LamhEile\Extras;

use Carawebs\LamhEile\Setup;
use Carawebs\LamhEile\Display;

/**
 * Add <body> classes
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Add class if sidebar is active
  if (Setup\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

function custom_get_excerpt( $post_ID, $words = 10 ) {

  $post_object = get_post( $post_ID );

  if ( empty( $post_object->post_excerpt ) ) {

    return wp_kses_post( wp_trim_words( $post_object->post_content, $words, '&hellip;' ) );

  } else {

    return wp_kses_post( $post_object->post_excerpt );

  }

}

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');

add_shortcode( 'CTA', array( '\Carawebs\LamhEile\Display\Shortcodes', 'main_CTA_shortcode') );
add_shortcode( 'share_this', array( '\Carawebs\LamhEile\Display\Shortcodes', 'share_this_shortcode') );

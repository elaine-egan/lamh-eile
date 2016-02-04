<?php
namespace Carawebs\LamhEile\Display;

class Image {

  public static function featured_image( $post_ID, $size = 'full', $class_array = [], $include_caption = false ) {

    $class_array[] = 'img-responsive'; // For Bootstrap responsive images

    $class = implode( ' ', $class_array ); // Ensure that all images are responsive

    if ( has_post_thumbnail( $post_ID ) ) {

      /* get the title attribute of the post or page
       * and apply it to the alt tag of the image if the alt tag is empty
       */
      $attachment_id = get_post_thumbnail_id( $post_ID );

      // if no alt attribute is filled out then echo "Featured Image of article: Article Name"
      if ( '' === get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) ) {

          $alt = the_title_attribute(
              array(
                  'before' => __( 'Featured image of article: ', 'castleview' ),
                  'echo' => false
              )
          );

      } else {

          $alt = trim( strip_tags( get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) ) );

      }

      // Get the title attribute for the featured image
      $title = get_the_title( $attachment_id );

      // Get the Image Caption
      $caption = get_post( $attachment_id )->post_excerpt;

      $default_attr = array(
          'class' => $class,
          'alt' => $alt,
          'title' => $title
      );

      if ( false === $include_caption ) {

        return get_the_post_thumbnail( $post_ID, $size, $default_attr );

      }

      if ( true === $include_caption ) {

        return [

          'image'   => get_the_post_thumbnail( $post_ID, $size, $default_attr ),
          'caption' => $caption
          
        ];

      }

    }

  }

}

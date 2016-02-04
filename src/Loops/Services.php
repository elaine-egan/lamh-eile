<?php

namespace Carawebs\LamhEile\Loops;

class Services extends Loop {

  /**
   * Set up the default arguments for WP_Query.
   *
   * Pass in an array to override or extend the default arguments.
   * For example, pass an array to $override:
   * ```
   * [
   *   'post_status'            => array( 'publish' ),
   *   'posts_per_page'         => '-1',
   *   'order'                  => 'ASC',
   *   'orderby'                => 'menu_order',
   * ]
   * ```
   *
   * @since    1.0.0
   * @param array $override Array of WP_Query arguments
   */
  public function __construct( $override = [], $term = null ) {

    parent::__construct();

    $this->args = array_merge( $this->args, array_merge( [ 'post_type' => array( 'service' ) ], $override ) );

  }

  /**
   * Return a loop of 'project' Custom Post Types
   *
   * Typically used to return a stream of project teasers
   *
   * @param  [type] $override [description]
   * @return [type]           [description]
   */
  public function services_loop( $count, $pagination, $term = [], $override = [], $partial = '/partials/project-teaser.php' ) {

    $this->custom_loop( $count, $pagination, $override, $partial );

  }

  /**
   * A basic loop for a services custom archive page
   *
   * @return [type] [description]
   */
  public function the_services( $count = '-1', $pagination = false ) {

    return $this->projects_loop( $count, $pagination, [], [], '/partials/projects-project-teaser.php');

  }

  /**
   * Return an array of data for 'service' Custom Post Types
   *
   * @param  string $term     A term from the 'project-category' custom taxonomy
   * @param  array  $override Override arguments for `WP_Query`
   * @return array            Array containing the title, the permalink and the post ID
   */
  public function services_data ( $count = '-1', $override = [] ) {

    return $this->data_loop( $count, $override );

  }

  /**
   * Return an array of post IDs for 'service' Custom Post Types
   *
   * @param  array  $override Override arguments for `WP_Query`
   * @return array            An array of post IDs
   */
  public function service_IDs ( $count = '-1', $override = [] ) {

    return $this->post_IDs( $count, $override );

  }

  /**
   * Return an array of post objects for 'service' Custom Post Types
   *
   * @param  array  $override Override arguments for `WP_Query`
   * @return array            An array of post objects
   */
  public function service_objects ( $override = [] ) {

    return $this->post_objects( $override );

  }

}

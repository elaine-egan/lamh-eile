<?php

namespace Carawebs\LamhEile\Loops;

class Projects extends Loop {

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

    $this->args = array_merge( $this->args, array_merge( [ 'post_type' => array( 'project' ) ], $override ) );

  }

  /**
   * Return a loop of 'project' Custom Post Types
   *
   * Typically used to return a stream of project teasers
   *
   * @param  [type] $term     [description]
   * @param  [type] $override [description]
   * @return [type]           [description]
   */
  public function projects_loop( $count, $pagination = false, $term = [], $override = [], $partial = '/partials/project-teaser.php' ) {

    // Make it easy to get term into the query args
    if ( !empty( $term ) ) {

      $override = array_merge( $override, $this->tax_query_args( $term ) );

    }

    $this->custom_loop( $count, $pagination, $override, $partial );

  }

  /**
   * A basic loop for a projects archive page
   *
   * @return [type] [description]
   */
  public function the_projects( $count = '-1', $pagination = false ) {

    return $this->projects_loop( $count, $pagination, [], [], '/partials/projects-project-teaser.php');

  }

  /**
   * Return an array of data for 'project' Custom Post Types
   *
   * @param  string $term     A term from the 'project-category' custom taxonomy
   * @param  array  $override Override arguments for `WP_Query`
   * @return array            Array containing the title, the permalink and the post ID
   */
  public function projects_data ( $count = '-1', $term = null, $override = [] ) {

    // Make it easy to get term into the query args
    if ( !empty( $term ) ) {

      $override = array_merge( $override, $this->tax_query_args( $term ) );

    }

    return $this->data_loop( $count, $override );

  }

  /**
   * Return an array of post IDs for 'project' Custom Post Types
   *
   * @param  string $term     A term from the 'project-category' custom taxonomy
   * @param  array  $override Override arguments for `WP_Query`
   * @return array            An array of post IDs
   */
  public function project_IDs ( $count = '-1', $term = null, $override = [] ) {

    // Make it easy to get term into the query args
    if ( !empty( $term ) ) {

      $override = array_merge( $override, $this->tax_query_args( $term ) );

    }

    return $this->post_IDs( $count, $override );

  }

  /**
   * Return an array of post objects for 'project' Custom Post Types
   *
   * @param  string $term     A term from the 'project-category' custom taxonomy
   * @param  array  $override Override arguments for `WP_Query`
   * @return array            An array of post objects
   */
  public function project_objects ( $term = null, $override = [] ) {

    // Make it easy to get term into the query args
    if ( !empty( $term ) ) {

      $override = array_merge( $override, $this->tax_query_args( $term ) );

    }

    return $this->post_objects( $override );

  }

  /**
   * Build a filter based on terms in the 'project-category' custom taxonomy
   *
   * @return [type] [description]
   */
  public function projects_filter() {

    $terms = get_terms( ['project-category'] );

    $this->posts_filter( $terms );

  }

  /**
   * Build a `tax_query` argument array for a 'project-category' taxonomy term
   *
   * @param  string $term A term (slug) in the 'project-category' custom taxonomy
   * @return array        An argument to be added via `array_merge()` to the `WP_Query` arguments array
   */
  private function tax_query_args( $term, $tax = 'project-category' ) {

    $term_args = [
      'tax_query' => array(
        array(
          'taxonomy' => $tax,
          'field'    => 'slug',
          'terms'    => $term,
        )
      ),
    ];

    return $term_args;

  }

}

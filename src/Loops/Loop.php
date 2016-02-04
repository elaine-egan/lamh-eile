<?php
namespace Carawebs\LamhEile\Loops;
/**
* The file that defines the Loops class
*
*
* @link       http://carawebs.com/plugins/staff-area
* @since      1.0.0
*
* @package    LamhEile
* @subpackage Loops
*/

/**
* The loop class - used to define custom loops.
*
* Passing an array of arguments when instantiating the class object allows the
* default $args to be overridden.
*
* @since      1.0.0
* @package    LamhEile
* @subpackage Loops
* @author     David Egan <david@carawebs.com>
*/

class Loop {

  /**
  * Arguments to be passed to WP_Query()
  * @since    1.0.0
  * @var array
  */
  protected $args;

  public $pagination_links;

  /**
  * Set up the default arguments for WP_Query.
  *
  * Pass in an array to override or extend the default arguments.
  *
  * @since    1.0.0
  * @param array $override Array of WP_Query arguments
  */
  public function __construct( $override = [] ) {

    $this->args = array_merge( array (
    'post_type'              => array( 'post' ),
    'post_status'            => array( 'publish' ),
    'posts_per_page'         => '-1',
    'order'                  => 'DESC',
    'orderby'                => 'date',
    ),
    $override
  );

}

/**
* Build a custom loop
*
* @since   1.0.0
* @uses    WP_Query()
* @return  string HTML post teasers
*/
public function custom_loop( $count = '', $pagination = false, $override = [], $display_template = '/partials/teaser.php', $filter = false ) {

  $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

  $args = $this->override_args( $count, $pagination, $paged, $override );

  // Include a filter partial
  // ---------------------------------------------------------------------------
  if ( true === $filter ) { include_once( get_template_directory() . '/partials/filter.php' ); }

  // The Custom Query
  // ---------------------------------------------------------------------------
  $custom_query = new \WP_Query( $args );

  if ( $custom_query->have_posts() ) {

    while ( $custom_query->have_posts() ) {

      $custom_query->the_post();

      // The HTML for each teaser
      include( get_template_directory() . $display_template );

    }

  } else {

    //echo "There are no posts";

  }

  if ( $custom_query->max_num_pages > 1 AND true === $pagination ) {

    ob_start();

    $big = 999999999; // need an unlikely integer

    echo '<nav class="page">' . paginate_links( array(
      'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
      'format' => '?paged=%#%',
      'current' => max( 1, get_query_var('paged') ),
      //'mid_size'     => 3,
      //'end_size'     => 4,
      'type'         => 'list',
      'total' => $custom_query->max_num_pages
      ) ) . '</nav>';

      $this->pagination_links = ob_get_clean();

    }

  wp_reset_postdata();

}

private function override_args( $count = '-1', $pagination = false, $paged, $override = [] ) {

  // Override array
  $args = empty ( $override ) ?  $this->args : array_merge( $this->args, $override );

  // Posts per page
  $args = empty ( $count ) ?  $args : array_merge( $args, [ 'posts_per_page' => $count ] );

  // Pagination
  $args = true === $pagination ? array_merge( $args, ['nopaging' => false, 'paged' => $paged] ): $args ;

  return $args;

}

/**
* Build a custom loop that returns post data as an array
*
* @since   1.0.0
* @uses    WP_Query()
* @return  string HTML post teasers
*/
public function data_loop( $count = '-1', $override = [] ) {

  // Allow arguments to be added to this method directly. If none passed, use defaults
  // ------------------------------------------------------------------------
  //$args = empty ( $args ) ?  $this->args : array_merge( $this->args, $args );
  $args = $this->override_args( $count, null, null, $override );

  $custom_query = new \WP_Query( $args );

  $data_array = [];

  if ( $custom_query->have_posts() ) {

    while ( $custom_query->have_posts() ) {

      $custom_query->the_post();

      $data_array[] = [
        'the_title'       => get_the_title(),
        'the_permalink'   => get_the_permalink(),
        'post_ID'         => get_the_ID(),
      ];

    }

  } else {

    //echo "There are no posts";

  }

  wp_reset_postdata();

  return $data_array;

}

/**
 * Build a custom loop that returns an array of post IDs
 *
 * @since   1.0.0
 * @uses    WP_Query()
 * @param   string $count     Number of posts to return
 * @param   array $overrides  Override default `WP_Query()` arguments
 * @return  string HTML post teasers
 */
public function post_IDs( $count = '-1', $overrides = [] ) {

  $args = empty ( $overrides ) ?  $this->args : array_merge( $this->args, $overrides );

  // Just fetch IDs. Can't be overridden
  $args = array_merge( $args, ['fields' => 'ids'] );

  // Set the number of posts to return
  $args = array_merge( $args, ['posts_per_page' => $count] );

  $custom_query = new \WP_Query( $args );

  $ID_array = $custom_query->posts;

  wp_reset_postdata();

  return $ID_array;

}

/**
* Build a custom loop that returns an array of post IDs
*
* @since   1.0.0
* @uses    WP_Query()
* @return  string HTML post teasers
*/
public function post_objects( $overrides = [] ) {

  // Allow arguments to be added to this method directly. If none passed, use defaults
  // ---------------------------------------------------------------------------
  $args = empty ( $overrides ) ?  $this->args : array_merge( $this->args, $overrides );

  $object_array = [];

  $custom_query = new \WP_Query( $args );

  if ( $custom_query->have_posts() ) {

    $posts = $custom_query->posts;

    foreach( $posts as $post ) {

      $object_array[] = $post;

    }

  }

  wp_reset_postdata();

  return $object_array;

}

/**
 * Set pagination args
 *
 * @return [type] [description]
 */
protected function pagination_args() {

  return [
    'nopaging' => false,
    'paged'   => 'true'
  ];

}

public function posts_filter( $terms ) {

  include_once( get_template_directory() . '/partials/filter.php' );

}


/**
* Loop through all terms in the given taxonomy
*
* Display staff resource teasers grouped by resource category.
* @uses    get_terms()
* @since   1.0.0
* @return  string HTML staff resource teasers
*/
public function posts_by_term() {

  // Get all the term objects
  // ------------------------------------------------------------------------
  $terms = get_terms( 'resource_category' );

  foreach( $terms as $term )  {

    $name = $term->name;

    $tax_query = array( 'tax_query' => array(
      array(
        'taxonomy' => 'resource_category',
        'field'    => 'slug',
        'terms'    => $term->slug,
      ),
    )
  );

  echo "<h2>Staff Resources: $name</h2>";

  $this->resource_loop( $tax_query, false );

}

}

}

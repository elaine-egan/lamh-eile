<?php
namespace Carawebs\LamhEile\Display;

use Carawebs\LamhEile\Loops;

class ProjectsPage {

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
  public function the_projects( $number_of_posts = '-1', $pagination = false, $term = [], $override = [] ) {

    $projects = new Loops\Projects();

    //$projects_data = $projects->projects_data( $term, $return_number );

    return $projects->projects_loop( $number_of_posts, $pagination, $term, $override );

    //$IDs = $projects->project_IDs( ['sea', 'space'] );
    //$objects = $projects->project_objects( ['sea', 'space'] );

  }

  public function projects_data( $count = '-1', $term = null, $override = [] ) {

    $projects = new Loops\Projects();

      return $projects->projects_data( $count, $term, $override );

  }

}

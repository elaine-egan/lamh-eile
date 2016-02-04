<?php
namespace Carawebs\LamhEile\Display;
//use Carawebs\LamhEile\Fetch;

class Map {

  public static function init() {

    //add_action( 'wp_head', array( __CLASS__, 'map_head_scripts'), 1, 1 );
    add_action( 'wp_enqueue_scripts', array( __CLASS__, 'main_map_control') );
    add_action( 'wp_head', array( __CLASS__, 'initialise_googlemaps'), 2 );
    add_action( 'wp_head', array( __CLASS__, 'map_style'), 1);

    // Think Up
    // add_action('wp_head', 'cw_map_style', 1);
    // add_action('wp_head', 'cw_event_map_style', 1);
    // add_action('wp_head', 'carawebs_initialise_googlemaps', 2);
    // add_action('wp_enqueue_scripts', 'carawebs_googlemaps_control', 105);
    // add_action('wp_enqueue_scripts', 'carawebs_eventmap_control', 105);

  }

  public static function map_head_scripts() {

    $output = "<script>alert('THANKS BE TO FUCK!!!!!');</script>";

    echo $output;

  }

  public static function map_style() {

    echo '<style>#map-canvas { width: 100%; height: 400px; } </style>';

  }


  /**
   * Enqueue the main map control
   *
   *
   * @return void
   */
  public static function main_map_control(){

    wp_register_script( 'carawebs_googlemap', get_template_directory_uri() . '/assets/scripts/map-control.js', '', '', true);
    $eventimagelocation = get_template_directory_uri() . '/assets/images/map-marker.png';

    $site_variables = [

      'mainMarker'      => $eventimagelocation,
      'latitude'        => '52.76',
      'longitude'       => '-8.763',
      'zoom'            => '8',
      'waterColour'     => '#578fb8',
      'landColour'      => '#d3ffdf',
      'mainRoadColour'  => '#777777',
      'minorRoadColour' => '#786f6f',

    ];

    // This function makes variables available to carawebs_googlemap
    // Define the image in js like this: var image = (carawebsMapVars.eventMarkerImage);
    wp_localize_script( 'carawebs_googlemap', 'cwCentre', $site_variables );

    // Enqueue the map controls - they will be built into the <head>
    wp_enqueue_script('carawebs_googlemap');

  }

  public static function initialise_googlemaps(){

    $googlescript = '<script src="https://maps.googleapis.com/maps/api/js"></script>';

    echo $googlescript;

  }

}

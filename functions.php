<?php
/**
 * Twenty Seventeen functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 */

function add_cors_http_header(){
    header("Access-Control-Allow-Origin: *");
}
add_action('init','add_cors_http_header');


register_nav_menus( array(
    'primary' => 'Primary Theme Menu',
    'social' => 'Social Media'
) );


//Nav-Menu API Endpoints
function wp_church_spa_get_all_menus_and_items(){
    $menus = [];
    foreach (get_registered_nav_menus() as $slug => $description) {
        $obj = new stdClass;
        $obj->items = [];
        $obj->slug = $slug;
        $obj->description = $description;
        if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $slug ] ) ) {
            $menu = get_term( $locations[ $slug ] );
            $obj->items = wp_get_nav_menu_items($menu->term_id);
        }
        
        $menus[] = $obj;
        
    }

    return $menus;
}

register_rest_route( 'church_spa/v1', '/menus_items', array(
    'methods' => 'GET',
    'callback' => 'wp_church_spa_get_all_menus_and_items',
) );
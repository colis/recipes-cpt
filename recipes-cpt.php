<?php
/**
 * Plugin Name: Recipes CPT
 * Description: This plugin registers a custom post type called Recipes.
 * Version:     1.0.0
 * Author:      Carmine Colicino
 * Author URI:  https://github.com/colis/
 * Text Domain: recipes-cpt
 * Domain Path: /languages/
 *
 * @package    recipes_cpt
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The core plugin class that is used to define internationalization and
 * admin-specific hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-recipes-cpt.php';

/**
 * Initialize Recipes CPT plugin.
 *
 * @since    1.0.0
 */
function run_recipes_cpt() {

	$plugin = new Recipes_CPT();
	$plugin->run();

}
run_recipes_cpt();

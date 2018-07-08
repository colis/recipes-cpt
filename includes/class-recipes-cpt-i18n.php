<?php
/**
 * Recipes CPT I18n class.
 *
 * @package    recipes_cpt
 * @subpackage recipes_cpt/includes
 * @link       https://github.com/colis/recipes-cpt
 * @since      1.0.0
 * @author     Carmine Colicino <carminecolicino@gmail.com>
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 */
class Recipes_CPT_I18n {

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'recipes-cpt',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}

}

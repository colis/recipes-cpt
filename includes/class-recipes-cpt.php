<?php
/**
 * Recipes CPT core class.
 *
 * A class definition that includes hooks & functions used by the
 * admin area.
 *
 * @package    recipes_cpt
 * @subpackage recipes_cpt/includes
 * @link       https://github.com/colis/recipes-cpt
 * @since      1.0.0
 * @author     Carmine Colicino <carminecolicino@gmail.com>
 */

/**
 * Recipes CPT core class.
 *
 * This is used to define internationalization and to register the CPT.
 *
 * Also maintains the unique identifier for Recipes CPT as well as
 * the current version of the plugin.
 */
class Recipes_CPT {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Recipes_CPT_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of Recipes CPT.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * The Option Prefix for Recipes CPT.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $option_name    The option prefix for Recipes CPT.
	 */
	protected $option_name;

	/**
	 * Define the core functionality of Recipes CPT.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'recipes-cpt';
		$this->version     = '1.0.0';
		$this->option_name = 'recipes_cpt_';

		$this->load_dependencies();
		$this->set_locale();
		$this->recipes_cpt_init();
		$this->create_endpoints();

	}

	/**
	 * Load the required dependencies for Recipes CPT.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Recipes_CPT_Loader. Orchestrates the hooks of the plugin.
	 * - Recipes_CPT_I18n. Defines internationalization functionality.
	 * - Recipes_CPT_Init. Registers the Recipes CPT.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-recipes-cpt-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-recipes-cpt-i18n.php';

		/**
		 * The class responsible for registering the CPT.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-recipes-cpt-init.php';

		/**
		 * The class responsible for creating the custom endpoints for Recipes CPT.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-recipes-cpt-endpoints.php';

		$this->loader = new Recipes_CPT_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Recipes_CPT_I18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Recipes_CPT_I18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register the Recipes CPT.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function recipes_cpt_init() {

		$recipes_cpt_init = new Recipes_CPT_Init();

		$this->loader->add_action( 'init', $recipes_cpt_init, 'recipes_cpt' );

	}

	/**
	 * Define the Custom Endpoint for Recipes CPT.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function create_endpoints() {

		$plugin_endpoint = new Recipes_CPT_Endpoints();

		// Construct custom endpoints.
		$this->loader->add_action( 'rest_api_init', $plugin_endpoint, 'recipes_cpt_custom_api_route_constructor' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {

		$this->loader->run();

	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {

		return $this->plugin_name;

	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Recipes_CPT_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {

		return $this->loader;

	}

	/**
	 * Retrieve the version number of Recipes CPT.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {

		return $this->version;

	}

	/**
	 * Retrieve the option prefix for Recipes CPT.
	 *
	 * @since     1.0.0
	 * @return    string    The option name prefix of the plugin.
	 */
	public function get_option_name() {

		return $this->option_name;

	}

}

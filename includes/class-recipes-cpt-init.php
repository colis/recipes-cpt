<?php
/**
 * Recipes CPT initialization class.
 *
 * @package    recipes_cpt
 * @subpackage recipes_cpt/includes
 * @link       https://github.com/colis/recipes-cpt
 * @since      1.0.0
 * @author     Carmine Colicino <carminecolicino@gmail.com>
 */

/**
 * This class initializes the Recipes CPT.
 */
class Recipes_CPT_Init {

	/**
	 * Registers the Recipes CPT.
	 *
	 * @since    1.0.0
	 */
	public function recipes_cpt() {

		$labels = array(
			'name'               => __( 'Recipes', 'recipes-cpt' ),
			'singular_name'      => __( 'Recipe', 'recipes-cpt' ),
			'all_items'          => __( 'All recipes', 'recipes-cpt' ),
			'add_new'            => __( 'Add New', 'recipes-cpt' ),
			'add_new_item'       => __( 'Add New recipe', 'recipes-cpt' ),
			'edit'               => __( 'Edit', 'recipes-cpt' ),
			'edit_item'          => __( 'Edit recipe', 'recipes-cpt' ),
			'new_item'           => __( 'New recipe', 'recipes-cpt' ),
			'view_item'          => __( 'View recipe', 'recipes-cpt' ),
			'search_item'        => __( 'Search recipe', 'recipes-cpt' ),
			'not_found'          => __( 'No recipe found', 'recipes-cpt' ),
			'not_found_in_trash' => __( 'No recipe found in trash', 'recipes-cpt' ),
			'menu_name'          => __( 'Recipes', 'recipes-cpt' ),
		);

		$args = array(
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'custom-fields' ),
			'taxonomies'          => array( 'category' ),
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 6,
			'menu_icon'           => 'dashicons-carrot',
			'show_in_nav_menus'   => true,
			'publicly_queryable'  => true,
			'exclude_from_search' => false,
			'query_var'           => true,
			'can_export'          => true,
		);

		register_post_type( 'recipe', $args );
	}

}

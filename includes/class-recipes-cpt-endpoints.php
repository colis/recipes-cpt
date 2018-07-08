<?php
/**
 * Create the custom endpoint and expose the data for Recipes CPT.
 *
 * @package    recipes_cpt
 * @subpackage recipes_cpt/includes
 * @link       https://github.com/colis/recipes-cpt
 * @since      1.0.0
 * @author     Carmine Colicino <carminecolicino@gmail.com>
 */

/**
 * Define the custom endpoint content.
 *
 * Add the route for the Recipes CPT Endpoints and expose
 * the necessary data for the frontend.
 */
class Recipes_CPT_Endpoints {

	/**
	 * API Route Constructor.
	 *
	 * @since    1.0.0
	 */
	public function recipes_cpt_custom_api_route_constructor() {

		register_rest_route( 'v1', '/recipes', array(
			'methods'  => 'GET',
			'callback' => array( $this, 'all_recipes' ),
		) );

		register_rest_route( 'v1', '/recipes/(?P<id>\d+)', array(
			'methods'  => 'GET',
			'callback' => array( $this, 'recipe_by_id' ),
			'args'     => array(
				'id' => array(
					'validate_callback' => function( $param, $request, $key ) {
						return is_numeric( $param );
					},
				),
			),
		) );

	}

	/**
	 * The recipes endpoint returns all the available recipes.
	 * The response includes the title, the content, the ingredients and the permalink.
	 * The number of results to return can be changed using the num_results parameter (defaults to 4).
	 *
	 * @param WP_REST_Request $params The REST request parameters.
	 */
	public function all_recipes( WP_REST_Request $params ) {

		$num_results = isset( $params['num_results'] ) && is_int( intval( $params['num_results'] ) ) ? $params['num_results'] : 4;

		$args = array(
			'post_type'      => 'recipe',
			'posts_per_page' => $num_results,
		);

		$query = new WP_Query( $args );

		$result_object['recipes'] = array();

		foreach ( $query->posts as $post ) {

			$result_post = $this->build_response_object( $post );
			array_push( $result_object['recipes'], $result_post );

		}

		return $result_object;
	}

	/**
	 * The recipes endpoint returns all the available recipes.
	 * The response includes the title, the content, the ingredients and the permalink.
	 *
	 * @param WP_REST_Request $params The REST request parameters.
	 */
	public function recipe_by_id( WP_REST_Request $params ) {

		$args = array(
			'p'         => $params['id'],
			'post_type' => 'recipe',
		);

		$query = new WP_Query( $args );

		$result_object['recipes'] = array();

		foreach ( $query->posts as $post ) {

			$result_post = $this->build_response_object( $post );
			array_push( $result_object['recipes'], $result_post );

		}

		return $result_object;
	}

	/**
	 * Build the response object.
	 *
	 * @param WP_Post $post The post object.
	 */
	private function build_response_object( $post ) {
		$ingredients = get_post_meta( $post->ID, 'ingredients', true );

		return array(
			'title'       => $post->post_title,
			'content'     => $post->post_content,
			'ingredients' => $ingredients,
			'permalink'   => get_permalink( $post->ID ),
		);
	}
}

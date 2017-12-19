<?php
/**
 * Main Action
 *
 * @author Jimmy Latour <jimmy@evarisk.com>
 * @since 0.1.0
 * @version 0.1.0
 * @copyright 2017 Eoxia
 * @package WP-Instance
 */

namespace wp_instance;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Main Action
 */
class WP_Instance_Core_Action {

	/**
	 * Construct for register route.
	 *
	 * @since 0.1.0
	 * @version 0.1.0
	 */
	public function __construct() {
		add_action( 'rest_api_init', array( $this, 'callback_api_init' ), 99 );
	}

	/**
	 * Add routes for add/put/get instances of WordPress.
	 *
	 * @since 0.1.0
	 * @version 0.1.0
	 *
	 * @return void
	 */
	public function callback_api_init() {
		register_rest_route( 'wp-instance/v1', '/instance/(?P<id>\d+)', array(
			array(
				'methods'             => \WP_REST_Server::CREATABLE,
				'callback'            => array( WP_Instance_Core_Class::g(), 'create' ),
				'permission_callback' => function() {
					if ( get_current_user_id() ) {
						return true;
					}

					return false;
				},
			),
			array(
				'methods'             => \WP_REST_Server::READABLE,
				'callback'            => array( WP_Instance_Core_Class::g(), 'get' ),
				'permission_callback' => function() {
					if ( get_current_user_id() ) {
						return true;
					}

					return false;
				},
			),
		) );

		register_rest_route( 'wp-instance/v1', '/instance/(?P<id>\d+)', array(
			array(
				'methods'             => \WP_REST_Server::DELETABLE,
				'callback'            => array( WP_Instance_Core_Class::g(), 'delete' ),
				'permission_callback' => function() {
					if ( get_current_user_id() ) {
						return true;
					}

					return false;
				},
			),
		) );
	}
}

new WP_Instance_Core_Action();

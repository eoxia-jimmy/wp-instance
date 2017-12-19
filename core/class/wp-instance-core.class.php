<?php
/**
 * Main Class
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
 * Main Class
 */
class WP_Instance_Core_Class extends \eoxia\Singleton_Util {

	/**
	 * Construct required for Singleton_util
	 *
	 * @since 0.1.0
	 * @version 0.1.0
	 */
	protected function construct() {}

	/**
	 * Créer une instance de WordPress pour l'utilisateur current_user_id.
	 *
	 * @since 0.1.0
	 * @version 0.1.0
	 *
	 * @return array All WordPress instances for this user founded in user meta "\eoxia\Config_Util::$init['wp_instance']->meta_wp_instance".
	 */
	public function create( $request ) {
		if ( empty( $request['id'] ) || empty( $request['app_id'] ) || empty( $request['app_title'] ) || empty( $request['app_url'] ) || empty( $request['app_username'] ) || empty( $request['app_password'] ) ) {
			return false;
		}

		$user_id = (int) $request['id'];

		$app = array(
			'id'       => (int) $request['app_id'],
			'title'    => sanitize_text_field( $request['app_title'] ),
			'url'      => sanitize_url( $request['app_url'] ),
			'username' => sanitize_text_field( $request['app_username'] ),
			'password' => sanitize_text_field( $request['app_password'] ),
		);

		$instances = get_user_meta( $user_id, \eoxia\Config_Util::$init['wp_instance']->meta_wp_instance, true );

		if ( empty( $instances ) ) {
			$instances = array();
		}

		$instances[ (int) $app['id'] ] = $app;

		update_user_meta( $user_id, \eoxia\Config_Util::$init['wp_instance']->meta_wp_instance, $instances );

		return $instances;
	}

	/**
	 * Récupères les instances de WordPress pour l'utilisateur current_user_id.
	 *
	 * @since 0.1.0
	 * @version 0.1.0
	 *
	 * @return array Founded WordPress instances in user meta "\eoxia\Config_Util::$init['wp_instance']->meta_wp_instance".
	 */
	public function get( $request ) {
		$user_id = ! empty( $request['id'] ) ? (int) $request['id'] : 0;

		if ( empty( $user_id ) ) {
			return array(
				'code'    => 'rest_user_no_logged',
				'message' => __( 'User no logged', 'wp-instance' ),
				'data'    => array(
					'status' => 200,
				),
			);
		}

		$instances = get_user_meta( $user_id, \eoxia\Config_Util::$init['wp_instance']->meta_wp_instance, true );

		return $instances;
	}

	/**
	 * Supprimes une instance de WordPress pour l'utilisateur current_user_id.
	 *
	 * @since 0.1.0
	 * @version 0.1.0
	 *
	 * @param  WP_Rest_Request $request Les données de la requêtes.
	 * @return array                    Founded WordPress instances without the removed instance.
	 */
	public function delete( $request ) {
		if ( empty( $request['id'] ) || empty( $request['app_id'] ) ) {
			return false;
		}

		$user_id = (int) $request['id'];

		$app = array(
			'id' => (int) $request['app_id'],
		);

		$meta = get_user_meta( $user_id, \eoxia\Config_Util::$init['wp_instance']->meta_wp_instance, true );

		if ( empty( $meta ) ) {
			$meta = array();
		}

		if ( ! empty( $meta ) ) {
			foreach ( $meta as $key => $m ) {
				if ( (int) $m['id'] === (int) $app['id'] ) {
					unset( $meta[ $key ] );
					break;
				}
			}
		}

		update_user_meta( $user_id, \eoxia\Config_Util::$init['wp_instance']->meta_wp_instance, $meta );

		return $meta;
	}
}

new WP_Instance_Core_Class();

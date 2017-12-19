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
	 * Affiches la vue pour mêttre à jour les données de DigiRisk dans le réseau.
	 *
	 * @since 0.2.0
	 * @version 0.2.0
	 *
	 * @return void
	 */
	public function display() {
		$done = ( ! empty( $_GET['done'] ) && 'true' == $_GET['done'] ) ? true : false;

		require_once PLUGIN_DIGIRISK_DASHBOARD_PATH . '/core/view/upgrade.view.php';
	}
}

new WP_Instance_Core_Class();

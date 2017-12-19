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
	public function __construct() {}
}

new WP_Instance_Core_Action();

<?php
/**
 * Fichier boot du plugin
 *
 * @package WP-Instance
 */

namespace wp_instance;

/**
 * Plugin Name: WP Instance
 * Plugin URI:
 * Description: Allow to connect third party application to a WordPress
 * Version:     0.1.0
 * Author:      Eoxia
 * Author URI:  http://www.eoxia.com
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Domain Path: /core/assets/languages
 * Text Domain: wp-instance
 */

DEFINE( 'PLUGIN_WP_INSTANCE_PATH', str_replace( '\\', '/', realpath( plugin_dir_path( __FILE__ ) ) . '/' ) );
DEFINE( 'PLUGIN_WP_INSTANCE_URL', str_replace( '\\', '/', plugins_url( basename( __DIR__ ) ) . '/' ) );
DEFINE( 'PLUGIN_WP_INSTANCE_DIR', basename( __DIR__ ) );

require_once 'core/external/eo-framework/eo-framework.php';

\eoxia\Init_Util::g()->exec( PLUGIN_WP_INSTANCE_PATH, basename( __FILE__, '.php' ) );

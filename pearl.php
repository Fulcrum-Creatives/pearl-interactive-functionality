<?php
/**
 * Pearl Interactive Functionality plugin
 * 
 * @link              http://fulcrumcreatives.com/
 * @since             0.0.1
 * @package           Wdwtwwy
 *
 * @wordpress-plugin
 * Plugin Name:       Pearl Interactive Functionality
 * Plugin URI:        https://github.com/Fulcrum-Creatives/pearl-interactive-functionality
 * Description:       Custom functionality plugin for Pearl Interactive
 * Version:           0.0.1
 * Author:            Fulcrum Creatives
 * Author URI:        http://fulcrumcreatives.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       pearl
 * Domain Path:       /languages
 * GitHub Plugin URI: https://github.com/Fulcrum-Creatives/pearl-interactive-functionality
 * GitHub Branch:     development
 */

// If this file is called directly, abort.
if ( !defined( 'WPINC' ) ) {
	die;
}
if( !class_exists( 'Pearl' ) ) {
	class Pearl {
		
		/**
		 * Instance of the class
		 *
		 * @since 1.0.0
		 * @var Instance of Pearl class
		 */
		private static $instance;

		/**
		 * Instance of the plugin
		 *
		 * @since 1.0.0
		 * @static
		 * @staticvar array $instance
		 * @return Instance
		 */
		public static function instance() {
			if ( !isset( self::$instance ) && ! ( self::$instance instanceof Pearl ) ) {
				self::$instance = new Pearl;
				self::$instance->define_constants();
				add_action( 'plugins_loaded', array( self::$instance, 'load_textdomain' ) );
				self::$instance->includes();
				self::$instance->admin_init = new Pearl_Admin_Init();
				self::$instance->init = new Pearl_Init();
			}
		return self::$instance;
		}

		/**
		 * Define the plugin constants
		 *
		 * @since  1.0.0
		 * @access private
		 * @return voide
		 */
		private function define_constants() {
			// Plugin Version
			if ( ! defined( 'PEARL_VERSION' ) ) {
				define( 'PEARL_VERSION', '0.0.1' );
			}
			// Prefix
			if ( ! defined( 'PEARL_PREFIX' ) ) {
				define( 'PEARL_PREFIX', 'pearl_' );
			}
			// Textdomain
			if ( ! defined( 'PEARL_TEXTDOMAIN' ) ) {
				define( 'PEARL_TEXTDOMAIN', 'custom' );
			}
			// Plugin Options
			if ( ! defined( 'PEARL_OPTIONS' ) ) {
				define( 'PEARL_OPTIONS', 'pearl-options' );
			}
			// Plugin Directory
			if ( ! defined( 'PEARL_PLUGIN_DIR' ) ) {
				define( 'PEARL_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
			}
			// Plugin URL
			if ( ! defined( 'PEARL_PLUGIN_URL' ) ) {
				define( 'PEARL_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
			}
			// Plugin Root File
			if ( ! defined( 'PEARL_PLUGIN_FILE' ) ) {
				define( 'PEARL_PLUGIN_FILE', __FILE__ );
			}
		}

		/**
		 * Load the required files
		 *
		 * @since  1.0.0
		 * @access private
		 * @return void
		 */
		private function includes() {
			$includes_path = plugin_dir_path( __FILE__ ) . 'includes/';
			require_once PEARL_PLUGIN_DIR . 'admin/class-pearl-add-menu-items.php';
			require_once PEARL_PLUGIN_DIR . 'admin/class-pearl-admin-init.php';
			require_once PEARL_PLUGIN_DIR . 'includes/class-pearl-register-post-type.php';
			require_once PEARL_PLUGIN_DIR . 'includes/class-pearl-register-taxonomies.php';
			require_once PEARL_PLUGIN_DIR . 'includes/class-pearl-init.php';
		}

		/**
		 * Load the plugin text domain for translation.
		 *
		 * @since  1.0.0
		 * @access public
		 */
		public function load_textdomain() {
			$pearl_lang_dir = dirname( plugin_basename( PEARL_PLUGIN_FILE ) ) . '/languages/';
			$pearl_lang_dir = apply_filters( 'pearl_lang_dir', $pearl_lang_dir );

			$locale = apply_filters( 'plugin_locale',  get_locale(), PEARL_TEXTDOMAIN );
			$mofile = sprintf( '%1$s-%2$s.mo', PEARL_TEXTDOMAIN, $locale );

			$mofile_local  = $pearl_lang_dir . $mofile;
			$mofile_global = WP_LANG_DIR . '/custom/' . $mofile;

			if ( file_exists( $mofile_local ) ) {
				load_textdomain( PEARL_TEXTDOMAIN, $mofile_local );
			} else {
				load_plugin_textdomain( PEARL_TEXTDOMAIN, false, $pearl_lang_dir );
			}
		}

		/**
		 * Throw error on object clone
		 *
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		public function __clone() {
			_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', PEARL_TEXTDOMAIN ), '1.6' );
		}

		/**
		 * Disable unserializing of the class
		 *
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		public function __wakeup() {
			_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', PEARL_TEXTDOMAIN ), '1.6' );
		}

	}
}
/**
 * Return the instance 
 *
 * @since 1.0.0
 * @return object The Safety Links instance
 */
function Pearl_Run() {
	return Pearl::instance();
}
Pearl_Run();
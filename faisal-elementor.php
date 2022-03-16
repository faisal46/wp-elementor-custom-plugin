<?php
/**
 * Plugin Name: Faisal Elementor Extension
 * Description: A plugin are extended the Elementor custom widgets functions.
 * Plugin URI:  https://github.com/faisal46/wp-elementor-extend-plugin
 * Author: Md. Faisal Amir Mostafa
 * Author URI: https://www.faisal.rajtechbd.com/
 * Version: 1.0.0
 * License: GPL2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: wpfee
 * Domain Path: /langusges/
 */

use \Elementor\Plugin as Plugin;

if( ! defined( 'ABSPATH' ) ){
    exit;
}

/**
 * Plugin final class
 */
final class Faisal_Elementor_Extension {

    const VERSION = '1.0.0';
    const MINIMUM_ELEMENTOR_VERSION = '3.5.0';
    const MINIMUM_PHP_VERSION = '7.0';


	private static $_instance = null;

	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	public function __construct() {
		add_action( 'plugin_loaded', [ $this, 'init' ] );
	}



	public function init() {
		load_plugin_textdomain( 'wpfee' );

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}

		// Add Plugin actions
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
		// add_action( 'elementor/controls/controls_registered', [ $this, 'init_controls' ] );
	}

	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'wpfee' ),
			'<strong>' . esc_html__( 'Faisal Elementor Extension', 'wpfee' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'wpfee' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'wpfee' ),
			'<strong>' . esc_html__( 'Faisal Elementor Extension', 'wpfee' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'wpfee' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'wpfee' ),
			'<strong>' . esc_html__( 'Faisal Elementor Extension', 'wpfee' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'wpfee' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

    /**
    * Include widgets files and register them
    */
	public function init_widgets() {

		// Include Widget files
		require_once( __DIR__ . '/widgets/faisal-widget.php' );

		// Register widget
		Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Faisal_Widget() );

	}

}

Faisal_Elementor_Extension::instance();
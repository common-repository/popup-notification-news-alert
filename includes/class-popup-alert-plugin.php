<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://devinvinson.com
 * @since      1.0.0
 *
 * @package    Popup_Alert_Plugin
 * @subpackage Popup_Alert_Plugin/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Popup_Alert_Plugin
 * @subpackage Popup_Alert_Plugin/includes
 * @author     Devin Vinson <devinvinson@gmail.com>
 */
class Popup_Alert_Plugin {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Popup_Alert_Plugin_Loader    $loader    Maintains and registers all hooks for the plugin.
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
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'popup-alert-plugin';
		$this->version = '1.0.4';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Popup_Alert_Plugin_Loader. Orchestrates the hooks of the plugin.
	 * - Popup_Alert_Plugin_i18n. Defines internationalization functionality.
	 * - Popup_Alert_Plugin_Admin. Defines all hooks for the admin area.
	 * - Popup_Alert_Plugin_Public. Defines all hooks for the public side of the site.
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
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-popup-alert-plugin-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-popup-alert-plugin-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-popup-alert-plugin-admin.php';
		//require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-popup-alert-plugin-admin-settings.php';


		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-popup-alert-plugin-public.php';

		$this->loader = new Popup_Alert_Plugin_Loader();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Popup_Alert_Plugin_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Popup_Alert_Plugin_i18n();
		$plugin_i18n->set_domain('popup-alert');

		$this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Popup_Alert_Plugin_Admin($this->get_plugin_name(), $this->get_version());
		$plugin_settings = new Popup_Alert_Admin_Settings($this->get_plugin_name(), $this->get_version());

		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');

		$this->loader->add_action('admin_menu', $plugin_settings, 'setup_plugin_options_menu');
		$this->loader->add_action('admin_init', $plugin_settings, 'initialize_display_options');
		$this->loader->add_action('admin_init', $plugin_settings, 'initialize_social_options');
		$this->loader->add_action('admin_init', $plugin_settings, 'initialize_input_examples');

		$this->loader->add_action('init', $plugin_admin, 'popup_msg');


		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-popup-alert-plugin-meta-box.php';
		$meta_box = new Popup_Alert_Plugin_Meta_Box();
		$this->loader->add_action('add_meta_boxes', $meta_box, 'popup_alert_meta_register');
		$this->loader->add_action('save_post', $meta_box, 'popup_alert_meta_save');
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Popup_Alert_Plugin_Public($this->get_plugin_name(), $this->get_version());

		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');

		// $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public,'regJquery' );
		$this->loader->add_action('wp_footer', $plugin_public, 'showToast');

		// $this->loader->add_action('wp_footer', $plugin_public,'myprefix_add_settings');
		// $this->loader->add_action( 'init', $plugin_public,'reg_shortcode' );


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
	 * @return    Popup_Alert_Plugin_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}
}

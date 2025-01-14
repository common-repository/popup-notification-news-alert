<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://devinvinson.com
 * @since      1.0.0
 *
 * @package    Popup_Alert_Plugin
 * @subpackage Popup_Alert_Plugin/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Popup_Alert_Plugin
 * @subpackage Popup_Alert_Plugin/admin
 * @author     Devin Vinson <devinvinson@gmail.com>
 */
class Popup_Alert_Plugin_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		$this->load_dependencies();

	}

	/**
	 * Load the required dependencies for the Admin facing functionality.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Popup_Alert_Plugin_Admin_Settings. Registers the admin settings and page.
	 *
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) .  'admin/class-popup-alert-plugin-settings.php';

	}
	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Popup_Alert_Plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Popup_Alert_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/popup-alert-plugin-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Popup_Alert_Plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Popup_Alert_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/popup-alert-plugin-admin.js', array( 'jquery' ), $this->version, false );

	}



/**
* Creates a new custom post type
*
* @since 1.0.0
* @access public
* @uses register_post_type()
*/
public static function popup_msg() {
	$cap_type = 'post';
	$plural = 'Alerts';
	$single = 'Alert';
	$cpt_name = 'popup_msg';
	$opts['can_export'] = TRUE;
	$opts['capability_type'] = $cap_type;
	$opts['description'] = '';
	$opts['exclude_from_search'] = FALSE;
	$opts['has_archive'] = TRUE;
	$opts['hierarchical'] = FALSE;
	$opts['map_meta_cap'] = TRUE;
	$opts['menu_icon'] = 'dashicons-sos';
	$opts['menu_position'] = 90;
	$opts['public'] = TRUE;
	$opts['publicly_querable'] = false;
	$opts['query_var'] = TRUE;
	$opts['register_meta_box_cb'] = '';
	$opts['rewrite'] = array( 'slug' => 'popups' );
	$opts['show_in_admin_bar'] = TRUE;
	$opts['show_in_menu'] = 'popup_alert_options';
	$opts['show_in_nav_menu'] = TRUE;
	$opts['show_in_rest'] = TRUE;
	$opts['taxonomies'] = array( 'category' );
	$opts['supports'] = array( 'title', 'editor', 'thumbnail','excerpt','custom-fields' );
	

	$opts['labels']['add_new'] = esc_html__( "Add New {$single}", 'popup-alert-msg' );
	$opts['labels']['add_new_item'] = esc_html__( "Add New {$single}", 'popup-alert-msg' );
	$opts['labels']['all_items'] = esc_html__( $plural, 'popup-alert-msg' );
	$opts['labels']['edit_item'] = esc_html__( "Edit {$single}" , 'popup-alert-msg' );
	$opts['labels']['menu_name'] = esc_html__( $plural, 'popup-alert-msg' );
	$opts['labels']['name'] = esc_html__( $plural, 'popup-alert-msg' );
	$opts['labels']['name_admin_bar'] = esc_html__( $single, 'popup-alert-msg' );
	$opts['labels']['new_item'] = esc_html__( "New {$single}", 'popup-alert-msg' );
	$opts['labels']['not_found'] = esc_html__( "No {$plural} Found", 'popup-alert-msg' );
	$opts['labels']['not_found_in_trash'] = esc_html__( "No {$plural} Found in Trash", 'popup-alert-msg' );
	$opts['labels']['parent_item_colon'] = esc_html__( "Parent {$plural} :", 'popup-alert-msg' );
	$opts['labels']['search_items'] = esc_html__( "Search {$plural}", 'popup-alert-msg' );
	$opts['labels']['singular_name'] = esc_html__( $single, 'popup-alert-msg' );
	$opts['labels']['view_item'] = esc_html__( "View {$single}", 'popup-alert-msg' );


	register_post_type( strtolower( $cpt_name ), $opts );
} 



}

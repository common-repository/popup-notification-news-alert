<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://profile.wordpress.org/apsaraaruna
 * @since             1.0.4
 * @package           Popup_alert_Plugin
 *
 * @wordpress-plugin
 * Plugin Name:       Popup Notification News Alert
 * Plugin URI:        https://wordpress.org/plugins/popup-notification-news-alert/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.4
 * Author:            Apsara Aruna
 * Author URI:        https://profile.wordpress.org/apsaraaruna
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       popup-alert-plugin
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-popup-alert-plugin-activator.php
 */
function activate_popup_alert_plugin() {
	require_once plugin_dir_path(__FILE__) . 'includes/class-popup-alert-plugin-activator.php';
	Popup_Alert_Plugin_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-popup-alert-plugin-deactivator.php
 */
function deactivate_popup_alert_plugin() {
	require_once plugin_dir_path(__FILE__) . 'includes/class-popup-alert-plugin-deactivator.php';
	Popup_Alert_Plugin_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_popup_alert_plugin');
register_deactivation_hook(__FILE__, 'deactivate_popup_alert_plugin');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-popup-alert-plugin.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_popup_alert_plugin() {

	$plugin = new Popup_Alert_Plugin();
	$plugin->run();
}
run_popup_alert_plugin();

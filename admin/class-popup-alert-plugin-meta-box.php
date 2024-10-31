<?php

/**
 * This class is responsible of the Nice Title meta box.
 *
 * In particular, it's responsible of displaying the meta box and
 * saving the value(s) its form contains.
 *
 * @package    Popup_alert_plugin
 * @subpackage Popup_alert_plugin/admin
 * @author     Your Name <email@example.com>
 */
class Popup_Alert_Plugin_Meta_Box {

	/**
	 * Displays the meta box.
	 *
	 * @param  WP_Post   $post   The object for the current post/page.
	 *
	 * @since    1.0.0
	 */
	public function popup_alert_meta_display( $post ) {

		$post_id = $post->ID;
		$nice_title = get_post_meta( $post_id, '_popup_alert', true );

		include plugin_dir_path( __FILE__ ) . 'partials/popup-alert-plugin-meta-box.templ.php';

	}

	/**
	 * Registers the meta box and makes it available in the Post Editor popup_alert_meta_display.
	 *
	 * @since    1.0.0
	 */
	public function popup_alert_meta_register() {

		add_meta_box(
			'popup-alert-plugin',
			esc_html__('Alert show in', 'popup-alert-plugin'),
			array( $this, 'popup_alert_meta_display' ),
			'popup_msg',	// 'popup_msg', 
			'side',
			'default'

		);

	}

	/**
	 * Saves all the fields displayed in the meta box.
	 *
	 * @param  int   $post_id   The ID of the post that's about to be saved.
	 *
	 * @since    1.0.0
	 */
	public function popup_alert_meta_save( $post_id ) {

		$post_ID = (int) $post_id;
		$post_type = get_post_type( $post_id );
		$post_status = get_post_status( $post_id );
		// $metavalue =  $_POST['sl-meta-box-sidebar'] ;
		// $metavalue =  $_POST[ 'sl-meta-box-sidebar-pages' ] ;
		$metavalue =sanitize_text_field( $_POST[ 'sl-meta-box-sidebar-pages' ] ) ;
		
		if (isset($_POST[ 'sl-meta-box-sidebar-pages' ])) {
			// $metavalue = sanitize_meta( 'sl-meta-box-sidebar-pages', $metavalue, 'post' );
			// echo "<pre>".var_export($metavalue , true)."</pre>";exit();
			if ($metavalue) {
				update_post_meta($post_id, "sl-meta-box-sidebar-pages", $metavalue);
			}
			return $post_ID;

		}

	}
}
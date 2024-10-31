<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://devinvinson.com
 * @since      1.0.0
 *
 * @package    Popup_Alert_Plugin
 * @subpackage Popup_Alert_Plugin/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Popup_Alert_Plugin
 * @subpackage Popup_Alert_Plugin/public
 * @author     Devin Vinson <devinvinson@gmail.com>
 */
class Popup_Alert_Plugin_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/popup-alert-plugin-public.css', array(), $this->version, 'all');
		wp_enqueue_style($this->plugin_name . '-toast', plugin_dir_url(__FILE__) . '/css/toastr.min.css', array(), $this->version, 'all');

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/popup-alert-plugin-public.js', array('jquery'), $this->version, false);
		wp_enqueue_script($this->plugin_name . 'toast-js', plugin_dir_url(__FILE__) . '/js/toastr.min.js', array('jquery'), $this->version, false);

	}

	public function showToast() {
		// 	$posts = get_posts(array(
		// 		'post_type'   => 'popup_msg',
		// 		'post_status' => 'publish',
		// 		'posts_per_page' => -1,
		// 		// 'fields' => 'ids'

		// 	)
		// );
		$options = get_option('popup_alert_display_options');
		// var_dump(get_option('popup_alert_display_options'));
		$args = array(
			'posts_per_page' => -1,
			'post_type' => 'popup_msg',
			'meta_key' => 'sl-meta-box-sidebar-pages',

		);
		$posts = new WP_Query($args);

		foreach ($posts->posts as $key => $value) {

			$pageIds[] = get_post_meta($value->ID, 'sl-meta-box-sidebar-pages', true);

			// echo "<pre>" . var_export($pageIds, true) . "</pre>";

			// $pageIds = get_metadata( 'post',  $value->ID, 'sl-meta-box-sidebar', true );

			foreach ($pageIds as $key => $fvalue) {

				if (is_page($fvalue)) {
					$msg = $value->post_content;

					// $msgrand =  2000* rand(1,10);

					if ($options['show_title'] == 1) {
						$title = $value->post_title;
					} else {
						$title = "";
					}
					// echo $title;
					?>
					<script type="text/javascript">
						(function($){

							$(document).ready(function(){
								// var rand = 1000* Math.floor((Math.random() * 10) + 9);
								var rand = 2000 * (Math.floor(Math.random() * 15) + 10);
								// var rand = <?php echo $msgrand ?> ;
								console.log(rand);


								// for (var i = 0; i < msgcount ; i++) {
									funky = setInterval(function() {
										var msg = <?php echo json_encode($msg) ?>;

										if (title !="") {
											var title = <?php echo json_encode($title) ?>;
										}else{
											var title = "";
										}

										toastr.options = {
											"closeButton": true,
											"debug": false,
											"newestOnTop": true,
											"progressBar": "<?php echo $options['show_progressbar'] == 1 ? true : false ?>",
											"positionClass": "<?php echo $options['popup_potision'] ?>",
											"preventDuplicates": true,
											"showDuration": "3000",
											"hideDuration": "3000",
											"timeOut": "3000",
											"extendedTimeOut": "5000",
											"showEasing": "swing",
											"hideEasing": "linear",
											"showMethod": "fadeIn",
											"hideMethod": "fadeOut"
										}

										toastr["<?php echo $options['popup_type'] ?>"](msg,title)

										$('.toast-close-button').on('click',function(){
											clearInterval(funky);
										})
									}, rand);
								// }

							});
						})(jQuery);
					</script>
					<?php

				}
			}
		}
	}

}

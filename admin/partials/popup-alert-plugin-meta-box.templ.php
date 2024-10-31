<?php

/**
 * The content of a Nelio Nice Title metabox, which is used in the Post Editor screen.
 *
 * This template assumes that the following variable is defined:
 *  * $nice_title  {string}  the Nice Title that has to be appended to the post (if any).
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Popup_alert_plugin
 * @subpackage Popup_alert_plugin/admin/partials
 */
?>

<?php 
global $post;
$custom = get_post_custom($post->ID);

$args = array(
	'post_type' => 'page',
	'post_parent' => 0,
	'fields' => 'ids',
	'order' => 'ASC',
	'posts_per_page' => -1,
);
$qry = new WP_Query($args);
// var_dump($qry->posts);
?>
<?php echo esc_attr( $nice_title ); ?>

<input type="hidden" name="sl-meta-box-sidebar-pages" class="sl-meta-box-sidebar-pages" value="<?php echo $custom["sl-meta-box-sidebar-pages"][0] ?>">
<?php foreach ($qry->posts as $key => $value): ?>
	<?php 
	// $sl_meta_box_sidebar = $custom["sl-meta-box-sidebar"][0]; 
	$sl_meta_box_sidebar = $custom["sl-meta-box-sidebar-pages"][0]; 
	$mydata = unserialize($sl_meta_box_sidebar);
	$checkedbox = explode(',', $sl_meta_box_sidebar);

	// echo "<pre>".var_export($sl_meta_box_sidebar, true)."</pre>";

	$checkbox = '';
	if (in_array($value, $checkedbox)) {
		// if( isset( $mydata[$value ] ) ) {
		$checkbox = 'checked';
		// var_dump($checkbox );
		// }
	}

	?>
	
	<input type="checkbox" name="sl-meta-box-sidebar[<?php echo $value ?>]" class="sl-meta-box-sidebar" value="<?php echo esc_attr($value) ?>" <?php echo $checkbox ?> />  <?php echo get_the_title( $value ) ?> <br>
	<!-- <input type="checkbox" name="sl-meta-box-sidebar[<?php echo $value ?>]" value="<?php echo $value ?>" <?php if( $mydata[$value] == true ) { ?>checked="checked"<?php } ?> />  <?php echo get_the_title( $value ) ?> <br> -->
<?php endforeach ?>




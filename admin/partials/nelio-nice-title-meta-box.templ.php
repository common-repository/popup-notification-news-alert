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
 * @package    Nelio_Nice_Title
 * @subpackage Nelio_Nice_Title/admin/partials
 */
?>

<!-- <label for="nelio-nice-title">Text:</label> -->
<!-- <input name="nelio-nice-title" type="text" value="<?php echo esc_attr( $nice_title ); ?>" /> -->
<?php 
$args = array(
	'post_type' => 'page',
	'post_parent' => 0,
	'fields' => 'ids',
	'posts_per_page' => -1,
);
$qry = new WP_Query($args);
// var_dump($qry->posts);
?>
<?php echo esc_attr( $nice_title ); ?>
<select name="nelio-nice-title[]" id="" multiple>

	<?php foreach ($qry->posts as $key => $value): ?>
		<option value="<?php echo $value ?>"><?php echo get_the_title( $value ) ?></option>
	<?php endforeach ?>
	
</select>


<?php
/*
Plugin Name: MNT Post taxonomy sort
Plugin URI:
Description:
Version: 0.1
Author: Andy Welch
Author URI: http://www.codebloc.co.uk
License: GPLv3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.html
*/
add_action( 'admin_enqueue_scripts', 'mnt_post_taxonomy_sort_scripts' );
function mnt_post_taxonomy_sort_scripts() {

	wp_enqueue_script( 'jquery-ui-core' );
	wp_enqueue_script( 'jquery-ui-draggable' );
	wp_enqueue_script( 'jquery-ui-droppable' );
	wp_enqueue_script( 'mtn_post_taxonomy_sort_custom_js', plugins_url( '/js/custom.js', __FILE__ ), ['jquery'], '0.1', true );
	wp_localize_script( 'mtn_post_taxonomy_sort_custom_js', 'mnt_drop_action', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
}
add_action( 'admin_menu', 'mnt_post_taxonomy_sort_setup_menu' );
function mnt_post_taxonomy_sort_setup_menu() {
	add_menu_page( 'MNT Post Taxonomy Sort Page', 'MNT Post Taxonomy Sort', 'manage_options', 'mnt-post-taxonomy-sort', 'test_init' );
	//add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
}

add_action( "wp_ajax_mnt_drop_action", "mnt_drop_action" );
function mnt_drop_action() {
	write_log( 'drop action' );
	write_log( $_GET['filterParams']);

	wp_set_object_terms( $_GET['filterParams']['postid'], $_GET['filterParams']['termslug'], 'category', true);
}


function test_init() {
?>
<div class="col1" style="width:50%;float:left;">
	<?php
	$posts = get_posts( ['post_status'=>'publish', 'post_type'=>'post', 'posts_per_page'=>-1] );
	foreach ( $posts as $key => $value ) {
		echo '<li class="draggable" data-postid="' . $value->ID . '">' .  $value->post_title . '</li><br>';
	}
?>
</div>
<div class="col2" style="width:50%;float:left;">
	<?php
	$terms  = get_terms( ['category'] , ['hide_empty'=>0] );
	foreach ( $terms as $key => $value ) {
		echo '<li class="droppable" data-termslug="' . $value->slug . '" data-termid="' .  $value->term_id . '">' . $value->name . '</li><br>';
	}
?>
</div>
<?php
}

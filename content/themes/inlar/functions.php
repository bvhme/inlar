<?php

// Includes
require_once('includes/map.php');

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
add_action('after_setup_theme', 'inlar_theme_setup');
function inlar_theme_setup() {
	// Use post thumbnails
	add_theme_support('post-thumbnails');

	// Semantic markup
	add_theme_support('html5');

	// Acknowledge that we are not defining titles on our own
	add_theme_support('title-tag');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	// Match wp_editor style with site 
	add_editor_style('assets/editor.css');

	load_theme_textdomain('inlar');

	// Use wp_nav_menu() in two locations.
	register_nav_menus(array(
		'menu-primary'		=> __('Primary menu', 'inlar'),
	));
}

// Enqueue theme CSS & JS
add_action('wp_enqueue_scripts', 'inlar_enqueue_frontend_scripts');
function inlar_enqueue_frontend_scripts() {
	$assets = get_template_directory_uri() . '/assets';

	// CSS
	wp_enqueue_style('app', $assets . '/app.css', array(), null, 'all');

	// JS
	wp_enqueue_script('inlar-modernizr', $assets . '/modernizr.js', array(), null, false);
	wp_enqueue_script('inlar-common', $assets . '/common.js', array(), null, false);
	wp_enqueue_script('inlar-app', $assets . '/app.js', array('jquery'), null, true);
}

// Enqueue theme backend CSS & JS
add_action('admin_enqueue_scripts', 'inlar_enqueue_backend_scripts');
function inlar_enqueue_backend_scripts() {
	$assets = get_template_directory_uri() . '/assets';

	wp_enqueue_style('inlar-backend', $assets . '/backend.css');

	wp_enqueue_script('inlar-common', $assets . '/common.js', array(), null, false);
	wp_enqueue_script('inlar-backend', $assets . '/backend.js', array('jquery'), null, true);
}

add_action('wp_head', 'inlar_head_vars');
function inlar_head_vars() {
	$vars = array(
		'flags_url' => get_template_directory_uri() . '/assets/images/flags',
	);

	print('<script>');
	foreach ($vars as $name => $value) {
		printf('var %s = "%s";',
			$name, esc_js($value)
		);
	}
	print('</script>');
}

?>
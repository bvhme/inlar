<?php

// Includes
require_once('includes/map.php');
require_once('includes/navigation.php');
require_once('includes/theme-options.php');
require_once('includes/contact-form.php');

// Image sizes
add_image_size('partner-logo-small', 150, 150, true);
add_image_size('partner-logo-large', 250, 250, true);
add_image_size('team-profile',       100, 100, true);

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

	register_nav_menus(array(
		'menu-primary' => __('Primary menu', 'inlar'),
	));

	add_theme_support('custom-header', array(
		'default-image' => get_template_directory_uri() . '/assets/images/header.jpg',
	));
}

add_action('get_header', 'my_filter_head');
function my_filter_head() {
	remove_action('wp_head', '_admin_bar_bump_cb');
}

// Enqueue theme CSS & JS
add_action('wp_enqueue_scripts', 'inlar_enqueue_frontend_scripts');
function inlar_enqueue_frontend_scripts() {
	$assets = get_template_directory_uri() . '/assets';

	// Fonts
	wp_enqueue_style('google-rubik', '//fonts.googleapis.com/css?family=Rubik:300,500&amp;subset=cyrillic,latin-ext', array(), null, 'all');
	wp_enqueue_style('google-noto-serif', '//fonts.googleapis.com/css?family=Noto+Serif&amp;subset=cyrillic,latin-ext', array(), null, 'all');
	wp_enqueue_style('google-cairo', '//fonts.googleapis.com/css?family=Cairo:400,600&subset=arabic', array(), null, 'all');

	// CSS
	wp_enqueue_style('app', $assets . '/app.css', array(), null, 'all');

	// JS
	wp_enqueue_script('inlar-modernizr', $assets . '/modernizr.js', array(), null, false);
	wp_enqueue_script('inlar-common', $assets . '/common.js', array(), null, false);
	wp_enqueue_script('inlar-app', $assets . '/app.js', array('jquery'), null, true);

	wp_localize_script('inlar-app', 'ajax_url', admin_url('admin-ajax.php'));
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
		'i18n'      => array(
			'another_country' => __('Another country', 'inlar'),
		),
	);

	print('<script>');
	foreach ($vars as $name => $value) {
		printf('var %s = %s;'.PHP_EOL,
			$name, (is_array($value) ? json_encode($value) : '"'. esc_js($value).'"' )
		);
	}
	print('</script>');
}

function inlar_language_switcher() {
	global $q_config;

	if (!function_exists('qtranxf_getSortedLanguages'))
		return;

	$languages = qtranxf_getSortedLanguages();

	$active = '';
	$output = array();

	foreach ($languages as $language) {
		if ($language === $q_config['language']) {
			$active = sprintf('<span class="current">%s <i class="icon-arrow"></i></span>',
				$language
			);
		} else {
			$output[] = sprintf('<li><a href="%1$s" hreflang="%2$s">%2$s</a></li>',
				qtranxf_convertURL(is_404() ? home_url() : '', $language),
				$q_config['language_name'][$language]
			);
		}
	}

	printf('<div class="lang-switcher dropdown-container">%s<ul class="dropdown top-right">%s</ul></div>',
		$active, implode('', $output)
	);
}

function inlar_header_raw($title = '', $text = '', $type = false) {
	$type_whitelist = array('hero', 'section');

	if (!in_array($type, $type_whitelist))
		return false;

	include(locate_template("partials/header-{$type}.php"));
}

function inlar_header($option_name, $type = '') {
	$opt = get_option($option_name, array(
		'title' => '',
		'text'  => '',
	));

	inlar_header_raw($opt['title'], $opt['text'], $type);
}

add_filter('get_the_excerpt', 'inlar_excerpt_trim', 10, 2);
function inlar_excerpt_trim($excerpt, $post) {
	switch ($post->post_type) {
		case 'team':
			$excerpt = wp_trim_words($excerpt, 20);
			break;
		
		default:
			// business as usual
			break;
	}

	return $excerpt;
}

function inlar_get_page_archive_link($template) {
	$template = "page-{$template}.php";

	if (!locate_template($template, false, false))
		return;

	$pages = get_pages(array(
		'meta_key'   => '_wp_page_template',
		'meta_value' => $template,
		'number'     => 1,
	));

	if (empty($pages))
		return;

	return get_permalink($pages[0]->ID);
}

function inlar_fetch_template($name) {
	if ('' === ($template = locate_template("partials/template-{$name}.php", false)))
		return;

	printf('<script id="template-%s" type="text/x-handlebars-template">'.PHP_EOL, $name);
	get_template_part('partials/template', $name);
	print ('</script>'.PHP_EOL);
}

?>

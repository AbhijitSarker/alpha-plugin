<?php

/**
 * Plugin Name:       Movie Archive
 * Plugin URI:        https://github.com/AbhijitSarker
 * Description:       Get latest collection of movies.
 * Version:           1.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Abhijit Sarker
 * Author URI:        https://github.com/AbhijitSarker
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       movie_arch_plugin
 * Domain Path:       /languages
 */

if (!defined('ABSPATH')) {
    die;
}

add_action('init', 'movie_arch_func');

/**
 * Register a custom post type called "Movie ".
 *
 * @see get_post_type_labels() for label keys.
 */
function movie_arch_func()
{
    $labels = array(
        'name'                  => _x('Movies', 'Post type general name', 'textdomain'),
        'singular_name'         => _x('Movie ', 'Post type singular name', 'textdomain'),
        'menu_name'             => _x('Movies', 'Admin Menu text', 'textdomain'),
        'name_admin_bar'        => _x('Movie ', 'Add New on Toolbar', 'textdomain'),
        'add_new'               => __('Add New', 'textdomain'),
        'add_new_item'          => __('Add New Movie ', 'textdomain'),
        'new_item'              => __('New Movie ', 'textdomain'),
        'edit_item'             => __('Edit Movie ', 'textdomain'),
        'view_item'             => __('View Movie ', 'textdomain'),
        'all_items'             => __('All Movies', 'textdomain'),
        'search_items'          => __('Search Movies', 'textdomain'),
        'parent_item_colon'     => __('Parent Movies:', 'textdomain'),
        'not_found'             => __('No Movies found.', 'textdomain'),
        'not_found_in_trash'    => __('No Movies found in Trash.', 'textdomain'),
        'featured_image'        => _x('Movie  Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain'),
        'set_featured_image'    => _x('Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain'),
        'remove_featured_image' => _x('Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain'),
        'use_featured_image'    => _x('Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain'),
        'archives'              => _x('Movie  archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain'),
        'insert_into_item'      => _x('Insert into Movie ', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain'),
        'uploaded_to_this_item' => _x('Uploaded to this Movie ', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain'),
        'filter_items_list'     => _x('Filter Movies list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain'),
        'items_list_navigation' => _x('Movies list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain'),
        'items_list'            => _x('Movies list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'movie-arch'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'menu_icon'          => 'dashicons-video-alt',
        'hierarchical'       => false,
        'menu_position'      => null,
        'show_in_rest'       => true,
        'supports'           => array('title', 'editor', 'thumbnail',),
    );

    register_post_type('movie-arch', $args);
}



add_action('init', 'my_rewrite_flush');

function my_rewrite_flush()
{

    flush_rewrite_rules();
}

function get_custom_post_type_template($archive_template)
{
    // global $post;

    if (is_post_type_archive('movie-arch')) {
        $archive_template = dirname(__FILE__) . '/templates/post-type-template.php';
    }
    return $archive_template;
}

add_filter('archive_template', 'get_custom_post_type_template');

function my_search_form($form)
{
    $form = '

<form id="search" action="" method="get">
<input type="hidden" name="post_type" value="post" />
<input id="s" name="s" type="text" value="" />
</form>';

    return $form;
}

// add_filter('get_search_form', 'my_search_form');

add_action('wp_enqueue_scripts', 'load_movies_enqueue_files');

function load_movies_enqueue_files()
{
    $dir = plugin_dir_url(__FILE__);
    wp_enqueue_style('style', $dir . 'assets/css/style.css');
    wp_enqueue_style('bootstrap', $dir . 'assets/css/bootstrap.min.css');

    wp_enqueue_script('bootstrapjs', $dir . 'assets/css/bootstrap.min.js', [], false, true);
    wp_enqueue_script('scriptjs', $dir . 'assets/css/script.js', 'jquery', false, true);
}

<?php
/**
 * Astra Child Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Astra Child
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define( 'CHILD_THEME_ASTRA_CHILD_VERSION', '1.0.0' );

/**
 * Enqueue styles
 */
function child_enqueue_styles() {

	wp_enqueue_style( 'astra-child-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );

}

add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );


// restict user's IP based
function restrict_ip_external_check() {
    $response = wp_remote_get('https://api64.ipify.org?format=json');
    
    if (is_wp_error($response)) {
        return;
    }

    $data = json_decode(wp_remote_retrieve_body($response), true);
    $user_ip = $data['ip'] ?? '';

    if (strpos($user_ip, '77.29') === 0) {
        wp_die('Access Denied', '403 Forbidden', array('response' => 403));
    }
}
add_action('init', 'restrict_ip_external_check');

// CPT projects and taxonomy

// Register Project custom post type
// Register Projects Custom Post Type
function register_projects_post_type() {
    $args = array(
        'labels' => array(
            'name' => 'Projects',
            'singular_name' => 'Project',
            'add_new' => 'Add New Project',
            'edit_item' => 'Edit Project',
            'all_items' => 'All Projects',
            'menu_name' => 'Projects',
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'projects'),
        'show_in_rest' => true,  // Gutenberg support
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'taxonomies' => array('project_type'), // Link taxonomy to post type
        'show_in_menu' => true,
    );
    register_post_type('project', $args);
}
add_action('init', 'register_projects_post_type');

// Register Project Type Taxonomy
function register_project_type_taxonomy() {
    $args = array(
        'labels' => array(
            'name' => 'Project Types',
            'singular_name' => 'Project Type',
            'search_items' => 'Search Project Types',
            'all_items' => 'All Project Types',
            'edit_item' => 'Edit Project Type',
            'update_item' => 'Update Project Type',
            'add_new_item' => 'Add New Project Type',
            'new_item_name' => 'New Project Type Name',
            'menu_name' => 'Project Type',
        ),
        'hierarchical' => true, // Enable for categories-like structure
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_rest' => true, // Enable in Gutenberg
        'query_var' => true,
        'rewrite' => array('slug' => 'project-type'),
    );
    register_taxonomy('project_type', 'project', $args); // Link taxonomy to the 'project' post type
}
add_action('init', 'register_project_type_taxonomy');


// loggeg in users and logged out users access CPT

// Add the action hook to handle AJAX requests
add_action('wp_ajax_get_architecture_projects', 'get_architecture_projects');
add_action('wp_ajax_nopriv_get_architecture_projects', 'get_architecture_projects'); // For non-logged in users

function get_architecture_projects() {
    // Log if the function is even called
    error_log('get_architecture_projects function called.');

    // Check if the user is logged in
    $posts_per_page = is_user_logged_in() ? 6 : 3;

    // Define the query args
    $args = [
        'post_type' => 'project',
        'posts_per_page' => $posts_per_page,
        'post_status' => 'publish',
        'tax_query' => [
            [
                'taxonomy' => 'project_type',
                'field' => 'slug',
                'terms' => 'architecture',
            ],
        ],
        'orderby' => 'date',
        'order' => 'DESC',
    ];

    // Log the query args
    error_log(print_r($args, true));

    $projects = new WP_Query($args);

    if ($projects->have_posts()) {
        $response_data = [];
        
        while ($projects->have_posts()) {
            $projects->the_post();
            $response_data[] = [
                'id' => get_the_ID(),
                'title' => get_the_title(),
                'link' => get_permalink(),
            ];
        }

        wp_reset_postdata();

        wp_send_json_success(['data' => $response_data]);
    } else {
        error_log('No projects found.');
        wp_send_json_error(['message' => 'No projects found.']);
    }

    wp_die();
}


function enqueue_custom_script() {
    // Enqueue your custom JS file
    wp_enqueue_script('custom-ajax-script', get_stylesheet_directory_uri() . '/js/script.js', ['jquery'], null, true);

    // Localize script to define ajaxurl
    wp_localize_script('custom-ajax-script', 'ajaxurl', admin_url('admin-ajax.php'));
}

add_action('wp_enqueue_scripts', 'enqueue_custom_script');



// coffee image api 

function hs_give_me_coffee() {
    $api_url = 'https://coffee.alexflipnote.dev/random.json'; // Replace with the actual API URL

    // Make the request using wp_remote_get
    $response = wp_remote_get( $api_url, array( 'timeout' => 15 ));

    if ( is_wp_error( $response ) ) {
        return 'Error: ' . $response->get_error_message();
    }

    // Show the raw API response for debugging
    return wp_remote_retrieve_body( $response );
}


// kanye qoutes 

function kanye_quotes_enqueue_scripts() {
    wp_enqueue_script( 'kanye-quotes', get_stylesheet_directory_uri() . '/js/kanye-quotes.js', array('jquery'), null, true );

    wp_localize_script( 'kanye-quotes', 'kanye_quotes_ajax', array(
        'url' => admin_url( 'admin-ajax.php' )
    ) );
}
add_action( 'wp_enqueue_scripts', 'kanye_quotes_enqueue_scripts' );
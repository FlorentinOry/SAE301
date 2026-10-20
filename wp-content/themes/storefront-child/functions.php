<?php
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style(
        'google-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800;900&display=swap',
        [],
        null
    );
    wp_enqueue_style(
        'nathans-main',
        get_stylesheet_directory_uri() . '/assets/css/main.css',
        ['storefront-style'],
        wp_get_theme()->get('Version')
    );
});
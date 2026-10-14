<?php

add_action('wp_enqueue_scripts', function() {
    wp_enqueue_style(
        'storefront-child',
        get_stylesheet_uri(),
        array('storefront-style')
    );
});
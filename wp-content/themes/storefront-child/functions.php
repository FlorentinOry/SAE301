<?php
/**
 * Nathan's Famous - thème enfant Storefront
 */
defined('ABSPATH') || exit;

/* ---------- CSS + JS ---------- */
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style(
        'nf-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;800;900&display=swap',
        [],
        null
    );
    wp_enqueue_style(
        'nf-main',
        get_stylesheet_directory_uri() . '/assets/css/main.css',
        ['storefront-style', 'nf-fonts'],
        filemtime(get_stylesheet_directory() . '/assets/css/main.css')
    );
    wp_enqueue_script(
        'nf-main',
        get_stylesheet_directory_uri() . '/assets/js/main.js',
        ['jquery'],
        filemtime(get_stylesheet_directory() . '/assets/js/main.js'),
        true
    );
}, 20);

/* ---------- Pas de sidebar ---------- */
add_action('init', function () {
    remove_action('storefront_sidebar', 'storefront_get_sidebar', 10);
});
add_filter('body_class', function ($classes) {
    return array_diff($classes, ['right-sidebar', 'left-sidebar']);
});

/* ---------- Textes des boutons ---------- */
add_filter('woocommerce_product_single_add_to_cart_text', fn() => 'Order');
add_filter('woocommerce_product_add_to_cart_text', fn() => 'Order');

/* ---------- Titre de la page boutique ---------- */
add_filter('woocommerce_page_title', function ($title) {
    return is_shop() ? 'Our Menu' : $title;
});

/* ---------- Itérations suivantes : décommente au fur et à mesure ---------- */
// require_once get_stylesheet_directory() . '/inc/it4-champs.php';   // IT-4
// require_once get_stylesheet_directory() . '/inc/it6-retrait.php';  // IT-6
require_once get_stylesheet_directory() . '/inc/contact.php';
require_once get_stylesheet_directory() . '/inc/it7-compte.php';
require_once get_stylesheet_directory() . '/inc/it2-produit.php';
require_once get_stylesheet_directory() . '/inc/it14-avis.php';
require_once get_stylesheet_directory() . '/inc/it6-retrait.php';
require_once get_stylesheet_directory() . '/inc/it6-checkout.php';

/* Adresse du restaurant, lue depuis WooCommerce > Réglages > Général */
function nf_restaurant() {
    $c = WC()->countries;
    return [
        'address' => trim($c->get_base_address() . ' ' . $c->get_base_address_2()),
        'city'    => $c->get_base_city(),
        'state'   => $c->get_base_state(),
        'zip'     => $c->get_base_postcode(),
    ];
}
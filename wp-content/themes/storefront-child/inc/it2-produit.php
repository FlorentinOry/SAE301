<?php
/**
 * Page produit selon la maquette (US-2.4 / 2.5)
 */
defined('ABSPATH') || exit;

/* Titre centré + bouton fermer, au-dessus de la fiche */
add_action('woocommerce_before_single_product', function () {
    echo '<h1 class="nf-product-title"><span>' . esc_html(get_the_title()) . '</span></h1>';
    echo '<div class="nf-close-wrap"><a class="nf-close" href="' . esc_url(wc_get_page_permalink('shop')) . '" aria-label="Retour au menu">'
       . '<svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><path d="M5 5l14 14M19 5L5 19"/></svg>'
       . '</a></div>';
}, 5);

/* Retire ce qu'on ne montre pas sur la maquette */
add_action('init', function () {
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);
});

/* Boutons − / + autour du champ quantité (aussi dans le panier) */
add_action('woocommerce_before_quantity_input_field', function () {
    echo '<button type="button" class="nf-qty__btn" data-dir="-1" aria-label="Diminuer la quantité">&minus;</button>';
});
add_action('woocommerce_after_quantity_input_field', function () {
    echo '<button type="button" class="nf-qty__btn" data-dir="1" aria-label="Augmenter la quantité">+</button>';
});

/* Message de retrait sous le bouton */
add_action('woocommerce_single_product_summary', function () {
    echo '<p class="nf-pickup-note">Retrait au comptoir du restaurant de Bellmore, 2713 Merrick Road.</p>';
}, 35);

/* Onglets : on garde Description + Avis */
add_filter('woocommerce_product_tabs', function ($tabs) {
    unset($tabs['additional_information']);
    return $tabs;
}, 98);

/* Produits suggérés : 3 cartes */
add_filter('woocommerce_output_related_products_args', function ($args) {
    $args['posts_per_page'] = 3;
    $args['columns']        = 3;
    return $args;
});
add_filter('woocommerce_product_related_products_heading', fn() => 'Vous aimerez aussi');
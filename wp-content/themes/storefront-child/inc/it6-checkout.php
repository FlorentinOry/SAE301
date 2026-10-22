<?php
/**
 * IT-6 : checkout simplifié pour le click & collect
 */
defined('ABSPATH') || exit;

/* L'adresse n'est pas obligatoire (retrait en restaurant), quel que soit le pays */
add_filter('woocommerce_default_address_fields', function ($fields) {
    foreach (['address_1', 'city', 'postcode', 'state'] as $key) {
        if (isset($fields[$key])) {
            $fields[$key]['required'] = false;
        }
    }
    return $fields;
});

add_filter('woocommerce_get_country_locale', function ($locale) {
    foreach ($locale as $country => $fields) {
        foreach (['address_1', 'city', 'postcode', 'state'] as $key) {
            $locale[$country][$key]['required'] = false;
        }
    }
    return $locale;
});

/* Champs de facturation : téléphone obligatoire, le reste allégé */
add_filter('woocommerce_billing_fields', function ($fields) {
    unset($fields['billing_company'], $fields['billing_address_2']);

    if (isset($fields['billing_phone'])) {
        $fields['billing_phone']['required'] = true;
    }
    if (isset($fields['billing_address_1'])) {
        $fields['billing_address_1']['label'] = 'Adresse (seulement pour la livraison)';
    }
    return $fields;
}, 99);

/* Texte du bouton final */
add_filter('woocommerce_order_button_text', fn() => 'Confirmer ma commande');

/* Note de commande : libellé plus clair */
add_filter('woocommerce_checkout_fields', function ($fields) {
    if (isset($fields['order']['order_comments'])) {
        $fields['order']['order_comments']['label']       = 'Remarques sur la commande';
        $fields['order']['order_comments']['placeholder'] = 'Une précision pour le restaurant ?';
    }
    return $fields;
});
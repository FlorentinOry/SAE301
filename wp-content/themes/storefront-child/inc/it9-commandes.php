<?php
/**
 * IT-9 : suivi des commandes (click & collect)
 */
defined('ABSPATH') || exit;

/* Statut "Prête au retrait" */
add_action('init', function () {
    register_post_status('wc-ready', [
        'label'                     => 'Prête au retrait',
        'public'                    => true,
        'exclude_from_search'       => false,
        'show_in_admin_all_list'    => true,
        'show_in_admin_status_list' => true,
        'label_count'               => _n_noop('Prête au retrait <span class="count">(%s)</span>', 'Prêtes au retrait <span class="count">(%s)</span>'),
    ]);
});
add_filter('wc_order_statuses', function ($statuses) {
    $statuses['wc-ready'] = 'Prête au retrait';
    return $statuses;
});

/* Email au client quand la commande est prête */
add_action('woocommerce_order_status_ready', function ($order_id) {
    $order = wc_get_order($order_id);
    if (!$order || !$order->get_billing_email()) return;

    $r = function_exists('nf_restaurant') ? nf_restaurant() : ['address' => '', 'city' => ''];
    $msg = "Bonjour " . $order->get_billing_first_name() . ",\n\n"
         . "Votre commande #" . $order->get_order_number() . " est prête. Vous pouvez venir la retirer au comptoir :\n"
         . $r['address'] . ", " . $r['city'] . "\n\n"
         . "Présentez votre numéro de commande à l'équipe.\n\nNathan's Famous";
    wp_mail($order->get_billing_email(), "Votre commande #" . $order->get_order_number() . " est prête", $msg);
});

/* Le client peut annuler une commande tant qu'elle est en attente de paiement (virement) */
add_filter('woocommerce_valid_order_statuses_for_cancel', function ($statuses) {
    $statuses[] = 'on-hold';
    return array_unique($statuses);
});

/* Confirmation d'annulation envoyée au client */
add_action('woocommerce_order_status_cancelled', function ($order_id) {
    $order = wc_get_order($order_id);
    if (!$order || !$order->get_billing_email()) return;

    $msg = "Bonjour " . $order->get_billing_first_name() . ",\n\n"
         . "Votre commande #" . $order->get_order_number() . " a bien été annulée.\n"
         . "Si vous aviez déjà payé, le remboursement vous sera confirmé par un email séparé.\n\nNathan's Famous";
    wp_mail($order->get_billing_email(), "Annulation de votre commande #" . $order->get_order_number(), $msg);
});
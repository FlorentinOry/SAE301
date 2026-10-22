<?php
/**
 * IT-6 : "Instructions pour le retrait" modifiables depuis le back office
 * (Réglages > Général) et affichées dans le checkout.
 */
defined('ABSPATH') || exit;

add_action('admin_init', function () {
    register_setting('general', 'retrait_instructions', ['sanitize_callback' => 'wp_kses_post']);
    add_settings_field('retrait_instructions', 'Instructions pour le retrait', function () {
        echo '<textarea name="retrait_instructions" rows="5" class="large-text">'
           . esc_textarea(get_option('retrait_instructions')) . '</textarea>';
    }, 'general');
});

add_action('woocommerce_review_order_before_payment', function () {
    $txt = get_option('retrait_instructions');
    if ($txt) {
        echo '<div class="retrait-instructions"><h3>Instructions pour le retrait</h3>' . wpautop(wp_kses_post($txt)) . '</div>';
    }
});
<?php
/**
 * IT-8 : emails aux couleurs de l'enseigne + instructions de retrait
 */
defined('ABSPATH') || exit;

/* Instructions de retrait dans les emails client */
add_action('woocommerce_email_before_order_table', function ($order, $sent_to_admin, $plain_text, $email) {
    if ($sent_to_admin) return;

    $ids = ['customer_on_hold_order', 'customer_processing_order', 'customer_completed_order'];
    if (!isset($email->id) || !in_array($email->id, $ids, true)) return;

    $txt = get_option('retrait_instructions');
    if (!$txt) return;

    if ($plain_text) {
        echo "INSTRUCTIONS POUR LE RETRAIT\n" . wp_strip_all_tags($txt) . "\n\n";
        return;
    }
    echo '<div style="background:#f4f6f1;border-left:4px solid #2d7436;padding:12px 16px;margin:0 0 20px;">'
       . '<h3 style="margin:0 0 6px;color:#2d7436;">Instructions pour le retrait</h3>'
       . wpautop(wp_kses_post($txt)) . '</div>';
}, 10, 4);

/* Styles supplémentaires : titres en gras, bandeau vert */
add_filter('woocommerce_email_styles', function ($css) {
    return $css . '
        h1, h2, h3 { text-transform: uppercase; font-weight: 900; }
        #template_header { border-radius: 0 !important; }
        a { color: #2d7436; }
    ';
});
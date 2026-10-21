<?php
/**
 * Traitement du formulaire de contact
 */
defined('ABSPATH') || exit;

function nf_handle_contact() {
    $back = remove_query_arg('contact', wp_get_referer() ?: home_url('/'));

    $nonce_ok = isset($_POST['nf_contact_nonce']) && wp_verify_nonce($_POST['nf_contact_nonce'], 'nf_contact');
    if (!$nonce_ok || !empty($_POST['website'])) { // champ piège anti-spam
        wp_safe_redirect(add_query_arg('contact', 'error', $back) . '#contact');
        exit;
    }

    $name    = sanitize_text_field(wp_unslash($_POST['name'] ?? ''));
    $email   = sanitize_email(wp_unslash($_POST['email'] ?? ''));
    $phone   = sanitize_text_field(wp_unslash($_POST['phone'] ?? ''));
    $message = sanitize_textarea_field(wp_unslash($_POST['message'] ?? ''));

    if (!$name || !is_email($email) || !$message) {
        wp_safe_redirect(add_query_arg('contact', 'error', $back) . '#contact');
        exit;
    }

    $subject = sprintf("[Nathan's] Message de %s", $name);
    $body    = "Nom : $name\nEmail : $email\nTéléphone : $phone\n\n$message";
    $headers = ['Reply-To: ' . $name . ' <' . $email . '>'];
    $sent    = wp_mail(get_option('admin_email'), $subject, $body, $headers);

    wp_safe_redirect(add_query_arg('contact', $sent ? 'ok' : 'error', $back) . '#contact');
    exit;
}
add_action('admin_post_nopriv_nf_contact', 'nf_handle_contact');
add_action('admin_post_nf_contact', 'nf_handle_contact');
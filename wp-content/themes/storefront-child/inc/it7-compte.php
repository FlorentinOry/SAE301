<?php
/**
 * IT-7 : champs supplémentaires à l'inscription (nom, téléphone, offres)
 */
defined('ABSPATH') || exit;

/* Validation : le nom est obligatoire */
add_filter('woocommerce_process_registration_errors', function ($errors, $username, $password, $email) {
    if (empty(trim($_POST['nf_name'] ?? ''))) {
        $errors->add('nf_name_error', 'Veuillez saisir votre nom.');
    }
    return $errors;
}, 10, 4);

/* Enregistrement des données */
add_action('woocommerce_created_customer', function ($customer_id) {
    $name   = sanitize_text_field(wp_unslash($_POST['nf_name'] ?? ''));
    $phone  = sanitize_text_field(wp_unslash($_POST['nf_phone'] ?? ''));
    $offers = (isset($_POST['nf_offers']) && is_array($_POST['nf_offers']))
        ? array_map('sanitize_key', wp_unslash($_POST['nf_offers']))
        : [];

    if ($name) {
        $parts = explode(' ', $name, 2);
        update_user_meta($customer_id, 'first_name', $parts[0]);
        update_user_meta($customer_id, 'last_name', $parts[1] ?? '');
        update_user_meta($customer_id, 'billing_first_name', $parts[0]);
        update_user_meta($customer_id, 'billing_last_name', $parts[1] ?? '');
        wp_update_user(['ID' => $customer_id, 'display_name' => $name]);
    }
    if ($phone) {
        update_user_meta($customer_id, 'billing_phone', $phone);
    }
    update_user_meta($customer_id, 'nf_offers_email', in_array('email', $offers, true) ? '1' : '0');
    update_user_meta($customer_id, 'nf_offers_phone', in_array('phone', $offers, true) ? '1' : '0');
});

/* Visible dans le back office (Utilisateurs > profil) */
foreach (['show_user_profile', 'edit_user_profile'] as $hook) {
    add_action($hook, function ($user) { ?>
        <h2>Offres Nathan's</h2>
        <table class="form-table">
            <tr><th>Offres par email</th><td><?php echo get_user_meta($user->ID, 'nf_offers_email', true) === '1' ? 'Oui' : 'Non'; ?></td></tr>
            <tr><th>Offres par téléphone</th><td><?php echo get_user_meta($user->ID, 'nf_offers_phone', true) === '1' ? 'Oui' : 'Non'; ?></td></tr>
        </table>
    <?php });
}
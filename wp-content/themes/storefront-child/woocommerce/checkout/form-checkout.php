<?php
/**
 * Page de paiement selon la maquette (US-6.x)
 */
defined('ABSPATH') || exit;

do_action('woocommerce_before_checkout_form', $checkout);

if (!$checkout->is_registration_enabled() && $checkout->is_registration_required() && !is_user_logged_in()) {
    echo '<p class="woocommerce-info">Vous devez être connecté pour passer commande.</p>';
    return;
}
?>

<header class="nf-checkout__hero">
  <span class="nf-badge">Payment details</span>
  <h1>Payment of the order</h1>
  <p>Renseignez vos coordonnées et choisissez votre moyen de paiement.</p>
</header>

<form name="checkout" method="post" class="checkout woocommerce-checkout"
      action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data" novalidate>

  <div class="nf-checkout">

    <div class="nf-checkout__main">
      <?php if ($checkout->get_checkout_fields()) : ?>
        <?php do_action('woocommerce_checkout_before_customer_details'); ?>
        <div id="customer_details">
          <div class="nf-col"><?php do_action('woocommerce_checkout_billing'); ?></div>
          <div class="nf-col"><?php do_action('woocommerce_checkout_shipping'); ?></div>
        </div>
        <?php do_action('woocommerce_checkout_after_customer_details'); ?>
      <?php endif; ?>
    </div>

    <aside class="nf-checkout__side">
      <?php do_action('woocommerce_checkout_before_order_review_heading'); ?>
      <h3 id="order_review_heading">Order summary</h3>
      <?php do_action('woocommerce_checkout_before_order_review'); ?>
      <div id="order_review" class="woocommerce-checkout-review-order">
        <?php do_action('woocommerce_checkout_order_review'); ?>
      </div>
      <?php do_action('woocommerce_checkout_after_order_review'); ?>
    </aside>

  </div>
</form>

<?php do_action('woocommerce_after_checkout_form', $checkout);
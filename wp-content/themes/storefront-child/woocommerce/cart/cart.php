<?php
/**
 * Panier selon la maquette "commande" (US-5.3)
 */
defined('ABSPATH') || exit;

do_action('woocommerce_before_cart'); ?>

<header class="nf-cart__hero">
  <p class="nf-cart__kicker">Your order</p>
  <h1>Order now and become famous!</h1>
  <p class="nf-cart__total">Total (TTC) : <?php echo wp_kses_post(WC()->cart->get_total()); ?></p>
  <a class="button" href="<?php echo esc_url(wc_get_checkout_url()); ?>">Proceed to payment</a>
</header>

<div class="nf-cart">

  <section class="nf-cart__items">
    <h2>Your order :</h2>

    <form class="woocommerce-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
      <?php do_action('woocommerce_before_cart_table'); ?>

      <ul class="nf-cart__list">
        <?php do_action('woocommerce_before_cart_contents');

        foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) :
            $_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
            $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

            if (!$_product || !$_product->exists() || $cart_item['quantity'] <= 0
                || !apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
                continue;
            }

            $permalink = apply_filters(
                'woocommerce_cart_item_permalink',
                $_product->is_visible() ? $_product->get_permalink($cart_item) : '',
                $cart_item,
                $cart_item_key
            );
            $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image('woocommerce_thumbnail'), $cart_item, $cart_item_key);
            ?>
            <li class="nf-cart__item woocommerce-cart-form__cart-item <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">

              <div class="nf-cart__thumb">
                <?php echo $permalink ? '<a href="' . esc_url($permalink) . '">' . $thumbnail . '</a>' : $thumbnail; // phpcs:ignore ?>
              </div>

              <div class="nf-cart__info">
                <p class="nf-cart__name">
                  <strong>
                    <?php
                    if ($permalink) {
                        echo wp_kses_post(apply_filters('woocommerce_cart_item_name', sprintf('<a href="%s">%s</a>', esc_url($permalink), $_product->get_name()), $cart_item, $cart_item_key));
                    } else {
                        echo wp_kses_post($_product->get_name());
                    }
                    ?>
                  </strong>
                  <span class="nf-cart__sep">-</span>
                  <span class="nf-cart__price"><?php echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key); // phpcs:ignore ?></span>
                </p>
                <?php
                do_action('woocommerce_after_cart_item_name', $cart_item, $cart_item_key);
                echo wc_get_formatted_cart_item_data($cart_item); // phpcs:ignore
                if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity'])) {
                    echo '<p class="backorder_notification">Disponible sur commande</p>';
                }
                ?>
              </div>

              <div class="nf-cart__qty">
                <?php
                if ($_product->is_sold_individually()) {
                    $min_quantity = 1;
                    $max_quantity = 1;
                } else {
                    $min_quantity = 0;
                    $max_quantity = $_product->get_max_purchase_quantity();
                }
                $product_quantity = woocommerce_quantity_input([
                    'input_name'   => "cart[{$cart_item_key}][qty]",
                    'input_value'  => $cart_item['quantity'],
                    'max_value'    => $max_quantity,
                    'min_value'    => $min_quantity,
                    'product_name' => $_product->get_name(),
                ], $_product, false);
                echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item); // phpcs:ignore
                ?>
              </div>

              <div class="nf-cart__sub">
                <?php echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); // phpcs:ignore ?>
              </div>

              <div class="nf-cart__remove">
                <?php
                echo apply_filters( // phpcs:ignore
                    'woocommerce_cart_item_remove_link',
                    sprintf(
                        '<a role="button" href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
                        esc_url(wc_get_cart_remove_url($cart_item_key)),
                        esc_attr(sprintf('Retirer %s du panier', wp_strip_all_tags($_product->get_name()))),
                        esc_attr($product_id),
                        esc_attr($_product->get_sku())
                    ),
                    $cart_item_key
                );
                ?>
              </div>
            </li>
        <?php endforeach; ?>

        <?php do_action('woocommerce_cart_contents'); ?>
      </ul>

      <div class="nf-cart__actions">
        <?php if (wc_coupons_enabled()) : ?>
          <div class="coupon">
            <label for="coupon_code" class="screen-reader-text">Code promo</label>
            <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="Code promo">
            <button type="submit" class="button" name="apply_coupon" value="Appliquer">Appliquer</button>
            <?php do_action('woocommerce_cart_coupon'); ?>
          </div>
        <?php endif; ?>

        <button type="submit" class="button nf-update" name="update_cart" value="Mettre à jour">Mettre à jour</button>
        <?php do_action('woocommerce_cart_actions'); ?>
        <?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>
      </div>

      <?php do_action('woocommerce_after_cart_contents'); ?>
      <?php do_action('woocommerce_after_cart_table'); ?>
    </form>
  </section>

  <aside class="nf-cart__side">
    <?php do_action('woocommerce_before_cart_collaterals'); ?>
    <div class="cart-collaterals">
      <?php do_action('woocommerce_cart_collaterals'); ?>
    </div>

    <?php $r = nf_restaurant(); ?>
    <div class="nf-cart__place">
      <p class="nf-cart__city"><?php echo esc_html($r['city']); ?></p>
      <p class="nf-cart__label">Address</p>
      <p><?php echo esc_html($r['address']); ?><br><?php echo esc_html($r['city'] . ', ' . $r['state'] . ' ' . $r['zip']); ?></p>
    </div>
  </aside>

</div>

<?php do_action('woocommerce_after_cart');
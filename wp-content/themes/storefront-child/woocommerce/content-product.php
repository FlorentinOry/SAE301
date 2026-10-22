<?php
/**
 * Carte produit (grille menu)
 */
defined('ABSPATH') || exit;
global $product;
if (empty($product) || !$product->is_visible()) return;
?>
<li <?php wc_product_class('menu-card', $product); ?>
    data-search="<?php echo esc_attr(get_the_title() . ' ' . wp_strip_all_tags($product->get_short_description())); ?>"
    data-price="<?php echo esc_attr($product->get_price()); ?>">
  <a href="<?php the_permalink(); ?>" class="menu-card__img">
    <?php echo woocommerce_get_product_thumbnail('woocommerce_single'); ?>
  </a>
  <h3 class="menu-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
  <div class="menu-card__desc"><?php echo wp_kses_post($product->get_short_description()); ?></div>
  <p class="menu-card__price"><?php echo $product->get_price_html(); ?></p>
  <a href="<?php the_permalink(); ?>" class="button menu-card__btn">Order</a>
</li>
<?php
/**
 * Page "The Menu" : une section par catégorie
 */
defined('ABSPATH') || exit;
get_header();

$cats = is_product_category()
    ? [get_queried_object()]
    : get_terms([
        'taxonomy'   => 'product_cat',
        'hide_empty' => true,
        'exclude'    => [get_option('default_product_cat')],
        'orderby'    => 'menu_order',
    ]);
?>
<main class="menu-page">
  <section class="menu-hero">
    <div class="menu-hero__inner">
      <h1>Our Menu</h1>
      <p>Pendant plus de 100 ans, Nathan's Famous a fait de « The Flavor of New York » une signature : hot dogs, crinkle-cut fries, burgers et desserts.</p>
    </div>
  </section>

  <?php wc_print_notices(); ?>

    <?php if (count($cats) > 1) : $cur = get_woocommerce_currency_symbol(); ?>
  <form class="nf-filters" role="search" aria-label="Filtrer le menu" onsubmit="return false">
    <div class="nf-filters__pills" role="group" aria-label="Catégories">
      <button type="button" class="nf-fpill is-active" data-cat="all">Tout</button>
      <?php foreach ($cats as $c) : ?>
        <button type="button" class="nf-fpill" data-cat="<?php echo esc_attr($c->slug); ?>"><?php echo esc_html($c->name); ?></button>
      <?php endforeach; ?>
    </div>

    <div class="nf-filters__row">
      <label class="screen-reader-text" for="nf-search">Rechercher un produit</label>
      <input id="nf-search" type="search" placeholder="Rechercher un produit…">

      <label class="screen-reader-text" for="nf-price">Prix maximum</label>
      <select id="nf-price">
        <option value="0">Tous les prix</option>
        <option value="5">Jusqu'à 5 <?php echo esc_html($cur); ?></option>
        <option value="7">Jusqu'à 7 <?php echo esc_html($cur); ?></option> 
        <option value="10">Jusqu'à 10 <?php echo esc_html($cur); ?></option>
      </select>

      <button type="button" class="nf-reset">Réinitialiser</button>
    </div>
    <p class="nf-filters__count" aria-live="polite"></p>
  </form>
  <p class="nf-empty is-hidden">Aucun produit ne correspond à votre recherche.</p>
  <?php endif; ?>
  <?php foreach ($cats as $cat) :
      $q = new WP_Query([
          'post_type'      => 'product',
          'posts_per_page' => -1,
          'tax_query'      => [[
              'taxonomy' => 'product_cat',
              'field'    => 'term_id',
              'terms'    => $cat->term_id,
          ]],
      ]);
      if (!$q->have_posts()) continue; ?>
    <section class="menu-section" id="<?php echo esc_attr($cat->slug); ?>">
      <h2 class="menu-section__title"><span><?php echo esc_html($cat->name); ?></span></h2>
      <?php if ($cat->description) : ?>
        <p class="menu-section__desc"><?php echo wp_kses_post($cat->description); ?></p>
      <?php endif; ?>
      <ul class="products menu-grid">
        <?php while ($q->have_posts()) : $q->the_post();
            wc_get_template_part('content', 'product');
        endwhile; wp_reset_postdata(); ?>
      </ul>
    </section>
  <?php endforeach; ?>
</main>
<?php get_footer();
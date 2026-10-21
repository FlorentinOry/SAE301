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
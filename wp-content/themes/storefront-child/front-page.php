<?php
/**
 * Page d'accueil Nathan's Famous
 * Les 3 derniers produits sont dynamiques (US-16).
 */
defined('ABSPATH') || exit;
get_header();

$latest = new WP_Query([
    'post_type'      => 'product',
    'posts_per_page' => 3,
    'orderby'        => 'date',
    'order'          => 'DESC',
    'post_status'    => 'publish',
]);
$menu_url    = wc_get_page_permalink('shop');
$account_url = wc_get_page_permalink('myaccount');
$img         = get_stylesheet_directory_uri() . '/assets/img/';
$img_dir     = get_stylesheet_directory() . '/assets/img/';
$video_file  = get_stylesheet_directory() . '/assets/video/burger.mp4';
$video_url   = get_stylesheet_directory_uri() . '/assets/video/burger.mp4';
?>
<main class="home">

  <!-- Bandeau -->
  <section class="home-hero">
    <div class="home-hero__inner">
      <p class="home-hero__since">Since 1916</p>
      <h1>The flavor of<br>New York</h1>
      <p class="home-hero__text">Hot dogs, crinkle-cut fries, burgers et desserts. Commandez en ligne et retirez au restaurant de Bellmore.</p>
      <a class="button" href="<?php echo esc_url($menu_url); ?>">Order now</a>
    </div>
  </section>

  <!-- Nouveau produit + vidéo -->
  <section class="home-dark home-new">
    <div class="home-dark__inner">
      <p class="home-kicker">Introducing the new</p>
      <h2>Bacon Cheddar<br>Cheesy Burger</h2>
      <?php if (file_exists($video_file)) : ?>
        <video class="home-video" controls preload="metadata"
               <?php if (file_exists($img_dir . 'video-poster.jpg')) echo 'poster="' . esc_url($img . 'video-poster.jpg') . '"'; ?>>
          <source src="<?php echo esc_url($video_url); ?>" type="video/mp4">
        </video>
      <?php elseif (file_exists($img_dir . 'video-poster.jpg')) : ?>
        <img class="home-video" src="<?php echo esc_url($img . 'video-poster.jpg'); ?>" alt="Bacon Cheddar Cheesy Burger">
      <?php endif; ?>
    </div>
  </section>

  <!-- Produits -->
  <section class="home-dark home-famous">
    <div class="home-dark__inner">
      <h2>It's our food that makes<br>us famous</h2>
      <p>Des hot dogs 100 % bœuf, des burgers et des frites crinkle-cut. Choisissez vos produits, personnalisez-les et passez récupérer votre commande au comptoir.</p>
    </div>
    <div class="menu-section home-latest">
      <ul class="products menu-grid">
        <?php while ($latest->have_posts()) : $latest->the_post();
            wc_get_template_part('content', 'product');
        endwhile; wp_reset_postdata(); ?>
      </ul>
      <p><a class="button" href="<?php echo esc_url($menu_url); ?>">Learn more about our menu</a></p>
    </div>
  </section>

  <!-- Step inside -->
  <section class="home-inside">
    <div class="home-inside__img">
      <?php if (file_exists($img_dir . 'restaurant.jpg')) : ?>
        <img src="<?php echo esc_url($img . 'restaurant.jpg'); ?>" alt="Le restaurant Nathan's Famous">
      <?php endif; ?>
    </div>
    <div class="home-inside__text">
      <h2>Step inside the new Nathan's Famous</h2>
      <p>Ce n'est pas seulement notre menu mondialement connu qui s'est refait une beauté : notre nouveau design de restaurant arrive bientôt près de chez vous.</p>
    </div>
  </section>

  <!-- Instagram -->
  <section class="home-insta">
    <h2>Check out @originalnathans<br>on Instagram to see what makes us famous</h2>
    <div class="home-insta__grid">
      <?php for ($i = 1; $i <= 8; $i++) :
          $f = "insta-$i.jpg";
          if (file_exists($img_dir . $f)) : ?>
            <img src="<?php echo esc_url($img . $f); ?>" alt="Photo Instagram <?php echo $i; ?>" loading="lazy">
          <?php else : ?>
            <span class="home-insta__ph" aria-hidden="true"></span>
          <?php endif;
      endfor; ?>
    </div>
    <a class="button" href="https://www.instagram.com/originalnathans/" target="_blank" rel="noopener">Follow us on Instagram</a>
  </section>

  <!-- Coupon Club -->
  <section class="home-coupon">
    <h2>Coupon Club</h2>
    <p>Inscrivez-vous au Coupon Club de Nathan's Famous et recevez nos dernières offres limitées, bons plans et nouveautés.</p>
    <a class="button" href="<?php echo esc_url($account_url); ?>">Sign up today for the loyalty club!</a>
  </section>

<?php get_template_part('template-parts/contact'); ?>

</main>
<?php get_footer();
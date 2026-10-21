<?php
/**
 * Header Nathan's Famous (remplace celui de Storefront)
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="hfeed site">
  <header id="masthead" class="nf-header">
    <div class="nf-header__inner">
      <div class="nf-logo">
        <?php if (has_custom_logo()) { the_custom_logo(); } else { ?>
          <a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
        <?php } ?>
      </div>
      <button class="nf-burger" aria-expanded="false" aria-controls="nf-nav" aria-label="Menu">&#9776;</button>
      <?php
      wp_nav_menu([
          'theme_location'  => 'primary',
          'container'       => 'nav',
          'container_id'    => 'nf-nav',
          'container_class' => 'nf-nav',
          'menu_class'      => 'nf-menu',
          'fallback_cb'     => false,
      ]);
      ?>
    </div>
  </header>
  <div id="content" class="site-content" tabindex="-1">

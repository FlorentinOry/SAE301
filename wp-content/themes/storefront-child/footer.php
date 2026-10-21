<?php
/**
 * Footer Nathan's Famous (remplace celui de Storefront)
 */
?>
  </div><!-- #content -->

  <?php
  // Section contact : page Menu, accueil et page de confirmation
  if (is_shop() || is_product_category() || is_order_received_page()) {
      get_template_part('template-parts/contact');
  }
  ?>
  
  <footer class="nf-footer">
    <div class="nf-footer__inner">
      <div class="nf-footer__col">
        <h4>About us</h4>
        <ul>
          <li><a href="#">Our history</a></li>
          <li><a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>">The menu</a></li>
          <li><a href="#">Locations</a>
            <ul>
              <li><a href="#">United States</a></li>
              <li><a href="#">International</a></li>
            </ul>
          </li>
          <li><a href="#contact">Contact us</a></li>
        </ul>
      </div>
      <div class="nf-footer__col">
        <h4>Work with us</h4>
        <ul>
          <li><a href="#">Franchise</a></li>
          <li><a href="#">Food service</a></li>
        </ul>
      </div>
      <div class="nf-footer__col">
        <h4>Also us</h4>
        <ul>
          <li><a href="#">Retail/Grocery</a></li>
          <li><a href="#">Hot dog eating contest</a></li>
        </ul>
      </div>
      <div class="nf-footer__logo">
        <?php if (has_custom_logo()) { the_custom_logo(); } ?>
      </div>
    </div>

    <div class="nf-footer__bottom">
      <div class="nf-footer__inner nf-footer__bottom-inner">
        <span>Copyright ©<?php echo date('Y'); ?> Nathan's Famous, Inc. All rights reserved</span>
        <div class="nf-social">
          <a href="https://www.facebook.com/NathansFamous" aria-label="Facebook" target="_blank" rel="noopener">
            <svg viewBox="0 0 24 24" width="22" height="22" fill="currentColor"><path d="M22 12a10 10 0 1 0-11.56 9.88v-6.99H7.9V12h2.54V9.8c0-2.5 1.49-3.89 3.78-3.89 1.09 0 2.24.2 2.24.2v2.46h-1.26c-1.24 0-1.63.77-1.63 1.56V12h2.78l-.44 2.89h-2.34v6.99A10 10 0 0 0 22 12z"/></svg>
          </a>
          <a href="https://x.com/originalnathans" aria-label="X" target="_blank" rel="noopener">
            <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
          </a>
          <a href="https://www.instagram.com/originalnathans/" aria-label="Instagram" target="_blank" rel="noopener">
            <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/></svg>
          </a>
          <a href="#" aria-label="RSS">
            <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><circle cx="5" cy="19" r="1.5" fill="currentColor" stroke="none"/><path d="M4 11a9 9 0 0 1 9 9M4 4a16 16 0 0 1 16 16"/></svg>
          </a>
        </div>
      </div>
    </div>
  </footer>
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
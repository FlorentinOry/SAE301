<?php
/**
 * Section "Contact us" (formulaire)
 */
defined('ABSPATH') || exit;
$status = isset($_GET['contact']) ? sanitize_key($_GET['contact']) : '';
?>
<section class="nf-contact" id="contact">
  <h2 class="nf-contact__title"><span>Contact us</span></h2>
  <h3 class="nf-contact__sub">Let's talk about being famous, together!</h3>

  <?php if ($status === 'ok') : ?>
    <p class="nf-contact__msg nf-contact__msg--ok" role="status">Merci, votre message a bien été envoyé.</p>
  <?php elseif ($status === 'error') : ?>
    <p class="nf-contact__msg nf-contact__msg--error" role="alert">Le message n'a pas pu être envoyé. Vérifiez les champs et réessayez.</p>
  <?php endif; ?>

  <form class="nf-contact__form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
    <input type="hidden" name="action" value="nf_contact">
    <?php wp_nonce_field('nf_contact', 'nf_contact_nonce'); ?>
    <div class="nf-contact__hp" aria-hidden="true">
      <label>Ne pas remplir <input type="text" name="website" tabindex="-1" autocomplete="off"></label>
    </div>

    <div class="nf-contact__row">
      <p><label for="nf-name">Name</label>
         <input id="nf-name" type="text" name="name" placeholder="Name" required></p>
      <p><label for="nf-email">Email Adresse</label>
         <input id="nf-email" type="email" name="email" placeholder="Email Adresse" required></p>
    </div>
    <p><label for="nf-phone">Phone Number</label>
       <input id="nf-phone" type="tel" name="phone" placeholder="Phone Number"></p>
    <p><label for="nf-message">Message</label>
       <textarea id="nf-message" name="message" rows="7" placeholder="Message" required></textarea></p>
    <p class="nf-contact__submit"><button type="submit" class="button">Submit</button></p>
  </form>

  <div class="nf-contact__info">
    <h3>Get in touch</h3>
    <p>One Jericho Plaza, Second Floor</p>
    <p>Jericho, New York 11753</p>
    <p>Phone: 1-800-NATHANS</p>
  </div>
</section>
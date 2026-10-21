<?php
/**
 * Connexion + création de compte (maquette "Create account")
 */
defined('ABSPATH') || exit;

do_action('woocommerce_before_customer_login_form');
$register_on = 'yes' === get_option('woocommerce_enable_myaccount_registration');
?>
<div class="nf-auth">
  <header class="nf-auth__hero">
    <span class="nf-badge">Mon compte</span>
    <h1>Create account</h1>
    <p>Connectez-vous ou créez votre compte pour suivre vos commandes.</p>
  </header>

  <div class="nf-auth__grid <?php echo $register_on ? '' : 'nf-auth__grid--single'; ?>">

    <!-- Connexion -->
    <section class="nf-auth__card">
      <h2 class="nf-auth__head">Se connecter</h2>
      <form class="woocommerce-form woocommerce-form-login login" method="post" novalidate>
        <?php do_action('woocommerce_login_form_start'); ?>

        <p class="form-row">
          <label for="username">Email ou nom d'utilisateur <span class="required">*</span></label>
          <input type="text" name="username" id="username" autocomplete="username"
                 value="<?php echo (!empty($_POST['username']) && is_string($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>" required>
        </p>
        <p class="form-row">
          <label for="password">Mot de passe <span class="required">*</span></label>
          <input type="password" name="password" id="password" autocomplete="current-password" required>
        </p>

        <?php do_action('woocommerce_login_form'); ?>

        <p class="form-row">
          <label class="nf-check"><input name="rememberme" type="checkbox" id="rememberme" value="forever"> <span>Se souvenir de moi</span></label>
        </p>
        <?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>
        <button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="login" value="Se connecter">Se connecter</button>
        <p class="woocommerce-LostPassword lost_password">
          <a href="<?php echo esc_url(wp_lostpassword_url()); ?>">Mot de passe oublié ?</a>
        </p>

        <?php do_action('woocommerce_login_form_end'); ?>
      </form>
    </section>

    <!-- Création de compte -->
    <?php if ($register_on) : ?>
    <section class="nf-auth__card">
      <h2 class="nf-auth__head">Your details</h2>
      <form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action('woocommerce_register_form_tag'); ?>>
        <?php do_action('woocommerce_register_form_start'); ?>

        <p class="form-row">
          <label for="nf_name">Name <span class="required">*</span></label>
          <input type="text" name="nf_name" id="nf_name" placeholder="Name" autocomplete="name" required
                 value="<?php echo !empty($_POST['nf_name']) ? esc_attr(wp_unslash($_POST['nf_name'])) : ''; ?>">
        </p>
        <p class="form-row">
          <label for="nf_phone">Phone</label>
          <input type="tel" name="nf_phone" id="nf_phone" placeholder="Phone" autocomplete="tel"
                 value="<?php echo !empty($_POST['nf_phone']) ? esc_attr(wp_unslash($_POST['nf_phone'])) : ''; ?>">
        </p>

        <?php if ('no' === get_option('woocommerce_registration_generate_username')) : ?>
        <p class="form-row">
          <label for="reg_username">Nom d'utilisateur <span class="required">*</span></label>
          <input type="text" name="username" id="reg_username" autocomplete="username" required
                 value="<?php echo !empty($_POST['username']) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>">
        </p>
        <?php endif; ?>

        <p class="form-row">
          <label for="reg_email">Email <span class="required">*</span></label>
          <input type="email" name="email" id="reg_email" placeholder="Email" autocomplete="email" required
                 value="<?php echo !empty($_POST['email']) ? esc_attr(wp_unslash($_POST['email'])) : ''; ?>">
        </p>

        <?php if ('no' === get_option('woocommerce_registration_generate_password')) : ?>
        <p class="form-row">
          <label for="reg_password">Password <span class="required">*</span></label>
          <input type="password" name="password" id="reg_password" placeholder="Password" autocomplete="new-password" required>
        </p>
        <?php else : ?>
          <p>Un lien pour définir votre mot de passe sera envoyé par email.</p>
        <?php endif; ?>

        <fieldset class="nf-auth__offers">
          <legend>I want to receive offers by:</legend>
          <label class="nf-check"><input type="checkbox" name="nf_offers[]" value="email"> <span>Email</span></label>
          <label class="nf-check"><input type="checkbox" name="nf_offers[]" value="phone"> <span>Phone</span></label>
        </fieldset>

        <?php do_action('woocommerce_register_form'); ?>

        <p class="form-row">
          <?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>
          <button type="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit" name="register" value="Create account">Create account</button>
        </p>

        <?php do_action('woocommerce_register_form_end'); ?>
      </form>
    </section>
    <?php endif; ?>

  </div>
</div>
<?php do_action('woocommerce_after_customer_login_form');
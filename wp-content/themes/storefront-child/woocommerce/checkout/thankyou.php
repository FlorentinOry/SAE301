<?php
/**
 * Page de confirmation de commande
 * Variable disponible : $order
 */
defined('ABSPATH') || exit;
$r = nf_restaurant();
$adresse_complete = $r['address'] . ', ' . trim($r['city'] . ', ' . $r['state'] . ' ' . $r['zip'], ' ,');
?>
<div class="woocommerce-order nf-thanks">
<?php if ($order) :
    do_action('woocommerce_before_thankyou', $order->get_id());

    if ($order->has_status('failed')) : ?>
        <p class="woocommerce-notice woocommerce-notice--error">Votre paiement a échoué. Merci de réessayer.</p>
        <p>
            <a href="<?php echo esc_url($order->get_checkout_payment_url()); ?>" class="button pay">Payer</a>
            <?php if (is_user_logged_in()) : ?>
                <a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>" class="button pay">Mon compte</a>
            <?php endif; ?>
        </p>
    <?php else : ?>
        <header class="nf-thanks__hero">
            <span class="nf-badge">Commande confirmée</span>
            <h1>Merci pour votre commande !</h1>
            <p>Merci d'avoir choisi Nathan's Famous.<br>Voici comment récupérer votre commande au restaurant de <?php echo esc_html($r['city']); ?>.</p>
        </header>

        <div class="nf-thanks__grid">
            <section>
                <h2>Récupérer votre commande</h2>
                <ol class="nf-steps">
                    <li><div><strong>Rendez-vous au restaurant</strong>
                        <p>Retrouvez-nous chez Nathan's Famous à <?php echo esc_html($r['city']); ?>, au <?php echo esc_html($adresse_complete); ?>. Présentez-vous au comptoir.</p></div></li>
                    <li><div><strong>Présentez votre confirmation</strong>
                        <p>Montrez votre confirmation de commande à l'équipe au comptoir pour qu'elle puisse retrouver votre commande.</p></div></li>
                    <li><div><strong>Vérifiez, puis régalez-vous !</strong>
                        <p>Avant de repartir, vérifiez le contenu de votre commande avec l'équipe. Un article manque ? Signalez-le sur place.</p></div></li>
                </ol>
                <div class="nf-thanks__actions">
                    <a class="button" href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>">Retour au menu</a>
                    <button type="button" class="button button--outline nf-print" onclick="window.print()">Imprimer ma commande</button>
                </div>
            </section>

            <aside class="nf-pickup">
                <h3 class="nf-pickup__head">Votre retrait</h3>
                <div class="nf-pickup__body">
                    <p class="nf-pickup__city"><?php echo esc_html($r['city']); ?></p>
                    <p>Nathan's Famous<br>
                       <?php echo esc_html($r['address']); ?><br>
                       <?php echo esc_html(trim($r['city'] . ', ' . $r['state'] . ' ' . $r['zip'], ' ,')); ?></p>
                    <p><strong>Retrait au comptoir du restaurant</strong></p>
                    <p class="nf-pickup__label">Référence de commande</p>
                    <p class="nf-pickup__ref">#<?php echo esc_html($order->get_order_number()); ?></p>
                    <p class="nf-pickup__hint">Gardez votre confirmation à portée de main pour la présenter au comptoir.</p>
                </div>
            </aside>
        </div>
    <?php endif;

    do_action('woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id());
    do_action('woocommerce_thankyou', $order->get_id());
else : ?>
    <p class="woocommerce-notice">Merci. Votre commande a bien été reçue.</p>
<?php endif; ?>
</div>
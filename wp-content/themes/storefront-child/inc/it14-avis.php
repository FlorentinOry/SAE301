<?php
/**
 * IT-14 : avis clients (textes du formulaire)
 */
defined('ABSPATH') || exit;

add_filter('woocommerce_product_review_comment_form_args', function ($args) {
    $args['title_reply']          = 'Laisser un avis';
    $args['label_submit']         = 'Publier mon avis';
    $args['comment_notes_before'] = '';
    return $args;
});
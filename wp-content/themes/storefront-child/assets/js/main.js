// Menu burger mobile
document.addEventListener('DOMContentLoaded', function () {
  var burger = document.querySelector('.nf-burger');
  var nav = document.getElementById('nf-nav');
  if (!burger || !nav) return;
  burger.addEventListener('click', function () {
    var open = nav.classList.toggle('is-open');
    burger.setAttribute('aria-expanded', open ? 'true' : 'false');
  });
});

// Boutons − / + de la quantité
document.addEventListener('click', function (e) {
  var btn = e.target.closest('.nf-qty__btn');
  if (!btn) return;
  var wrap = btn.closest('.quantity');
  var input = wrap && wrap.querySelector('input.qty');
  if (!input) return;

  var step = parseFloat(input.step) || 1;
  var min = input.min !== '' ? parseFloat(input.min) : 0;
  var max = input.max !== '' ? parseFloat(input.max) : Infinity;
  var val = (parseFloat(input.value) || 0) + step * parseInt(btn.dataset.dir, 10);

  input.value = Math.max(min, Math.min(max, val));
  input.dispatchEvent(new Event('change', { bubbles: true }));
});
// Options des produits variables : boutons au lieu de listes déroulantes
(function ($) {
  if (!$) return;

  function build($form) {
    $form.find('table.variations select').each(function () {
      var $select = $(this);
      if ($select.data('nf')) return;
      $select.data('nf', true).addClass('nf-select-hidden');
      var $group = $('<div class="nf-pills" role="group"></div>').insertAfter($select);
      $select.find('option').each(function () {
        if (!this.value) return;
        $('<button type="button" class="nf-pill"></button>')
          .text($(this).text())
          .attr('data-value', this.value)
          .appendTo($group);
      });
    });
    sync($form);
  }

  function sync($form) {
    $form.find('table.variations select').each(function () {
      var $select = $(this);
      var val = $select.val();
      $select.next('.nf-pills').find('.nf-pill').each(function () {
        var v = $(this).attr('data-value');
        var exists = $select.find('option').filter(function () { return this.value === v; }).length > 0;
        $(this).toggleClass('is-active', v === val).prop('disabled', !exists);
      });
    });
  }

  $(document).on('click', '.nf-pill', function () {
    var $b = $(this);
    $b.parent().prev('select').val($b.attr('data-value')).trigger('change');
  });

  $(document).on('wc_variation_form', '.variations_form', function () { build($(this)); });
  $(document).on('woocommerce_update_variation_values check_variations reset_data', '.variations_form', function () { sync($(this)); });
  $(function () { $('.variations_form').each(function () { build($(this)); }); });
})(window.jQuery);
// Panier : mise à jour automatique à chaque changement de quantité
(function ($) {
  if (!$) return;
  var timer;
  $(document).on('change', '.woocommerce-cart-form input.qty', function () {
    var $form = $(this).closest('form');
    clearTimeout(timer);
    timer = setTimeout(function () {
      $form.find('button[name="update_cart"]')
        .prop('disabled', false)
        .removeAttr('aria-disabled')
        .trigger('click');
    }, 600);
  });
})(window.jQuery);
// Filtres de la page Menu (catégorie, recherche, prix)
(function () {
  var bar = document.querySelector('.nf-filters');
  if (!bar) return;

  var pills = bar.querySelectorAll('.nf-fpill');
  var search = bar.querySelector('#nf-search');
  var price = bar.querySelector('#nf-price');
  var count = bar.querySelector('.nf-filters__count');
  var reset = bar.querySelector('.nf-reset');
  var sections = document.querySelectorAll('.menu-section');
  var empty = document.querySelector('.nf-empty');
  var cat = 'all';

  // Ignore majuscules et accents : "Crème" trouve "creme"
  function norm(s) {
    return (s || '').toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '');
  }

  function apply() {
    var q = norm(search.value.trim());
    var max = parseFloat(price.value) || 0;
    var total = 0;

    sections.forEach(function (sec) {
      var inCat = cat === 'all' || sec.id === cat;
      var shown = 0;

      sec.querySelectorAll('.menu-card').forEach(function (card) {
        var ok = inCat;
        if (ok && q) ok = norm(card.dataset.search).indexOf(q) !== -1;
        if (ok && max) {
          var p = parseFloat(card.dataset.price);
          ok = !isNaN(p) && p <= max;
        }
        card.classList.toggle('is-hidden', !ok);
        if (ok) shown++;
      });

      sec.classList.toggle('is-hidden', shown === 0);
      total += shown;
    });

    count.textContent = total + (total > 1 ? ' produits' : ' produit');
    if (empty) empty.classList.toggle('is-hidden', total !== 0);
  }

  pills.forEach(function (btn) {
    btn.addEventListener('click', function () {
      cat = btn.dataset.cat;
      pills.forEach(function (b) { b.classList.toggle('is-active', b === btn); });
      apply();
    });
  });

  search.addEventListener('input', apply);
  price.addEventListener('change', apply);

  reset.addEventListener('click', function () {
    search.value = '';
    price.value = '0';
    cat = 'all';
    pills.forEach(function (b) { b.classList.toggle('is-active', b.dataset.cat === 'all'); });
    apply();
  });

  apply();
})();
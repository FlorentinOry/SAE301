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

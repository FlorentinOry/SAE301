<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Design System - Nathan's Famous</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;800;900&display=swap">
  <link rel="stylesheet" href="../assets/css/main.css">
  <style>
    /* Styles propres à cette page de documentation uniquement */
    .ds { max-width: 1100px; margin: 0 auto; padding: 2rem 1rem 4rem; }
    .ds section { margin-bottom: 3.5rem; }
    .ds h2 { border-bottom: 3px solid var(--green); padding-bottom: .5rem; }
    .ds .row { display: flex; flex-wrap: wrap; gap: 1rem; align-items: center; }
    .ds .swatch { width: 140px; }
    .ds .swatch span { display: block; height: 80px; border: 1px solid var(--border); }
    .ds .swatch small { display: block; margin-top: .35rem; font-size: .8rem; }
    .ds .nf-nav { display: block; position: static; }
    .ds .nf-burger { display: none; }
  </style>
</head>
<body>
<main class="ds">
  <h1>Design System - Nathan's Famous</h1>

  <section>
    <h2>Couleurs</h2>
    <div class="row">
      <div class="swatch"><span style="background:#2d7436"></span><small>Vert principal<br>#2d7436</small></div>
      <div class="swatch"><span style="background:#1f5426"></span><small>Vert survol<br>#1f5426</small></div>
      <div class="swatch"><span style="background:#b30f0f"></span><small>Rouge titres<br>#b30f0f</small></div>
      <div class="swatch"><span style="background:#222222"></span><small>Gris foncé<br>#222222</small></div>
      <div class="swatch"><span style="background:#000000"></span><small>Noir<br>#000000</small></div>
      <div class="swatch"><span style="background:#f4f6f1"></span><small>Fond clair<br>#f4f6f1</small></div>
    </div>
  </section>

  <section>
    <h2>Typographie (Inter)</h2>
    <h1>Titre H1 - Order now</h1>
    <h2 style="border:0">Titre H2 - World famous</h2>
    <h3>Titre H3 - New York Cheesesteak</h3>
    <p>Texte courant : Nathan's Famous hot dogs are all beef, all craveable, made with our secret spice recipe.</p>
  </section>

  <section>
    <h2>Boutons</h2>
    <div class="row">
      <a class="button" href="#">Order</a>
      <a class="button button--outline" href="#">Print ticket</a>
      <a class="button button--grey" href="#">À emporter</a>
      <button class="button" disabled style="opacity:.5">Désactivé</button>
    </div>
  </section>

  <section>
    <h2>Badges</h2>
    <div class="row">
      <span class="nf-badge">Commande confirmée</span>
      <span class="nf-badge">Produit star</span>
    </div>
  </section>

  <section>
    <h2>Navigation</h2>
    <header class="nf-header" style="position:static">
      <div class="nf-header__inner">
        <div class="nf-logo"><a href="#">Nathan's</a></div>
        <nav class="nf-nav"><ul class="nf-menu">
          <li><a href="#">Our history</a></li>
          <li class="current-menu-item"><a href="#">The menu</a></li>
          <li><a href="#">Contact us</a></li>
          <li><a href="#">Ma commande</a></li>
          <li><a href="#">Compte</a></li>
        </ul></nav>
      </div>
    </header>
  </section>

  <section>
    <h2>Card produit</h2>
    <div class="menu-section" style="margin:0;padding:0">
      <ul class="products menu-grid">
        <li class="product menu-card">
          <div class="menu-card__img" style="background:var(--bg-light);aspect-ratio:4/3"></div>
          <h3 class="menu-card__title">NY Attitude Burger</h3>
          <div class="menu-card__desc"><p>Description du produit avec les ingrédients.</p></div>
          <p class="menu-card__price">6,50 $</p>
          <a href="#" class="button menu-card__btn">Order</a>
        </li>
      </ul>
    </div>
  </section>

  <section>
    <h2>Champs de formulaire</h2>
    <form onsubmit="return false" style="max-width:420px">
      <p><label for="n">Name</label><input id="n" type="text" placeholder="Name"></p>
      <p><label for="e">Email</label><input id="e" type="email" placeholder="Email"></p>
      <p><label><input type="checkbox"> Email</label> <label><input type="checkbox"> Phone</label></p>
      <button class="button" type="submit">Create account</button>
    </form>
  </section>

  <section>
    <h2>Messages</h2>
    <div class="woocommerce-message">Produit ajouté à votre commande.</div>
    <div class="woocommerce-error">Ce code promo est expiré.</div>
  </section>
</main>
</body>
</html>

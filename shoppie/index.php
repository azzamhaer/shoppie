<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
  <!-- 
    - primary meta tags
  -->
  <title>Shoppie - Man summer collection</title>
  <meta name="title" content="Shoppie - Man summer collection">

  <!-- 
    - favicon
  -->
  <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">

  <!-- 
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./assets/fonts/font.css">

  <!-- 
    - custom css link
  -->
  <link rel="stylesheet" href="./assets/css/style.css">

  <!-- 
    - preload images
  -->
  <link rel="preload" as="image" href="./assets/images/hero-banner.png">

</head>

<body>

  <!-- 
    - #HEADER
  -->

  <header class="header" data-header>
    <div class="container">

      <a href="#" class="logo">
        <img src="./assets/images/logo.svg" width="132" height="27" alt="shoppie home">
      </a>

      <nav class="navbar" data-navbar>

      <?php
    // Check if the user is logged in
    if (isset($_SESSION["username"])) {
        ?>
        <ul class="navbar-list">



          <li>
            <a href="index.php" class="navbar-link">Home</a>
          </li>

          <li>
            <a href="catalog.php" class="navbar-link">Catalog</a>
          </li>

          <li>
            <a href="orders.php" class="navbar-link">Orders</a>
          </li>

          <li>
            <a href="logout.php" class="navbar-link">Logout</a>
          </li>

        </ul>
        <?php } else { ?>

          <li>
            <a href="index.php" class="navbar-link">Home</a>
          </li>

          <li>
            <a href="login.php" class="navbar-link">Login</a>
          </li>

          <li>
            <a href="signup.php" class="navbar-link">Signup</a>
          </li>
          
          <?php } ?>

          <button class="cart-btn">
          <ion-icon name="person-circle-outline" aria-hidden="true"></ion-icon>

          <span class="span">Account</span>
        </button>

        <a href="#" class="btn">Contact Us</a>
      </nav>

      <button class="nav-open-btn" aria-label="toggle menu" data-nav-toggler>
        <ion-icon name="menu-outline" aria-hidden="true"></ion-icon>
      </button>

    </div>
  </header>





  <main>
    <article>

      <!-- 
        - #HERO
      -->

      <div class="hero">
        <div class="container">

          <div class="hero-content">

            <p class="hero-subtitle title">$120.00</p>

            <h1 class="h1 hero-title title">Man summer <br> collection</h1>

            <p class="hero-text">
              This is the factor that sets us apart from competition and allows us deliver a specialist business service
              team applies its ranging experience determining
            </p>

            <a href="catalog.php" class="btn btn-primary">
              <span class="span">Shop Now</span>

              <ion-icon name="arrow-forward" aria-hidden="true"></ion-icon>
            </a>

          </div>

          <div class="hero-banner">
            <figure class="img-holder" style="--width: 704; --height: 700;">
              <img src="./assets/images/hero-banner.png" width="704" height="700" alt="hero banner" class="img-cover">
            </figure>

            <img src="./assets/images/hero-shape-1.png" width="255" height="249" alt="shape" class="shape shape-1">
          </div>

          <img src="./assets/images/hero-shape-2.png" width="360" height="133" alt="shape" class="shape shape-2">

        </div>
      </div>
      <br><br><br><br><br>
      <!-- 
        - #OFFER
      -->

      <section class="offer has-bg-image" style="background-image: url('./assets/images/offer-bg.png')">
        <div class="container">

          <div class="offer-card">

            <h2 class="title card-title">35% Off</h2>

            <p class="card-text">
              This is the main factor that sets us apart our competition and allows us deliver a specialist business
              consultancy service
            </p>

            <a href="catalog.php" class="btn btn-secondary">
              <span class="span">Shop Now</span>

              <ion-icon name="arrow-forward" aria-hidden="true"></ion-icon>
            </a>

          </div>

        </div>
      </section>

    </article>
  </main>





  <!-- 
    - #FOOTER
  -->

  <footer class="footer">
    <div class="container">

      <div class="footer-top">

        <div class="footer-brand">

          <a href="#" class="logo">
            <img src="./assets/images/logo.svg" width="132" height="27" loading="lazy" alt="shoppie home">
          </a>

          <p class="footer-text">
            Main factor that sets us apart competition allows deliver a specialist business consultancy service applies
            its ranging experience
          </p>

          <ul class="social-list">

            <li>
              <a href="#" class="social-link">
                <ion-icon name="logo-facebook"></ion-icon>
              </a>
            </li>

            <li>
              <a href="#" class="social-link">
                <ion-icon name="logo-twitter"></ion-icon>
              </a>
            </li>

            <li>
              <a href="#" class="social-link">
                <ion-icon name="logo-linkedin"></ion-icon>
              </a>
            </li>

          </ul>

        </div>

        <ul class="footer-list">

          <li>
            <p class="footer-list-title title">Contact info</p>

            <address class="footer-text">
              Neal St, London WC2H 9PR <br>
              United Kingdom
            </address>
          </li>

          <li>
            <a href="mailto:info.shoppie@support.com" class="email">info.shoppie@support.com</a>
          </li>

          <li>
            <a href="tel:+00 123 456 789" class="call">+00 123 456 789</a>
          </li>

        </ul>

        <div class="footer-list">

          <p class="footer-list-title title">Subscribe newsletter</p>

          <input type="email" name="email_address" placeholder="Enter your email address" required autocomplete="off"
            class="input-field">

          <button class="btn btn-secondary">Subscribe</button>

        </div>

      </div>

      <div class="footer-bottom">

        <div class="wrapper">
          <div class="link-wrapper">

            <a href="#" class="footer-bottom-link">Portfolio</a>
            <a href="#" class="footer-bottom-link">Our Team</a>
            <a href="#" class="footer-bottom-link">Pricing Plan</a>
            <a href="#" class="footer-bottom-link">Services</a>
            <a href="#" class="footer-bottom-link">Contact Us</a>

          </div>

          <div class="link-wrapper">
            <a href="#" class="footer-bottom-link">Terms & Conditions</a>

            <a href="#" class="footer-bottom-link">Privacy Policy</a>
          </div>
        </div>

        <p class="copyright">
          &copy; 2022 codewithsadee, All Rights Reserved
        </p>

      </div>

      <img src="./assets/images/footer-shape-1.png" width="245" height="165" loading="lazy" alt="shape"
        class="shape shape-1">

      <img src="./assets/images/footer-shape-2.png" width="138" height="316" loading="lazy" alt="shape"
        class="shape shape-2">

      <img src="./assets/images/footer-shape-3.png" width="346" height="92" loading="lazy" alt="shape"
        class="shape shape-3">

    </div>
  </footer>





  <!-- 
    - custom js link
  -->
  <script src="./assets/js/script.js"></script>

  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>
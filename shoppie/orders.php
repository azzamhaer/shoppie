<?php
session_start();

// Check if the user is not logged in, redirect to the login page
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

require_once 'db.php';

// Check if a delete request is sent
if (isset($_GET["delete_id"])) {
    $delete_id = $_GET["delete_id"];

    // Delete the order
    $delete_query = "DELETE FROM orders WHERE id = ? AND user_id = ?";
    $delete_stmt = $conn->prepare($delete_query);
    $delete_stmt->bind_param("ii", $delete_id, $_SESSION["user_id"]);

    if ($delete_stmt->execute()) {
        // Redirect to refresh the page after deletion
        header("Location: orders.php");
        exit();
    }
}

// Check if the payment confirmation button is clicked
if (isset($_GET["confirm_payment"])) {
  // Update the status of all products for the logged-in user to "Payment success"
  $update_query = "UPDATE orders SET status = 'Payment success' WHERE user_id = ?";
  $update_stmt = $conn->prepare($update_query);
  $update_stmt->bind_param("i", $_SESSION["user_id"]);

  $update_stmt->execute();
}

// Retrieve user orders from the 'orders' table
$query = "SELECT * FROM orders WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $_SESSION["user_id"]);
$stmt->execute();
$result = $stmt->get_result();

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
            table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
  </style>

  <!-- 
    - primary meta tags
  -->
  <title>Shoppie - Catalog</title>
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

  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


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
        - #FEATURE
      -->

      <section class="section feature" aria-label="feature-label">
        <div class="container">
<br><br><br><br><br><br>
          <h2 class="h2 section-title title text-center" id="feature-label">Catalog</h2>

          <?php
        // Display user orders
        if ($result->num_rows > 0) {
            echo '<table>';
            echo '<tr><th>Order ID</th><th>Product Name</th><th>Price</th><th>Status</th><th>Action</th></tr>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row["id"] . '</td>';
                echo '<td>' . $row["product_name"] . '</td>';
                echo '<td>$' . $row["price"] . '</td>';
                echo '<td>' . $row["status"] . '</td>';
                echo '<td><button class="delete-btn" onclick="confirmDelete(' . $row["id"] . ')">Cancel</button></td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo '<p style="text-align:center;">No orders found.</p>';
        }
        ?>
<br><br>
<div style="display: flex;">
          <a href="catalog.php" class="btn btn-secondary">Continue shopping</a>
          <button id="showAlertButton" class="btn btn-secondary">Confirm and pay</button>
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



  <script>
        function confirmDelete(orderId) {
            if (confirm("Are you sure you want to cancel this order?")) {
                window.location.href = 'orders.php?delete_id=' + orderId;
            }
        }
    </script>

<script>
    // Add an event listener to the button
    document.getElementById('showAlertButton').addEventListener('click', function () {
        // Display a SweetAlert alert when the button is clicked
        swal({
            title: "Confirm payment",
            text: "Are you sure want to continue to payment?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                swal("Payment Success!", {
                    icon: "success",
                })
                .then(() => {
                    // Redirect to pay.php after the modal is closed
                    window.location.href = 'orders.php?confirm_payment=1';
                });
            } else {
                swal("Payment canceled!");
            }
        });
    });
</script>


</body>

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


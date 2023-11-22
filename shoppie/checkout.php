<?php
session_start();

// Check if the user is not logged in, redirect to the login page
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

// Check if the product ID is provided in the URL
if (!isset($_GET["id"])) {
    // Redirect to the catalog page if no product ID is provided
    header("Location: catalog.php");
    exit();
}

// Get the product ID from the URL
$product_id = $_GET["id"];

require_once 'db.php';

// Retrieve product information from the 'products' table
$query = "SELECT * FROM products WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if the product exists
if ($result->num_rows == 0) {
    // Redirect to the catalog page if the product does not exist
    header("Location: catalog.php");
    exit();
}

// Get product details
$product = $result->fetch_assoc();

// Add a new order to the 'orders' table
$query = "INSERT INTO orders (user_id, product_id, product_name, price) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("iisd", $_SESSION["user_id"], $product_id, $product["product_name"], $product["price"]);
$stmt->execute();

// Close the database connection
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shoppie - Checkout</title>
    <style>
        /* Add your styles here */
        .confirmation {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 10px;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>
<body>

    <div class="confirmation">
        <h2>Order Confirmation</h2>
        <p>Thank you for your order!</p>
        <p>You have successfully ordered <?php echo $product["product_name"]; ?> for $<?php echo $product["price"]; ?>.</p>
        <p><a href="orders.php">See Orders</a></p>
    </div>
</body>
</html>

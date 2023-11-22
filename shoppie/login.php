<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get user inputs
    $username = $_POST["username"];
    $password = $_POST["password"];

require_once 'db.php';

    // Prepare and execute a SQL query to check the user's credentials
    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if the user exists and the password is correct
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user["password"])) {
            // Password is correct, set session variables and redirect to the catalog page
            $_SESSION["user_id"] = $user["user_id"];
            $_SESSION["username"] = $user["username"];
            header("Location: catalog.php");
            exit();
        } else {
            // Incorrect password
            $error_message = "Incorrect password";
        }
    } else {
        // User does not exist
        $error_message = "User not found";
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shoppie - Login</title>
    <style>
        /* Add your styles here */
        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 25px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        button {
            background-color: #fc7940;
            color: black;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .error {
            color: red;
            margin-bottom: 10px;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>
<body>


    


    <form method="post" action="">
        <a href="index.php">← Back to Home</a>
    <h2>Login</h2>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <?php
    // Display error message if exists
    if (isset($error_message)) {
        echo '<p class="error">' . $error_message . '</p>';
    }
    ?><br>

        <button type="submit">Login</button>
        <p>Not yet have an account? <a href="signup.php">Signup now</a></p>
    </form>
</body>
</html>

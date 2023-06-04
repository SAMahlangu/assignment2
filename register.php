<?php
// Establish database connection
$host = "localhost";
$username = "root";
$password = "";
$database = "blog";

$conn = mysqli_connect($host, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Sanitize and validate user input (e.g., using filter_input or custom validation functions)

    // Insert data into the database
    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

    if (mysqli_query($conn, $sql)) {
        echo "User information stored successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>

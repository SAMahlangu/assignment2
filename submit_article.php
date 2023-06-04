<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Check if all required fields are filled
  if (isset($_POST['title']) && isset($_POST['author']) && isset($_POST['content'])) {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $content = $_POST['content'];

    // Handle the uploaded image
    $targetFile = null; // Variable to store the image file path
    if (isset($_FILES['image'])) {
      $image = $_FILES['image'];
      // Process the image here (e.g., move it to a specific directory, save its path, etc.)
      // Example code to move the uploaded image to a specific directory:
      $targetDirectory = 'uploads/';
      $targetFile = $targetDirectory . basename($image['name']);
      move_uploaded_file($image['tmp_name'], $targetFile);
      // You can save the $targetFile path to a database or use it as needed
    }

    // Create a timestamp for the article
    $timestamp = date('Y-m-d H:i:s');

    // Database connection details
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "blog";

    // Create a connection to the database
    $conn = new mysqli($host, $username, $password, $database);

    // Check if the connection was successful
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the SQL query to insert the article data into the database
    $sql = "INSERT INTO articles (title, author, content, image, timestamp) VALUES ('$title', '$author', '$content', '$targetFile', '$timestamp')";

    if ($conn->query($sql) === TRUE) {
      echo "Post saved successfully.";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
  } else {
    // Required fields are missing, handle the error as needed
    echo 'Please fill in all required fields.';
  }
}
?>

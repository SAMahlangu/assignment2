<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">  
  <title>My Blog</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
  <link rel="stylesheet" href="styles.css"> <!-- You can link your own CSS file here -->
  <style>
    .jumbotron img {
      max-width: 100%;
      height: auto;
    }
    .article {
      display: flex;
      align-items: center;
    }
    .article-content {
      flex: 1;
      margin-left: 10px; /* Adjust the spacing between the image and content */
    }
    .article-images {
      display: inline-block;
    }
    .article-images img {
      max-width: 200px; /* Adjust the width as per your preference */
      height: auto;
      margin-right: 10px; /* Adjust the spacing between images */
    }
  </style>
</head>
<body>
  <header>
    <h1>Welcome to My Blog</h1>
    <nav>
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="about.html">About</a></li>
        <li><a href="contact.html">Contact</a></li>
        <li><a href="register.html">Register</a></li>
        <li><a href="submit_article.html">Post</a></li>
      </ul>
    </nav>
  </header>

  <main>
  <div class="jumbotron">
  <h1 class="text-center">Sipho's Blog</h1>
  <p class="text-center">All you need to know about CSE</p>    
</div>

<div class="container">
  <div class="row">
    <div class="col-md-4">
      <a href="images/css.jpg">
        <img src="images/css.jpg" class="img-thumbnail" alt="CSS Image">
      </a>
    </div>
    <div class="col-md-4">
      <a href="images/js.jpg">
        <img src="images/js.jpg" class="img-thumbnail" alt="JavaScript Image">
      </a>
    </div>
    <div class="col-md-4">
      <a href="images/bootstrap.jpg">
        <img src="images/bootstrap.jpg" class="img-thumbnail" alt="Bootstrap Image">
      </a>
    </div>
  </div>
  
  <div class="row">
    <div class="col-md-4">
      <a href="images/js.jpg">
        <img src="images/js.jpg" class="img-thumbnail" alt="JavaScript Image">
      </a>
    </div>
    <div class="col-md-4">
      <a href="images/css.jpg">
        <img src="images/css.jpg" class="img-thumbnail" alt="CSS Image">
      </a>
    </div>
    <div class="col-md-4">
      <a href="images/bootstrap.jpg">
        <img src="images/bootstrap.jpg" class="img-thumbnail" alt="Bootstrap Image">
      </a>
    </div>
  </div>
  
  <div class="row">
    <div class="col-md-4">
      <a href="images/bootstrap.jpg">
        <img src="images/bootstrap.jpg" class="img-thumbnail" alt="Bootstrap Image">
      </a>
    </div>
    <div class="col-md-4">
      <a href="images/js.jpg">
        <img src="images/js.jpg" class="img-thumbnail" alt="JavaScript Image">
      </a>
    </div>
    <div class="col-md-4">
      <a href="images/css.jpg">
        <img src="images/css.jpg" class="img-thumbnail" alt="CSS Image">
      </a>
    </div>
  </div>
</div>

    <div class="jumbotron">
      <div class="container">
        <h1 class="display-4">Latest Articles</h1>
      </div>
    </div>

    <div class="container">
      <?php
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

        // Prepare and execute the SQL query to fetch articles from the database
        $sql = "SELECT * FROM articles ORDER BY title DESC";
        $result = $conn->query($sql);

        // Check if there are articles to display
        if ($result->num_rows > 0) {
          // Loop through each row/article and display them
          while ($row = $result->fetch_assoc()) {
            echo '<article class="article">';
            echo '<div class="article-images">';
            
            // Display the images if they exist
            if ($row['image']) {
              $images = explode(',', $row['image']);
              foreach ($images as $image) {
                echo '<img src="' . $image . '" alt="Article Image">';
              }
            }
            
            echo '</div>';
            echo '<div class="article-content">';
            echo '<h2>' . $row['title'] . '</h2>';
            echo '<p class="post-meta">Posted by ' . $row['author'] . ' on ' . $row['timestamp'] . '</p>';
            echo '<p>' . $row['content'] . '</p>';
            echo '</div>';
            echo '</article>';
          }
        } else {
          echo '<p>No articles found.</p>';
        }

        // Close the database connection
        $conn->close();
      ?>
    </div>
  </main>

  <footer>
    <p>&copy; 2023 My Blog. All rights reserved.</p>
  </footer>
  
  <!-- Bootstrap JavaScript -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.bundle.min.js"></script>
</body>
</html>

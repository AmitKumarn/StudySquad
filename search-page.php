<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Search Results - StudySquad</title>
  <link rel="icon" type="image/x-icon" href="img/favicon.ico">
  <link rel="stylesheet" href="threadStyle.css">
  <link rel="stylesheet" href="indexStyle.css">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: white;
      margin: 0;
      padding: 0;
    }

    a {
      text-decoration: none;
      color: black;
    }

    .container {
      max-width: 95%;
      margin: 30px;
      padding: 40px 20px;
      background-color: #eee;
      border-radius: 10px;
      overflow-y: auto;
    }

    .container::-webkit-scrollbar {
      width: 0;
    }

    .container p {
      margin-bottom: 15px;
    }

    .search-results {
      margin-bottom: 40px;
    }

    .result-item {
      background-color: #fff;
      padding: 20px;
      margin-bottom: 20px;
      box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
    }

    .result-title {
      color: #333;
      font-size: 18px;
      margin-bottom: 10px;
    }

    .pagination {
      display: flex;
      justify-content: center;
      margin-top: 20px;
    }

    .pagination-link {
      color: #333;
      text-decoration: none;
      padding: 5px 10px;
      margin: 0 5px;
      border-radius: 3px;
      background-color: #eee;
      transition: background-color 0.3s;
    }

    .pagination-link:hover {
      background-color: #ccc;
    }
  </style>
</head>

<body>
  <?php session_start(); ?>
  <?php include 'partials/_dbconnect.php'; ?> <!--including to establish connection with database -->
  <?php include 'partials/_navbar.php'; ?>  <!--including for navigation bar -->
  <div class="container">
    <p>Search results for :
      <?php echo $_GET['search']; ?>
    </p>
    <div class="search-results">
      <?php
      // fetching all threads matching with the search keyword
      $noresults = true;
      $query = $_GET["search"];
      $sql = "select * from threads where match (thread_title, thread_desc) against ('$query')";
      $result = mysqli_query($conn, $sql);
      while ($row = mysqli_fetch_assoc($result)) {
        $title = $row['thread_title'];
        $thread_id = $row['thread_id'];
        $url = "thread.php?threadid=" . $thread_id;
        $noresults = false;

        // Display the search result
        echo '<div class="result-item">
                        <h2><a href="' . $url . '" class="text-dark">' . $title . '</a> </h2>
                  </div>';
      }
      if ($noresults) {
        echo '<p> No search result found. <p>';
      }
      ?>
    </div>
  </div>
  <?php include 'partials/_footer.php'; ?>  <!--including for footer -->
  <script src="navbarjs.js"></script> <!--contains javascript for navbar -->
</body>

</html>
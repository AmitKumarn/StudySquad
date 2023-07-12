<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ThreadList - StudySquad</title>
  <link rel="icon" type="image/x-icon" href="img/favicon.ico">
  <link rel="stylesheet" href="indexStyle.css">
  <link rel="stylesheet" href="threadlistStyle.css">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body>
  <?php
  session_start();  // starting session for this page
  ?>
  <?php include 'partials/_dbconnect.php'; ?> <!--including to establish connection with database -->
  <?php include 'partials/_navbar.php'; ?>  <!--including for navigation bar -->
  <?php
  // fetching the group name and group description 
  $id = $_GET['catid'];
  $catid = $_GET['catid'];
  $sql = "SELECT * FROM `group` WHERE grp_id=$id";
  $result = mysqli_query($conn, $sql);
  while ($row = mysqli_fetch_assoc($result)) {
    $grpname = $row['grp_name'];
    $grpdesc = $row['grp_desc'];
    $img = $row['image'];
  }

  ?>
  <?php
  // delete thread (for admin)
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_thread'])) {
    $threadId = $_POST['thread_id'];
    $sqld = "DELETE FROM threads WHERE thread_id = $threadId";
    $resultd = mysqli_query($conn, $sqld);
  }
  ?>
  <div class="group-banner">
    <img src="<?php echo $img; ?>" alt="Group Image" class="group-image">
    <div class="group-info">
      <h1 class="group-title">
        <?php echo $grpname; ?>
      </h1>
      <p class="group-type">Public Group</p>
      <p class="group-description">
        <?php echo $grpdesc; ?>
      </p>
    </div>
  </div>

  <div class="post-box">
    <?php
    // showing post thread only for logged in users
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
      $sno = $_SESSION['sno'];
      $sql = "Select * from users where sno='$sno'";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      echo '
      <img src="' . $row['img_path'] . '" alt="User Icon" class="user-icon">
      <div class="post-content">
        <form action="' . $_SERVER["REQUEST_URI"] . '" method="post">
          <textarea class="title-textarea" name="title" placeholder="Title of your thread..." required></textarea>
          <textarea class="desc-textarea" name="desc" placeholder="Thread group description..." required></textarea>
          <button class="post-button" type="submit"> + Post Thread</button>
        </form>';
    } else {
      echo '<p>Please login to post</p>';
    }
    ?>
    </div>
  </div>

  <?php
  // posting thread i.e. inserting thread into database
  $method = $_SERVER['REQUEST_METHOD'];
  if ($method == 'POST' && isset($_POST['title'])) {
    $th_title = $_POST['title'];
    $th_desc = $_POST['desc'];

    $th_title = str_replace("<", "&lt;", $th_title);
    $th_title = str_replace(">", "&gt;", $th_title);

    $th_desc = str_replace("<", "&lt;", $th_desc);
    $th_desc = str_replace(">", "&gt;", $th_desc);
    $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`,`timestamp`) VALUES ( '$th_title', '$th_desc', '$id', '$sno', current_timestamp())";
    $result = mysqli_query($conn, $sql);

  }
  ?>
  <div class="popthreads">
    <p>Popular Threads</p>
  </div>
  <div class="thread-container">
    <?php
    // fetching and displaying all threads of this group
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id";
    $result = mysqli_query($conn, $sql);
    $noResult = true;
    while ($row = mysqli_fetch_assoc($result)) {
      $noResult = false;
      $id = $row['thread_id'];
      $title = $row['thread_title'];
      $desc = $row['thread_desc'];
      $thread_time = $row['timestamp'];
      $dateTime = new DateTime($thread_time);
      $dateMonthYear = $dateTime->format('d-m-Y');
      $thread_user_id = $row['thread_user_id'];
      $sql2 = "SELECT * FROM `users` WHERE sno='$thread_user_id'";
      $result2 = mysqli_query($conn, $sql2);
      $row2 = mysqli_fetch_assoc($result2);

      // fetching the details of users who posted this thread
      $sql6 = "SELECT * FROM `users` WHERE sno='$thread_user_id'";
      $result6 = mysqli_query($conn, $sql6);
      $row6 = mysqli_fetch_assoc($result6);
      echo '<div class="thread-item">
              <img src="' . $row6['img_path'] . '" alt="User Icon" class="thread-icon">
              <div class="thread-text">
                <div class="thread-title">
                  <p><a class="text-dark" href="thread.php?threadid=' . $id . '">' . $title . ' </a></p>
                  <span class="material-symbols-outlined arrow"><a class="text-dark" href="thread.php?threadid=' . $id . '">arrow_forward</a></span>
                </div>
              <div class="thread-sign">
                <p class="username">' . $row6['user_name'] . '</p>
                <p class="time">' . $dateMonthYear . '</p>
              </div>';
      // delete button (for admin)
      if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        $snou = $_SESSION['sno'];
        $sqlu = "Select * from users where sno='$snou'";
        $resultu = mysqli_query($conn, $sqlu);
        $rowu = mysqli_fetch_assoc($resultu);
        if ($rowu['user_email'] == 'admin@studysquad.com') {
          echo
            '<div class="btn1-container">
              <form action="' . $_SERVER["REQUEST_URI"] . '" method="POST">
                <input type="hidden" name="thread_id" value="' . $id . '">
                <button class="btn1" type="submit" name="delete_thread">Delete</button>
              </form>
            </div>';
        }
      }


      echo '
        </div>
  </div>';
    }
    if ($noResult) {
      echo '<div class="noResult"><h2>No Threads found</h2></div>';
    }
    echo '</div>';
    ?>

    <?php include 'partials/_footer.php'; ?>  <!--including for footer -->
    <script src="navbarjs.js"></script> <!--contains javascript for navbar -->
    <script>
      const titleTextarea = document.querySelector(".title-textarea");
      const descTextarea = document.querySelector(".desc-textarea");

      const adjustTextareaHeight = (textarea) => { // function to make text area self height adjustable
        textarea.style.height = "0px";
        textarea.style.height = textarea.scrollHeight - 12 + "px";
      };
      titleTextarea.addEventListener("input", () => {
        adjustTextareaHeight(titleTextarea);
      });
      descTextarea.addEventListener("input", () => {
        adjustTextareaHeight(descTextarea);
      });
    </script>
</body>

</html>
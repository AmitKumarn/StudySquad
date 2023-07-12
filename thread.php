<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thread - StudySquad</title>
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
    <link rel="stylesheet" href="threadStyle.css">
    <link rel="stylesheet" href="indexStyle.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
    <?php
    session_start(); // starting session for this page
    ?>
    <?php include 'partials/_dbconnect.php'; ?> <!--including to establish connection with database -->
    <?php include 'partials/_navbar.php'; ?>    <!--including for navigation bar -->
    <?php
    // fetching the title and description of thread
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `threads` WHERE thread_id=$id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['thread_id'];
        $thread_id = $id;
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
        $thread_time = $row['timestamp'];
        $dateTime = new DateTime($thread_time);
        $dateMonthYear = $dateTime->format('d-m-Y');
        $thread_user_id = $row['thread_user_id'];
        // fetching the sno of user who posted this thread
        $sql2 = "SELECT * FROM `users` WHERE sno='$thread_user_id'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
    }

    ?>
    <?php
    // delete comment (for admin)
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_comment'])) {
        $comId = $_POST['comment_id'];
        $sqlr = "DELETE FROM replies WHERE comment_id = $comId";
        $resultr = mysqli_query($conn, $sqlr);
        $sqld = "DELETE FROM comments WHERE comment_id = $comId";
        $resultd = mysqli_query($conn, $sqld);
    }
    ?>
    <?php
    // delete reply (for admin)
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_reply'])) {
        $replyId = $_POST['reply_id'];
        $sqld = "DELETE FROM replies WHERE reply_id = $replyId";
        $resultd = mysqli_query($conn, $sqld);
    }
    ?>
    <div class="container">
        <div class="user-info">
            <img src="<?php echo $row2['img_path']; ?>" alt="User-icon" class="user-img">
            <div class="user-details">
                <span class="user-name">
                    <h3>
                        <?php echo $row2['user_name']; ?>
                    </h3>
                    <span id="dot"> . </span>
                    <p>
                        <?php echo $dateMonthYear; ?>
                    </p>
                </span>
                <p>Student at
                    <?php echo $row2['user_school']; ?>
                </p>
            </div>
        </div>
        <div class="thread-title">
            <?php echo $title; ?>
        </div>
        <div class="thread-desc">
            <?php echo $desc; ?>
        </div>
        <div class="thread-footer">
            <span class="material-icons" id="like" onclick="toggleColor()">favorite</span>
        </div>
        <hr>
        <?php
        // fetching deatils of logged in user
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            $sno = $_SESSION['sno'];
        }
        ?>
        <?php
        // posting comment i.e. inserting comments into database
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'POST' && isset($_POST['comment'])) {

            $comment = $_POST['comment'];
            $comment = str_replace("<", "&lt;", $comment);
            $comment = str_replace(">", "&gt;", $comment);

            $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`,`comment_time`) VALUES ( '$comment', '$thread_id','$sno', current_timestamp())";
            $result = mysqli_query($conn, $sql);
        }
        ?>

        <?php
        // posting reply i.e. inserting replies into database
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'POST' && isset($_POST['reply'])) {

            $reply = $_POST['reply'];
            $reply = str_replace("<", "&lt;", $reply);
            $reply = str_replace(">", "&gt;", $reply);
            $comment_id = $_POST['comment_id'];

            $sqli = "INSERT INTO `replies` (`reply_content`, `comment_id`, `reply_by`,`reply_time`) VALUES ( '$reply', '$comment_id', '$sno',current_timestamp())";
            $resulti = mysqli_query($conn, $sqli);
        }
        ?>

        <div class="comment-section">
            <div class="comment">
                <?php
                // fetching and displaying the number of comments on this thread
                $id = $_GET['threadid'];
                $sql = "SELECT * FROM `comments` WHERE thread_id=$id";
                $result = mysqli_query($conn, $sql);
                $CommentCount = mysqli_num_rows($result);
                $noResult = true;
                echo '<p class="comment-count"><span class="material-symbols-outlined">comment</span>' . $CommentCount . ' comments</p>';
                // fetching and displaying all comments on this thread
                while ($row = mysqli_fetch_assoc($result)) {
                    $noResult = false;
                    $id = $row['comment_id'];
                    $content = $row['comment_content'];
                    $comment_time = $row['comment_time'];
                    $dateTime = new DateTime($comment_time);
                    $dateMonthYear = $dateTime->format('d-m-Y');
                    $thread_user_id = $row['comment_by'];

                    $sql4 = "SELECT * FROM `users` WHERE sno='$thread_user_id'";
                    $result4 = mysqli_query($conn, $sql4);
                    $row4 = mysqli_fetch_assoc($result4);
                    echo '
                <div class="comment-item" data-comment-id="' . $id . '">
                <img src="' . $row4['img_path'] . '" alt="profile-pic">
                <div class="comment-info">
                    <div class="commenter">
                        <h4>' . $row4['user_name'] . '</h4>
                        <p>' . $dateMonthYear . '</p>
                    </div>
                    <div class="comment-desc">' . $content . '</div>
                </div>';
                    // showing delete comment button (for admin)
                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                        $snou = $_SESSION['sno'];
                        $sqlu = "Select * from users where sno='$snou'";
                        $resultu = mysqli_query($conn, $sqlu);
                        $rowu = mysqli_fetch_assoc($resultu);
                        if ($rowu['user_email'] == 'admin@studysquad.com') {
                            echo
                                '<div class="btn1-container">
                                <form action="' . $_SERVER["REQUEST_URI"] . '" method="POST">
                                    <input type="hidden" name="comment_id" value="' . $id . '">
                                    <button class="btn1" type="submit" name="delete_comment">Delete</button>
                                </form>
                            </div>
                      ';
                        }
                    }
                    echo '</div>';
                    // fetching and displaying the number of replies of this comment
                    $sqlr = "SELECT * FROM `replies` WHERE comment_id=$id";
                    $resultr = mysqli_query($conn, $sqlr);
                    $replyCount = mysqli_num_rows($resultr);
                    echo '<p>' . $replyCount . ' replies</p>';
                    // showing post reply box only to logged in users 
                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                        echo '<p class="reply-opt"  onclick="toggleReply(event)">Reply</p>
                                <form action="' . $_SERVER['REQUEST_URI'] . '" method="post" class="reply-box" id="replyClick">
                                    <input type="hidden" name="comment_id" value="">
                                    <textarea name="reply" id="replyBox" class="box" placeholder="Write your reply..." required></textarea>
                                    <button class="btn" type="sibmit"><span class="material-icons">send</span></button>
                                </form>';
                    }
                    echo '<div class="reply-section">';
                    // fetching and displaying replies of this comment
                    $sql3 = "SELECT * FROM `replies` WHERE comment_id=$id";
                    $result3 = mysqli_query($conn, $sql3);
                    while ($row3 = mysqli_fetch_assoc($result3)) {
                        $reply_id = $row3['reply_id'];
                        $reply_content = $row3['reply_content'];
                        $reply_time = $row3['reply_time'];
                        $dateTime = new DateTime($reply_time);
                        $dateMonthYear = $dateTime->format('d-m-Y');
                        $reply_user_id = $row3['reply_by'];

                        $sql5 = "SELECT * FROM `users` WHERE sno='$reply_user_id'";
                        $result5 = mysqli_query($conn, $sql5);
                        $row5 = mysqli_fetch_assoc($result5);

                        echo '<div class="reply">
                                <div class="reply-item">
                                    <img src="' . $row5['img_path'] . '" alt="profile-pic">
                                    <div class="reply-info">
                                        <div class="replier">
                                            <h4>' . $row5['user_name'] . '</h4>
                                            <p>' . $dateMonthYear . '</p>
                                        </div>
                                    <div class="reply-desc">' . $reply_content . '</div>
                                </div>';
                        // showing delete reply button (for admin) 
                        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                            $snou = $_SESSION['sno'];
                            $sqlu = "Select * from users where sno='$snou'";
                            $resultu = mysqli_query($conn, $sqlu);
                            $rowu = mysqli_fetch_assoc($resultu);
                            if ($rowu['user_email'] == 'admin@studysquad.com') {
                                echo
                                    '<div class="btn1-container">
                                        <form action="' . $_SERVER["REQUEST_URI"] . '" method="POST">
                                            <input type="hidden" name="reply_id" value="' . $reply_id . '">
                                            <button class="btn1" type="submit" name="delete_reply">Delete</button>
                                        </form>
                                    </div>';
                            }
                        }
                        echo '</div>
                        </div>';
                    }
                    echo '</div>';
                }
                if ($noResult) {
                    echo '<div class="noResult"><h2>No Comments found</h2></div>';
                }
                echo '</div>';
                ?>
            </div>
        <div>
                <?php
                // showing post comment box only to logged in users 
                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                    echo '
                    <form action= "' . $_SERVER['REQUEST_URI'] . '" method="post" class="comment-box">
                        <textarea name="comment" id="commentBox" class="box" placeholder="Add a comment..." required></textarea>
                        <button class="btn" type="submit"><span class="material-icons">send</span></button>
                    </form>';
                } else {
                    echo '<p>Login in to post comment</p>';
                }
                ?>
            </div>
        </div>
        <?php include 'partials/_footer.php'; ?> <!--including for footer -->
        <script src="navbarjs.js"></script>  <!--contains javascript for navbar -->
        <script>
            const commentTextarea = document.querySelector(".comment-box textarea");
            const replyTextarea = document.querySelector(".reply-box textarea");

            const adjustTextareaHeight = (textarea) => { // making text area height self adjustable
                textarea.style.height = "54px";
                textarea.style.height = textarea.scrollHeight + "px";
            };

            commentTextarea.addEventListener("input", () => {
                adjustTextareaHeight(commentTextarea);
            });

            replyTextarea.addEventListener("input", () => {
                adjustTextareaHeight(replyTextarea);
            });

            function toggleReply(event) { // toggling reply box 
                const replyopt = event.target;
                const replyBox = replyopt.nextElementSibling;
                const commentId = replyopt.parentNode.querySelector('.comment-item').getAttribute('data-comment-id');
                const commentIdInput = document.querySelector('.reply-box input[name="comment_id"]');
                commentIdInput.value = commentId;

                replyBox.classList.toggle("open-reply");
            }

            const like = document.getElementById("like");

            function toggleColor() { 
                like.classList.toggle("change-color");
            }
        </script>
</body>

</html>
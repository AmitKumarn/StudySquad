<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thread</title>
    <link rel="stylesheet" href="threadStyle.css">
    <link rel="stylesheet" href="indexStyle.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
<?php 
  session_start();
?>
  <?php include 'partials/_dbconnect.php'; ?>
  <?php include 'partials/_navbar.php'; ?>
    <?php
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
        $com_no = $row['com_no'];

        $sql2 = "SELECT * FROM `users` WHERE sno='$thread_user_id'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
  }

  ?>
    <div class="container">
        <div class="user-info">
            <img src="<?php echo $row2['img_path'];?>" alt="User-icon" class="user-img">
            <div class="user-details">
                <span class="user-name">
                    <h3><?php echo $row2['user_name'];?></h3>
                    <span id="dot"> . </span>
                    <p><?php echo $dateMonthYear;?></p>
                </span>
                <p>Student at <?php echo $row2['user_school'];?></p>
            </div>
        </div>
        <div class="thread-title"><?php echo $title;?></div>
        <div class="thread-desc"><?php echo $desc;?></div>
        <div class="thread-footer">
            <span class="material-icons" id="like" onclick="toggleColor()">favorite</span>
        </div>
        <hr>
        <?php 
            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
                $sno = $_SESSION['sno'];
            }
        ?>
        <?php
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == 'POST' && isset($_POST['comment'])){
        
            $comment = $_POST['comment'];

            $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`,`comment_time`) VALUES ( '$comment', '$thread_id','$sno', current_timestamp())";
            $result = mysqli_query($conn, $sql);

        }
        
        ?>

        <?php
            $method = $_SERVER['REQUEST_METHOD'];
            if($method == 'POST' && isset($_POST['reply'])){
            
                $reply = $_POST['reply'];
                $comment_id = $_POST['comment_id'];

                $sqli = "INSERT INTO `replies` (`reply_content`, `comment_id`, `reply_by`,`reply_time`) VALUES ( '$reply', '$comment_id', '$sno',current_timestamp())";
                $resulti = mysqli_query($conn, $sqli);
    
            }
        ?>
        <div class="comment-section">
            <div class="comment">
            <?php
            $id = $_GET['threadid'];
            $sql = "SELECT * FROM `comments` WHERE thread_id=$id"; 
            $result = mysqli_query($conn, $sql);
            $noResult = true;
            echo '<p class="comment-count"><span class="material-symbols-outlined">comment</span>'.$com_no.' comments</p>';
            while($row = mysqli_fetch_assoc($result)){
                $noResult = false;
                $id = $row['comment_id'];
                $content = $row['comment_content']; 
                $comment_time = $row['comment_time'];
                $reply_no = $row['reply_no'];
                $dateTime = new DateTime($comment_time);
                $dateMonthYear = $dateTime->format('d-m-Y');
                $thread_user_id = $row['comment_by']; 

                $sql4 = "SELECT * FROM `users` WHERE sno='$thread_user_id'";
                $result4 = mysqli_query($conn, $sql4);
                $row4 = mysqli_fetch_assoc($result4);
                echo '
                <div class="comment-item" data-comment-id="'.$id.'">
                <img src="'.$row4['img_path'].'" alt="profile-pic">
                <div class="comment-info">
                    <div class="commenter">
                        <h4>'.$row4['user_name'].'</h4>
                        <p>'.$dateMonthYear.'</p>
                    </div>
                    <div class="comment-desc">'.$content.'</div>
                </div>
            </div>
            <p>'.$reply_no.' replies</p>';
            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
            echo '<p class="reply-opt"  onclick="toggleReply(event)">Reply</p>
                <form action="'. $_SERVER['REQUEST_URI'] . '" method="post" class="reply-box" id="replyClick">
                    <input type="hidden" name="comment_id" value="">
                    <textarea name="reply" id="replyBox" class="box" placeholder="Write your reply..."
                required></textarea>
                    <button class="btn" type="sibmit"><span class="material-icons">send</span></button>
                </form>';
            }
            
            $sql3 = "SELECT * FROM `replies` WHERE comment_id=$id"; 
            $result3 = mysqli_query($conn, $sql3);
            while($row3 = mysqli_fetch_assoc($result3)){
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
                    <img src="'.$row5['img_path'].'" alt="profile-pic">
                    <div class="reply-info">
                        <div class="replier">
                            <h4>'.$row5['user_name'].'</h4>
                            <p>'.$dateMonthYear.'</p>
                        </div>
                        <div class="reply-desc">'.$reply_content.'</div>
                    </div>
                </div>  
            </div>
                ';}

                }
                if($noResult){
                    echo '<div class="noResult"><h2>No Comments found</h2></div>';
                  }
                  echo '</div>';
                ?>
                
            
        </div>
        <div >
        <?php 
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
      echo '
            <form action= "'.$_SERVER['REQUEST_URI'].'" method="post" class="comment-box">
                <textarea name="comment" id="commentBox" class="box" placeholder="Add a comment..." required></textarea>
                <button class="btn" type="submit"><span class="material-icons">send</span></button>
            </form>';}
            else{
                echo '<p>Login in to post comment</p>';
            }
            ?>
        </div>
    </div>
    <?php include 'partials/_footer.php'; ?>
    <script src="indexjs.js"></script>
    <script>
        const commentTextarea = document.querySelector(".comment-box textarea");
        const replyTextarea = document.querySelector(".reply-box textarea");

        const adjustTextareaHeight = (textarea) => {
            textarea.style.height = "54px";
            textarea.style.height = textarea.scrollHeight + "px";
        };

        commentTextarea.addEventListener("input", () => {
            adjustTextareaHeight(commentTextarea);
        });

        replyTextarea.addEventListener("input", () => {
            adjustTextareaHeight(replyTextarea);
        });

        function toggleReply(event) {
            const replyopt = event.target;
            const replyBox = replyopt.nextElementSibling;
            const commentId = replyopt.parentNode.querySelector('.comment-item').getAttribute('data-comment-id');
            const commentIdInput = document.querySelector('.reply-box input[name="comment_id"]');
            commentIdInput.value = commentId;

            replyBox.classList.toggle("open-reply");
        }

        const like = document.getElementById("like");

        function toggleColor(){
            like.classList.toggle("change-color");
        }
        
    </script>
</body>

</html>
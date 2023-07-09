<?php
$showError = "false";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'partials/_dbconnect.php';
    $user_name = $_POST['signup-name'];
    $user_email = $_POST['signup-email'];
    $user_school = $_POST['signup-school'];
    $img_path = $_POST['avatar-path'];
    $pass = $_POST['signup-password'];
    $cpass = $_POST['signup-confirm-password'];

    // Check whether this email exists
    $existSql = "select * from `users` where user_email = '$user_email'";
    $result = mysqli_query($conn, $existSql);
    $numRows = mysqli_num_rows($result);
    if($numRows>0){
        $showError = "Email already in use";
    }
    else{
        if($pass == $cpass){
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`user_name`, `user_email`, `user_school`, `user_pass`, `img_path`, `timestamp`) VALUES ( '$user_name','$user_email','$user_school','$hash','$img_path', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            
            if($result){
                header("Location: /studysquad/index.php?signupsuccess=true");
                exit();
            }

        }
        else{
            $showError = "Passwords do not match"; 
            
        }
    }
    header("Location: /studysquad/login.php?signupsuccess=false&error=$showError");

}
?>
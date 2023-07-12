<?php
$showError = "false";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'partials/_dbconnect.php'; // establishing connection to database
    $user_name = $_POST['signup-name'];
    $user_name = str_replace("<", "&lt;", $user_name);
    $user_name = str_replace(">", "&gt;", $user_name);
    $user_email = $_POST['signup-email'];
    $user_email = str_replace("<", "&lt;", $user_email);
    $user_email = str_replace(">", "&gt;", $user_email);
    $user_school = $_POST['signup-school'];
    $user_school = str_replace("<", "&lt;", $user_school);
    $user_school = str_replace(">", "&gt;", $user_school);
    $img_path = $_POST['avatar-path'];
    $pass = $_POST['signup-password'];
    $cpass = $_POST['signup-confirm-password'];

    
    $existSql = "select * from `users` where user_email = '$user_email'";
    $result = mysqli_query($conn, $existSql);
    $numRows = mysqli_num_rows($result);
    
    // Check whether this email exists
    if($numRows>0){ 
        $showError = "Email already in use";
    }
    else{
        if($pass == $cpass){ // matching password and confirm password inputs
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`user_name`, `user_email`, `user_school`, `user_pass`, `img_path`, `timestamp`) VALUES ( '$user_name','$user_email','$user_school','$hash','$img_path', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            
            if($result){
                header("Location: index.php?signupsuccess=true");
                exit();
            }

        }
        else{
            $showError = "Passwords do not match"; 
            
        }
    }
    header("Location: login.php?signupsuccess=false&error=$showError");
}
?>
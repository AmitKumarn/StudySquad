<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'partials/_dbconnect.php';
    $email = $_POST['login-email'];
    $pass = $_POST['login-password'];

    $sql = "Select * from users where user_email='$email'";
    $result = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($result);
    if ($numRows == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($pass, $row['user_pass'])) {
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['sno'] = $row['sno'];
            echo $SESSION['sno'];
        } else {
            $showError = "Incorrect Password";
            header("Location: login.php?signupsuccess=false&error=$showError");
            exit();
        }
        header("Location: index.php");
    } else {
        $showError = "User Email not found";
        header("Location: login.php?signupsuccess=false&error=$showError");
        exit();
    }
}

?>
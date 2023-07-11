<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <style>
        * {
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f5f5f5;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 400px;
    margin: 50px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 4px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
    color: #333;
}

form {
    margin-top: 20px;
}

.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 5px;
    color: #333;
}

input[type="password"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    transition: border-color 0.3s ease;
}

input[type="password"]:focus {
    border-color: #333;
}

button {
    display: block;
    width: 100%;
    padding: 10px;
    background-color: #333;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #555;
}
.error-message{
    margin: 0 40%;
}

    </style>
</head>

<body>
    <?php 
        session_start();
     ?>
    <?php include 'partials/_dbconnect.php'; ?>

    <div class="container">
        <h1>Change Password</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="form-group">
                <label for="current-password">Current Password:</label>
                <input type="password" id="current-password" name="current_password" required>
            </div>
            <div class="form-group">
                <label for="new-password">New Password:</label>
                <input type="password" id="new-password" name="new_password" required>
            </div>
            <div class="form-group">
                <label for="confirm-password">Confirm Password:</label>
                <input type="password" id="confirm-password" name="confirm_password" required>
            </div>
            <button type="submit">Change Password</button>
        </form>
    </div>
    
    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
        $sno = $_SESSION['sno'];
        $sql = "Select * from users where sno='$sno'";
        $result = mysqli_query($conn, $sql);
        $numRows = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $currentPassword = $_POST['current_password'];
        $newPassword = $_POST['new_password'];
        $confirmPassword = $_POST['confirm_password'];

        $showError="false";
        
        if (!password_verify($currentPassword, $row['user_pass'])) { 
            $showError = "Invalid current password.";
        }

        if ($newPassword !== $confirmPassword) {
            $showError = "Confirm password does not match new password.";
        }

        if ($showError=="false") {
            $hashnew = password_hash($newPassword, PASSWORD_DEFAULT);
            $sqli = "UPDATE `users` SET user_pass =  '$hashnew' WHERE sno = '$sno'";
	        $resulti = mysqli_query($conn, $sqli);
            header('Location: index.php');
            exit;
        }
        if ($showError!="false"){
            echo '<div class="error-message">
                    <p>'.$showError.'</p>
            </div>';}
}
?>

    
</body>

</html>

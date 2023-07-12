<?php
    session_start();    // starting session for this page
    echo "Logging you out. Please wait...";

    session_destroy();  // destroying the session
    header("Location: ../index.php")
?>
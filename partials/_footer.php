<?php
    echo'
    <footer class="footer">
        <div class="footer-content">
            <p class="footer-description">Embark on a journey of endless knowledge and vibrant discussions.</p>';
            if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){  // checking whether there is any user logged in 
                // showing create account button if user is not logged in
                echo '<div class="footer-buttons">                             
                        <a href="./login.php" class="footer-button">Create a new account</a>
                      </div>';
            }
        echo '</div>
        <div class="footer-bottom">
            <p class="footer-copy">© 2023 Study Squad. All rights reserved. | Made by Amit Kumar</p>
        </div>
    </footer>
    '
?>
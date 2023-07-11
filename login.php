<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Login/Signup - StudySquad</title>
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
</head>

<body>
    <div>
        <p></p>
    </div>
    <div class="container" id="main-container">
        <div class="left-section">
            <img src="img/login.jpg" alt="image">
        </div>
        <div class="right-section">
            <div class="toggle">
                <button id="login-btn" class="active">Login</button>
                <button id="signup-btn">Signup</button>
            </div>
            <form id="login-form" action="login_handle.php" method="post">
                <div class="form-group">
                    <label for="login-email">Email</label>
                    <input type="email" id="login-email" name="login-email" required>
                </div>
                <div class="form-group">
                    <label for="login-password">Password</label>
                    <input type="password" id="login-password" name="login-password" required>
                </div>
                <div class="btn-container">
                    <button type="submit" class="btn">Login</button>
                    <p class="toggle-link" id="toggle-signup">Not a member ? Signup</p>
                    <p style="color:rgb(51, 157, 233);">
                        <?php
                        if (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "false") {
                            echo $_GET['error'];
                        }
                        ?>
                    </p>
                </div>
            </form>
            <form id="signup-form" style="display: none;" action="signup_handle.php" method="post">
                <div class="avatar-image">
                    <img src="img/default-avatar.png" alt="Avatar" id="choose-avatar">
                    <input type="hidden" id="avatar-path" name="avatar-path">
                </div>
                <div class="form-group">
                    <label for="signup-name">Name</label>
                    <input type="text" id="signup-name" name="signup-name" required>
                </div>
                <div class="form-group">
                    <label for="signup-email">Email</label>
                    <input type="email" id="signup-email" name="signup-email" required>
                </div>
                <div class="form-group">
                    <label for="signup-school">School/College/University</label>
                    <input type="text" id="signup-school" name="signup-school" required>
                </div>
                <div class="form-group">
                    <label for="signup-password">Password</label>
                    <input type="password" id="signup-password" name="signup-password" required>
                </div>
                <div class="form-group confirm-password">
                    <label for="signup-confirm-password">Confirm Password</label>
                    <input type="password" id="signup-confirm-password" name="signup-confirm-password" required>
                </div>
                <div class="btn-container">
                    <button type="submit" class="btn">Signup</button>
                    <p class="toggle-link" id="toggle-login">Already a member ? Login</p>
                    <p style="color:rgb(51, 157, 233);"></p>
                </div>
            </form>
        </div>
    </div>

    <div class="modal" id="avatar-modal">
        <span class="modal-close">&times;</span>
        <h3>Choose Avatar</h3>
        <div class="modal-images">
            <img src="img/a1.jpg" alt="Avatar 1">
            <img src="img/a2.jpg" alt="Avatar 2">
            <img src="img/a3.jpg" alt="Avatar 3">
            <img src="img/a4.jpg" alt="Avatar 4">
            <img src="img/a5.jpg" alt="Avatar 5">
            <img src="img/a6.jpg" alt="Avatar 6">
            <img src="img/a7.jpg" alt="Avatar 7">
            <img src="img/a8.jpg" alt="Avatar 8">
        </div>
    </div>

    <script>
        const loginForm = document.getElementById('login-form');
        const signupForm = document.getElementById('signup-form');
        const loginBtn = document.getElementById('login-btn');
        const signupBtn = document.getElementById('signup-btn');
        const toggleSignupLink = document.getElementById('toggle-signup');
        const toggleLoginLink = document.getElementById('toggle-login');
        const chooseAvatarLink = document.getElementById('choose-avatar');
        const avatarForm = document.getElementById('avatar-form');
        const avatarPathInput = document.getElementById('avatar-path');
        const avatarModal = document.getElementById('avatar-modal');
        const modalClose = document.querySelector('.modal-close');
        const mainContainer = document.getElementById('main-container');

        const toggleSignupForms = () => {
            signupBtn.classList.add('active');
            loginBtn.classList.remove('active');
            signupForm.style.display = 'block';
            loginForm.style.display = 'none';
            mainContainer.style.width = '95%';
            mainContainer.style.marginTop = '20px';
            mainContainer.style.marginBottom = '20px';
        };

        signupBtn.addEventListener('click', toggleSignupForms);
        toggleSignupLink.addEventListener('click', toggleSignupForms);

        const toggleLoginForms = () => {
            signupBtn.classList.remove('active');
            loginBtn.classList.add('active');
            signupForm.style.display = 'none';
            loginForm.style.display = 'block';
            mainContainer.style.width = '60%';
        };

        loginBtn.addEventListener('click', toggleLoginForms);
        toggleLoginLink.addEventListener('click', toggleLoginForms);

        chooseAvatarLink.addEventListener('click', () => {
            avatarModal.style.display = 'block';
        });

        modalClose.addEventListener('click', () => {
            avatarModal.style.display = 'none';
        });

        const avatarImages = document.querySelectorAll('.modal-images img');

        const defaultAvatar = document.getElementById('choose-avatar');
        defaultAvatar.addEventListener('click', () => {
            avatarModal.style.display = 'block';
        });

        avatarImages.forEach((avatar) => {
            avatar.addEventListener('click', () => {
                const chosenAvatar = avatar.getAttribute('src');
                const defaultAvatar = document.getElementById('choose-avatar');
                defaultAvatar.setAttribute('src', chosenAvatar);
                avatarPathInput.value = chosenAvatar;
                avatarForm.submit();
                avatarModal.style.display = 'none';
            });
        });

        const confirmPassword = document.getElementById('signup-confirm-password');

        confirmPassword.addEventListener('input', () => {
            const password = document.getElementById('signup-password').value;
            if (confirmPassword.value === password) {
                confirmPassword.classList.remove('invalid');
                confirmPassword.classList.add('valid');
            }
            else {
                confirmPassword.classList.remove('valid');
                confirmPassword.classList.add('invalid');
            }
        });

    </script>
</body>

</html>
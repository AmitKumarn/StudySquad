<?php
    echo '
    <nav>
        <div class="navbar">
            <span class="logo primary"><img src="./img/logo-transparent.png" alt="StudySquad" class="logo-img"></span>
            <span class="logo secondary"><img src="./img/logo-transparent1.png" alt="StudySquad" class="logo-img"></span>
            <ul class="nav-menu-left" id="navleft">
                <li class="nav-menu-list"><a href="./index.php">Home</a></li>
                <li class="dropdown-title nav-menu-list">
                    <a href="#" class="category">Groups</a>
                    <ul class="dropdown">
                        <li><a href="threadlist.php?catid=1">Class 10</a></li>
                        <li><a href="threadlist.php?catid=2">Class 11-12</a></li>
                        <li><a href="threadlist.php?catid=3">Jee Mains</a></li>
                        <li><a href="threadlist.php?catid=4">Jee Advanced</a></li>
                        <li><a href="threadlist.php?catid=5">NEET</a></li>
                        <li><a href="threadlist.php?catid=6">B.Tech UG</a></li>
                        <li><a href="threadlist.php?catid=7">Counselling</a></li>
                        <li><a href="threadlist.php?catid=8">Career Guidance</a></li>
                    </ul>
                </li>
                <li class="nav-menu-list"><a href="./about.php">About</a></li>
                <li class="nav-menu-list"><a href="./contacts.php">Contacts</a></li>
            </ul>
            <ul class="nav-menu-right">
                <li>
                <form action="search-page.php" method="get" class="searchBar">
                    <div class="search-bar">
                        <span class="material-symbols-outlined" onclick="toggleSearch()">search</span>
                        <input type="text" placeholder="Search" id="search-form" name="search">
                    </div>
                </form>
                </li>';
                if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
                    $sno = $_SESSION['sno'];
                    $sql = "Select * from users where sno='$sno'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    echo '<li>
                        <div class="profile-icon" onclick="toggleProfile()">
                            <img src="./'.$row['img_path'].'" alt="">
                        </div>
                    </li>';
                }
                else{
                    echo '<li>
                    <a href="login.php"><button class="btn">Login</button></a>
                </li>';
                }

                echo '<li class="menu-toggle">
                    <span class="material-symbols-outlined" onclick="toggleMenu()">menu</span>
                </li>
            </ul>
        </div>
        <form action="./search-page.php" method="get" >
            <div class="search-bar2 open-search" id="searchid">
                <span class="material-symbols-outlined">search</span>
                <input type="text" placeholder="Search" class ="" id="searchform" name="search">
            </div>
        </form>
        <div class="menu-clicked" id="offset"></div>';
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
            $sno = $_SESSION['sno'];
            $sql = "Select * from users where sno='$sno'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
        echo '<div class="profile-wrap" id="subprofile">
            <div class="profile">
                <div class="user-info">
                    <img src="./'.$row['img_path'].'">
                    <div class="nameSchool">
                        <h4>'.$row['user_name'].'</h3>
                        <p>Student at '.$row['user_school'].'</p>
                    </div>
                </div>
                <hr>
                <div class="profile-menu-link">
                    <span class="material-symbols-outlined icon">mail</span>
                    <p>'.$row['user_email'].'</p>
                </div>
                <a href="changePass.php" class="profile-menu-link">
                    <span class="material-symbols-outlined icon">key</span>
                    <p>Change Password</p>
                    <span class="material-symbols-outlined">arrow_right</span>
                </a>
                <a href="./partials/logout.php" class="profile-menu-link">
                    <span class="material-symbols-outlined icon">logout</span>
                    <p>Logout</p>
                    <span class="material-symbols-outlined">arrow_right</span>
                </a>
            </div>
        </div>';
        }
    echo'</nav>';
?>
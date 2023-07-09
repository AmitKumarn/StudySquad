<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudySquad</title>
    <link rel="stylesheet" href="indexStyle.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&family=Montserrat:wght@300&display=swap"
        rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<style>
    .profile-icon {
        position: relative;
        border: 1px solid rgb(6, 240, 6);
        display: flex;
        align-items: center;
        justify-content: center;
        height: 36px;
        width: 36px;
        border-radius: 50%;
    }

    .profile-icon img {
        width: 99%;
        border-radius: 50%;
    }

    .search-bar{
        background-color: white;
    }
    #search-form{
        background-color: white;
    }
</style>

<body>
<?php 
        session_start();
     ?>
    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_navbar.php'; ?>
    
    <header>
        <div class="intro">
            <div class="intro-image">
                <img src="img/intro-image.png" alt="StudySquad">
            </div>
            <div class="intro-text">
                <h1>
                    Welcome to <span>StudySquad</span>.
                    <br>
                    Discuss anything.
                </h1>
                <p>Engage in meaningful discussions, ask questions, and receive helpful insights from peers who are
                    passionate about learning.</p>
                <div class="intro-button">
                    <a href="#"><button class="btn">Know more</button></a>
                </div>
            </div>
        </div>
    </header>
    <?php
        if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="true"){
           echo '<script>
                    alert ("You can now login");
                </script>';
            }
    ?>
    <section>
        <div class="section">
            <div class="section-top">
                <h2 class="category-heading">Browse Groups</h2>
            </div>
            <div class="category-row">

                <?php
                $sql = "SELECT * FROM `group`";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['grp_id'];
                    $name = $row['grp_name'];
                    $img = $row['image'];
                    echo '
                    <div class="category-card">
                        <div class="category-image">
                            <img src="'.$img. '" alt="'.$name. '">
                        </div>
                        <div class="category-content">
                            <h3 class="category-title">'.$name. '</h3>
                            <a href="threadlist.php?catid=' . $id . '" class="category-link">Discuss</a>
                        </div>
                    </div>
                    ';
                }
                ?>
            </div>
        </div>
    </section>
    <?php include 'partials/_footer.php'; ?>
    <script src="indexjs.js"></script>
</body>

</html>
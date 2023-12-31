<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudySquad</title>
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
    <link rel="stylesheet" type="text/css" href="indexStyle.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&family=Montserrat:wght@300&display=swap"
        rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body>
    <?php
    session_start(); // starting the session for this page
    ?>
    <?php include 'partials/_dbconnect.php'; ?> <!--including to establish connection with database -->
    <?php include 'partials/_navbar.php'; ?>    <!--including for navigation bar -->

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
    // alert message after successful signup
    if (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "true") {
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
                // fetching all information from group table of database 
                $sql = "SELECT * FROM `group`";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['grp_id'];
                    $name = $row['grp_name'];
                    $img = $row['image'];
                    echo '
                    <div class="category-card">
                        <div class="category-image">
                            <img src="' . $img . '" alt="' . $name . '">
                        </div>
                        <div class="category-content">
                            <h3 class="category-title">' . $name . '</h3>
                            <a href="threadlist.php?catid=' . $id . '" class="category-link">Discuss</a>
                        </div>
                    </div>
                    ';
                }
                ?>
            </div>
        </div>
    </section>

    <?php include 'partials/_footer.php'; ?>    <!--including for footer -->
    <script src="navbarjs.js"></script>     <!--contains javascript for navbar -->
</body>

</html>

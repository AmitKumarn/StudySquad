<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - StudySquad</title>
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
    <link rel="stylesheet" href="indexStyle.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            line-height: 1.5;
            color: #2f2f32;
            background-color: #eeeeee;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        #introduction {
            padding: 60px 0;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.4);
            margin-bottom: 20px;
            background-color: #fffffe;
        }

        #introduction h2 {
            font-size: 30px;
            margin-bottom: 30px;
        }

        #introduction p {
            font-size: 16px;
            margin-bottom: 15px;
        }

        #testimonials {
            padding: 60px 0;
            text-align: center;
            border-radius: 10px;
        }

        #testimonials h2 {
            font-size: 30px;
            margin-bottom: 30px;
        }

        .testimonial-row {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .testimonial-card {
            flex: 0 0 250px;
            background-color: #ffffff;
            border-radius: 10px;
            padding: 20px;
            margin: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
            text-align: center;
        }

        .testimonial-card img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-bottom: 15px;
        }

        .testimonial-card p {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .testimonial-card p:last-child {
            font-weight: bold;
        }

        #features {
            padding: 60px 0;
            text-align: center;
        }

        #features h2 {
            font-size: 30px;
            margin-bottom: 30px;
        }

        .feature-row {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .feature-card {
            flex: 0 0 220px;
            background-color: #ffffff;
            border-radius: 10px;
            padding: 20px;
            margin: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
            text-align: center;
        }

        .feature-card .feature-icon {
            font-size: 48px;
            margin-bottom: 20px;
        }

        .feature-card h3 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .feature-card p {
            font-size: 16px;
            margin-bottom: 20px;
        }

        /* Media Queries */

        @media only screen and (max-width: 768px) {

            .testimonial-card,
            .feature-card {
                flex: 0 0 80%;
            }
        }
    </style>
</head>

<body>
    <?php
    session_start();
    ?>
    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_navbar.php'; ?>
    <section id="introduction">
        <div class="container">
            <h2>About StudySquad</h2>
            <p>Welcome to StudySquad, your go-to platform for academic discussions and doubt-solving. We are dedicated
                to creating a supportive and collaborative environment for students to engage in meaningful learning
                conversations.</p>
            <p>At StudySquad, we believe that learning is enhanced through interaction and sharing knowledge. Our
                platform offers a range of discussion categories, providing a space for students to connect, ask
                questions, and find answers from peers and experts.</p>
            <p>Join our community today and be a part of the StudySquad family!</p>
            <p>Happy learning,</p>
            <p style="font-weight: 600;">- Amit Kumar</p>
        </div>
    </section>



    <section id="testimonials">
        <div class="container">
            <h2>What Our Users Say</h2>
            <div class="testimonial-row">
                <div class="testimonial-card">
                    <img src="img/a4.jpg" alt="User 1">
                    <p>"StudySquad has been a game-changer for me. I've found amazing study groups and got help with my
                        doubts. Highly recommended!"</p>
                    <p>- Rajat Patel</p>
                </div>
                <div class="testimonial-card">
                    <img src="img/a6.jpg" alt="User 2">
                    <p>"The StudySquad community is so supportive and friendly. It's a great platform to connect with
                        like-minded students and expand your knowledge."</p>
                    <p>- Neha Shankar</p>
                </div>
                <div class="testimonial-card">
                    <img src="img/a8.jpg" alt="User 3">
                    <p>"I'm grateful for StudySquad. Whenever I'm stuck with a question, I can rely on the community to
                        provide valuable insights and solutions."</p>
                    <p>- Vishwas Gupta</p>
                </div>
            </div>
        </div>
    </section>

    <section id="features">
        <div class="container">
            <h2>Key Features</h2>
            <div class="feature-row">
                <div class="feature-card">
                    <span class="feature-icon">📚</span>
                    <h3>Knowledge Sharing</h3>
                    <p>Share your knowledge, expertise, and study resources with fellow students, promoting
                        collaborative learning.</p>
                </div>
                <div class="feature-card">
                    <span class="feature-icon">💬</span>
                    <h3>Engaging Discussions</h3>
                    <p>Participate in meaningful discussions, ask questions, and contribute to an active and vibrant
                        community.</p>
                </div>
                <div class="feature-card">
                    <span class="feature-icon">🔍</span>
                    <h3>Doubt Resolution</h3>
                    <p>Get answers to your doubts and questions from experienced users and subject matter experts.</p>
                </div>
                <div class="feature-card">
                    <span class="feature-icon">🌟</span>
                    <h3>Personalized Experience</h3>
                    <p>Different Categories for students of different standard for enhanced discussion experience.</p>
                </div>
            </div>
        </div>
    </section>
    <?php include 'partials/_footer.php'; ?>
    <script src="indexjs.js"></script>
</body>

</html>
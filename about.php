<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About - StudySquad</title>
  <link rel="stylesheet" href="indexStyle.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f1f1f1;
      margin: 0;
      padding: 0;
    }

    .container {
      width: 90%;
      margin: 20px auto;
      padding: 20px 20px;
      background: linear-gradient(15deg, #8787cf,#D4D4FF);
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.3);
    }

    .header {
      text-align: center;
      margin-bottom: 40px;
    }

    .header h1 {
      color: rgb(0, 145, 255);
      font-size: 32px;
      margin-bottom: 10px;
    }

    .header p {
      color: #666;
      font-size: 16px;
      margin-bottom: 5px;
    }

    .categories {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
      margin-top: 40px;
    }

    .category-card {
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      padding: 20px;
      width: 250px;
      text-align: center;
      transition: transform 0.3s ease-in-out;
    }

    .category-card:hover {
      transform: translateY(-5px);
    }

    .category-card h3 {
      font-size: 24px;
      margin-bottom: 10px;
      color: #333;
    }

    .category-card p {
      font-size: 16px;
      color: #666;
    }

    .description {
      color: #333;
      font-size: 14px;
      line-height: 1.6;
      margin-bottom: 40px;
      margin-top: 30px;
    }

    @media (max-width: 768px) {
      .category-card {
        width: 100%;
      }
      .description {
        font-size: 14px;
      }
    }
  </style>
</head>

<body>
    <?php include 'partials/_navbar.php'; ?>
  <div class="container">
    <div class="header">
      <h1>About the Forum - StudySquad</h1>
      <p>StudySquad is a discussion forum where students can collaborate, share knowledge, and seek assistance on various subjects and topics.
      <br>These are various categories on which you can discuss any doubts related to your academics.</p>
    </div>

    <div class="categories">
      <div class="category-card">
        <h3>Class X</h3>
      </div>
      <div class="category-card">
        <h3>Class XI-XII</h3>
      </div>
      <div class="category-card">
        <h3>JEE Mains</h3>
      </div>
      <div class="category-card">
        <h3>JEE Advanced</h3>
      </div>
      <div class="category-card">
        <h3>NEET</h3>
      </div>
      <div class="category-card">
        <h3>B.Tech UG</h3>
      </div>
      <div class="category-card">
        <h3>College Admission</h3>
      </div>
      <div class="category-card">
        <h3>Career Guidance</h3>
      </div>
    </div>

    <div class="description">
      <p>We believe that learning is enhanced through interaction and collaboration. Whether you're a high school student preparing for exams, a college student exploring career paths, or a professional seeking educational resources, our forum provides a space to ask questions, share insights, and gain valuable knowledge.</p>
      <p>Our dedicated team of moderators ensures a safe and respectful environment for everyone. We encourage constructive discussions, active participation, and a willingness to help one another. Together, we can overcome challenges, expand our horizons, and make meaningful connections.</p>
      <p>Join our community today and embark on a journey of learning, growth, and inspiration. Together, let's make education a collaborative and enriching experience!</p>
    </div>
  </div>
  <?php include 'partials/_footer.php'; ?>
  <script src="indexjs.js"></script>
</body>

</html>

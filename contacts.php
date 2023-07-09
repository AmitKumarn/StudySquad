<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contacts - StudySquad</title>
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
      max-width: 1200px;
      margin: 40px;
      padding: 40px 20px;
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.4);
    }

    .header {
      text-align: center;
      margin-bottom: 40px;
    }

    .header h1 {
      color: #333;
      font-size: 32px;
      margin-bottom: 10px;
    }

    .header p {
      color: #666;
      font-size: 18px;
    }

    .contact-list {
      list-style: none;
      padding: 0;
      margin: 0;
      margin-top: 40px;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-wrap: wrap;
      column-gap: 20px;
    }

    .contact-item {
      display: flex;
      align-items: center;
      margin-bottom: 20px;
    }

    .contact-item img {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      margin-right: 20px;
    }

    .contact-item h3 {
      font-size: 18px;
      color: #333;
      margin: 0;
    }

    .contact-item p {
      font-size: 14px;
      color: #666;
      margin: 0;
    }

    @media (max-width: 768px) {
      .contact-item img {
        width: 40px;
        height: 40px;
      }

      .contact-item h3 {
        font-size: 16px;
      }

      .contact-item p {
        font-size: 12px;
      }
    }
  </style>
</head>

<body>
<?php include 'partials/_navbar.php'; ?>
  <div class="container">
    <div class="header">
      <h1>Contact Us</h1>
      <p>If you have any questions or inquiries, feel free to reach out to us. We're here to assist you.</p>
    </div>

    <ul class="contact-list">
      <li class="contact-item">
        <img src="img/email-icon.png" alt="Email Icon">
        <div>
          <h3>Email</h3>
          <p>studysquad@forum.com</p>
        </div>
      </li>
      <li class="contact-item">
        <img src="img/phone-icon.png" alt="Phone Icon">
        <div>
          <h3>Phone</h3>
          <p>+91 9709834526</p>
        </div>
      </li>
      <li class="contact-item">
        <img src="img/address-icon.png" alt="Address Icon">
        <div>
          <h3>Address</h3>
          <p> Manpur, Gaya, India</p>
        </div>
      </li>
    </ul>
  </div>
  <?php include 'partials/_footer.php'; ?>
  <script src="indexjs.js"></script>
</body>

</html>

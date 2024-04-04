<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Master Coders | About Us</title>
  <?php include 'header.html' ?>
  <link rel="stylesheet" type="text/css" href="index.css">
  <style>
    .about-section {
      display: flex; 
      justify-content: space-around; 
      flex-wrap: wrap; 
    }
    .about-person {
      flex: 0 0 calc(25% - 20px); 
      margin: 10px;
      text-align: center;
    }
  </style>
</head>
<body>
  <header>
    <?php include 'navbar.html' ?>
  </header>
  <main>
    <h2 style="text-align: center;">Meet the Team!</h2>
    <section class="about-section">
      <div class="about-person">
        <img src="image1.jpg" alt="Person 1">
        <h3>Person 1</h3>
        <p>Bio for Person 1 goes here.</p>
      </div>
      <div class="about-person">
        <img src="image2.jpg" alt="Person 2">
        <h3>Person 2</h3>
        <p>Bio for Person 2 goes here.</p>
      </div>
      <div class="about-person">
        <img src="image3.jpg" alt="Person 3">
        <h3>Person 3</h3>
        <p>Bio for Person 3 goes here.</p>
      </div>
      <div class="about-person">
        <img src="image4.jpg" alt="Person 4">
        <h3>Person 4</h3>
        <p>Bio for Person 4 goes here.</p>
      </div>
    </section>
  </main>
  <footer>
    <?php include 'footer.html' ?>
  </footer>
</body>
</html>


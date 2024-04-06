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
    .about-person p {
      margin: 0 10px 0 10px;
      padding: 5px 7px 5px 7px;
      text-align: justify;
      border: 2px dotted rgb(24, 177, 44);
    }
    .about-person img {
      border: 2px solid rgb(24, 177, 44);
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
        <img src="images/photoofme.JPG" alt="Janette Arostegui" width="250px">
        <h3>Janette Arostegui</h3>
        <p>Hi there! I'm Janette, a Computer Science major at CSU, aiming to graduate
            in the class of Spring 2024. With a passion for technology and innovation, 
            I'm excited about the opportunities the tech industry holds. 
            Beyond coding, I love to read and play tennis in my free time.

            One of my proudest achievements is my determination to overcome obstacles and keep 
            pushing forward towards my goal of graduation.
            As a first-generation Latina, I'm driven by the hope of creating a brighter future for 
            myself and paving the way for others in my community.

            I'm looking forward to the journey ahead and the chance to contribute to the ever-evolving
             world of technology!
        </p>
      </div>
      <div class="about-person">
        <img src="images/michelle-pic.jpg" alt="Michelle Cortes" width="250px">
        <h3>Michelle Cortes</h3>
        <p>Hiya! My name is Michelle. I'm from the Western Slope of Colorado and I'm a graduating
          Senior this year. Since young I've been skiing and snowboarding in the winter months and 
          in the summer months I enjoy paddleboarding and hiking in the wilderness. I also travel a 
          lot around the world. Most recently I toured all over Southern Ireland!
        <br> <br>
          Before going back to school to get my Bachelors in Computer Science I worked at my local 
          school district as a part of their adminsitration for four years. I returned to school in 
          order to pursue my longtime dream of recieving my CS degree.
        </p>
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

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include 'header.php' ?>
</head>
<body>
  <header>
    <?php include 'navbar.php' ?>
  </header>
  <main>
    <!-- 2 inputs, one for number of rows/columns, one for number of colors  -->
    <form method="get" action="<?php
      $n = $_GET["n"];
      $num_colors = $_GET["num_colors"];

      $n_warning = 'Table size must be a value between 1 and 26';
      $num_colors_warning = 'Color must be a value between 1 and 10';
      $both_warning = 'Values must be between denoted range';

      $n_warning_display = false;
      $num_colors_warning_display = false;
      $both_warning_display = false;

      if (!isset($_GET["n"])){
      } else if ($n > 26 || $n < 1){
        $n_warning_display = true;
      }
      
      if(!isset($_GET["num_colors"])){
      } else if($num_colors > 10 || $num_colors < 1){
        $num_colors_warning_display = true;
      }

      if($n_warning_display && $num_colors_warning_display){
        $both_warning_display = true;
      }

    ?>">

    <label for="n">Table Size(1-26)</label>
    <input type="text" name="n" id="n">

    <label for="num_colors">Color(1-10)</label>
    <input type="text" name="num_colors" id="num_colors">
    <span style="color:red;"><?php 
    if($both_warning_display){echo $both_warning; }
    elseif($n_warning_display){echo $n_warning; }
    elseif($num_colors_warning_display){echo $num_colors_warning; } else{echo '';}
    ?>
    </span>

    <input type="submit" value="generate tables">
    </form>
  </main>
</body>
<footer>
  <?php include 'footer.php' ?>
</footer>
</html>
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
    <form method="get" action="<?php>
      $n = $_GET["n"];
      $num_colors = $_GET["color"];

      $n_warning = 'Table size must be a value between 1 and 26';
      $num_colors_warning = 'Color must be a value between 1 and 10';
      $both_warning = 'Values must be between denoted range';

      $n_warning_display = false;
      $num_colors_warning_display = false;
      $both_warning_display = false;

      if (isset($_GET["n"]) && $n > 26 && $n < 1){
        // Error
        $n_warning_display = true;
      } else if(isset($_GET["color"]) && $color > 10 && $color < 1){
        $num_colors_warning_display = true;
      }

      if($n_warning_display && $num_colors_warning_display){
        $both_warning_display = true;
      }
    ?>">
    <label for="n">Table Size(1-26)</label>
    <input type="text" name="n" id="n">

    <label for="num_color">Color(1-10)</label>
    <input type="num_color" name="num_color" id="num_color">
    <span style="color:red;"><?php if($both_warning_display){echo $both_warning; }else if($n_warning_display){echo $n_warning; }else if($num_colors_warning_display){echo $color_warning; }?></span>

    <input type="submit" value="generate tables">
    </form>
  </main>
</body>
<footer>
  <?php include 'footer.php' ?>
</footer>
</html>
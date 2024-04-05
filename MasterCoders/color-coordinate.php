<!DOCTYPE html>
<html lang="en">
<!-- <style>
table, th, td {
  border: 1px solid black;
}
</style> -->
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
    elseif($num_colors_warning_display){echo $num_colors_warning; }
    ?>
    </span>

    <input type="submit" value="generate tables">
    </form>

  <!-- If Validation has been passed -->
  <?php
  if(isset($_GET["n"]) && isset($_GET["num_colors"]) && !$num_colors_warning_display && !$n_warning_display){
    //Print 2 tables, one 2 columns x num_colors
    $t1_num_rows = $_GET["num_colors"];

    echo "<table>";
    for($i = 0; $i < $t1_num_rows; $i++){
      echo "<tr>";

      //column 1
      echo "<td>a";
      echo "</td>";

      //column 2
      echo "<td>b";
      echo "</td>";

      echo "</tr>";
    }
    echo "</table>";

    //2nd table n+1 X n+1 Top row: A-Z Left Column: 1-26
    $t2_n = $_GET["n"];

    $alphabet = array("","A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
    $numbering = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26);

    array_splice($alphabet, $t2_n + 1);
    array_splice($numbering, $t2_n);

    echo "<table>";
      echo "<tr>";
      foreach($alphabet as $x){ //column headers
        echo "<th>";
        echo $x;
        echo "</th>";
      } 
      echo "</tr>";
      foreach($numbering as $y){ //row labels
        echo "<tr>";
        echo "<td>";
        echo $y;
        echo "</td>";
        // foreach(){
        //   echo "<td>";
        //   //echo "color data here";
        //   echo "/<td>";
        // }
        echo "</tr>";
      }
    echo "</table>";
  }

  ?>
  </main>
</body>
<footer>
  <?php include 'footer.php' ?>
</footer>
</html>
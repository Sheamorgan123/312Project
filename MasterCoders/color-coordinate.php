<!DOCTYPE html>
<html lang="en">
<style>
th, td {
  border: 1px solid black;
  padding: 8px;
}
table{
  width: 100%;
  border-collapse: collapse;
}

.left-column {
  /* width: 20%; */
  display: flex;
}

.right-column {
  width: 80%;
}

select {
  width: 100%; /* Make dropdowns fill their container */
  padding: 5px; /* Add padding to dropdowns */
}

main{
  padding-bottom: 300px;
}

</style>
<head>
  <title>Master Coders | Color Generation</title>
  <?php include 'header.html' ?>
  <link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>
  <header>
    <?php include 'navbar.html' ?>
  </header>
  <main>
  <h2 style="text-align: center;">Color Generation</h2>

  <?php

    $n_warning = 'Table size must be a value between 1 and 26';
    $num_colors_warning = 'Color must be a value between 1 and 10';
    $both_warning = 'Values must be between denoted range';

    $n_warning_display = false;
    $num_colors_warning_display = false;
    $both_warning_display = false;

    if (isset($_GET["n"])){
    $n = $_GET["n"];
    if ($n > 26 || $n < 1){
        $n_warning_display = true;

        }
    } 

    if(isset($_GET["num_colors"])){
    $num_colors = $_GET["num_colors"];
    if($num_colors > 10 || $num_colors < 1){
        $num_colors_warning_display = true;
        }
    } 

    if($n_warning_display && $num_colors_warning_display){
    $both_warning_display = true;
    }

?>

<form method="get" >

<label for="n">Table Size(1-26)</label>
<input type="text" name="n" id="n" value="<?php if(isset($_GET['n'])){echo htmlspecialchars($_GET['n']); }?>">

<label for="num_colors">Color(1-10)</label>
<input type="text" name="num_colors" id="num_colors" value="<?php if(isset($_GET['num_colors'])){echo htmlspecialchars($_GET['num_colors']); }?>">
<span style="color:red;"><?php 
if($both_warning_display){echo $both_warning; }
elseif($n_warning_display){echo $n_warning; }
elseif($num_colors_warning_display){echo $num_colors_warning; }
?>
</span>

<input type="submit" value="submit">
</form>

<?php

  if(isset($_GET["n"]) && isset($_GET["num_colors"]) && !$num_colors_warning_display && !$n_warning_display){
    
    //Print 2 tables, one 2 columns x num_colors
    $t1_num_rows = $_GET["num_colors"];
    $all_color_names = [];
    $all_color_hex = [];

    $these_colors = [];

    #We each put our own login/database information here
    $servername = "faure";
    $username = "";
    $password = "";
    $dbname = "";

    $message_add = "";
    $message_delete = "";
    $message_edit = "";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Could not connect to server. " . $conn->connect_error);
    }
    echo "<script>console.log('Successfully connected to server.');</script>";

    // Query to retrieve colors from the database
    $colors_query = "SELECT id, Name, hex_value FROM colors";
    $colors_result = $conn->query($colors_query);
    
    // Check if there are any colors retrieved
    if ($colors_result->num_rows > 0) {
        // Loop through each row of the result set
        while ($color_row = $colors_result->fetch_assoc()) {
            $database = True;
            $color_id = $color_row['id'];
            $color_name = ucfirst(strtolower($color_row['Name']));
            $hex_value = ucfirst(strtolower($color_row['hex_value']));

    
            // Output the color information
            // echo "Color ID: $color_id, Name: $color_name, Hex Value: $hex_value<br>";
            array_push($all_color_names, $color_name);
            array_push($all_color_hex, $hex_value);
            array_push($these_colors, $color_name);
        }
    } else {
        // No colors found in the database
        echo "No colors found in the database.";
    }
    
    // Close the database connection
    $conn->close();

    $all_hex = array();

    for ($i = 0; $i < count($all_color_names); $i++) {
        // Assign the key-value pair to the associative array
        $all_hex[$all_color_names[$i]] = $all_color_hex[$i];
    }

    array_splice($these_colors, $t1_num_rows);

    $j = 0;
    foreach($these_colors as $c) { //set each beginning color variable
        ${"color" . $j} = $c;
        $j++;
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $warning = "";
        for ($k = 0; $k < $t1_num_rows; $k++) { //set each beginning color variable
            if(isset($_POST["color" . $k])){
                ${"color" . $k} = $_POST["color" . $k];
            }
        }
        $selected = null;
        if(isset($_POST["selected_color"])){
          $selected = $_POST["selected_color"];
        }
        
    }

    echo "<table>";
    echo "<form method ='post' id = 'colorForm'>";


    for($i = 0; $i < $t1_num_rows; $i++){ //for each row
      echo "<tr>";

      //column 1
      echo "<td class='left-column'>";
      
      $checked = "";
      if (isset($_POST['selected_color']) && $_POST['selected_color'] === $all_color_names[$i]){
        $checked = "checked";
      }
  
      echo "<input type='radio' name='selected_color' id='radio_color$i' value='$i' $checked>";

      echo "<select name='color$i' id='color$i'>";

      foreach ($all_color_names as $color) {
        $selected = ($color == ${"color" . $i}) ? "selected='selected'" : "";
        echo "<option value='$color' $selected>$color</option>";
    }

      echo "</select>";
      echo "</td>";

      //column 2
      echo "<td class='right-column'>";
      echo "</td>";

      echo "</tr>";
      
    }

    echo "<div id='warningDiv' style='display: none;' padding: 'none;'>";
      echo "<span style='color: red;'>Maximum one selection per color</span>";
    echo "</div>";

    echo "<br>";

    echo "</form>";
    echo "</table>";
     
    //2nd table n+1 X n+1 Top row: A-Z Left Column: 1-26
    $t2_n = $_GET["n"];

    $alphabet = array("","A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
    $numbering = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26);

    array_splice($alphabet, $t2_n + 1);
    array_splice($numbering, $t2_n);

    echo "<br>";
    echo "<table id='mainTable'>";
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
        for($i = 0; $i < count($alphabet) - 1; $i++){
          echo "<td>";
          echo "</td>";
        }
        echo "</tr>";
      }
    echo "</table>";
  }

  $selected

  ?>
  </main>
</body>
<footer>
  <button onclick="printExclude()">Print Exclude</button>
  <?php include 'footer.html' ?>
</footer>
<script>

<?php
  if (isset($these_colors)) {
    echo "var currentColors = " . json_encode($these_colors) . ";";
  } else {
    echo "var currentColors = null;";
  }

  if (isset($all_hex)) {
    echo "var hexColors = " . json_encode($all_hex) . ";";
  } else {
    echo "var hexColors = null;";
  }

  if (isset($alphabet)) {
    echo "var currentLetters = " . json_encode($alphabet) . ";";
  } else {
    echo "var currentLetters = null;";
  }

  if (isset($numbering)) {
    echo "var currentNumbers = " . json_encode($numbering) . ";";
  } else {
    echo "var currentNumbers = null;";
  }
?>

const dropdowns = document.querySelectorAll('select');
const warningDiv = document.getElementById('warningDiv');

dropdowns.forEach((dropdown, index) => {
    dropdown.addEventListener('change', function(event) {
        event.preventDefault(); // Prevent the default form submission behavior
        const selectedColor = this.value;
        // console.log(selectedColor, index);

        if (currentColors.includes(selectedColor)) {
            // console.log("Color already selected. Choose a different color.");
            warningDiv.style.display = 'block';
            this.value = currentColors[index];
        } else{
          const previousColor = currentColors[index];
          colorchange(previousColor, selectedColor);
          currentColors[index] = selectedColor;
          warningDiv.style.display = 'none';
        }
        
    });
});


function colorchange(oldColor, newColor){

  for (const key in coloredCells) {
    if (coloredCells.hasOwnProperty(oldColor)) {
      swapColors(oldColor, newColor, coloredCells[oldColor]);
      coloredCells[newColor] = coloredCells[oldColor]; // Create new property with new key and copy value
      delete coloredCells[oldColor]; // Delete old property
    }
  }

}

const coloredCells = {};

console.log(currentColors);
//console.log("stored nyms", currentNumbers)
//console.log("stored letters", currentLetters)
function updateColoredCells(row, col, color) {

  const cellIdentifier = currentLetters[col] + currentNumbers[row];

  for (const key in coloredCells) {
    const colorIndex = coloredCells[key].indexOf(cellIdentifier);
    if (colorIndex !== -1) {
      coloredCells[key].splice(colorIndex, 1);
      //console.log("removed", key, cellIdentifier);
    }
    
  }

  if(color != null){
    if (!coloredCells[color]) {
     coloredCells[color] = [];
    }

    const colorIndex = coloredCells[color].indexOf(cellIdentifier);

    //console.log("added", color, cellIdentifier)
    coloredCells[color].push(cellIdentifier); // Append cellIdentifier
  }

  //console.log(coloredCells);

  const colorStrings = Array(currentColors.length).fill("");
  for (const color in coloredCells) {
    colorStrings[currentColors.indexOf(color)] = getStringForColor(color);
  }

  //console.log("color strings", colorStrings);
  updateRightColumn(colorStrings);
}

function getStringForColor(color) {
  if (coloredCells[color]) {
    return coloredCells[color].join(', ');
  } else {
    return '';
  }
}

function updateRightColumn(arr) {
    const rightColumnCells = document.querySelectorAll('.right-column');
    rightColumnCells.forEach((cell, index) => {
        cell.textContent = arr[index] || ''; // Update content with colorStrings value or empty string if undefined
    });
}


const tbody = document.querySelector('#mainTable');
if(tbody){
tbody.addEventListener('click', function (e) {
  const cell = e.target.closest('td');
  if (!cell) {return;} // Quit, not clicked on a cell
  const row = cell.parentElement;
  
  const selectedRadioButton = document.querySelector('input[name="selected_color"]:checked');

  if(selectedRadioButton){
    selectedColor = currentColors[selectedRadioButton.value];
    
    // console.log("Color", selectedColor);

    // console.log("HEXES: ", hexColors);

    selectedHex = hexColors[selectedColor];
    console.log("Color", selectedHex);

    selectedRGB = hexToRgb(selectedHex);
    if (cell.style.backgroundColor){
      console.log("bg", cell.style.backgroundColor)
      console.log("hex", selectedHex)
      console.log("rgv", selectedRGB)
      if(cell.style.backgroundColor == selectedRGB){
        cell.style.backgroundColor = null;
        updateColoredCells(row.rowIndex - 1, cell.cellIndex, null);
        //console.log('Removed Colored Cells:', row.rowIndex - 1, cell.cellIndex, null);
      } else {
        updateColoredCells(row.rowIndex - 1, cell.cellIndex, selectedColor);
        //console.log('Colored Cells:', row.rowIndex - 1, cell.cellIndex, selectedColor);
        cell.style.backgroundColor = selectedHex;
      }
      // console.log("bg: ", cell.style.backgroundColor, " s:", selectedColor.toLowerCase);
      //cell.style.backgroundColor = null;
    }  else if(!cell.style.backgroundColor && cell.cellIndex != 0){
        cell.style.backgroundColor = selectedHex;
        updateColoredCells(row.rowIndex - 1, cell.cellIndex, selectedColor);
        //console.log('Colored Cells:', row.rowIndex - 1, cell.cellIndex, selectedColor);
    } 
  }
});
}

const hexToRgb = (hex) => {
    const r = parseInt(hex.slice(1, 3), 16);
    const g = parseInt(hex.slice(3, 5), 16);
    const b = parseInt(hex.slice(5, 7), 16);
    
    // return {r, g, b} 
    strVal = "rgb(" + r + ", " + g + ", " + b + ")";
    return strVal;
}

//If dropdown color is changed
function swapColors(oldC, newC, position){
  for (const coordinate of position) {
    const row = parseInt(coordinate.substring(1)) - 1;
    const col = coordinate.charCodeAt(0) - 65; 

    const cell = tbody.rows[row+1].cells[col+1];

    cell.style.backgroundColor = hexColors[newC];
  }
}

  var isGrayscale = false;

  function printExclude() {
    isGrayscale = !isGrayscale;

    if (isGrayscale) {
      document.body.style.filter = "grayscale(100%)";
    } else {
      document.body.style.filter = "none";
    }
  }
</script>
</html>

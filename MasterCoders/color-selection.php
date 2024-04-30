<!DOCTYPE html>
<html lang="en">
<head>
  <title>Master Coders | Color Selection </title>
  <?php include 'header.html' ?>
  <link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>
  <header>
    <?php include 'navbar.html' ?>
  </header>
  <main>
    <?php
    /*
    code for the database connection,
    everyone needs to change this to your own database params.
    */
    $servername = "faure";
    $username = "";
    $password = "";
    $dbname = "";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Could not connect to server. " . $conn->connect_error);
    }
    echo "<script>console.log('Successfully connected to server.');</script>";
    ?>

    <h2>Add/Edit/Delete Colors</h2>
    <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
      <h3>Add a Color:</h3>
      Color Name: <input type="text" name="color_name" required><br>
      Hex Value: <input type="text" name="hex_value" pattern="#[0-9a-fA-F]{6}" title="Enter a valid hex color value (e.g., #RRGGBB)" required><br>
      <input type="submit" name="add_color" value="Add Color">
      <h3>Delete a Color:</h3>
      <h3>Edit a Color:</h3>
    </form>

    <?php
      if (isset($_POST['add_color'])) {
        $color_name = $_POST['color_name'];
        $hex_value = $_POST['hex_value'];

        // Check if color already exists
        $check_query = $conn->prepare("SELECT * FROM colors WHERE Name=? OR hex_value=?");
        $check_query->bind_param("ss", $color_name, $hex_value);
        $check_query->execute();
        $result = $check_query->get_result();
      
        if ($result->num_rows > 0) {
          echo "<p style='color: red;'>Color already exists in the database.</p>";
        }
        else {
          $insert_query = $conn->prepare("INSERT INTO colors (Name, hex_value) VALUES (?, ?)");
          $insert_query->bind_param("ss", $color_name, $hex_value);
          $insert_query->execute();
          if ($insert_query->get_result()) {
            echo "<p style='color: green;'>Color added successfully.</p>";
          }
          else {
            echo "Error: " . $insert_query . "<br>" . $conn->error;
          }
        }
      }
    ?>

    <?php
    $conn->close();
    ?>

  </main>
</body>
<footer>
  <?php include 'footer.html' ?>
</footer>
</html>

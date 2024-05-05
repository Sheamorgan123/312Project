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
    Code for the database connection,
    Everyone needs to change this to your own database params.
    */
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
    ?>

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
          $message_add = "<p style='color: red;'>Color already exists in the database.</p>";
        }
        else {
          $insert_query = $conn->prepare("INSERT INTO colors (Name, hex_value) VALUES (?, ?)");
          $insert_query->bind_param("ss", $color_name, $hex_value);
          $insertion_result = $insert_query->execute();
          if ($insertion_result === TRUE) {
            $message_add = "<p style='color: green;'>Color added successfully.</p>";
          }
          else {
            $message_add = "Error: " . $insert_query . "<br>" . $conn->error;
          }
        }
      }

      if (isset($_POST['delete_color'])) {
        // To check there is at least 2 colors
        $count_query = "SELECT COUNT(*) AS count FROM colors";
        $count_result = $conn->query($count_query);
        $row = $count_result->fetch_assoc();
        $color_count = $row['count'];
        
        // Actually checks
        if ($color_count > 2) {
          $color = $_POST['colors_list'];
          $delete_query = $conn->prepare("DELETE FROM colors WHERE id=?");
          $delete_query->bind_param("i", $color);
          $deletion_result = $delete_query->execute();

          $colors_query = "SELECT id, Name FROM colors";
          $colors_result = $conn->query($colors_query);

          // If successfully deletes from database
          if ($deletion_result === TRUE) {
            $message_delete = "<p style='color:green;'>Color deleted successfully.</p>";
          }
          else {
            $message_delete = "Error: " . $delete_query . "<br>" . $conn->error;
          }
        }
        else {
          $message_delete = "<p style='color:red;'>There must be at least 2 colors in database in order to delete a color.</p>";
        }
      }
    ?>

    <h2>Add/Edit/Delete Colors</h2>

    <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
      <h3>Add a Color:</h3>
      Color Name: <input type="text" name="color_name" required><br>
      Hex Value: <input type="text" name="hex_value" pattern="#[0-9a-fA-F]{6}" title="Enter a valid hex color value (e.g., #RRGGBB)" required><br>
      <input type="submit" name="add_color" value="Add Color">
      <?php echo $message_add ?>
    </form>

<h3>Edit Color</h3>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <?php
  // Get the selected color ID from the form (if submitted)
  $selected_color_id = isset($_POST['color_id']) ? $_POST['color_id'] : '';

  // If a color ID is selected, pre-fill the form with existing values
  if ($selected_color_id) {
    $edit_query = $conn->prepare("SELECT Name, hex_value FROM colors WHERE id=?");
    $edit_query->bind_param("i", $selected_color_id);
    $edit_query->execute();
    $edit_result = $edit_query->get_result();
    $color_row = $edit_result->fetch_assoc();

    if ($color_row) {
      $color_name = $color_row['Name'];
      $hex_value = $color_row['hex_value'];
    } else {
      // Handle case where selected color ID doesn't exist
      $color_name = "";
      $hex_value = "";
      echo "<p style='color: red;'>Error: Color with ID $selected_color_id not found.</p>";
    }
  } else {
    // No color selected, set empty values
    $color_name = "";
    $hex_value = "";
  }
  ?>
  <input type="hidden" name="color_id" value="<?php echo $selected_color_id; ?>">
  Color Name: <input type="text" name="color_name" value="<?php echo $color_name; ?>" required><br>
  Hex Value: <input type="text" name="hex_value" value="<?php echo $hex_value; ?>" pattern="#[0-9a-fA-F]{6}" title="Enter a valid hex color value (e.g., #RRGGBB)" required><br>
  <input type="submit" name="edit_color" value="Edit Color">
</form>

<?php
// Process edit color form submission
if (isset($_POST['edit_color'])) {
  $color_id = $_POST['color_id'];
  $color_name = $_POST['color_name'];
  $hex_value = $_POST['hex_value'];

  // Validate inputs
  if (empty($color_name) || empty($hex_value)) {
    echo "<p style='color: red;'>Error: Color name and hex value cannot be empty.</p>";
  } else if (!preg_match("/^#[0-9a-fA-F]{6}$/", $hex_value)) {
    echo "<p style='color: red;'>Error: Please enter a valid hex color value in the format #RRGGBB.</p>";
  } else {
    // Update the color in the database
    $update_query = $conn->prepare("UPDATE colors SET Name = ?, hex_value = ? WHERE id = ?");
    $update_query->bind_param("ssi", $color_name, $hex_value, $color_id);
    $update_result = $update_query->execute();

    if ($update_result === TRUE) {
      $message_edit = "<p style='color: green;'>Color updated successfully.</p>";
    } else {
      echo "Error: " . $update_query . "<br>" . $conn->error;
    }
  }
}
?>
echo $message_edit;



    <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
      <h3>Delete a Color:</h3>
      <select name='colors_list'>
        <?php 
          $colors_query = "SELECT id, Name FROM colors";
          $colors_result = $conn->query($colors_query);
          while ($color_row = $colors_result->fetch_assoc()) {
            echo "<option value='{$color_row['id']}'>{$color_row['Name']}</option>";
          }
        ?>
      </select>
      <input type='submit' name='delete_color' value='Delete Color'>
      <?php echo $message_delete ?>
    </form>

    <?php
    $conn->close();
    ?>
  </main>
</body>
<footer>
  <?php include 'footer.html' ?>
</footer>
</html>

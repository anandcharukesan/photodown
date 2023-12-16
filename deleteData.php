<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Delete User Data</title>
  <link rel="stylesheet" href="styles.css"> <!-- Linking an external CSS file -->
</head>
<body>
  <div class="container">
    <h1>Delete User Data by ID</h1>
    <form action="deleteData.php" method="post" class="form">
      <label for="id">Enter ID:</label>
      <input type="text" id="id" name="id" required>
      <input type="submit" value="Delete" class="btn">
    </form>
  </div>

  <?php
  // SQLite database connection
  try {
      $db = new PDO('sqlite:userdata.db');
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $e) {
      die("Error connecting to the database: " . $e->getMessage());
  }

  // Check if ID is submitted through the form
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
      $id = $_POST['id'];

      // Prepare and execute SQL DELETE statement
      $deleteStmt = $db->prepare("DELETE FROM UserData WHERE id = :id");

      try {
          $deleteStmt->bindParam(':id', $id);
          $deleteStmt->execute();

          echo "<p>Data with ID $id has been deleted successfully.</p>";
      } catch (PDOException $e) {
          echo "Error deleting data: " . $e->getMessage();
      }
  }
  ?>
</body>
</html>

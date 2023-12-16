<?php
// SQLite database connection
try {
    $db = new PDO('sqlite:userdata.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create a table to store user data if it doesn't exist
    $db->exec("CREATE TABLE IF NOT EXISTS UserData (
                id INTEGER PRIMARY KEY,
                name TEXT,
                mobile TEXT
            )");
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['name']) && isset($_POST['mobile'])) {
        // Prepare a SQL statement to insert data into the UserData table
        $insertStmt = $db->prepare("INSERT INTO UserData (name, mobile) VALUES (:name, :mobile)");

        $name = $_POST['name'];
        $mobile = $_POST['mobile'];

        // Bind parameters and execute the statement
        $insertStmt->bindParam(':name', $name);
        $insertStmt->bindParam(':mobile', $mobile);

        try {
            $insertStmt->execute();
            // Redirect to images.php after data insertion
            header("Location: images.php");
            exit(); // Ensure that no other content is sent
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Please provide both name and mobile number.";
    }
}
?>

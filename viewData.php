<?php
// SQLite database connection
try {
    $db = new PDO('sqlite:userdata.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error connecting to the database: " . $e->getMessage());
}

// Retrieve data from the UserData table
try {
    $query = $db->query("SELECT * FROM UserData");
    if (!$query) {
        die("Query failed: " . print_r($db->errorInfo(), true));
    }
    $users = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error executing query: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View User Data</title>
    <link rel="stylesheet" href="styles.css"> <!-- Linking the external CSS file -->
</head>
<body>
    <div class="container">
        <h1>User Data</h1>
        <?php if (empty($users)): ?>
            <p>No data found in the UserData table.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Mobile Number</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo $user['id']; ?></td>
                            <td><?php echo $user['name']; ?></td>
                            <td><?php echo $user['mobile']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>

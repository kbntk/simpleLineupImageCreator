<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "ziobro";
$dbname = "lineup";

try {
    // Connect to the database
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the "name" parameter is set
    if (isset($_POST['name'])) {
        $teamName = $_POST['name'];

        // Query to search for teams by name
        $stmt = $conn->prepare("SELECT * FROM team WHERE name LIKE :name");
        $stmt->bindValue(':name', '%' . $teamName . '%');
        $stmt->execute();

        // Check if any teams were found
        if ($stmt->rowCount() > 0) {
            // Display team data
            echo "<h2>Teams Found:</h2><ul>";
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<li>Team Name: " . htmlspecialchars($row['name']) . "</li>";
            }
            echo "</ul>";
        } else {
            echo "No teams found with the name: " . htmlspecialchars($teamName);
        }
    } else {
        echo "Team name not provided!";
    }
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
}
?>

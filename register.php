<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve values from the form
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $name = $_POST['name'];
    $phoneNumber = $_POST['phoneNumber'];

    // Establish database connection (replace with your actual database credentials)
    $con = new mysqli("localhost", "root", "", "musicdb");

    if ($con->connect_error) {
        die("Failed to connect: " . $con->connect_error);
    } else {
        // Insert data into the users table
        $stmt = $con->prepare("INSERT INTO users (email, password, name, phoneNumber) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $email, $password, $name, $phoneNumber);

        if ($stmt->execute()) {
            echo "<h2>Registration successful</h2>";
        } else {
            echo "<h2>Registration failed</h2>";
        }

        // Close the prepared statement and database connection
        $stmt->close();
        $con->close();
    }
}
?>
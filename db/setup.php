<?php

include_once 'database.php';

$db = new Database();
$conn = $db->connection();


// Create database
$sql = "CREATE DATABASE " . $db->getDbName();
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully<br>";

    $conn->select_db($db->getDbName());
    //create table POST
    $sql = "CREATE TABLE Posts (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(150) NOT NULL,
        slug VARCHAR(180) NOT NULL,
        content TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";

    if ($conn->query($sql) === TRUE) {
        echo "Table Posts created successfully<br>";
    } else {
        echo "Error creating table Posts: " . $conn->error . "<br>";
    }
} else {
    echo "Error creating database: " . $conn->error;
}

$conn->close();

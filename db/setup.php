<?php


$db_name = "CRUD_DB";
$db_username = "root";
$db_password = "";
$db_host = "localhost";

$conn = new mysqli($db_host, $db_username, $db_password);

// Create database
$sql = "CREATE DATABASE " . $db_name;
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully<br>";

    $conn->select_db($db_name);
    //create table POST
    $sql = "CREATE TABLE posts (
        postId INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(150) NOT NULL,
        slug VARCHAR(180) NOT NULL,
        content TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        CONSTRAINT Unique_Title UNIQUE (title,slug)
        )";

    if ($conn->query($sql) === TRUE) {
        echo "Table Posts created successfully<br>";
    } else {
        echo "Error creating table Posts: " . $conn->error . "<br>";
    }




    //create table USERS
    $sql = "CREATE TABLE users (
            userId INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            fullname VARCHAR(150) NOT NULL,
            username VARCHAR(100) NOT NULL,
            email VARCHAR(180) NOT NULL,
            passwd VARCHAR(150) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            CONSTRAINT Unique_user UNIQUE (username,email)
            )";

    if ($conn->query($sql) === TRUE) {
        echo "Table Users created successfully<br>";
    } else {
        echo "Error creating table Posts: " . $conn->error . "<br>";
    }
} else {
    echo "Error creating database: " . $conn->error;
}

$conn->close();

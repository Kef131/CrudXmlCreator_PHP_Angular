<?php
include("config.php");

session_start();
$servername = DBHOST;
$username   = DBUSER;
$password   = DBPWD;

$conn = new mysqli($servername, $username, $password, $_COOKIE['dbname']);
if ($conn->connect_error) {
    die("<p>Connection failed: " . $conn->connect_error . "</p>");
}

if (isset($_POST['column'])) {
    $sql = "UPDATE " . $_COOKIE['dbname'];
    $sql = $sql . " SET " . $_POST["column"] . " = '" . $_POST["editval"] . "' WHERE  id=" . $_POST["id"];
    
    if (mysqli_query($conn, $sql)) {
        echo "Element updated successfully";
    } else {
        echo "Error updating element: " . mysqli_error($conn);
    }
}

if (isset($_POST['deleteId'])) {
    $sql = "DELETE FROM " . $_COOKIE['dbname'];
    $sql = $sql . " WHERE  id=" . $_POST["deleteId"];
    
    if (mysqli_query($conn, $sql)) {
        echo "Element deleted successfully";
    } else {
        echo "Error deleting element: " . mysqli_error($conn);
    }
}
if (isset($_POST['sql'])) {
    $sql = $_POST['sql'];
    $sql = str_replace('-', '"-"', $sql);
    if (mysqli_query($conn, $sql)) {
        echo "Test element inserted successfully";
    } else {
        echo "Error inserting element: " . mysqli_error($conn);
    }
    
}
?>
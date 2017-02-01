<?php

$servername = "localhost";
$username = "root";
$password = "";
// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";
mysqli_select_db(($conn), "nutridelga");


function guardarObservaciones($observaciones) {
    global $conn;
    $query = "INSERT INTO ga_dieta (observaciones) values ('$observaciones')";
    mysqli_query($conn, $query);
}

$observaciones=$_POST['observaciones'];
guardarObservaciones($observaciones);

?>
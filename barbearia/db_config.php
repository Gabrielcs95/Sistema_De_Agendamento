<?php 
$local = "localhost";
$user = "root";
$password = "";
$banco = "barbearia";

//$conn = new PDO("mysql:host=$local;dbname=$banco", $user,$password);
$conn = new mysqli($local, $user, $password,$banco);

if ($conn->connect_error) {
    echo "erro de banco: " . $conn->connect_error;
}
?>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "prepenade";

$conn = new mysqli($servername, $username, $password, $dbname, 8111);

if ($conn->connect_error) {
    echo "falha ao conectar:(" . $conn->connect_errno . ")" . $conn->connect_errno;
}


<?php
require("constants.php");

$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
mysqli_select_db($conn, DB_NAME) or die("Cannot select DB");
<?php 
// DB credentials.
$connection = new mysqli("localhost", "root", "", "exam_vlwp");
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>
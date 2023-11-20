<?php
include("functions/connectdb.php");
include("default_values.php");

function test_input($con,$data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = mysqli_real_escape_string($con,$data);
    return $data;
}
?>
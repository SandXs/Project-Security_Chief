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

function Get_user_info ($id){
    $con = connectdb();
    $query = 'SELECT * FROM users WHERE user_id = "'.$id.'"';
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    return $row;
}
?>
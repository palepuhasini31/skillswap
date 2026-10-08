<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "skillswap"
);

if(!$conn){
    die("Database Connection Failed");
}
?>
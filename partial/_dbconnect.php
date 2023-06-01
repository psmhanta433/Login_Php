<?php

$host="localhost";
$username="root";
$password="";
$database="user";


$conn=mysqli_connect($host,$username,$password,$database);

if(!$conn){
    die("Error". mysqli_connect_error());
}

?>
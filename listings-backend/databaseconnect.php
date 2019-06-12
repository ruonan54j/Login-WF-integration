<?php
//include('control.php');
//require_once('control.php');
//file_put_contents('debug/session_db.txt',print_r($_SESSION['username'],true),FILE_APPEND );
 if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
$servername = "localhost";
$username = $_SESSION['username'];
$password = $_SESSION['password'];
$dbname = $_SESSION['name'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    $AccessDenied= $conn->connect_error;
    echo '<script type="text/javascript">alert("'. $AccessDenied.'");
          window.location.href="index.html";
          </script>';
  }
  
 ?>


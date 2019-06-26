<?php
     session_start();
    //connect to database
    $dbServername = "localhost";
    $dbUsername = "webcjcyg_admin";
    $dbPassword = "admin";
    $dbName = "webcjcyg_castle_user";

    $con = mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);

    if(isset($_POST['pass'])) {
    
            $username = mysqli_real_escape_string($con, $_POST['username']);
            $password = mysqli_real_escape_string($con, $_POST['pass']);
        
            $sql = "SELECT * FROM `users` WHERE `username` = '$username' AND `password` = '$password';";
            $result = mysqli_query($con, $sql);
        
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            $count = mysqli_num_rows($result);
        
        if ($count = 1 && $row['username'] != ''){
           
            $clientServername = "localhost";
            $_SESSION['username'] = $row['db_username'];
            $_SESSION['password'] = $row['db_password'];
            $_SESSION['name'] = $row['db_name'];
            $_SESSION['webflow_api'] = $row['webflow_api'];
            $_SESSION['sub_domain'] = $row['sub_domain'];
            $_SESSION['sub_domain2'] = $row['sub_domain2'];

            include("loggedin.php");
        }else{
            echo "<script>
            alert('Sorry, either password or username is incorrect');
            window.location.href='index.html';
            </script>";
        }
    }else if($_SESSION['username'] != ''){
    
            include("loggedin.php");
            
    }else{
            echo "<script>
            window.location.href='index.html';
           </script>";
    }

?>

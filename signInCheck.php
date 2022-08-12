<?php
include 'DB_CONFIG.PHP';
$conf = mysqli_connect(DBHOST,DBUSER,DBPWD,DBNAME);
$username ="";
$password ="";


    $username = $_POST['username'];
    $password = $_POST['password'];
    $ident = $_POST['Identity'];

    if(mysqli_connect_errno())
    die("Cannot connect to database.".mysqli_connect_errno());

    $query = "SELECT *  FROM blogger WHERE username = '$username' AND thePassword = '$password' AND identity = '$ident'";
    $result= mysqli_query($conf , $query);

    if (mysqli_num_rows($result) > 0) {
        session_start();
        $_SESSION['username'] = $username;
        mysqli_close($conf);
        header('location:index.php');
    }else {
      mysqli_close($conf);
      header('location: signIn.php?error= Incorrect Username or Password');
    }

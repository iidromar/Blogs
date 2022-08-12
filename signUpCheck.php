<?php
session_start();
include 'DB_CONFIG.PHP';
$conf = mysqli_connect(DBHOST,DBUSER,DBPWD,DBNAME);
$username ="";
$email ="";
$pswd ="";
$repswd ="";
$fname ="";
$lname ="";
$ident ="";
$secretq ="";
$secreta ="";

    $email = $_POST['email'];
    $username = $_POST['Username'];
    $password = $_POST['password'];
   $repswd = $_POST['re_password'];
   $fname = $_POST['First_name'];
   $lname = $_POST['Last_name'];
   $ident = $_POST['Blogger'];
   $secretq = $_POST['secretq'];
   $secreta = $_POST['secreta'];


   if(mysqli_connect_errno())
    die("Cannot connect to database.".mysqli_connect_errno());

   $userCheckQuery = "SELECT * FROM blogger WHERE username = '$username'";
   $result= mysqli_query($conf , $userCheckQuery);

   if($repswd != $password){
    mysqli_close($conf);
    header('location: signUp.php?error=Passwords must be same');
   }
   if(mysqli_num_rows($result) < 1) {

    $_SESSION['username'] = $username;
    $queryAdd = "INSERT INTO blogger VALUES('$username','$password','$email', '$fname', '$lname', '$ident', '$secretq', '$secreta')";
    $adding = mysqli_query($conf , $queryAdd);

    mysqli_close($conf);
    header('location: index.php?success=Welcome, You Have been logged in');
}else{
    mysqli_close($conf);
    header('location: signUp.php?error=This username have been taken, please try again');
}

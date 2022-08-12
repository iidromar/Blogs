<?php
session_start();
if(!isset($_SESSION['username'])){
    header("location:signIn.php?error=Please Sign in first");
}
if(!isset($_POST['rate']) || !isset($_GET['Bid'])){
    header("location:index.php?error=error occured when process rate");
}
include 'DB_CONFIG.php';
$con = mysqli_connect(DBHOST, DBUSER, DBPWD, DBNAME);
if(mysqli_connect_errno()){
    die("DB connection error" . mysqli_connect_error());
}

$rate = $_POST['rate'];
$username = $_SESSION['username'];
$bid = $_GET['Bid'];

$query = "INSERT INTO RATING VALUES (NULL,".$bid.", '".$username."', ".$rate.")";
$result = mysqli_query($con, $query);
if(!$result){
    mysqli_close($con);
    die("<p>error inserting rate</p>".$username);
}
mysqli_close($con);
header("location:blog-post2.php?Bid=".$bid."&success=Rated successfully!");
?>

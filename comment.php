<?php
session_start();
if(!isset($_SESSION['username'])){
    header("location:signIn.php?error=Please Sign in first");
}
if(!isset($_POST['commentText']) || !isset($_GET['Bid'])){
    header("location:index.php?error=error occured when process comment");
}
include 'DB_CONFIG.php';
$con = mysqli_connect(DBHOST, DBUSER, DBPWD, DBNAME);
if(mysqli_connect_errno()){
    die("DB connection error" . mysqli_connect_error());
}
$comment = $_POST['commentText'];
$username = $_SESSION['username'];
$bid = $_GET['Bid'];

$query = "INSERT INTO comments VALUES(NULL, ". $bid .", '". $username ."', '". $comment ."', null);";
$result = mysqli_query($con, $query);
if(!$result){
    mysqli_close($con);
    die("<p>error inserting comment</p>".$username);
}
mysqli_close($con);
header("location:blog-post2.php?Bid=".$bid."&success=Commented successfully!");
?>

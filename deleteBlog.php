<?php
session_start();
if(!isset($_SESSION['username'])){
    header("location:signIn.php?error=Please Sign in first");
}
if(!isset($_GET['Bid'])){
    header('location:index.php?error=Blog id not received!');
}
include 'DB_CONFIG.php';
$con = mysqli_connect(DBHOST, DBUSER, DBPWD, DBNAME);
if(mysqli_connect_errno()){
    die("DB connection error" . mysqli_connect_error());
}

$username = $_SESSION['username'];
$bid = $_GET['Bid'];
$query = 'DELETE FROM BLOG WHERE BLOGID = '.$bid.'';
$result = mysqli_query($con, $query);
if(!$result){
    mysqli_close($con);
    die("error while deleting blog");
}
mysqli_close($con);
header('location:author.php?author='.$username.'&success=Blog deleted successfully!');
?>

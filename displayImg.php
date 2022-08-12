<?php
include 'DB_CONFIG.php';
$con = mysqli_connect(DBHOST, DBUSER, DBPWD, DBNAME);
if($_GET['img']>0){
    $imgID = $_GET['img'];
    $qu = "SELECT imageType, imageData FROM IMAGE WHERE imageID = ".$imgID.";";
    $re = mysqli_query($con, $qu);
    $ro = mysqli_fetch_array($re);
    header("Content-type: " . $ro["imageType"]);
    echo $ro["imageData"];
}
else{
    header("content-type: image/jpeg");
    echo "img\post-10.jpg";
}
mysqli_close($con);

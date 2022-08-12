<?php
session_start();
if(!isset($_SESSION['username'])){
    header("location:signIn.php?error=Please Sign in first");
}
if(!isset($_GET['Bid'])){
    header('location:index.php?error=Blog id not received!');
}
if (!isset($_POST['title']) || !isset($_POST['category']) || !isset($_POST['text'])) {
    header("location:index.php?error=Title and Category and Blog Text are required!");
}
include 'DB_CONFIG.php';
$con = mysqli_connect(DBHOST, DBUSER, DBPWD, DBNAME);
if(mysqli_connect_errno()){
    die("DB connection error" . mysqli_connect_error());
}

$username = $_SESSION['username'];
$title = $_POST['title'];
$category = $_POST['category'];
$text = $_POST['text'];
$date = date("Y-m-d");
$Bid = $_GET['Bid'];
$imageinserted = false;
$videoinserted = false;
$imgid = -1;
$vidid = -1;
$kepimg = false;
$kepvid = false;
$query = 'SELECT * FROM BLOG WHERE BLOGID = '.$Bid.'';
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);
if(isset($_POST['keepimages'])){
    $kepimg = true;
    $keepimages = $_GET['keepimages'];
    $imgid = $row['imageID'];
}
if(isset($_POST['keepvideos'])){
    $kepvid = true;
    $keepvideos = $_GET['keepvideos'];
    $vidid = $row['videoID'];
}


if (count($_FILES) > 0) {
    if (is_uploaded_file($_FILES['userImage']['tmp_name'])) {
        $imgData = addslashes(file_get_contents($_FILES['userImage']['tmp_name']));
        $imageProperties = getimageSize($_FILES['userImage']['tmp_name']);

        $sql = "INSERT INTO image(imageType ,imageData)
	    VALUES('{$imageProperties['mime']}', '{$imgData}')";
        $current_id = mysqli_query($con, $sql) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_error($con));
        $imageinserted = true;
        $kepimg = true;
    }
    if (is_uploaded_file($_FILES['video']['tmp_name'])) {
        $target_dir = "videos/";
        $target_file = $target_dir . basename($_FILES["video"]["name"]);
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        if ($imageFileType != "mp4" && $imageFileType != "avi" && $imageFileType != "mov" && $imageFileType != "3gp" && $imageFileType != "mpeg") {
            die("File Format Not Suppoted");
        } else {
            $video_path = $_FILES['video']['name'];
            $result = mysqli_query($con, "insert into video values(NULL, '$video_path', '');");
            if(!$result)
                die($video_path);
            elseif (move_uploaded_file($_FILES["video"]["tmp_name"], $target_file)) {
                $videoinserted = true;
                $kepvid = true;
                //die("uploaded");
            }
            else
                die("not moved");
        }
    }
}

if($imageinserted){
    $query = 'SELECT MAX(imageID) AS maxid FROM IMAGE';
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    $imgid = $row['maxid'];

    if($videoinserted){
        $query = 'SELECT MAX(id) AS vidid FROM VIDEO';
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_array($result);
        $vidid = $row['vidid'];

        $query = "UPDATE BLOG SET TITLE = '".$title."', blogText = '".$text."', category = '".$category."', blogDate = '".$date."', imageID = ".$imgid.", videoID = ".$vidid." WHERE blogID = ".$Bid.";";
        $result = mysqli_query($con, $query);
    } else{//only image
        if($kepvid){
            $query = "UPDATE BLOG SET TITLE = '".$title."', blogText = '".$text."', category = '".$category."', blogDate = '".$date."', imageID = ".$imgid.", videoID = ".$vidid." WHERE blogID = ".$Bid.";";
            $result = mysqli_query($con, $query);
        }
        else{
            $query = "UPDATE BLOG SET TITLE = '".$title."', blogText = '".$text."', category = '".$category."', blogDate = '".$date."', imageID = ".$imgid.", videoID = NULL WHERE blogID = ".$Bid.";";
            $result = mysqli_query($con, $query);
        }
    }
} else{
    if($videoinserted){//only video
        $query = 'SELECT MAX(id) AS vidid FROM VIDEO';
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_array($result);
        $vidid = $row['vidid'];

        if($kepimg){
            $query = "UPDATE BLOG SET TITLE = '".$title."', blogText = '".$text."', category = '".$category."', blogDate = '".$date."', imageID = ".$imgid.", videoID = ".$vidid." WHERE blogID = ".$Bid.";";
            $result = mysqli_query($con, $query);
        }
        else{
            $query = "UPDATE BLOG SET TITLE = '".$title."', blogText = '".$text."', category = '".$category."', blogDate = '".$date."', imageID = NULL, videoID = ".$vidid." WHERE blogID = ".$Bid.";";
            $result = mysqli_query($con, $query);
        }
    }
    else{//neither
        if($kepimg){
            if($kepvid){
                $query = "UPDATE BLOG SET TITLE = '".$title."', blogText = '".$text."', category = '".$category."', blogDate = '".$date."', imageID = ".$imgid.", videoID = ".$vidid." WHERE blogID = ".$Bid.";";
                $result = mysqli_query($con, $query);
            }else{
                $query = "UPDATE BLOG SET TITLE = '".$title."', blogText = '".$text."', category = '".$category."', blogDate = '".$date."', imageID = ".$imgid.", videoID = NULL WHERE blogID = ".$Bid.";";
                $result = mysqli_query($con, $query);
            }
        }else{
            if($kepvid){
                $query = "UPDATE BLOG SET TITLE = '".$title."', blogText = '".$text."', category = '".$category."', blogDate = '".$date."', imageID = NULL, videoID = ".$vidid." WHERE blogID = ".$Bid.";";
                $result = mysqli_query($con, $query);
            }else{
                $query = "UPDATE BLOG SET TITLE = '".$title."', blogText = '".$text."', category = '".$category."', blogDate = '".$date."', imageID = NULL, videoID = NULL WHERE blogID = ".$Bid.";";
                $result = mysqli_query($con, $query);
            }
        }
    }
}


if (!$result) {
    echo "<h1>error:" . mysqli_error($con) . "</h1>";
    mysqli_close($con);
    die();
} else {
    mysqli_close($con);
    header("location:author.php?success=Blog updated successfully!");
}

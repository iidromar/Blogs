<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:signIn.php?error=Please Sign in first");
}
if (!isset($_POST['title']) || !isset($_POST['category']) || !isset($_POST['text'])) {
    header("location:createBlog.php?error=Title and Category and Blog Text are required!");
}
include 'DB_CONFIG.php';
$con = mysqli_connect(DBHOST, DBUSER, DBPWD, DBNAME);
if (mysqli_connect_errno()) {
    die("DB connection error" . mysqli_connect_error());
}
$image = null;
$video = null;
$username = $_SESSION['username'];
$title = $_POST['title'];
$category = $_POST['category'];
$text = $_POST['text'];
$date = date("Y-m-d");
$imageinserted = false;
$videoinserted = false;

if (count($_FILES) > 0) {
    if (is_uploaded_file($_FILES['userImage']['tmp_name'])) {
        $imgData = addslashes(file_get_contents($_FILES['userImage']['tmp_name']));
        $imageProperties = getimageSize($_FILES['userImage']['tmp_name']);

        $sql = "INSERT INTO image(imageType ,imageData)
	    VALUES('{$imageProperties['mime']}', '{$imgData}')";
        $current_id = mysqli_query($con, $sql) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_error($con));
        $imageinserted = true;
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
                //die("uploaded");
            }
            else
                die("not moved");
        }
    }
}
if ($imageinserted) {
    $query = 'SELECT MAX(imageID) AS maxid FROM IMAGE';
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    $imgid = $row['maxid'];

    if ($videoinserted) {//image and video
        $query = 'SELECT MAX(id) AS vidid FROM VIDEO';
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_array($result);
        $vidid = $row['vidid'];

        $query = "INSERT INTO BLOG VALUES(NULL, '" . $username . "', '"
            . $text . "', '" . $title . "', '" . $category . "', '" . $date . "', " . $imgid . ", " . $vidid . ");";
        $result = mysqli_query($con, $query);
    } else {//image no video
        $query = "INSERT INTO BLOG VALUES(NULL, '" . $username . "', '"
            . $text . "', '" . $title . "', '" . $category . "', '" . $date . "', " . $imgid . ", NULL);";
        $result = mysqli_query($con, $query);
    }
} else{//no image
    if ($videoinserted) {//no image with video
        $query = 'SELECT MAX(id) AS vidid FROM VIDEO';
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_array($result);
        $vidid = $row['vidid'];

        $query = "INSERT INTO BLOG VALUES(NULL, '" . $username . "', '"
            . $text . "', '" . $title . "', '" . $category . "', '" . $date . "', NULL, " . $vidid . ");";
        $result = mysqli_query($con, $query);
    }
    else{//no image no video
        $query = "INSERT INTO BLOG VALUES(NULL, '" . $username . "', '"
            . $text . "', '" . $title . "', '" . $category . "', '" . $date . "', NULL, NULL);";
        $result = mysqli_query($con, $query);
    }
}

if (!$result) {
    echo "<h1>error:" . mysqli_error($con) . "</h1>";
    mysqli_close($con);
    die();
} else {
    mysqli_close($con);
    header("location:author.php?success=Blog posted successfully!");
}



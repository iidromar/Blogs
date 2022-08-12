<?php
    include 'DB_CONFIG.PHP';
    $con = mysqli_connect(DBHOST,DBUSER,DBPWD,DBNAME);
    $username = $_POST['username'];
    $secreta = $_POST['secreta'];
    $password = $_POST['password'];
    $identity = $_POST['Identity'];
    $query = "SELECT *  FROM blogger WHERE username = '$username' AND answer = '$secreta' AND identity ='$identity'";
    $result= mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        $update = "UPDATE blogger SET thePassword = '$password' WHERE username='$username'";

        $resultUpdating= mysqli_query($con, $update);

        header('location:index.php?success=password has been reset, please sign in ');
    }else       
         header('location:forgetPass.php?error=password has not been reset, please try again');
?>
<?php
    session_start();
    session_destroy();
    header('location:index.php?success= See you next time.');
?>

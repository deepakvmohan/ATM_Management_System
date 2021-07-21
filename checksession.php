<?php
    if((!isset($_SESSION["acc_no"]))){
        header("location:index.php");
        exit();
    }
?>
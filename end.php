<?php
            require_once "header.php";
            if(session_destroy()){
                header("location:index.php");
            }
?>
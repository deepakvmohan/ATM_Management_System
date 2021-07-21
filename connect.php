<?php
$connect = mysqli_connect("localhost","root","","atm_machine");
if(mysqli_connect_errno()){
    echo "Could not connect";
    die();
}
?>
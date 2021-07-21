<?php
    require_once "header.php";
    require_once "checksession1.php";
    if(isset($_POST["submit"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
        $amt = mysqli_escape_string($connect,$_POST["amt"]);
        $error = "";
        $success = "";
        if(empty($amt)){
            $error = "PLease enter amount";
        }else{
            $q2 = mysqli_query($connect,"SELECT * FROM atm ");

            if(( mysqli_num_rows($q2) > 0)){
                $r2 = mysqli_fetch_assoc($q2);
                $atm_bal=$r2["ATM_BAL"];
                    $res= $atm_bal + $amt;
                    $up ="UPDATE atm SET ATM_BAL='$res'";
                    if(mysqli_query($connect,$up)){
                        $success = "PLEASE WAIT FOR YOUR TRANSACTION TO COMPLETE";
                        header("refresh:2; url= admin_output.php");
                    }else{
                        $error = "Transaction Failed";
                    }
                }else{
                $error = "invalid fetch";
            }
        }
    }



?>

<!DOCTYPE html>
<html>
    <head>
        <title>ATM Deposite</title>
        <link rel="stylesheet" type="text/css" href="cash.css">
    </head>
    <body>
        <form action="atm_deposite.php" method="POST" class="container">
    <ul class="list">
        <h1 style="color:white;text-align:center">ATM Deposite</h1>
        <li><input  type="text" name="amt" placeholder="Enter the Amount"></li>
        <li><input type="submit" name="submit" value="Confirm"></li>
        <?php
                if(!empty($error)){
                    echo '<p id="diss">'. $error .'</p>';
                }
                if(!empty($success)){ 
                    echo '<p id="diss">'. $success .'</p>';
                }
        ?> 
        </ul>
           
            
         </form>

    </body>
    </html>
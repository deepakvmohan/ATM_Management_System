<?php
    require_once "header.php";
    if(isset($_POST["submit"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
        $amt = mysqli_escape_string($connect,$_POST["amt"]);
        $error = "";
        $success = "";
        if(empty($amt)){
            $error = "PLease enter amount";
        }else{
            $acc_no = $_SESSION["acc_no"];
            $q2 = mysqli_query($connect,"SELECT * FROM account WHERE ACC_NO='$acc_no'");

            if(( mysqli_num_rows($q2) > 0)){
                $r2 = mysqli_fetch_assoc($q2);
                $acc_bal=$r2["ACC_BAL"];
                    $res= $acc_bal + $amt;
                    $up ="UPDATE account SET ACC_BAL='$res' WHERE ACC_NO='$acc_no'";
                    if(mysqli_query($connect,$up)){
                        $success = "PLEASE WAIT FOR YOUR TRANSACTION TO COMPLETE";
            
                        $action="DEPOSIT";

                        $np = "INSERT INTO transactions ( TRANS_DESC ,TRANS_AMT, ACC_NO) VALUES ('$action','$amt','$acc_no')";
                        if(mysqli_query($connect,$np)){
                            $success = "PLEASE WAIT FOR YOUR TRANSACTION TO COMPLETE";
                            header("refresh:1; url=output.php");
                        }else{
                            $error = "Transaction Failed";
                           
                         }

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
        <title>Deposite</title>
        <link rel="stylesheet" type="text/css" href="cash.css">
    </head>
    <body>
        <form action="deposite.php" method="POST" class="container">
    <ul class="list">
        <h1 style="color:white;text-align:center"> Deposite</h1>
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
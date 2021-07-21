<?php
    require_once "header.php";
    if(isset($_POST["submit"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
        $amt = mysqli_escape_string($connect,$_POST["amt"]);
        $error = "";
        $success = "";
        if(empty($amt)){
            $error = "PLease enter amountr";
        }else{
            $acc_no = $_SESSION["acc_no"];
            $q1 = mysqli_query($connect,"SELECT * FROM atm");
            $q2 = mysqli_query($connect,"SELECT * FROM account WHERE ACC_NO='$acc_no'");

            if(( mysqli_num_rows($q2) > 0) && ( mysqli_num_rows($q1)  > 0)){
                $r1 = mysqli_fetch_assoc($q1);
                $r2 = mysqli_fetch_assoc($q2);
                $acc_bal=$r2["ACC_BAL"];
                $atm_bal=$r1["ATM_BAL"];
                if($acc_bal<$amt){
                    $error = "Your account balance too low for this transaction";
                }
                else if($atm_bal<$amt){
                    $error ="Atm Does not have enough cash to make this transaction";
                }else{
                    $res= $acc_bal - $amt;
                    $up ="UPDATE account SET ACC_BAL='$res' WHERE ACC_NO='$acc_no'";
                    if(mysqli_query($connect,$up)){
                       
                        $action="WITHDRAW";

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
                    

                }
        }   else{
                $error = "invalid fetch";
            }
       
        }
    }



?>

<!DOCTYPE html>
<html>
    <head>
        <title>CASH WITHDRAWAL</title>
        <link rel="stylesheet" type="text/css" href="cash.css">
    </head>
    <body>
        <form action="cash.php" method="POST" class="container">
    <ul class="list">
        
        <h1 style="color:white;text-align:center"> Cash Widthdrawal </h1>
        
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
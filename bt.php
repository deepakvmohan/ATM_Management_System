<?php
    require_once "header.php";
    if(isset($_POST["submit"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
        $amt = mysqli_escape_string($connect,$_POST["amt"]);
        $r_no = mysqli_escape_string($connect,$_POST["r_no"]);
        $error = "";
        $success = "";
        if(empty($r_no)){
            $error = "PLease enter the account number";

        }else if(empty($amt)){
            $error = "PLease enter amount";

        }else{
            $acc_no = $_SESSION["acc_no"];
            $q1 = mysqli_query($connect,"SELECT * FROM account WHERE ACC_NO='$acc_no'");
            $q2 = mysqli_query($connect,"SELECT * FROM account WHERE ACC_NO='$r_no'");

            if(( mysqli_num_rows($q2) > 0) &&( mysqli_num_rows($q1) > 0) ){ 
                $r1 = mysqli_fetch_assoc($q1);
                $r2 = mysqli_fetch_assoc($q2);
                $r_bal=$r2["ACC_BAL"];
                $s_bal=$r2["ACC_BAL"];

                    $s_bal=$s_bal - $amt;
                    $r_bal= $r_bal + $amt;
                    $up1 ="UPDATE account SET ACC_BAL='$s_bal' WHERE ACC_NO='$acc_no'";
                    $up2 ="UPDATE account SET ACC_BAL='$r_bal' WHERE ACC_NO='$r_no'";

                    if(mysqli_query($connect,$up1)){
                        $success = "PLEASE WAIT FOR YOUR TRANSACTION TO COMPLETE";
                    }else{
                        $error = "Transaction Failed";
                    }
                    if(mysqli_query($connect,$up2)&&(empty($error))){
                        $success = "PLEASE WAIT FOR YOUR TRANSACTION TO COMPLETE";
                        header("refresh:1; url=output.php");
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
        <title>Balance transfer</title>
        <link rel="stylesheet" type="text/css" href="bt.css">
    </head>
    <body>
        <div class="user_img"></div>
        <form action="bt.php" method="POST" class="container">
            <ul class="list">
                <li><h2 style="color:white"> Balance transfer </h2> </li>
                <?php
                if(!empty($error)){
                    echo '<p id="dis">'. $error .'</p>';
                }
                if(!empty($success)){ 
                    echo '<p id="dis">'. $success .'</p>';
                }
                ?> 
                <li><input type="text" name="r_no" placeholder="Enter the account number">   </li>
                <li><input type="text" name="amt" placeholder="Enter the amount"></li>
               
                <li><input type="submit" name="submit" value="Send"></li>
            </ul>
            
        </form>

    </body>
</html>
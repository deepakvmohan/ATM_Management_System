<?php
    require_once "header.php";
    if(isset($_POST["submit"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
        $pin = mysqli_escape_string($connect,$_POST["pin"]);
        $acc_no = $_SESSION["acc_no"];
        $error = "";
        $success = "";
        if(empty($pin)){
            $error = "PLease enter new pin number";

        }else{
            $q2 = mysqli_query($connect,"SELECT * FROM account WHERE ACC_NO='$acc_no'");

            if(( mysqli_num_rows($q2) > 0)){
             
                $r2 = mysqli_fetch_assoc($q2);
                $card_no = $r2["CARD_NO"];

                    $up1 ="UPDATE cards SET CARD_PIN ='$pin' WHERE CARD_NO='$card_no'";

                    if(mysqli_query($connect,$up1)){
                        $success = "PIN CHANGED SUCCESSFULLY";
                        header("Refresh:2;url=main.php");
                    }else{
                        $error = "PIN NOT CHANGED";
                    }
                }else{
                    $error ="There is no user to  change";
                }
        }
    }
         
        



?>
<!DOCTYPE html>
<html>
    <head>
        <title>change pin</title>
        <link rel="stylesheet" type="text/css" href="bt.css">
    </head>
    <body>
        <div class="user_img"></div>
        <form action="cp.php" method="POST" class="container">
            <ul class="list">
                <li><h2 style="color:white"> Change pin </h2> </li>
                <?php
                if(!empty($error)){
                    echo '<p id="diss">'. $error .'</p>';
                }
                if(!empty($success)){ 
                    echo '<p id="diss">'. $success .'</p>';
                }
                ?> 
                <li><input type="text" name="pin" placeholder="Enter your newpin"></li>
               
                <li><input type="submit" name="submit" value="Send"></li>
            </ul>
            
        </form>

    </body>
</html>
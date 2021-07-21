<?php
    require_once "header.php";
    if(isset($_POST["submit"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
        $admin_id = mysqli_escape_string($connect,$_POST["admin_id"]);
        $admin_pin = mysqli_escape_string($connect,$_POST["admin_pin"]);
        $error = "";
        $success = "";
        if(empty($admin_id)){
            $error = "PLease Input ADMIN_ID";
        }else if(empty($admin_pin)){
            $error = "Please Input ADMIN_PIN";
        }else{
              $query = mysqli_query($connect,"SELECT * FROM ADMIN WHERE ADMIN_ID = '$admin_id'" );
              if(mysqli_num_rows($query) > 0){  
                  $row = mysqli_fetch_assoc($query);
                  $_SESSION["admin_id"]=$row["ADMIN_ID"];
                  $passwordHash = $row["ADMIN_PIN"];
                  
                  if(!($passwordHash == $admin_pin)){
                      $error = "PIN DOESNT MATCH";

                  }else{
                      $success = "LOGIN SUCCESS";

                      header("Refresh:2;url=atm_deposite.php");
                  }
              
              }else{
                  $error= "YOU CANT ADD MONEY";
              }

              
            }
    }
    
    

?>
<!DOCTYPE html>
<html>
    <head>
        <title>ATM Admin PAGE</title>
        <link rel="stylesheet" type="text/css" href="home.css">
    </head>
    <body>
        <div class="user_img"></div>
        <form action="admin.php" method="POST" class="container">
            <ul class="list">
                <li><h2 style="color:white"> WELCOME TO PIKA'S ATM  </h2> </li>
                <?php
                if(!empty($error)){
                    echo '<p id="dis">'. $error .'</p>';
                }
                if(!empty($success)){ 
                    echo '<p id="dis">'. $success .'</p>';
                }
                ?> 
                <li><input type="text" name="admin_id" placeholder="Enter Admin_id">   </li>
                <li><input type="password" name="admin_pin" placeholder="Enter Admin_pin"></li>
                <li><input type="submit" name="submit" value="login"></li>
                <li><a class="A" href="index.php">User_login</a></li>
                <li><a class= "A" href="changepin.php">Forgot pin?</a></li>               

            </ul>
            </form>

    </body>
</html>
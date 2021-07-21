<?php
    require_once "header.php";
    if(isset($_POST["submit"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
        $card_no = mysqli_escape_string($connect,$_POST["card_no"]);
        $card_pin = mysqli_escape_string($connect,$_POST["card_pin"]);
        $error = "";
        $success = "";
        if(empty($card_no)){
            $error = "PLease Input CORRECT ID";
        }else if(empty($card_pin)){
            $error = "Please Input PIN";
        }else{
              $query = mysqli_query($connect,"SELECT * FROM CARDS WHERE CARD_NO = '$card_no'" );
              if(mysqli_num_rows($query) > 0){  
                  $row = mysqli_fetch_assoc($query);
                  $acc_no = $row["ACC_NO"];
                  $passwordHash = $row["CARD_PIN"];
                  
                  if(!($passwordHash == $card_pin)){
                      $error = "Invalid pin";

                  }else{
                      $success = "Sucess login";
                      $q = mysqli_query($connect,"SELECT * FROM USER_TABLE WHERE ACC_NO='$acc_no'");
                      $p = mysqli_fetch_assoc($q);
                      $_SESSION["username"]=$p["FNAME"];
                      $_SESSION["acc_no"]=$acc_no;
                    

                      header("Refresh:2;url=main.php");
                  }
              
              }else{
                  $error= "User does not found";
              }

              
            }
    }
    
    

?>
<!DOCTYPE html>
<html>
    <head>
        
        <script type="text/javascript">
            function preback() { window.history.forward(); }
            setTimeout("preback()",0);
            window.onunload = function() { null };
        </script>
        <meta charset="utf=8">
        <title>ATM HOME PAGE</title>
        <link rel="stylesheet" type="text/css" href="home.css">
    </head>
    <body>
        <div class="user_img"></div>
        <form action="index.php" method="POST" class="container">
            <ul class="list">
                <li><h2 style="color:white"> WELCOME TO PIKA'S ATM </h2> </li>
                <?php
                if(!empty($error)){
                    echo '<p id="dis">'. $error .'</p>';
                }
                if(!empty($success)){ 
                    echo '<p id="dis">'. $success .'</p>';
                }
                ?> 
                <li><input type="text" name="card_no" placeholder="Enter your card number">   </li>
                <li><input type="password" name="card_pin" placeholder="Enter your pin"></li>
               
                <li><input type="submit" name="submit" value="Login"></li>
                <li><a class="A" href="admin.php">Admin login</a></li>
                <li><a class="A" href="fp.php">Forgot pin?</a></li> 

            </ul>
            
        </form>

    </body>
</html>
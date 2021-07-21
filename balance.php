<?php
    require_once "header.php";
    $username = $_SESSION["username"];
    $acc_no = $_SESSION["acc_no"];
    $qq2 = mysqli_query($connect,"SELECT * FROM account WHERE ACC_NO='$acc_no'");
    if(mysqli_num_rows($qq2) > 0){  
        $rr = mysqli_fetch_assoc($qq2);
        $acc_bal = $rr["ACC_BAL"];
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>BALANCE ENQUIRY</title>
        <link rel="stylesheet" type="text/css" href="output.css">
    </head>
    <body>
        <form action="main.php" method="POST" class="container">
            <h1 class="text"> HELLO <?php echo $username; ?> </h1>
            <h2 class="text"> Your account balance is : </h2>
            <h3 class="text"> <?php echo 'Rs '. $acc_bal . '.00'; ?> </h3>
            <div class="text"><input type="image" src="gif.gif" alt="Submit" width="60" height="60"></div>
            <ul class="list">
              
                <li><a class="A" href="output.php" >LOGOUT</a></li>
            </ul>
            
            


        </form>
    

    </body>
</html>
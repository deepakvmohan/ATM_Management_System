<?php
    require_once "header.php";
    require_once "checksession.php";
    $username = $_SESSION["username"];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Main menu</title>
        <link rel="stylesheet" type="text/css" href="main.css">
    </head>
    <body>
        <form action="main.html" method="POST" class="container">
            <ul class="list">
                <li><h3 style="color: white;font-size: xx-large;">HELLO <?php echo $username; ?></h3></li>
                <li><h2 style="color: white"> SELECT TRANSACTION </h2></li>
                <li><a class="A" href="cash.php" >CASH WITHDRAWAL</a></li>
                <li><a class="A"  href="deposite.php" >DEPOSITE</a></li>
                <li><a class="A"  href="bt.php" >TRANSFER</a></li>
                <li><a class="A"  href="balance.php" >BALANCE ENQUIRY</a></li>
                <li><a class="A"  href="trans.php" >LAST THREE TRANSACTION</a></li>
                <li><a class="A"  href="cp.php" >CHANGE PIN</a></li>
                <li><a class="A"  href="output.php" >QUIT</a></li>

                
            </ul>
        </form>

    </body>
</html>
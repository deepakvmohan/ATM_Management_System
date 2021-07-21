<?php
    require_once "header.php";
    require_once "checksession1.php";
    $username = $_SESSION["admin_id"];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Main menu</title>
        <link rel="stylesheet" type="text/css" href="output.css">
    </head>
    <body>
        <form action="end.php" method="POST" class="container">
            <h1 class="text"> YOUR TRANSACTION IS SUCCESSFUL </h1>
            <h2 class="text"> THANK YOU ADMIN  </h2>
            <h3 class="text"> <?php echo $username; ?></h3>
            <div class="text"><input type="image" src="gif.gif" alt="Submit" width="60" height="60"></div>
           


        </form>
       
        
        

    </body>
</html>
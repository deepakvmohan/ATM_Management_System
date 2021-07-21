<!DOCTYPE html>
<html>
    <head>
        <title>Main menu</title>
        <link rel="stylesheet" type="text/css" href="output.css">
    </head>
    <body>
        <form action="output.php" method="POST" class="conb">
        <h2 class="text"> YOUR LAST THREE TRANSACTION DETAILS </h2>
        <?php
        require_once "header.php";
        $acc_no =$_SESSION["acc_no"];
       
        $result = mysqli_query($connect,"SELECT * FROM transactions WHERE ACC_NO = '$acc_no' ORDER BY TRANS_NO DESC LIMIT 3");
        if (mysqli_num_rows($result) > 0) {
        ?>
         <table>
  
         <tr>
          <td>TRANS_NO</td>
         <td>TRANS_DATETIME</td>
         <td>TRANS_DESC</td>
         <td>TRANS_AMT</td>
         <td>ACC_NO</td>
         </tr>
        <?php
        $i=0;
        while($row = mysqli_fetch_array($result)) {
        ?>
        <tr>
          <td><?php echo $row["TRANS_NO"]; ?></td>
          <td><?php echo $row["TRANS_DATETIME"]; ?></td>
          <td><?php echo $row["TRANS_DESC"]; ?></td>
          <td><?php echo $row["TRANS_AMT"]; ?></td>
          <td><?php echo $row["ACC_NO"]; ?></td>
        </tr>
        <?php
        $i++;
     }
        ?>
        </table>
    <?php
    }
    else{
        echo "No result found";
    }
    ?>
            
            <div class="text"><input type="image" src="gif.gif" alt="Submit" width="60" height="60"></div>
           


        </form>
       
        
        

    </body>
</html>


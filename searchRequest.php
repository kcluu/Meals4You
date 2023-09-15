

<!DOCTYPE html>
<html>
    <head>
        <title>Modify Meal Request</title>
        <meta charset="utf-8" />
        <meta name="author" content="Sarah Deacon" />
        <meta name="keywords" content="modify, meal" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/bootstrap.min.css" rel="stylesheet" />
        <link href="css/bootstrap.css" rel="stylesheet" />
       

        <style>
            .header{
                text-align: center;
            }

            body{
                background-image: url('food.jpeg');
                padding-top: 20px;
            }
            *{
              box-sizing: border-box;
            }
            .body{
              padding-left: 15px;
              background-color: peachpuff;
              padding-bottom: 15px;
              padding-top: 2px;
              margin-right: 50px;
              margin-left:50px;
              margin-bottom: 25px;
              border: 2px solid grey;
              border-top:none;
              margin-top:0px;
            }
            #background{
              background-color: white;
              padding-top: 25px;
            }
            #title2{
              border: 2px solid grey;
              background-color: white;
              padding-bottom: 10px;
              margin-right: 50px;
              margin-left:50px;
              padding-top: 0px;
            }
            
            body{
            background-color: peachpuff;
        }
        #search{
            color:lightcoral;
            background-color: white;
            
        }
        
        #page{
            font-size: 18px;
            text-align:center;
          }

        </style>

    <script src="jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    

    </head>

    <body>

        <div id="title2">
        <h1 class="header">Meal Request Search Results
        </h1>
        <div id="page">
        <a href="modify.php" style="color: rgb(240, 64, 85); background: #EFEFEF; border-color: #333333; border-style: solid; border-width: thin; padding: 3px; color: #333333">Return to Modify/Delete Page</a>
        </div>
        </div>
        <div class="body">
        
        <?php

    $search = "";
    if(isset($_POST["search"])) {
        $search = $_POST["search"];
    }
    echo '';
            require_once("db.php");
              $sql="SELECT `requestdate`,`rname`, `description`, `price`, `quantity`, `deadline`, `requeststatus`, `requestercid` FROM `mealrequest`
              WHERE `rname` LIKE '%$search%' OR `description` LIKE '%$search%' OR `requestercid` LIKE '%$search%'";
              $result = $mydb->query($sql);
              while($row=mysqli_fetch_array($result)) {
                  echo "<div class='table'>";
                  echo "<table id='search' border='2px black solid'>";
                  echo "<thead><tr><th>Request Date</th><th>Meal Name</th><th>Description</th><th>Price</th><th>
                  Quantity</th><th>Deadline</th><th>Request Status</th><th>Buyer ID</th></tr></thead>";
                  echo "<tbody><tr><td>".$row['requestdate']."</td><td>".$row['rname']."</td><td>".$row['description']."</td><td>".$row['price']."</td><td>".$row['quantity']."</td><td>".$row['deadline']."
                  </td><td>".$row['requeststatus']."</td><td>".$row['requestercid']."</td></tr>";
                  echo "</tbody>";
                  echo "<br>";
                  echo "</div>";
              }

              
              
?>

       

        </div>
    </body>
</html>

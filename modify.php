<?php

  $search = "";
  $cid = "";
  $meal = "";
  $modify = "";
  $delete ="";
  $err = false;

  if (isset($_POST["submit"])) {

      if(isset($_POST["modifier"])) $cid=$_POST["modifier"];
      if(isset($_POST["meal"])) $meal=$_POST["meal"];
      if(isset($_POST["modifications"])) $modify=trim($_POST["modifications"]);
      if(isset($_POST["delete"])) $delete=$_POST["delete"];
      if(isset($_POST["search"])) $search=$_POST["search"];
      

      if(!empty($modify) && !empty($cid) && !empty($meal)) {
        require_once('db.php');
        $sql4 = "update `mealrequest` set `description`='$modify' where `rname`='$meal' AND `requestercid`='$cid'";
        $result=$mydb->query($sql4);


        function function_alert($message) {
          echo "<script>alert('$message');";
          echo "window.location.href='Profile.php';</script>";
          }
          
        function_alert("Success! Your meal has been updated.");

        


        } else if(!empty($cid) && !empty($meal) && !empty($delete)){
          require_once('db.php');
          $sql1="select rid from mealrequest where rname='$meal' and requestercid='$cid'" ;
          $result1=$mydb->query($sql1);
          $row = mysqli_fetch_array($result1);
          
          $sql="delete from payment where rid='".$row['rid']."'";
          $result2=$mydb->query($sql);

          $sql4 = "delete from `mealrequest` where rname='$meal' and requestercid='$cid'";
          $result3=$mydb->query($sql4);
          
        
          function function_alert($message) {
            echo "<script>alert('$message');";
            echo "window.location.href='Profile.php';</script>";
            }
          function_alert("Success! Your meal has been deleted.");


      } elseif(!empty($search)){
        
            
                   header("HTTP/1.1 307 Temporary Redirect");
                   header("Location: searchRequest.php");
              
            
              
            
            
      }
      else {
        $err = true;

        function function_alert($message) {
          echo "<script>alert('$message');</script>";
          }
        function_alert("Error! Correct your errors and submit again.");

      }
  }
 ?>



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
            .navbar-brand {
              padding: 0px;
            }
            .navbar-brand>img {
              height: 100%;
              padding: 5px;
              width: auto;
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
            .errlabel {color:red;}
            .search{
              background-color: peachpuff;
              border: 2px black solid;
              margin-top: 50px;
            }

        </style>

    <script src="jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script>
     

      function getContent() {
        var id = document.getElementById("modifier").value;
        var z = document.getElementById("contentArea");
        if(id==0) {
          z.innerHTML = "Must select your ID.";
        } else {
          try {
  					asyncRequest = new XMLHttpRequest();  //create request object

  					//register event handler
  					asyncRequest.onreadystatechange=stateChange;
            var url="getMeal.php?id="+id;
  					asyncRequest.open('GET',url,true);  // prepare the request
  					asyncRequest.send(null);  // send the request
  				}
  					catch (exception) {alert("Request failed");}

        }

        function stateChange() {
          // if request completed successfully
          if(asyncRequest.readyState==4 && asyncRequest.status==200) {
            document.getElementById("contentArea").innerHTML=
              asyncRequest.responseText;  // places text in contentArea
          }
        }
      }
    </script>

    </head>

    <body>

      

        <?php
          require_once('db.php');

          $sql = 'select distinct concat(FirstName, " ", LastName) as "name" from user inner join mealrequest on mealrequest.RequesterCID = user.cid;';
          $result = $mydb->query($sql);

          $sql2 = 'select RName from mealrequest;';
          $result2 =  $mydb->query($sql2);

          $sql3 = 'select distinct RequesterCID from mealrequest order by RequesterCID asc;';
          $result3 = $mydb->query($sql3);
        ?>

        <div id="title2">
        <h1 class="header">Modify Meal Request</h1></div>
        <div class="body">
        <h3>Modify Meal Information:</h3>
        <form name="myForm" method="post" id="form1" action="<?php echo $_SERVER['PHP_SELF']?>">
        
        <p>
              <strong>Who is modifying?</strong> <select name="modifier" id="modifier" onchange="getContent()">
              
                <option value="0">Select</option>
                <?php
                  while($row = mysqli_fetch_array($result3)){
                    $cid = $row['RequesterCID'];
                    echo "<option value='".$cid."'>".$cid."</option>";
                  };
                ?>
              </select>
          </p>
            
            <div id="contentArea">
            </div>
          
            <p>
                <label>What would you like to change about this meal?</label><br>
                <textarea name="modifications" rows="4" cols="50" id="mods">
                  <?php echo $modify;?>
                </textarea>
       

                <?php
                if ($err && empty($modify)) {
                    echo "<label class='errlabel'>Error: Please enter your modifications.</label>";
                  }
                ?>
            
            </p>

            <p>
                <strong>Would you like to delete this meal? (leave as No if not) </strong><select name="delete" id="delete">
                  <option value="">No</option>
                  <option value="yes">Yes</option>
                </select>
            </p>

            <p>
                  <label>Search Requests: </label>
                  <input type="text" name="search">
            </p>

            <input type="submit" value="Submit" name="submit">
            <input type="reset" value="Reset">
        </form>

       

        </div>
    </body>
</html>

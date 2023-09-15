<!doctype html>
<html>
<head>
  <title>Get Meal</title>
</head>
<body>
  <?php
    $id = 0;

    if(isset($_GET['id'])) $id=$_GET['id'];

    require_once("db.php");

    $sql="SELECT rname FROM mealrequest WHERE requestercid=".$id;
    
    $result = $mydb->query($sql);

    if(mysqli_num_rows($result)>0){
        echo "<p>";
        echo "<strong>What meal would you like to modify?</strong> <select name='meal' id='meal'>";
          
         echo "<option value='0'>Select</option>;";
          
            while($row = mysqli_fetch_array($result)){
              $meal = $row['rname'];
              echo "<option value='".$meal."'>".$meal."</option>";
            };
        
        echo"</select>";
      echo"</p>";
    } else {
      echo "Your company name cannot be found.";
    }
  

  ?>


    
</body>
</html>
<!doctype html>
<html>
<head>
  <title> Php Ajax</title>
</head>
<body>
  <?php
    $rid = 0;
    if(isset($_GET['rid'])) {
        $rid=$_GET['rid'];

        require_once("db.php");
        $sql = "DELETE FROM `payment`
        WHERE `RID` =".$rid;
        $result = $mydb->query($sql);

        $sql2 = "DELETE FROM `mealrequest`
        WHERE `RID` =".$rid;
        $result2 = $mydb->query($sql2);
    } 

  ?>
</body>
</html>

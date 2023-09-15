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
        $sql = "UPDATE `mealrequest`
        SET `RequestStatus` = 'Delivered', `RequestDate` = CURDATE()
        WHERE `RID` =".$rid;
        $result = $mydb->query($sql);
    } 

  ?>
</body>
</html>

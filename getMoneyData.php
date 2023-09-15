<?php
  require_once("db.php");

  $id=0;
  if(isset($_GET['userid'])) $id=$_GET['userid'];

  $sql = "select month(requestdate) as requestday, sum(price) as moneyCount 
  from mealrequest where requestercid=$id group by requestday order by requestday";

  $result = $mydb->query($sql);

  $data = array();
  for($x=0; $x<mysqli_num_rows($result); $x++) {
    $data[] = mysqli_fetch_assoc($result);
  }

  echo json_encode($data);
 ?>
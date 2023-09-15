<?php
  require_once("db.php");
  $cmid=0;
  if(isset($_GET["cmid"])) $cmid = $_GET["cmid"];

  $sql = "  SELECT meal, AVG(starnum.number) AS AvgStar
            From review
            INNER JOIN mealchoices
              ON review.CMID = mealchoices.CMID
            INNER JOIN starnum
              ON review.StarRating = starnum.word
            GROUP BY meal";
    $result = $mydb->query($sql);

    $data = array();
    for($x=0; $x<mysqli_num_rows($result); $x++) {
      $data[] = mysqli_fetch_assoc($result);
    }

    echo json_encode($data);
 ?>

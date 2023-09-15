<!doctype html>
<html lang="en">
<head> 
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatable" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Display Products</title>
</head>
<style>
  .orange{background-color:orange; color:white;}
  .lightorange{background-color:#fbe4d5;}
</style>
<body>
  <?php
    session_start();
    $rvid = 0;
    $cid = 0;
    $image;
    $email = $_SESSION["email"];

    if(isset($_GET['rvid'])) $rvid=$_GET['rvid'];
    require_once("db.php");
    $sql = "SELECT CID
            FROM user
            WHERE email='$email'";
    $result = $mydb->query($sql);
    while($row = mysqli_fetch_array($result)){
      $cid = $row["CID"];
    }

    echo "<table style='width: 98%'>";
          
    echo "<thead class='orange'>
          <tr><th>Meal Name</th><th>Review Title</th><th>Review Description</th><th>Star Review</th>
          </tr></thead><tbody>";
      
    if($rvid==0){   
      $sql="SELECT meal AS meal,
        ReviewTitle,
        ReviewDescription,
        StarRating,
        review.CID,
        RVID
        FROM review
        INNER JOIN mealchoices
        ON review.CMID = mealchoices.CMID
        INNER JOIN user
          ON review.CID = user.CID
        WHERE review.CID=$cid ORDER BY review.DateOfReview DESC";    
        $result = $mydb->query($sql);

        while($row = mysqli_fetch_array($result)){
          if($row["StarRating"]=="one"){
            $image = "<img src='1 star.png' height='45' width='235'/>";
          }
          if($row["StarRating"]=="two"){
            $image = "<img src='2 star.png' height='45' width='235'/>";
          }
          else if($row["StarRating"]=="three"){
            $image = "<img src='3 star.png' height='45' width='235'/>";
          }
          else if($row["StarRating"]=="four"){
            $image = "<img src='4 star.png' height='45' width='235'/>";
          }
          else if($row["StarRating"]=="five"){
            $image = "<img src='5 star.png' height='45' width='235'/>";
          }
          
            echo "<tr>
            <td class='lightorange'>".$row["meal"]."</td>
            <td class='lightorange'>".$row["ReviewTitle"]."</td>
            <td class='lightorange'>".$row["ReviewDescription"]."</td>
            <td class='lightorange'>".$image."</td>
            </tr>";
        }
    }else{
      $sql="SELECT meal AS meal,
      ReviewTitle,
      ReviewDescription,
      StarRating,
      review.CID,
      RVID
      FROM review
      INNER JOIN mealchoices
      ON review.CMID = mealchoices.CMID
      INNER JOIN user
      ON review.CID = user.CID
      WHERE user.email='$email' AND RVID=$rvid ORDER BY review.DateOfReview DESC";  
      $result = $mydb->query($sql);

      while($row = mysqli_fetch_array($result)){
        if($row["StarRating"]=="one"){
          $image = "<img src='1 star.png' height='45' width='235'/>";
        }
        if($row["StarRating"]=="two"){
          $image = "<img src='2 star.png' height='45' width='235'/>";
        }
        else if($row["StarRating"]=="three"){
          $image = "<img src='3 star.png' height='45' width='235'/>";
        }
        else if($row["StarRating"]=="four"){
          $image = "<img src='4 star.png' height='45' width='235'/>";
        }
        else if($row["StarRating"]=="five"){
          $image = "<img src='5 star.png' height='45' width='235'/>";
        }

          echo "<tr>
          <td class='lightorange'>".$row["meal"]."</td>
          <td class='lightorange'>".$row["ReviewTitle"]."</td>
          <td class='lightorange'>".$row["ReviewDescription"]."</td>
          <td class='lightorange'>".$image."</td>
          </tr>";
      }
    } 
    echo "</tbody></table>";
  ?>
</body>
</html>

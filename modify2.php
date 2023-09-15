<?php
  session_start();
  $email = $_SESSION["email"];
  $rvid = $_SESSION["rvid"];
  $cmid = 0;
  $star = "";
  $rTitle = "";
  $rDez = "";
  if(isset($_POST["revMeal"])) $cmid=$_POST["revMeal"];
  if(isset($_POST["star"])) $star=$_POST["star"];
  if(isset($_POST["reviewTitle"])) $rTitle=$_POST["reviewTitle"];
  if(isset($_POST["reviewDescription"])) $rDez=$_POST["reviewDescription"];
  if(isset($_POST["specReview"])) $rvid=$_POST["specReview"];
?>

<?php
    require_once("db.php");
    $sql = "SELECT CID
            FROM user
            where email='$email'";
    $result = $mydb->query($sql); 
    while($row = mysqli_fetch_array($result)){
      $cid = $row["CID"];
    }
    
    $today = Date("Y/m/d");
    $sql = "UPDATE review SET StarRating = '$star', ReviewTitle = '$rTitle', ReviewDescription = '$rDez', DateOfReview = $today 
            WHERE RVID=".$rvid;
    $result = $mydb->query($sql);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>MODIFICAION CONFIRMATION</title>
        <meta charset="utf-8" />
        <meta name="author" content="Jack Hartmann" /> 
        <meta name="keywords" content="home, recipe, student, service, food" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/bootstrap.min.css" rel="stylesheet" />
        <link href="css/bootstrap.css" rel="stylesheet" />
        <script src="jquery-3.1.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </head>
    <style>
      *   {
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
          hr{
            width: 100%;
            height: 1px;
            background-color: #f43c54;
            position: fixed;
            left: 0px;
            margin-top: 10px;
          }
          #body{
            padding-left: 15px;
            background-color: peachpuff;
            padding-bottom: 15px;
            padding-top: 2px;
            margin-right: 20%;
            margin-left:20%;
            margin-bottom: 25px;
            border-top:none;
          }
          #title{
            padding-top: 25px;
            text-align: center;
            background-color: peachpuff;
          }
          body{
            background-image: url('food.jpeg');
          }
          #title2{
            background-color: peachpuff;
            padding-bottom: 10px;
            margin-right: 20%;
            margin-left:20%;
          }
          [type=radio] { 
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
          }          
          [type=radio] + img {
            cursor: pointer;
          }
          #description{ 
            vertical-align: top;
          }
         
    </style>
    <script>
      function continueFunction(){
        document.location.href = "Manage Reviews.php";
      }
    </script>
    <body>
    <div id="title2"><h2 id="title">MODIFICAION CONFIRMATION</h2></div>
    <div id="body"> 
    <form name="myForm" method="post" id="form1" action="<?php echo $_SERVER['PHP_SELF']?>">
    <section class="reviewRating">
    
    <center>
    <input type="button" value="CONTINUE" onclick="continueFunction()" />
    </center>
    </section>
    </form>
    </div>
    </div>
    </body>
</html>
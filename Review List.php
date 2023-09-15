<?php
  session_start();
  $email = $_SESSION["email"];
  $cmid = 0;
  $image;
  if(isset($_GET['cmid'])) $cmid=$_GET['cmid'];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Review List</title>
        <meta charset="utf-8" />
        <meta name="author" content="Jack Hartmann" /> 
        <meta name="keywords" content="home, recipe, student, service, food" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/bootstrap.min.css" rel="stylesheet" />
        <link href="css/bootstrap.css" rel="stylesheet" />
        <script src="jquery-3.1.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </head>
    <style>
      .orange{background-color:orange; color:white;}
      .lightorange{background-color:#fbe4d5;}

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
      table, th, td {
        border: 1px solid black;
        text-align: center;
      }
      .nav-pills > li.navbar-dark > a, .nav-pills > li.active > a:focus {
        color:black;
      }
      .nav-pills > li.active > a, .nav-pills > li.active > a:focus {
        color:white;
        background-color:#AE0000;
      }
      .nav-pills > li.active > a:hover {
        color:white;
          background-color: #800000; 
      }
    </style>
    <body>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">
          <img alt="Logo" src="logo3.png" width=90px>
        </a>
      </div>
  
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li><a href="home.php">Home <span class="sr-only">(current)</span></a></li>
          <li><a href="exploreProfiles.php">Profiles</a></li>
          <li><a href="exploreMeals.php">Meals</a></li>
          <li><a href="your_requests.php">Requests</a></li>
        </ul>
        <form class="navbar-form navbar-left" method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
          <div class="form-group">
            <input type="text" name="searchVal" class="form-control" placeholder="Search for a meal">
          </div>
          <button type="submit" name="submit" class="btn btn-default">Search</button>
        </form>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="Profile.php">My Profile</a></li>
        </ul>
      </div>
      </div>
    </nav>
    <div id="title2"><h1 id="title">Review List</h1></div>
    <div id="body"> 
    <form name="myForm" method="post" id="form1" action="<?php echo $_SERVER['PHP_SELF']?>">
    <nav>
      <ul class="nav nav-pills nav-justified">
        <li class="active"><a href="Review List.php">Review List</a></li>
        <li class="navbar-dark"><a href="Review Analytics.php">Review Analytics</a></li>
      </ul>
    </nav>
    <section class="table">
    <?php
    require_once("db.php");

    echo "<table style='width: 98%'>";
      
    echo "<thead class='orange'>
          <tr><th>User Name</th><th>Meal Name</th><th>Review Title</th><th>Review Description</th><th>Star Review</th>
          </tr></thead><tbody>";
      
    $sql="SELECT CONCAT(FirstName, ' ',
    LastName) AS FullName,
    meal AS meal,
    ReviewTitle,
    ReviewDescription,
    StarRating
    FROM review
    INNER JOIN mealchoices
        ON review.CMID = mealchoices.CMID
    INNER JOIN user
      ON review.CID = user.CID 
    INNER JOIN starnum
      ON review.StarRating = starnum.word
    ORDER BY starnum.number DESC, DateOfReview DESC";
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
      <td class='lightorange'>".$row["FullName"]."</td>
      <td class='lightorange'>".$row["meal"]."</td>
      <td class='lightorange'>".$row["ReviewTitle"]."</td>
      <td class='lightorange'>".$row["ReviewDescription"]."</td>
      <td class='lightorange'>".$image."</td>
      </tr>";      
    }
    echo "</tbody></table>";
  ?>
  </section>
    </div>
    </div>
    </body>
</html>
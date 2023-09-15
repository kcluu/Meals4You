<?php
  session_start();
  $email = $_SESSION["email"];

  require_once("db.php");
  $sql="SELECT * FROM `user`
  WHERE `email` ='$email'";
  $result = $mydb->query($sql);
  $row=mysqli_fetch_array($result);
  $status = $row['Status'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Data Analysis</title>
            <meta charset="utf-8" />
            <meta name="author" content="Jacob Gann" /> 
            <meta name="keywords" content="issue, submission, error, request, meal" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link href="css/bootstrap.min.css" rel="stylesheet" />
            <link href="css/bootstrap.css" rel="stylesheet" />
            <script src="jquery-3.1.1.min.js"></script>
            <script src="js/bootstrap.min.js"></script>  
            <script src="https://d3js.org/d3.v4.min.js"></script>
<style>
* {
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
  .request {
    text-align: center;
    margin: auto;
  text-align: center;
  width: 50%; 
   
    border: 30px solid transparent;
    background-color: #f2eae8;
  }
  body {
  background-image: url("images/food.jpeg");
 }
</style>
</head>
<body>
<nav class="navbar navbar-default">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="home.php">
              <img alt="Logo" src="images/logo.png" width=90px>
              </a>
            </div>
        
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <li><a href="home.php">Home <span class="sr-only">(current)</span></a></li> <!-- Collect the nav links, forms, and other content for toggling -->
                <li><a href="exploreProfiles.php">Profiles</a></li> <!-- Collect the nav links, forms, and other content for toggling -->
                <li><a href="exploreMeals.php">Meals</a></li>
                <li><a href="your_requests.php">Requests</a></li> <!-- Collect the nav links, forms, and other content for toggling -->
              </ul>
              
              <ul class="nav navbar-nav navbar-right">
              <?php
              if ($status == "Employee") {
                echo "<li class='active'><a href='ExistingServiceRequests.php'>Manage Service Requests</a></li>";
              }
            ?>
                <li><a href="Profile.php">My Profile</a></li>
              </ul>
            </div><!-- /.navbar-collapse -->
           </div><!-- /.container-fluid -->
          </nav>


<div class ='request'>
          <h1 style="color: rgb(240, 64, 85)">Select an employee to see their data</h1>
          
          
          

          <form method= "get" action="DataReport.php" >
  <select name="EID" id="empID" style="color: rgb(240, 64, 85); background: #FFFFFF; border-style: outset; border-color:rgb(240, 64, 85);
     font: bold 15px arial,sans-serif;text-shadow:none;">
  
  <?php
   //echo "<option value='0'> </option>";
      require_once("db.php"); 
      $sql = "select Distinct EID from errorresponse" ;
      $result = $mydb->query($sql);
      while ($row = mysqli_fetch_array($result)) {
       echo "<option value = '".$row["EID"]."'>" .$row["EID"]. "</option>";
      }
  ?>
  </select>
  <input type="submit" name ="submit" value="Request Data" style="color: rgb(240, 64, 85); background: #FFFFFF; border-style: outset; border-color:#FFFFFF;
     font: bold 15px arial,sans-serif;text-shadow:none;">

     <a href="ExistingServiceRequests.php" style="color: rgb(240, 64, 85); background: #FFFFFF; border-style: outset; border-color:#FFFFFF;
     font: bold 15px arial,sans-serif;text-shadow:none;">Return to Requests</a>
  </div>

          


</body>
</html>
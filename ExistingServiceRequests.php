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
<title>Existing Service Requests</title>
            <meta charset="utf-8" />
            <meta name="author" content="Jacob Gann" /> 
            <meta name="keywords" content="issue, submission, error, request, meal" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link href="css/bootstrap.min.css" rel="stylesheet" />
            <link href="css/bootstrap.css" rel="stylesheet" />
            <script src="jquery-3.6.0.min.js"></script>
            <script src="js/bootstrap.min.js"></script>  

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
        .da{
          margin: auto;
          text-align: center;
          width: 50%; 
          
            border: 30px solid transparent;
        }
        .SearchResults {
          margin: auto;
          text-align: center;
          width: 50%; 
          
            border: 30px solid transparent;
            background-color: #f2eae8;
        }
        .title {
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
<script>
  function clear() {
    document.getElementById("cArea").innerHTML = ""; 
  }

</script>
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

<div class = "title">
  <h1 style="color: rgb(240, 64, 85);"> Existing Service Requests </h1>
  <br>
  <br>
      <form action="ExistingServiceRequests.php" method="POST" id="searchForm">
        <input name="search" type="text" id="searchBox" placeholder="" value="" maxlength="25">
        <button type = "submit" name="submit-search">Search</button>
        <button type = "submit" name="refresh">Return to Original List</button>
    </form>
    <br>
    <p style="color: rgb(240, 64, 85)"> click error to view details and submit a response</p>
</div>
<br>
<br>
<div class ="SearchResults" id="cArea">
  <h2 style="color: rgb(240, 64, 85); text-decoration: underline;">Search Results:</h2>




    <?php
    require_once("db.php");
    
    $sql = "SELECT * FROM errorrequest" ;
    $result = $mydb->query($sql);
    while($row = mysqli_fetch_array($result)) {
      $id = $row['ErrID']; 
      $title = $row['ErrorRequestTitle'];
      $status = $row['ErrorRequestStatus'];
      $sdisplay = "";  
      if($status == 0){ 
        $sdisplay = "Unanswered";
        $address = "CreateNewIssue.php";
      } 
      else{
        $sdisplay = "Answered"; 
        $address = "ModifyIssue.php"; 
      }
      echo "<h3>
        <a href = $address style='color:rgb(240, 64, 85);'> $title </a>
        </h3><p>$sdisplay</p><br />"; 
      }




      if(isset($_POST['submit-search'])) {
        echo '<script type="text/javascript">',
        'clear();',
        '</script>' 
        ;
        echo "<h2 style='color: rgb(240, 64, 85); text-decoration: underline;'>Search Results:</h2>" ;
        $search = $_POST['search'];
        $sql = "SELECT * FROM errorrequest WHERE ErrorRequestTitle LIKE '%$search%'  ";
        $result = $mydb->query($sql); 
        while($row = mysqli_fetch_array($result)) {
           $id = $row['ErrID']; 
           $title = $row['ErrorRequestTitle'];
           $status = $row['ErrorRequestStatus'];
           $sdisplay = "";
           $address = "";  
           if($status == 0){ 
             $sdisplay = "Unanswered";
             $address = "CreateNewIssue.php";
           } 
           else{
             $sdisplay = "Answered";
             $address = "ModifyIssue.php"; 
           }
             
           echo "<h3>
           <a href = $address style='color:rgb(240, 64, 85);'> $title </a>
           </h3><p>$sdisplay</p><br />"; 
        }
       }




    if(isset($_POST['refresh'])){
      echo '<script type="text/javascript">',
        'clear();',
        '</script>' 
        ;
        echo "<h2 style='color: rgb(240, 64, 85); text-decoration: underline;'>Search Results:</h2>" ;
      $sql = "SELECT * FROM errorrequest" ;
      $result = $mydb->query($sql);
      while($row = mysqli_fetch_array($result)) {
        $id = $row['ErrID']; 
        $title = $row['ErrorRequestTitle'];
        $status = $row['ErrorRequestStatus'];
        $sdisplay = "";  
        if($status == 0){ 
          $sdisplay = "Unanswered";
          $address = "CreateNewIssue.php";
        } 
        else{
          $sdisplay = "Answered"; 
          $address = "ModifyIssue.php"; 
        }
        echo "<h3>
          <a href = $address style='color:rgb(240, 64, 85);'> $title </a>
          </h3><p>$sdisplay</p><br />"; 
        }
      }




      
    ?>
</div>
<div class = "da"> 
    
    <a href="DataRequest.php" style="color: rgb(240, 64, 85); background: #FFFFFF; border-style: outset; border-color:#FFFFFF;
     font: bold 15px arial,sans-serif;text-shadow:none;">Data Analysis</a>
    
    
   </div>
</body>

</html>
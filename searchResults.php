<?php

    $searchQuery = "";
    if(isset($_POST["searchVal"])) {
        $searchQuery = $_POST["searchVal"];
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Home</title>
        <meta charset="utf-8" />
        <meta name="author" content="Katelyn Luu" />
        <meta name="keywords" content="home, recipe, student, service, food" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/bootstrap.min.css" rel="stylesheet" />
        <link href="css/bootstrap.css" rel="stylesheet" />
        <script src="jquery-3.6.0.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </head>
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


    /* Create two equal columns that floats next to each other */
    .column {
      float: left;
      width: 50%;
      padding-left: 30px;
      padding-right: 30px;
    }

    /* Clear floats after the columns */
    .row:after {
      content: "";
      display: table;
      clear: both;
    }

    /* Responsive layout - makes the two columns stack on top of each other instead of next to each other */
    @media screen and (max-width: 600px) {
      .column {
        width: 100%;
        padding-left: 30px;
      }
    }

    .content {
    width: auto;
    padding: 10px;
    overflow: hidden;
    }

    .content img {
        margin-right: 5px;
        float: left;
    }

    .content h3,
    .content p{
        margin-left: 5px;
        display: block;
        margin: 2px 0 0 0;
    }

    h3.meal_title {
      color: inherit
    }

    
    
    </style>

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
            <?php
            session_start();
            $email = $_SESSION["email"];
            require_once("db.php");
  $sql="SELECT * FROM `user`
  WHERE `email` ='$email'";
  $result = $mydb->query($sql);
  $row=mysqli_fetch_array($result);
  $status = $row['Status'];
              if ($status == "Employee") {
                
                echo "<li><a href='ExistingServiceRequests.php'>Manage Service Requests</a></li>";
              }
            ?>
              <li><a href="Profile.php">My Profile</a></li>
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>

      
      <div class="row">
        <div class="column">
          <h2>Search Results For: <?php echo $searchQuery;?></h2>
            <?php
              require_once("db.php");
              $sql="SELECT `meal`, `MealDescription`, `img_url` FROM `mealchoices`
              WHERE `meal` LIKE '%$searchQuery%' OR `mealdescription` LIKE '%$searchQuery%'";
              $result = $mydb->query($sql);
              while($row=mysqli_fetch_array($result)) {
                if (empty($row['img_url'])) {
                  echo "<div class='content'>
                  <h3 class='meal_title'>".$row['meal']."</h3>
                  <p>".$row['MealDescription']."
                  </p>
                  </div>";
                } else {
                echo "<div class='content'>
                  <img src=".$row['img_url']." width=200px>
                  <h3 class='meal_title'>".$row['meal']."</h3>
                  <p>".$row['MealDescription']."
                  </p>
                  </div>";
                }
              }
            ?>
        </div>
      </div>      
    </body>
</html>
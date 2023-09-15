<?php
  $searchQuery = "";
  if (isset($_POST["submit"])) {
      if(isset($_POST["searchVal"])) {
        $searchQuery=$_POST["searchVal"];
      }
       header("HTTP/1.1 307 Temporary Redirect");
       header("Location: searchResults.php");
  }


  $firstName = "";
  session_start();
  $email = $_SESSION["email"];

  require_once("db.php");
  $sql="SELECT * FROM `user`
  WHERE `email` ='$email'";
  $result = $mydb->query($sql);
  $row=mysqli_fetch_array($result);
  $firstName = $row['1'];
  $status = $row['Status'];

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
            <a class="navbar-brand" href="#">
              <img alt="Logo" src="images/logo.png" width=90px>
            </a>
          </div>
      
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <li class="active"><a href="home.php">Home <span class="sr-only">(current)</span></a></li>
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
              if ($status == "Employee") {
                echo "<li><a href='ExistingServiceRequests.php'>Manage Service Requests</a></li>";
              }
            ?>
              <li><a href="Profile.php">My Profile</a></li>
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>

      <h1 class="text-center">Welcome, <?php echo $firstName ?>!</h1>

      <!--carousel-->
      <div id="carousel1" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
          <li data-target="#carousel1" data-slide-to="0" class="active"></li>
          <li data-target="#carousel1" data-slide-to="1"></li>
          <li data-target="#carousel1" data-slide-to="2"></li>
        </ol>
      
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img src="images/slide1.png">
            <div class="carousel-caption">
              <h2></h2>
            </div>
          </div>
          <div class="item">
            <img src="images/slide2.jpeg">
            <div class="carousel-caption">
              <h2></h2>
            </div>
          </div>
          <div class="item">
            <img src="images/slide3.jpeg">
            <div class="carousel-caption">
              <h2></h2>
            </div>
          </div>
        </div>
      
        <!-- Controls -->
        <a class="left carousel-control" href="#carousel1" role="button" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel1" role="button" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
      <div class="row">
        <div class="column">
          <h2>Featured Meals</h2>
          <div class="content">
            <img src="images/meal1.jpeg" width=200px>
            <h3 class="meal_title">Cauliflower Tacos</h3>
            <p>These tacos are the perfect vegan version of fish tacos. With crispy cauliflower, pickled slaw,
              and spicy mayo, expect freshness and heat in every bite!
            </p>
          </div>
          <div class="content">
            <img src="images/meal2.jpeg" width=200px>
            <h3 class="meal_title">Citrus-Glazed Chicken</h3>
            <p>You've never had chicken like this before! Marinated chicken thighs with Brussels sprouts topped with
              a sweet and sticky irresistible glaze.
            </p>
          </div>
          <div class="content">
            <img src="images/meal3.jpeg" width=200px>
            <h3 class="meal_title">Fettuccine Alfredo</h3>
            <p>You can never go wrong with a classic Fettuccine Alfredo pasta! With luscious alfredo 
              sauce, you can add any mix-ins you want like chicken or shrimp.
            </p>
          </div>
        </div>
        <div class="column">
          <h2>About Us</h2>
          <p>
            Due to COVID-19, off-campus students at Virginia Tech were initially unable to purchase a dining planning in order to avoid large groups 
            of people in dining halls. Considering this issue, Meals 4 You hopes to provide a resource for those off-campus students 
            who most likely do not have the time to cook meals each day or might not have the skills to do so. Through our website, students will be 
            able to navigate through different user profiles and choose to order from a selection of meals. These meals are posted and prepared by 
            students, who have a love for cooking and have the time to cook, for students, who might not have that availability. Through crowdsourcing, 
            our website takes advantage of the diverse 
            Virginia Tech student population, specifically those who enjoy creating meals and cooking for others, and matching them with the demand 
            from off-campus students who aren’t able to purchase a dining plan and lack easy access to meals.
          </p>
        </div>
      </div>      
    </body>
</html>
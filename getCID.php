<?php
  $searchQuery = "";
  if (isset($_POST["submit2"])) {
      if(isset($_POST["searchVal"])) {
        $searchQuery=$_POST["searchVal"];
      }

       header("HTTP/1.1 307 Temporary Redirect");
       header("Location: searchResults.php");
  }

  

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Money Analysis Graph</title>
        <meta charset="utf-8" />
        <meta name="author" content="Sarah Deacon" />
        <meta name="keywords" content="money, analysis, day" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/bootstrap.min.css" rel="stylesheet" />
        <link href="css/bootstrap.css" rel="stylesheet" />

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
          #body{
            padding-left: 15px;
            background-color: peachpuff;
            padding-bottom: 15px;
            padding-top: 2px;
            /*border: black 2px solid;*/
            margin-right: 50px;
            margin-left:50px;
            margin-bottom: 25px;
            border: 2px solid grey;
            border-top:none;
          }
          #title{
            text-align: center;
          }
          body{
            background-image: url('food.jpeg');
          }
          #background{
            background-color: white;
            padding-top: 25px;
          }
         
          #title2{
            border: 2px solid grey;
            background-color: white;
            padding-bottom: 10px;
            margin-right: 50px;
            margin-left:50px;
            
          }
          
          </style>

        <script src="jquery-3.1.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>

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
            <a class="navbar-brand" href="#">
              <img alt="Logo" src="logo3.png" width=90px>
            </a>
          </div>
      
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <li><a href="home.php">Home <span class="sr-only">(current)</span></a></li>
              <li><a href="exploreProfiles.php">Profiles</a></li>
              <li class="active"><a href="#">Meals</a></li>
              <li><a href="your_requests.php">Requests</a></li>
            </ul>
            <form class="navbar-form navbar-left" method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
              <div class="form-group">
                <input type="text" name="searchVal" class="form-control" placeholder="Search for a meal">
              </div>
              <button type="submit" name="submit2" class="btn btn-default">Search</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
            <li><a href="Profile.php">My Profile</a></li>
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
        </nav>

    <div id="title2"><h1 id="title">Money Analysis User Selection</h1></div>
    <div id="body">
    <h3>Select User:</h3>


    <form method="get" action="moneyChart.php">
        <strong>Who's money analyis would you like to view?</strong> <select name="cid">
            <option value="">Select</option>
            <?php
                require_once("db.php");
                $sql = "select distinct requestercid from mealrequest order by requestercid asc";
                $result =  $mydb->query($sql);

                while($row = mysqli_fetch_array($result)){
                    echo "<option value='".$row['requestercid']."'>".$row['requestercid']."</option>";
                  };
            ?>
        </select>
        <br><br>
        <input type="submit" name="submit" value="Submit">
    </form>

</body>
</html>
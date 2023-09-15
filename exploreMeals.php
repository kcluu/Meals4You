<?php
  $searchQuery = "";
  if (isset($_POST["submit"])) {
      if(isset($_POST["searchVal"])) {
        $searchQuery=$_POST["searchVal"];
      }

       header("HTTP/1.1 307 Temporary Redirect");
       header("Location: searchResults.php");
  }

  session_start();
  $email = $_SESSION["email"];
  require_once("db.php");
  $sql="SELECT * FROM `user`
  WHERE `email` ='$email'";
  $result = $mydb->query($sql);
  $row=mysqli_fetch_array($result);
  $status = $row['Status'];

?>
<!doctype html>
<html>

<head>
    <title>Explore Meals</title>
    <meta charset="utf-8" />
    <meta name="author" content="Sarah Deacon" />
    <meta name="keywords" content="exlore, meala" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/bootstrap.css" rel="stylesheet" />
    
    <style>
        .navbar-brand {
            padding: 0px;
        }
        .navbar-brand>img {
            height: 100%;
            padding: 5px;
            width: auto;
        }
        #header{
            text-align: center;
        }
        #name{
            text-align:left;
            font-family: verdana;
            font-weight: bold;
            color: grey;
        }
        #body{
            padding-left: 55px;
            padding-right: 55px;
            padding-bottom: 25px;
        }
        #profile{
            background-color:peachpuff;
            border: 2px solid grey;
            border-top:none;
        }
        body{
            background-image: url('food.jpeg');
        }
        #title2{
            border: 2px solid grey;
            background-color: white;
            padding-bottom: 10px;
            margin-right: 40px;
            margin-left:40px;
        }
        #info{
            text-align:left;
            font-family: verdana;
            color: grey;
        }
        #buttons{
            /*margin-left: 120px; */
            font-size: 18px;
            text-align:center;
          }
    </style>


    
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
        <div class="container-fluid content">
        
        <div id="title2"><h1 id="header">Explore Meals</h1>

        <div id="buttons">
        <a href="mealRequestForm.php" style="color: rgb(240, 64, 85); background: #EFEFEF; border-color: #333333; border-style: solid; border-width: thin; padding: 3px; color: #333333">Request a Meal</a>&nbsp
        <a href="Review List.php" style="color: rgb(240, 64, 85); background: #EFEFEF; border-color: #333333; border-style: solid; border-width: thin; padding: 3px; color: #333333">Review of Meals</a>&nbsp
        <a href="Leave a Review.php" style="color: rgb(240, 64, 85); background: #EFEFEF; border-color: #333333; border-style: solid; border-width: thin; padding: 3px; color: #333333">Leave a Review</a>
        </div>
        
        
        </div>

        <div id="body">

        
        <?php
            require_once("db.php");

            $sql = "select meal, mealdescription, price, img_url from mealchoices";
            $result = $mydb->query($sql);
            echo'<div class="row" id="profile">';
              while($row = mysqli_fetch_array($result)){  
                    
                    echo'<div class="col-sm-6 col-md-3 col-lg-3">';
                    if(empty($row['img_url'])){

                        echo'<img class="img-square" src="nomeal.png" width=200 height=200 alt="Profile image">';
                     
                    } 
                   else{
                      
                        echo'<img class="img-square" src="'.$row['img_url'].'" width=200 height=200 alt="Meal image" class="user">';
                      

                  }
                      echo'<p id="name">';

                            echo $row["meal"];
                    echo'</p>';
                    echo '<p id="info">'.$row["mealdescription"].'<br>Price:&nbsp$'.$row["price"].'</p>';
                    echo'</div>';
                 
              }

            
            echo'</div>';
               
        ?>

        
        </div>
</div>
</body>

</html>
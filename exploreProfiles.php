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
    <title>Explore Profiles</title>
    <meta charset="utf-8" />
    <meta name="author" content="Sarah Deacon" />
    <meta name="keywords" content="exlore, profiles" />
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
        .user{
            border-radius: 50%;
        }
        .chef-img{
          border-radius: 50%;
        }
        .user-img{
          border-radius: 50%;
        }
    </style>


    <script src="jquery-3.1.1.min.js"></script>
    <script>
      $(function(){
        var tempImg = "";
        $(".img-circle").mouseover(function(){
                  this.src="chef.png";
              });
              $(".img-circle").mouseout(function(){
                  this.src="profile.png";
              });
        $(".user").mouseover(function(){
                  this.src="user.png";
              });
              $(".user").mouseout(function(){
                  this.src="profile.png";
              });
      
        $(".chef-img").mouseover(function(){
            tempImg=this.src;
            this.src="chef.png";
          });
          $(".chef-img").mouseout(function(){
              this.src=tempImg;
          });
        $(".user-img").mouseover(function(){
            tempImg=this.src;
            this.src="user.png";
          });
          $(".user-img").mouseout(function(){
              this.src=tempImg;
          });
      })
    </script>

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
              <li class="active"><a href="#">Profiles</a></li>
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
        
        <div class="container-fluid content">
        <div id="title2"><h1 id="header">Explore Profiles</h1></div>

        <div id="body">
        <?php
            require_once("db.php");

            $sql = "select `firstname`, `lastname`,'email', `status`, `img_url` from user where status='Chef' or status='User'";
            $result = $mydb->query($sql);
            echo'<div class="row" id="profile">';
              while($row = mysqli_fetch_array($result)){  
                    
                    echo'<div class="col-sm-6 col-md-3 col-lg-3">';
                    if(empty($row['img_url'])){
                      if($row['status']=="Chef"){
                        echo'<img class="img-circle" src="profile.png" width=200 alt="Profile image">';
                      }
                      else{
                        echo'<img class="user" src="profile.png" width=200 alt="Profile image" class="user">';
                      }
                    } 
                   else{
                      if($row['status']=="Chef"){
                        echo'<img class="chef-img" src="'.$row['img_url'].'" width=200 height=200 alt="Profile image">';
                      }
                      else{
                        echo'<img class="user-img" src="'.$row['img_url'].'" width=200 height=200 alt="Profile image" class="user">';
                      }

                  }
                      echo'<p id="name">';
                            echo $row["firstname"]." ".$row["lastname"];
                    echo'</p>';
                    echo'</div>';
                 
              }

            
            echo'</div>';
               
        ?>
        </div>
</div>
</body>

</html>
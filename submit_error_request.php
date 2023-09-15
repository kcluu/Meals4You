<?php
$searchQuery = "";
if (isset($_POST["submitSearch"])) {
    if(isset($_POST["searchVal"])) {
      $searchQuery=$_POST["searchVal"];
    }

     header("HTTP/1.1 307 Temporary Redirect");
     header("Location: searchResults.php");
}
    $title = "";
    $description = "";
    $cid = 0;
    $status = "";

    session_start();
    $email = $_SESSION["email"];
    require_once("db.php");
    $sql="SELECT * FROM `user`
    WHERE `email` ='$email'";
    $result = $mydb->query($sql);
    $row=mysqli_fetch_array($result);
    $cid = $row['CID'];
    $status=$row['Status'];

    if (isset($_POST["submit"])) {
        if(isset($_POST["title"])) $title=$_POST["title"];
        if(isset($_POST["description"])) $description=$_POST["description"];

        require_once("db.php");
        $sql2 = "INSERT INTO `errorrequest`(`ErrorRequestTitle`, `ErrorRequestStatus`, `DateOfError`, `ErrorRequestDescription`, `CID`)
                VALUES('$title', 0, NOW(), '$description', $cid)";
        $result2 = $mydb->query($sql2);
        Header("Location:your_requests.php");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Submit an Error Request</title>
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

    label.pendingRequest {
        padding-right: 15px;
    }
    button {
        font-size: 10px;
    }

    p.status {
        font-size: 10px;
        font-style: italic;
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
    #background{
      background-color: white;
      padding-top: 25px;
    }
    body{
            background-image: url("images/food.jpeg")
          }
    #title2{
      border: 2px solid grey;
      background-color: white;
      padding-bottom: 10px;
      margin-right: 50px;
      margin-left:50px;
      
    }
    #title{
            text-align: center;
          }

  .arc path {
    stroke: #fff;
  }

  .legend rect {
    fill:white;
    stroke:black;
  }

  .bar {
  fill: steelblue;
}

.bar:hover {
  fill: brown;
}

.axis--x path {
  display: none;
}
#graph {
  background-color: white;
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
              <li class="active"><a href="your_requests.php">Requests</a></li>
            </ul>
            <form class="navbar-form navbar-left" method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
              <div class="form-group">
                <input type="text" name="searchVal" class="form-control" placeholder="Search for a meal">
              </div>
              <button type="submit" name="submitSearch" class="btn btn-default">Search</button>
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
        <div id='title2'><h1 id='title'>Submit a Help Ticket</h1></div>
        <div id='body'>
          <div class='row'>
              <div class='column'>
                  <div class='section1'>
                  </br>
                  <form method='post' action="<?php $_SERVER['PHP_SELF']; ?>">
                      <div class='content' id='username' >
                          <label class='label1'>Enter title of request: </label>
                          <input type='text' name='title'></input>
                      </div>
                    </br>
                      <div class='content' id='lastname' >
                        <label class='label1'>Enter a description of the problem: </label>
                        <textarea id='modifications' name='description' rows='4' cols='70'></textarea>
                      </div>
                        <input type='submit' name='submit' value='Submit' />
                      </br>  
                  </div> 
                  </form>
              </div>
            </div>      
          </div>
    </body>
</html>
 
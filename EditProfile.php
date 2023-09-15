<?php
$searchQuery = "";
if (isset($_POST["submitSearch"])) {
    if(isset($_POST["searchVal"])) {
      $searchQuery=$_POST["searchVal"];
    }

     header("HTTP/1.1 307 Temporary Redirect");
     header("Location: searchResults.php");
}
 
  session_start();

  $email = $_SESSION["email"];
  $firstname = "";
  $lastname = "";
  $address = "";
  $city = "";
  $zip = "";
  $state = "";
  $country = "";
  $status = "";
  $pass = "";
  $image = "";
  $id = 0;

  require_once("db.php");
  $sql = "select * from user where Email = '$email'";
  $result = $mydb->query($sql);
  $row = mysqli_fetch_array($result);
  $id = $row['CID'];
  $firstname = $row['FirstName'];
  $lastname = $row['LastName'];
  $address = $row['StreetAddress'];
  $city = $row['City'];
  $zip = $row['PostalCode'];
  $state = $row['State'];
  $country = $row['Country'];
  $status = $row['Status'];
  $pass = $row['CPassword'];
  $image = $row['img_url'];

    if (isset($_POST["submit"])) {
        if(isset($_POST["firstname"])) $firstname=$_POST["firstname"];
        if(isset($_POST["lastname"])) $lastname=$_POST["lastname"];
        if(isset($_POST["email"])) $email=$_POST["email"];
        if(isset($_POST["address"])) $address=$_POST["address"];
        if(isset($_POST["city"])) $city=$_POST["city"];
        if(isset($_POST["zip"])) $zip=$_POST["zip"];
        if(isset($_POST["state"])) $state=$_POST["state"];
        if(isset($_POST["country"])) $country=$_POST["country"];
        if(isset($_POST["status"])) $status=$_POST["status"];
        if(isset($_POST["pass"])) $pass=$_POST["pass"]; 
        if(isset($_POST["image"])) $image=$_POST["image"]; 

        header("Location: Profile.php");
    }

    require_once("db.php");

    if(isset($firstname)){
      $sql = "update user set FirstName = '$firstname' where user.CID = $id";
      $result=$mydb->query($sql);
    }
    if(isset($_POST["lastname"])) {
      $sql = "update user set LastName = '$lastname' where user.CID = $id";
      $result=$mydb->query($sql);
    }
    if(isset($_POST["email"])) {
      $sql = "update user set Email = '$email' where user.CID = $id";
      $result=$mydb->query($sql);
    }
    if(isset($_POST["pass"])) {
      $sql = "update user set CPassword = '$pass' where user.CID = $id";
      $result=$mydb->query($sql);
    }
    if(isset($_POST["address"])) {
      $sql = "update user set StreetAddress = '$address' where user.CID = $id";
      $result=$mydb->query($sql);
    }
    if(isset($_POST["city"])) {
      $sql = "update user set City = '$city' where user.CID = $id";
      $result=$mydb->query($sql);
    }
    if(isset($_POST["state"])) {
      $sql = "update user set State = '$state' where user.CID = $id";
      $result=$mydb->query($sql);
    }
    if(isset($_POST["country"])) {
      $sql = "update user set Country = '$country' where user.CID = $id";
      $result=$mydb->query($sql);
    }
    if(isset($_POST["zip"])) {
      $sql = "update user set PostalCode = '$zip' where user.CID = $id";
      $result=$mydb->query($sql);
    }
    if(isset($_POST["status"])) {
      $sql = "update user set Status = '$status' where user.CID = $id";
      $result=$mydb->query($sql);
    }
    if(isset($_POST["image"])) {
      $sql = "update user set img_url = '$image' where user.CID = $id";
      $result=$mydb->query($sql);
    }

?>


<!DOCTYPE html>
<html>
    <head>
        <title>Update Profile</title>
        <meta charset="utf-8" />
        <meta name="author" content="Paige Zeidman" />
        <meta name="keywords" content="form" />
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
            padding-bottom: 25px;
            padding-top: 2px;
            /*border: black 2px solid;*/
            margin-right: 450px;
            margin-left:450px;
            margin-bottom: 25px;
            border: 2px solid grey;
            /*border-top:none;*/
          }
          #title{
            text-align: center;
          }
          body{
            background-image: url('food.jpeg');
          }
          #background{
            padding-left: 15px;
            padding-bottom: 25px;
            /*border: black 2px solid;*/
            margin-right: 25px;
            margin-left:25px;
            margin-bottom: 25px;
            border: 2px solid grey;
            /*border-top:none;*/
            background-color: white;
            padding-top: 25px;
          }
          #mealImg{
            position: fixed;
            right:12%;
            top:23%;
            width: 450px;
          }
          #centerForm {
            margin-left: 90px;
          }
          #centerPass {
            margin-left: 60px;
          }
          #createAccount, #login{
            display:inline-block;
          }
          #buttons{
            margin-left: 120px;
            font-size: 18px;
          }
          .errlabel {color:black};

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
              <img alt="Logo" src="logo.PNG" width=90px>
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

        <div id="background">
            <div id="title"><h1>UPDATE PROFILE</h1></div>
            <br />
        </div>

            <div id="body">
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
  
                <div id="centerForm">   
                    <h2>Update Personal Information</h2> 
                    <div id="fname">
                        <label>First Name:</label>
                        <input name="firstname" type="text" value="<?php echo $firstname; ?>"/>
                    </div>

                    <div id="lname">
                         <label>Last Name:</label>
                        <input name="lastname" type="text" value="<?php echo $lastname; ?>"/>
                        <br />
                    </div>

                    <div id="street">
                        <label>Street Address:</label>
                        <input type="text" name="address" value="<?php echo $address; ?>"/>
                    </div>

                    <div id="city">
                        <label>City:</label>
                        <input type="text" name="city" value="<?php echo $city; ?>"/>
                    </div>

                    <div id="state">
                        <label>State:</label>
                        <input type="text" name="state" maxlength="2" size="2" value="<?php echo $state; ?>"/>
                        <br />
                    </div>

                    <div id="zip">
                        <label>Zip Code:</label>
                        <input type="text" name="zip" maxlength="5" size="5" value="<?php echo $zip; ?>"/>
                    </div>

                    <div id="country">
                        <label>Country:</label>
                        <input type="text" name="country" value="<?php echo $country; ?>"/>
                        <br />
                    </div>

                    <div id="status">
                        <label>Select Status</label>
                        <input type="radio" name="status" value="Chef" <?php if($status=="Chef") echo "checked"; ?>/><label>Chef Status</label>
                        <input type="radio" name="status" value="User" <?php if($status=="User") echo "checked"; ?>/><label>User Only</label>
                        <br />
                    </div>

                    <div id="image">
                      <label>Profile Picture URL:</label>
                      <input type="text" name="image" value="<?php echo $image; ?>"/>
                      <br />
                      <br />
                    </div>

                    <h2>Update Login Information</h2>
                    <div id="email">
                        <label>Email:</label>
                        <input type="text" name="email" value="<?php echo $email; ?>"/>
                        <br />
                    </div>

                    <div id="pass">
                        <label>Password:</label>
                        <input type="text" name="pass" value="<?php echo $pass; ?>"/>
                        <br />
                        <br />
                    </div>
                </div>

                <div id="button">
                    <input type="submit" name="submit" value="Update Profile" />
                    <a href="Profile.php" style="color: rgb(240, 64, 85); background: #EFEFEF; border-color: #333333; border-style: solid; border-width: thin; padding: 3px; color: #333333">Cancel</a>
                    <br />
                </div>
                </form>
            </div>

    </body>
</html>
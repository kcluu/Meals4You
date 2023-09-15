<?php
  $firstname = "";
  $lastname = "";
  $email = "";
  $address = "";
  $city = "";
  $zip = "";
  $state = "";
  $country = "";
  $status = "";
  $pass = "";
  $image = "";
  $err = false;

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


      if(!empty($firstname) && !empty($lastname) && !empty($status) && !empty($email) && !empty($address) && !empty($city) && !empty($zip) && !empty($state) && !empty($country) && !empty($pass) ) {
        
        require_once("db.php");

        $sql = "insert into user(FirstName, LastName, Email, CPassword, StreetAddress, City, State, Country, PostalCode, Status, img_url) 
            values('$firstname', '$lastname', '$email', '$pass', '$address', '$city', '$state', '$country', '$zip', '$status', '$image')";

        $result=$mydb->query($sql);

        if ($result==1) {
            session_start();
            $_SESSION["email"] = $email;
        }
        
        
        header("HTTP/1.1 307 Temprary Redirect"); 
        header("Location: Profile.php");
      } else {
        $err = true;
      }
      
  }
 ?>

<!doctype html>
<html>
<head>
  <title>Create Account</title>
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
        padding-bottom: 15px;
            /*border: black 2px solid;*/
        margin-right: 25px;
        margin-left:25px;
        margin-bottom: 25px;
        border: 2px solid grey;
            /*border-top:none;*/
        background-color: white;
        padding-top: 15px;
        font-size: 15px;
    }
    #mealImg{
        position: fixed;
        right:12%;
        top:23%;
        width: 450px;
    }
    #centerForm {
        padding-top: 25px;
        margin-left: 100px;
    }
    #fname, #lname{
        display:inline-block;
    }
    #street, #city, #state{
        display:inline-block;
    }
    
    #zip, #country{
        display:inline-block;
    }
    
    #button{
        margin-left: 155px;
        font-size: 18px;
    }
    .errlabel {color:red;}
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
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>

<div id="background">
    <div id="title"><h1>CREATE ACCOUNT</h1></div>
    <br />
</div>

<div id="body">
<form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
  
    <div id="centerForm">   
    <h2>Personal Information</h2> 
    <div id="fname">
        <label>First Name:</label>
        <input name="firstname" type="text" value="<?php echo $firstname; ?>"/>
        <?php
            if ($err && empty($firstname)) {
                echo "<label class='errlabel'>Error: Please enter a first name</label>";
            }
        ?>
    </div>

    <div id="lname">
        <label>Last Name:</label>
        <input name="lastname" type="text" value="<?php echo $lastname; ?>"/>
        <?php
            if ($err && empty($lastname)) {
            echo "<label class='errlabel'>Error: Please enter a last name</label>";
            }
        ?>
        <br />
    </div>

    <div id="street">
        <label>Street Address:</label>
        <input type="text" name="address" value="<?php echo $address; ?>"/>
        <?php
            if ($err && empty($address)) {
                echo "<label class='errlabel'>Error: Please enter a street address</label>";
            }
        ?>
    </div>

    <div id="city">
        <label>City:</label>
        <input type="text" name="city" value="<?php echo $city; ?>"/>
        <?php
            if ($err && empty($city)) {
                echo "<label class='errlabel'>Error: Please enter a city</label>";
            }
        ?>
    </div>

    <div id="state">
        <label>State:</label>
        <input type="text" name="state" maxlength="2" size="2" value="<?php echo $state; ?>"/>
        <?php
            if ($err && empty($state)) {
                echo "<label class='errlabel'>Error: Please enter a state</label>";
            }
        ?>
        <br />
    </div>

    <div id="zip">
        <label>Zip Code:</label>
        <input type="text" name="zip" maxlength="5" size="5" value="<?php echo $zip; ?>"/>
        <?php
            if ($err && empty($zip)) {
                echo "<label class='errlabel'>Error: Please enter a zip code</label>";
            }
        ?>
    </div>

    <div id="country">
        <label>Country:</label>
        <input type="text" name="country" value="<?php echo $country; ?>"/>
        <?php
            if ($err && empty($country)) {
                echo "<label class='errlabel'>Error: Please enter a country</label>";
            }
        ?>
        <br />
    </div>

    <div id="status">
        <label>Select Status</label>
        <input type="radio" name="status" value="Chef" <?php if($status=="Chef") echo "checked"; ?>/><label>Chef Status</label>
        <input type="radio" name="status" value="User" <?php if($status=="User") echo "checked"; ?>/><label>User Only</label>
        <?php
            if ($err && empty($status)) {
                echo "<label class='errlabel'>Error: Please choose an option</label>";
            }
        ?>
        <br />
    </div>

    <div id="image">
        <label>Profile Picture URL:</label>
        <input type="text" name="image" value="<?php echo $image; ?>"/>
        <br />
        <br />
    </div>

    <h2>Login Information</h2>
    <div id="email">
        <label>Email:</label>
        <input type="text" name="email" value="<?php echo $email; ?>"/>
        <?php
            if ($err && empty($email)) {
                echo "<label class='errlabel'>Error: Please enter a valid email</label>";
            }
        ?>
        <br />
    </div>

    <div id="pass">
        <label>Password:</label>
        <input type="text" name="pass" value="<?php echo $pass; ?>"/>
        <?php
            if ($err && empty($pass)) {
                echo "<label class='errlabel'>Error: Please enter a password</label>";
            }
        ?>
        <br />
        <br />
    </div>
</div>

<div id="button">
    <input type="submit" name="submit" value="Join Meals 4 You!" />
    <br />
</div>
</form>
</div>
</body>
</html>
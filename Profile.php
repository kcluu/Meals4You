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

?>

<!DOCTYPE html>

<html>
<head>
<title>Profile</title>
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
            margin-right: 500px;
            margin-left:500px;
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
          #center {
            margin-left: 90px;
          }
          #centerPass {
            margin-left: 60px;
          }
          #createAccount, #login{
            display:inline-block;
          }
          #buttons{
            font-size: 18px;
            text-align: center;
          }
          .errlabel {color:black};

          </style>

        <script src="jquery-3.1.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script> 
        <script>
          function myFunction() {
            var r = confirm("Are you sure you want to delete your profile? Clicking OK your profile will be deleted permanently. Clicking Cancel will return you to your profile screen.");

            if (r == true) {
              <?php
                require_once("db.php");
                $sql = "delete from user where CID = $id";
              ?>
              window.location = "Login.php";
            }
            else {
              window.location = "Profile.php" ;
            }
    
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
              <button type="submit" name="submit" class="btn btn-default">Search</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
            <?php
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
              <li class="active"><a href="Profile.php">My Profile</a></li>
            </ul>
          </div><!-- /.navbar-collapse -->
         </div><!-- /.container-fluid -->
        </nav>


    <div id="background">
        <h1 id="title"><?php echo "<p> ".$firstname."'s Profile </p>"?></h1>
    </div>
    <div id="body">
    
        <table border: 1px>
       
            <tbody>
                <tr>
                    <td> </td>
                    <td><img src="<?php echo $image ?>" alt="No Profile Picture" width="300" height="300" /></td>
                </tr>
                <tr>
                    <td>First Name: </td>
                    <td><?php echo $firstname ?></td>
                </tr>
                <tr>
                    <td>Last Name: </td>
                    <td><?php echo $lastname ?></td>
                </tr>
                <tr>
                    <td>Address: </td>
                    <td><?php echo $address." ".$city.", ".$state." ".$zip." ".$country ?></td>
                </tr>
                <tr>
                    <td>Status: </td>
                    <td><?php echo $status ?></td>
                </tr>
                <tr>
                    <td>Email: </td>
                    <td><?php echo $email ?></td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td><?php echo $pass ?></td>
                </tr>
                <tr>
                  <td>ID: </td>
                  <td><?php echo $id ?></td></tr>
            </tbody>
        </table>
        <br />
        <div id="buttons">
           
            <a href="modify.php" style="color: rgb(240, 64, 85); background: #EFEFEF; border-color: #333333; border-style: solid; border-width: thin; padding: 3px; color: #333333">Modify/Delete a Request</a>
            <a href="Manage Reviews.php" style="color: rgb(240, 64, 85); background: #EFEFEF; border-color: #333333; border-style: solid; border-width: thin; padding: 3px; color: #333333">Manage Your Reviews</a>
            <br/>
            <br/>
            <a href="getCID.php" style="color: rgb(240, 64, 85); background: #EFEFEF; border-color: #333333; border-style: solid; border-width: thin; padding: 3px; color: #333333">Money Analysis</a>
            <br/> 
            <br/>           
            <a href="EditProfile.php" style="color: rgb(240, 64, 85); background: #EFEFEF; border-color: #333333; border-style: solid; border-width: thin; padding: 3px; color: #333333">Edit Profile</a>
            
            <a href="Login.php" style="color: rgb(240, 64, 85); background: #EFEFEF; border-color: #333333; border-style: solid; border-width: thin; padding: 3px; color: #333333">Log Out</a>
            <button onclick="myFunction()">Delete Profile</button>
            
        </div>
    </div>

</body>
</html>
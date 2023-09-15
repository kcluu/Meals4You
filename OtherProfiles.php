<?php

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
    $meal = "";
    $mealdesc = "";
    $price = 0;
    $count = 0;

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


    $sql2 = "SELECT count(*) as count FROM mealchoices WHERE CID = $id";
    $result2 = $mydb->query($sql2);
    $row2 = mysqli_fetch_array($result2);
    $count = $row2['count'];

    $sql3 = "SELECT user.CID, user.FirstName, mealchoices.meal, mealchoices.MealDescription, mealchoices.price
            FROM user INNER JOIN mealchoices
                ON mealchoices.CID = user.CID
            WHERE user.CID = $id";
    $result3 = $mydb->query($sql3);
 
    
    $i = 0;
    while ($row3 = mysqli_fetch_array($result3)) {

      ${"meal$i"} = $row3['meal'];
      ${"mealDesc$i"} = $row3['MealDescription'];
      ${"price$i"} = $row3['price'];
      $i++;
    }
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
            margin-left: 75px;
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
              <li class="active"><a href="#">Home <span class="sr-only">(current)</span></a></li>
              <li><a href="#">Profiles</a></li>
              <li><a href="#">Requests</a></li>
            </ul>
            <form class="navbar-form navbar-left">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Search">
              </div>
              <button type="submit" class="btn btn-default">Search</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
              <li><a href="Profile.php">My Profile</a></li>
            </ul>
          </div><!-- /.navbar-collapse -->
         </div><!-- /.container-fluid -->
        </nav>


    <div id="background">
        <h1 id="title"><?php echo "<p> ".$firstname."'s Profile </p>"?></h1>
    </div>
    <div id="body">
        <div id="center">
        <table border="1">
       
            <tbody>
                <tr>
                    <td>Profile Picture: </td>
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
                    <td>Status: </td>
                    <td><?php echo $status ?></td>
                </tr>
                
                <?php
                if ($status == "Chef") { 
                    echo '<tr>';
                        echo '<td>Meals: </td>';
                        echo '<td>';
                        for ($j = 0; $j < $count; $j++) {
                          echo ${"meal$j"}." ";
                          echo ${"price$j"};
                          echo "<br/>";
                        }
                    echo '</td>';
                    echo '</tr>';
                  }
                ?>
                
            </tbody>
        </table>
        </div>
        <br />
        <div id="buttons">
        <a href="#" style="color: rgb(240, 64, 85); background: #EFEFEF; border-color: #333333; border-style: solid; border-width: thin; padding: 3px; color: #333333">Request a Meal</a>
        
        </div>
    </div>

</body>
</html>
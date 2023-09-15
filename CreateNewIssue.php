<?php
    $response = ""; 
    $employeeid=0; 
    $errorid = 0; 
    $formError = false ;


    if(isset($_POST["submit"])){
      if(isset($_POST["responseText"])) $response = $_POST["responseText"];
      if(isset($_POST["EID"])) $employeeid = $_POST["EID"];
      if(isset($_POST["ErrID"])) $errorid = $_POST["ErrID"];
    
    if (!empty($employeeid) && ($errorid)>=0 && !empty($response)){
        header("HTTP/1.1 307 Temporary Redirect") ;
        Header("Location: CreateIssueHandler.php");
    }
    else {
      $formError = true; 
    }
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

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Issue Submission Page</title>
            <meta charset="utf-8" />
            <meta name="author" content="Jacob Gann" /> 
            <meta name="keywords" content="issue, submission, error, request, meal" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> 
            <link href="css/bootstrap.min.css" rel="stylesheet" />
            <link href="css/bootstrap.css" rel="stylesheet" />
            <script src="jquery-3.1.1.min.js"></script>
            <script src="js/bootstrap.min.js"></script>
            <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
      <script>
                  //populating with details 
                  $(function(){
                    $("#errdet").change(function(){
                      var errd = $("#errdet").val(); 
                      if(errd == 0){
                        $("#details").html(""); 
                      } else{
                      $.ajax({
                        url: "details.php?ErrID="+errd, 
                        async: true, 
                        success: function(result){
                            $("#details").html(result);
                          
                      }    
                      })
                      }
                    });
                  })
                  </script>
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
      body {
  background-image: url("images/food.jpeg");
   }
      .content{
        margin: auto;
        width: 50%;
        border: 30px solid transparent;
    background-color: #f2eae8;
      }
      .php{
        position: relative;
  left: 50px; 
      }
      <style>
        .errlabel {color:red;}
  
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
                <li><a href="home.php">Home <span class="sr-only">(current)</span></a></li> <!--Home link-->
                <li><a href="exploreProfiles.php">Profiles</a></li> <!-- Profile Link -->
                <li><a href="exploreMeals.php">Meals</a></li>
                <li><a href="your_requests.php">Requests</a></li><!-- Request Link -->
              </ul>
              
              <ul class="nav navbar-nav navbar-right">
              <?php
              if ($status == "Employee") {
                echo "<li class='active'><a href='ExistingServiceRequests.php'>Manage Service Requests</a></li>";
              }
            ?>
                <li><a href="Profile.php">My Profile</a></li> <!-- Profile Link -->
              </ul>
            </div><!-- /.navbar-collapse -->
           </div><!-- /.container-fluid -->
          </nav>

  <div class ="content">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>" >
          <h1 style="color: rgb(240, 64, 85);">Issue Submission Page </h1>
          <p id="pname" style="color: rgb(240, 64, 85)">Add Solution Description</p>
          <p style="color: rgb(240, 64, 85)"> Select your Employee ID and the Error you wish to respond to. </p>
          <select name="EID" style="color: rgb(240, 64, 85); background: #FFFFFF; border-style: outset; border-color:rgb(240, 64, 85);
          font: bold 15px arial,sans-serif;text-shadow:none;">
              <?php 
              echo "<option value='0'> </option>";
                  require_once("db.php");
                  $sql = "select EID from employee" ;
                  $result = $mydb->query($sql);
                  while ($row = mysqli_fetch_array($result)) 
                  {
                    echo "<option value= '".$row["EID"]."'>" .$row['EID']. "</option>";
                  }
              ?>
            </select>
            

            <select name="ErrID" id="errdet" style="color: rgb(240, 64, 85); background: #FFFFFF; border-style: outset; border-color:rgb(240, 64, 85);
            font: bold 15px arial,sans-serif;text-shadow:none;" >
                  <?php 
                  echo "<option value='0'> </option>";
                  $sql = "select * from errorrequest where ErrorRequestStatus = 0 " ;
                  $result = $mydb->query($sql);
                  while ($row = mysqli_fetch_array($result))
                  { 
                    echo "<option value = ".$row['ErrID'].">" .$row['ErrorRequestTitle']. "</option>";    
                  }
                    ?>
                  </select>
                  <br>
                  <br>

                  <div id = "details">
                  &nbsp;
                  </div>



                  <label style="color: rgb(240, 64, 85);">Solution Description:
                  <br>
                <textarea name="responseText" id="ta1" cols=75% rows=15><?php echo $response?></textarea>
                
                <?php
                //text area php lines go between text area
                    if ($formError && $response= " " ) {
                     echo "<label class='errlabel'>Error: Please enter a Solution Description.</label>";
                      }
                ?>
                </label>
                <br>
                <br>
                <input type="submit" name="submit" value="Submit" style="color: rgb(240, 64, 85); background: #FFFFFF; border-style: outset; border-color:#FFFFFF;
            font: bold 15px arial,sans-serif;text-shadow:none;">
          </form>
          <br>
          <a href="ExistingServiceRequests.php" style="color: rgb(240, 64, 85); background: #FFFFFF; border-style: outset; border-color:#FFFFFF;
     font: bold 15px arial,sans-serif;text-shadow:none;">Return to Requests</a>
  </div>
</body>
</html>
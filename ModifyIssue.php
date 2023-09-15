<?php
  $response = ""; 
  $employeeid = 0; 
  $rid = 0;
  $formError = false;
  $delMessage = "Are youe sure you want to delete this issue?";
  if(isset($_POST["submit"])){
    if(isset($_POST["responseText"])) $response = $_POST["responseText"];
    if(isset($_POST["EID"])) $employeeid = $_POST["EID"];
    if(isset($_POST["RID"])) $rid = $_POST["RID"];
  
  if (!empty($employeeid) && ($rid)>=0 && !empty($response)){
      header("HTTP/1.1 307 Temporary Redirect") ;
      Header("Location: ModifyIssueHandler.php");
  }
  else {
    $formError = true; 
  }
}
if(isset($_POST["reset"])){
  $response = ""; 
  $employeeid = 0; 
  $rid = 0;
}
if(isset($_POST["delete"])){
  if(isset($_POST["RID"])) $rid = $_POST["RID"];
  
      Header('HTTP/1.1 307 Temporary Redirect') ;
      Header('Location: DeletedIssue.php');

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
<html lang="en">
    <head>
        <title>Modify Issue</title>
            <meta charset="utf-8" />
            <meta name="author" content="Jacob Gann" /> 
            <meta name="keywords" content="issue, submission, error, request, meal" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link href="css/bootstrap.min.css" rel="stylesheet" />
            <link href="css/bootstrap.css" rel="stylesheet" />
            <script src="jquery-3.1.1.min.js"></script>
            <script src="js/bootstrap.min.js"></script> 
            <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

            <script>
                  //populating with details 
                  $(function(){
                    $("#errdet").change(function(){
                      var rd = $("#errdet").val(); 
                      if(rd == 0){
                        $("#oResp").html(""); 
                      } else{
                      $.ajax({
                        url: "moddetails.php?RID="+rd, 
                        async: true, 
                        success: function(result){
                            $("#oResp").html(result);
                          
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
                <li><a href="home.php">Home <span class="sr-only">(current)</span></a></li> <!-- Collect the nav links, forms, and other content for toggling -->
                <li><a href="exploreProfiles.php">Profiles</a></li> <!-- Collect the nav links, forms, and other content for toggling -->
                <li><a href="exploreMeals.php">Meals</a></li>
                <li><a href="your_requests.php">Requests</a></li> <!-- Collect the nav links, forms, and other content for toggling -->
              </ul>
              
              <ul class="nav navbar-nav navbar-right">
              <?php
              if ($status == "Employee") {
                echo "<li class='active'><a href='ExistingServiceRequests.php'>Manage Service Requests</a></li>";
              }
            ?>
                <li><a href="#">My Profile</a></li>
              </ul>
            </div><!-- /.navbar-collapse -->
           </div><!-- /.container-fluid -->
          </nav>
<div class = "content">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>" >
        <h1 style="color: rgb(240, 64, 85);">Modify Issue </h1>

        <p id="pname" style="color: rgb(240, 64, 85)">
        Select your employee ID and the Issue you wish to Modify
        <br>
        </p>
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

            <select name="RID" id="errdet" style="color: rgb(240, 64, 85); background: #FFFFFF; border-style: outset; border-color:rgb(240, 64, 85);
            font: bold 15px arial,sans-serif;text-shadow:none;" >
                  <?php 
                  echo "<option value='0'> </option>";
                  $sql = "select * from errorresponse Inner JOIN errorrequest ON errorresponse.ErrID = errorrequest.ErrID " ;
                  $result = $mydb->query($sql);
                  while ($row = mysqli_fetch_array($result))
                  { 
                    echo "<option value = ".$row['RID'].">" .$row['ErrorRequestTitle']. "</option>";    
                  }
                    ?>
                  </select>
      <div id = "oResp">
      &nbsp;
      </div>
      <label style="color: rgb(240, 64, 85);">Make Modifications Below:
        <br>
      <textarea name="responseText" id="ta1" cols=85% rows=15><?php echo $response?></textarea>
      <?php
                //text area php lines go between text area
                    if ($formError && $response= " " ) {
                     echo "<label class='errlabel'>Error: Please Update the Issue if you wish to submit.</label>";
                      }
                ?>
      </label>
        <br>
        <br>
        <input id="fsubmit" name = "submit" type="submit" value="Update" style="color: rgb(240, 64, 85); background: #FFFFFF; border-style: outset; border-color:#FFFFFF;
        font: bold 15px arial,sans-serif;text-shadow:none;">
            
        <input id="fcancel" name = "reset" type="reset" value="Undo Changes" style="color: rgb(240, 64, 85); background: #FFFFFF; border-style: outset; border-color:#FFFFFF;
        font: bold 15px arial,sans-serif;text-shadow:none;">

        <input id="fdelete" name = "delete" type="submit" value="Delete Issue" style="color: rgb(240, 64, 85); background: #FFFFFF; border-style: outset; border-color:#FFFFFF;
        font: bold 15px arial,sans-serif;text-shadow:none;">
    </form>
    <a href="ExistingServiceRequests.php" style="color: rgb(240, 64, 85); background: #FFFFFF; border-style: outset; border-color:#FFFFFF;
     font: bold 15px arial,sans-serif;text-shadow:none;">Return to Requests</a>
</div>
</body>

</html>
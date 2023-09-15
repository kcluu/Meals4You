<?php
    session_start();
    $email = $_SESSION["email"];
    $rvid=0;
    
    if(isset($_POST["modify1"]) == "Modify This Review"){
      if(isset($_POST["specReview"])) $_SESSION["rvid"]=$_POST["specReview"];
      $rvid = $_SESSION["rvid"];
      if($rvid!=0) {
        header("HTTP/1.1 307 Temprary Redirect"); 
        header("Location: Modify Review.php");
      } 
      else{
        echo '<script type="text/javascript">','alert("Please select a review to modify");','</script>';
      }
    }else if(isset($_POST["delete1"]) == "Delete This Review"){
      if(isset($_POST["specReview"])) $_SESSION["rvid"]=$_POST["specReview"];
      $rvid = $_SESSION["rvid"];
      if($rvid!=0) {
        header("HTTP/1.1 307 Temprary Redirect"); 
        header("Location: Delete Review.php");
      } 
      else{
        echo '<script type="text/javascript">','alert("Please select a review to delete '.$rvid.'");','</script>';
      }
    }
    

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Manage Reviews</title>
        <meta charset="utf-8" />
        <meta name="author" content="Jack Hartmann" /> 
        <meta name="keywords" content="home, recipe, student, service, food" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/bootstrap.min.css" rel="stylesheet" />
        <link href="css/bootstrap.css" rel="stylesheet" />
        <script src="jquery-3.1.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </head>
    <style>
      .orange{background-color:orange; color:white;}
      .lightorange{background-color:#fbe4d5;}

      *   {
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
        padding-bottom: 15px;
        padding-top: 2px;
        margin-right: 20%;
        margin-left:20%;
        margin-bottom: 25px;
        border-top:none;
      }
      #title{
        padding-top: 25px;
        text-align: center;
        background-color: peachpuff;
      }
      body{
        background-image: url('food.jpeg');
      }
      #title2{
        background-color: peachpuff;
        padding-bottom: 10px;
        margin-right: 20%;
        margin-left:20%;
      }
      table, th, td {
        border: 1px solid black;
        text-align: center;
      }
    </style> 
    <script>
      $(function(){  
          $("#input").change(function() {
              var rvid = $('#input').val();
              try {
                  $.ajax({
                  url:"manage2.php?rvid="+rvid,    
                  async:true,        
                  success: function(rvid){          
                  $("#contentArea").html(rvid);      
                  }
                  })
              }
              catch (err) {document.getElementById("error").innerHTML = err.message;}
          })
      })

      function initiate(rvid){              
          try {
            $.ajax({
              url:"manage2.php?rvid="+rvid,    
              async:true,         
              success: function(rvid){           
              $("#contentArea").html(rvid);     
              }
            })
          }
        catch (err) {document.getElementById("error").innerHTML = err.message;}
      }

      function modifyFunction(){
        document.location.href = "Modify Review.php";
      }

      function deleteFunction(){
        document.location.href = "Delete Review.php";
      }

      function backFunction(){
        document.location.href = "Profile.php";
      }
    </script>
    <body onload="initiate(0)">
    <nav class="navbar navbar-default">
      <div class="container-fluid">
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
          <li><a href="Profile.php">My Profile</a></li>
        </ul>
      </div>
      </div>
    </nav>
    <div id="title2"><h1 id="title">Manage Reviews</h1></div>
    <div id="body"> 
    <form name="myForm" method="post" id="form1" action="<?php echo $_SERVER['PHP_SELF']?>">
    <section>
    <label for="specReview"><h4>Look at a Specific Review:</h4></label>
    <select name="specReview" id="input">
      <option value=0>All Reviews</option>
      <?php          
        session_start();
        $email = $_SESSION["email"];
        require_once("db.php");
        
        $sql = "SELECT RVID, ReviewTitle 
                FROM review 
                INNER JOIN user
                  ON review.CID = user.CID 
                  WHERE email='$email'
                  ORDER BY review.DateOfReview DESC";

        $result=$mydb->query($sql);
        while($row = mysqli_fetch_array($result)){
            echo "<option value='".$row["RVID"]."'>".$row["ReviewTitle"]."</option>";
        }
        
      ?>
    </select>
    <input type="submit" name="modify1" value="Modify This Review">
    <input type="submit" name="delete1" value="Delete This Review">
    <input type="button" value="Back" onclick="backFunction()" />
    </section>
    <div id="contentArea">&nbsp;
    </div>
    </div>
    </body>
</html>
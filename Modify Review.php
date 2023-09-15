<?php
    session_start();
    $email = $_SESSION["email"];
    $rvid = $_SESSION["rvid"];
    $star = "";
    $rTitle = "";
    $rDez = "";

    if(isset($_POST["star"])) $star=$_POST["star"];
    if(isset($_POST["reviewTitle"])) $rTitle=$_POST["reviewTitle"];
    if(isset($_POST["reviewDescription"])) $rDez=$_POST["reviewDescription"];

    if (isset($_POST["modify2"])) {
      if(isset($_POST["star"])) $star=$_POST["star"];
      if(isset($_POST["reviewTitle"])) $rTitle=$_POST["reviewTitle"];
      if(isset($_POST["reviewDescription"])) $rDez=$_POST["reviewDescription"];

      if(!empty($star) && !empty($rTitle) && !empty($rDez)) {
        header("HTTP/1.1 307 Temprary Redirect"); 
        header("Location: modify2.php");
      } else {
        echo '<script type="text/javascript">','alert("Please ensure all fields are filled out");','</script>';
      }
  }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Modify Review</title>
        <meta charset="utf-8" />
        <meta name="author" content="Jack Hartmann" /> 
        <meta name="keywords" content="home, recipe, student, service, food" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/bootstrap.min.css" rel="stylesheet" />
        <link href="css/bootstrap.css" rel="stylesheet" />
        <script src="jquery-3.1.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </head>
    <style>
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
          [type=radio] { 
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
          }          
          [type=radio] + img {
            cursor: pointer;
          }
          /* [type=radio]:checked + img {
            outline: 2px solid #f00;
          } */
          #description{ 
            vertical-align: top;
          }
    </style>
    <script>
      $(document).ready(function() { 
        if($('input[name="star"]:checked').val()=="one"){
          $("#img-1").attr("src","filled star.jpg");
          $("#img-2").attr("src","empty star.jpg");
          $("#img-3").attr("src","empty star.jpg");
          $("#img-4").attr("src","empty star.jpg");
          $("#img-5").attr("src","empty star.jpg");
        }else if($('input[name="star"]:checked').val()=="two"){
          $("#img-1").attr("src","filled star.jpg");
          $("#img-2").attr("src","filled star.jpg");
          $("#img-3").attr("src","empty star.jpg");
          $("#img-4").attr("src","empty star.jpg");
          $("#img-5").attr("src","empty star.jpg");
        }else if($('input[name="star"]:checked').val()=="three"){
          $("#img-1").attr("src","filled star.jpg");
          $("#img-2").attr("src","filled star.jpg");
          $("#img-3").attr("src","filled star.jpg");
          $("#img-4").attr("src","empty star.jpg");
          $("#img-5").attr("src","empty star.jpg");
        }else if($('input[name="star"]:checked').val()=="four"){
          $("#img-1").attr("src","filled star.jpg");
          $("#img-2").attr("src","filled star.jpg");
          $("#img-3").attr("src","filled star.jpg");
          $("#img-4").attr("src","filled star.jpg");
          $("#img-5").attr("src","empty star.jpg");
        }else if($('input[name="star"]:checked').val()=="five"){
            $("#img-1").attr("src","filled star.jpg");
            $("#img-2").attr("src","filled star.jpg");
            $("#img-3").attr("src","filled star.jpg");
            $("#img-4").attr("src","filled star.jpg");
            $("#img-5").attr("src","filled star.jpg");
        }else{
          $("#img-1").attr("src","empty star.jpg");
          $("#img-2").attr("src","empty star.jpg");
          $("#img-3").attr("src","empty star.jpg");
          $("#img-4").attr("src","empty star.jpg");
          $("#img-5").attr("src","empty star.jpg");
        }

        $('input:radio').click(function(){
            switch($(this).val()) {
                case "one":
                    $("#img-1").attr("src","filled star.jpg");
                    $("#img-2").attr("src","empty star.jpg");
                    $("#img-3").attr("src","empty star.jpg");
                    $("#img-4").attr("src","empty star.jpg");
                    $("#img-5").attr("src","empty star.jpg");
                break;
                
                case "two":
                    $("#img-1").attr("src","filled star.jpg");
                    $("#img-2").attr("src","filled star.jpg");
                    $("#img-3").attr("src","empty star.jpg");
                    $("#img-4").attr("src","empty star.jpg");
                    $("#img-5").attr("src","empty star.jpg");
                break;
                
                case "three":
                    $("#img-1").attr("src","filled star.jpg");
                    $("#img-2").attr("src","filled star.jpg");
                    $("#img-3").attr("src","filled star.jpg");
                    $("#img-4").attr("src","empty star.jpg");
                    $("#img-5").attr("src","empty star.jpg");
                break;
                
                case "four":
                    $("#img-1").attr("src","filled star.jpg");
                    $("#img-2").attr("src","filled star.jpg");
                    $("#img-3").attr("src","filled star.jpg");
                    $("#img-4").attr("src","filled star.jpg");
                    $("#img-5").attr("src","empty star.jpg");
                break;
                
                case "five":
                    $("#img-1").attr("src","filled star.jpg");
                    $("#img-2").attr("src","filled star.jpg");
                    $("#img-3").attr("src","filled star.jpg");
                    $("#img-4").attr("src","filled star.jpg");
                    $("#img-5").attr("src","filled star.jpg");
                break;
            }
        });
      });
      function backFunction(){
        document.location.href = "Manage Reviews.php";
      }
      function error(){
        var message = alert("Please enter information in all fields. \
        A star Rating cannot be 0. \ ");
      }
    </script>
    <body>
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
    <div id="title2"><h1 id="title">Modify Review</h1></div>
    <div id="body"> 
    <form name="myForm" method="post" id="form1" action="<?php echo $_SERVER['PHP_SELF']?>">
    <section class="reviewRating">
    <label for="revMeal">Meal</label>
    <select name="revMeal" id="input" disabled>
      <?php  
        require_once("db.php");
        
        $sql = "SELECT meal 
        FROM mealchoices 
        INNER JOIN review 
        ON mealchoices.CMID=review.CMID 
        WHERE review.RVID=".$rvid;
        
        $result=$mydb->query($sql);
        while($row = mysqli_fetch_array($result)){
            echo "<option value='".$row["rvid"]."'>".$row["meal"]."</option>";
        }
      ?>
    </select>
    <br>
    <label class="form-check-inline"><h3>Review Rating</h3> </label>    
    
    <label class="form-check-inline"> <!-- one -->
      <input type="radio" class="form-check-input" name="star" id="start-radio-1" value="one"
      <?php 
        require_once("db.php");
        $sql = "SELECT StarRating, ReviewDescription, ReviewTitle 
                FROM review 
                INNER JOIN user
                  ON review.CID = user.CID
                WHERE RVID=".$rvid." AND user.email='$email'";
        $result = $mydb->query($sql);
        while($row = mysqli_fetch_array($result)){
        $star = $row['StarRating']; 
        $rTitle = $row['ReviewTitle'];
        $rDez = $row['ReviewDescription'];        
        }
        if ($star == 'one') {echo ' checked ';}   
        ?>
      >
      <img src="empty star.jpg" id="img-1" width="50" height="50">
    </label>
                
    <label class="form-check-inline"> <!-- two -->
      <input type="radio" class="form-check-input" name="star" id="start-radio-2" value="two"
      <?php 
        require_once("db.php");
        $sql = "SELECT StarRating, ReviewDescription, ReviewTitle 
                FROM review 
                INNER JOIN user
                  ON review.CID = user.CID
                WHERE RVID=$rvid AND user.email='$email'";
        $result = $mydb->query($sql);
        while($row = mysqli_fetch_array($result)){
        $star = $row['StarRating']; 
        $rTitle = $row['ReviewTitle'];
        $rDez = $row['ReviewDescription'];      
        }
        if ($star == 'two') {echo ' checked ';}   
        ?>
      >
      <img src="empty star.jpg" id="img-2" width="50" height="50">                 
    </label>

    <label class="form-check-inline"> <!-- three -->
      <input type="radio" class="form-check-input" name="star" id="start-radio-3" value="three"
      <?php 
            require_once("db.php");
            $sql = "SELECT StarRating, ReviewDescription, ReviewTitle 
                    FROM review 
                    INNER JOIN user
                      ON review.CID = user.CID
                    WHERE RVID=$rvid AND user.email='$email'";
            $result = $mydb->query($sql);
            while($row = mysqli_fetch_array($result)){
            $star = $row['StarRating']; 
            $rTitle = $row['ReviewTitle'];
            $rDez = $row['ReviewDescription'];   
            }
            if ($star == 'three') {echo ' checked ';}   
        ?>
      >
      <img src="empty star.jpg" id="img-3" width="50" height="50">
    </label>

    <label class="form-check-inline"> <!-- four -->
      <input type="radio" class="form-check-input" name="star" id="start-radio-4" value="four"
      <?php 
            require_once("db.php");
            $sql = "SELECT StarRating, ReviewDescription, ReviewTitle 
                    FROM review 
                    INNER JOIN user
                      ON review.CID = user.CID
                    WHERE RVID=$rvid AND user.email='$email'";
            $result = $mydb->query($sql);
            while($row = mysqli_fetch_array($result)){
            $star = $row['StarRating']; 
            $rTitle = $row['ReviewTitle'];
            $rDez = $row['ReviewDescription'];         
            }
            if ($star == 'four') {echo ' checked ';}   
        ?>
      >
      <img src="empty star.jpg" id="img-4" width="50" height="50">
    </label>
    
    <label class="form-check-inline"> <!-- five -->
      <input type="radio" class="form-check-input" name="star" id="start-radio-5" value="five"
      <?php 
            require_once("db.php");
            $sql = "SELECT StarRating, ReviewDescription, ReviewTitle 
                    FROM review 
                    INNER JOIN user
                      ON review.CID = user.CID
                    WHERE RVID=$rvid AND user.email='$email'";
            $result = $mydb->query($sql);
            while($row = mysqli_fetch_array($result)){
            $star = $row['StarRating']; 
            $rTitle = $row['ReviewTitle'];
            $rDez = $row['ReviewDescription'];      
            }
            if ($star == 'five') {echo ' checked ';}   
        ?>
      >
      <img src="empty star.jpg" id="img-5" width="50" height="50">
    </label>
    <p></p>
    <p>
    <label>Review Title
        <input type="text" name="reviewTitle" size="25" id="meal" autofocus required value=
        <?php 
            require_once("db.php");
            $sql = "SELECT StarRating, ReviewDescription, ReviewTitle 
                    FROM review 
                    INNER JOIN user
                      ON review.CID = user.CID
                    WHERE RVID=$rvid AND user.email='$email'";
            $result = $mydb->query($sql);
            while($row = mysqli_fetch_array($result)){
            $star = $row['StarRating']; 
            $rTitle = $row['ReviewTitle'];
            $rDez = $row['ReviewDescription'];     
            }
            echo $rTitle;    
        ?>
        >
    </label>
    </p>
    <p>
      <label>Review Description
      <textarea name="reviewDescription" rows="4" cols="50" id="description">
<?php 
    // session_start();
    // $email = $_SESSION["email"];
require_once("db.php");
$sql = "SELECT StarRating, ReviewDescription, ReviewTitle 
        FROM review 
        INNER JOIN user
          ON review.CID = user.CID
        WHERE RVID=$rvid AND user.email='$email'";
$result = $mydb->query($sql);
while($row = mysqli_fetch_array($result)){
$star = $row['StarRating']; 
$rTitle = $row['ReviewTitle'];
$rDez = $row['ReviewDescription'];  
}
echo $rDez;    
?>
      </textarea>
    </label>
    </p>  
    </section>

    <input type="submit" name="modify2" value="Modify" />
    <input type="button" value="Cancel" onclick="backFunction()" />
    </section>
    </form>
    </div>
    </div>
    </body>
</html>
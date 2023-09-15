<!DOCTYPE html>
<html>
    <head>
        <title>Home</title>
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
    label.label2 {
        background-color: white;
        font-style: italic;
        font-weight: 200;
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
    </style>

    <body>
      <?php
        session_start();
        $email = $_SESSION["email"];
        $status = "";
        $cid = 0;
        $firstName = "";
        $statusForDetail = "";
      
        require_once("db.php");
        $sql="SELECT * FROM `user`
        WHERE `email` ='$email'";
        $result = $mydb->query($sql);
        $row=mysqli_fetch_array($result);
        $status = $row['Status'];
        $cid = $row['CID'];
        $firstName = $row['FirstName'];


      $rid = 0;
      if(isset($_GET['rid'])) {
          $rid=$_GET['rid'];
          $rname = "";
          $description = "";
          $requestStatus = "";
          $firstName = "";
          $lastName = "";
          $requestDate = "";
          require_once("db.php");
          $sql = "";
          if ($status == "Chef") {
            $statusForDetail = "Customer";
            $sql="SELECT `RID`, `RName`, `Description`, `RequestStatus`, `FirstName`, `LastName`, `RequestDate`,`RequesterCID` FROM `mealrequest`
            INNER JOIN `user`
            ON `mealrequest`.RequesterCID = `user`.CID
            WHERE `RID` =".$rid;
          } else {
            $statusForDetail = "Chef";
            $sql="SELECT `RID`, `RName`, `Description`, `RequestStatus`, `FirstName`, `LastName`, `RequestDate`,`RequesterCID` FROM `mealrequest`
            INNER JOIN `user`
            ON `mealrequest`.CID = `user`.CID
            WHERE `RID` =".$rid;
          }
          $result = $mydb->query($sql);
          $row=mysqli_fetch_array($result);
          $rname = $row['1'];
          $description = $row['2'];
          $requestStatus = $row['3'];
          $firstName = $row['4'];
          $lastName = $row['5'];
          $requestDate = $row['6'];
      
          $time = strtotime($requestDate);
          $myFormatForView = date("m/d/y", $time);
      
        echo "<div id='title2'><h1 id='title'>Request Details</h1></div>
        <div id='body'>
          <div class='row'>
              <div class='column'>
                  <div class='section1'>
                  </br>
                      <div class='content' id='username' >
                          <label class='label1'>".$statusForDetail."'s first name: </label>
                          <label class='label2'>" .$firstName. "</label>
                      </div>
                    </br>
                      <div class='content' id='lastname' >
                        <label class='label1'>".$statusForDetail."'s last name: </label>
                        <label class='label2'>". $lastName."</label>
                      </div>
                    </br>
                      <div class='content'>
                          <label class='label1'>Which meal would you like to buy? </label>
                          <label class='label2'>".$rname."</label>
                          
                      </div>
                    </br>
                      <div class='content'>
                          <label class='label1'>Are there any modifications you want? </label>
                          <label class='label2'>".$description."</label>
                      </div>
                      </br>  
                  </div> 
              </div>
              <div class='column'>
                  <div class='section1'>
                  </br>
                      <div class='content' id='date' >
                          <label class='label1'>Status: </label>
                          <label class='label2'>".$requestStatus."</label>
                        </br>
                      </div>
                  </div>
                  <div class='section1'>
                  </br>
                      <div class='content'>
                          <label class='label1'>Date ".$requestStatus.": </label>
                          <label class='label2' id='countdown'>".$myFormatForView."</label>
                      </div>
                      </br>  
                  </div> 
              </div>
            </div>      
          </div>";
      }
        ?>
        
    </body>
</html>

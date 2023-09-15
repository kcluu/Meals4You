<?php
  $searchQuery = "";
  if (isset($_POST["submit2"])) {
      if(isset($_POST["searchVal"])) {
        $searchQuery=$_POST["searchVal"];
      }
       header("HTTP/1.1 307 Temporary Redirect");
       header("Location: searchResults.php");
  }


  session_start();
  $email = $_SESSION["email"];
  $status = "";
  $cid = 0;
  $firstName = "";
  $hasSent = false;
  $hasAccepted = false;
  $hasPending = false;
  $hasDelivered = false;

  require_once("db.php");
  $sql="SELECT * FROM `user`
  WHERE `email` ='$email'";
  $result = $mydb->query($sql);
  $row=mysqli_fetch_array($result);
  $status = $row['Status'];
  $cid = $row['CID'];
  $firstName = $row['FirstName'];
?>
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

        <script type='text/javascript'>
          function accepted(rid) {
            try {
  					asyncRequest = new XMLHttpRequest();  //create request object

  					//register event handler
            asyncRequest.onreadystatechange=stateChangeAccept();
            var url="accept.php?rid="+rid;
  					asyncRequest.open('GET',url,true);  // prepare the request
  					asyncRequest.send(null);  // send the request
  				}
  					catch (exception) {alert(exception);}
                            // window.alert(RID);
                            // var accepted_request = document.getElementById('label1');
                            // document.getElementById('pendingRequest1').remove();
                            // var progressRequest = document.getElementById('progress').appendChild(accepted_request);
          }
          function stateChangeAccept() {
            <?php
              header("location=your_requests.php");
            ?>
            window.alert("Your request has been accepted. Please refresh the page to see changes.");
          
        }

        function declined(rid) {
            try {
  					asyncRequest = new XMLHttpRequest();  //create request object

  					//register event handler
            asyncRequest.onreadystatechange=stateChangeDeclined();
            var url="decline.php?rid="+rid;
  					asyncRequest.open('GET',url,true);  // prepare the request
  					asyncRequest.send(null);  // send the request
  				}
  					catch (exception) {alert(exception);}
                            // window.alert(RID);
                            // var accepted_request = document.getElementById('label1');
                            // document.getElementById('pendingRequest1').remove();
                   
                            // var progressRequest = document.getElementById('progress').appendChild(accepted_request);
          }
          function stateChangeDeclined() {
            location.reload(true);
            window.alert("Your request has been declined. Please refresh the page to see changes.");
          
        }

        function delivered(rid) {
            try {
  					asyncRequest = new XMLHttpRequest();  //create request object

  					//register event handler
            asyncRequest.onreadystatechange=stateChangeDelivered();
            var url="delivered.php?rid="+rid;
  					asyncRequest.open('GET',url,true);  // prepare the request
  					asyncRequest.send(null);  // send the request
  				}
  					catch (exception) {alert(exception);}
                            // window.alert(RID);
                            // var accepted_request = document.getElementById('label1');
                            // document.getElementById('pendingRequest1').remove();
                            // var progressRequest = document.getElementById('progress').appendChild(accepted_request);
          }
          function stateChangeDelivered() {
            location.reload(true);
            window.alert("Your request has been delivered. Please refresh the page to see changes.");
          
        }

        function cancel(rid) {
          var answer = window.confirm('Are you sure you want to cancel your meal order?');
          if (answer) {
            try {
  					asyncRequest = new XMLHttpRequest();  //create request object

  					//register event handler
            asyncRequest.onreadystatechange=stateChangeCanceled();
            var url="decline.php?rid="+rid;
  					asyncRequest.open('GET',url,true);  // prepare the request
  					asyncRequest.send(null);  // send the request
  				}
  					catch (exception) {alert(exception);}
                            // window.alert(RID);
                            // var accepted_request = document.getElementById('label1');
                            // document.getElementById('pendingRequest1').remove();
                            // var progressRequest = document.getElementById('progress').appendChild(accepted_request);
          }
        }
        function stateChangeCanceled() {
            location.reload(true);
            window.alert("Your request has been canceled. Please refresh the page to see changes.");
          
        }
        
        function goToDetail(rid) {
          $.ajax({
              url:"request_details.php?rid="+rid,
              async:true,
              success: function(result){
                $("#entireRequest").html(result);
              }
            })
          }

          function goToModifications(rid) {
          $.ajax({
              url:"chef_modifications.php?rid="+rid,
              async:true,
              success: function(result){
                $("#entireRequest").html(result);
              }
            })
          }
        
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
              <button type="submit" name="submit2" class="btn btn-default">Search</button>
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
        
        <div id="entireRequest">
          <div id="title2"><h1 id="title"><?php echo $firstName ?>'s Requests</h1></div>
          <div id="body">
            <div class="row">
                <div class="column">
                <?php
                  if ($status == "Chef") {
                    echo "<h3>Pending Requests</h3>";
                    echo "<hr>";
                    echo "<div class='content' id='pendingRequest1' >";
                    require_once("db.php");
                
                    $sql="SELECT `RName`, `RID` FROM `mealrequest` WHERE `RequestStatus` = 'Pending' AND `CID` = '$cid'";
                    $result = $mydb->query($sql);
                    while($row=mysqli_fetch_array($result)){
                      $hasPending = true;
                      echo "<label class='pendingRequest' id='label1' onclick='goToDetail(".$row['1'].")'><a href=#>" .$row['0'] . "</label></a>
                      <button class='acceptButton' type='button' onclick='accepted(".$row['1'].")'><img src='images/accept.png' width=10px> Accept</button></a>
                      <button class='declineButton' type='button' onclick='declined(".$row['1'].")'><img src='images/decline.png' width=10px> Decline</button>
                      <button class='modifyButton' id='modButton' type='button' onclick='goToModifications(".$row['1'].")'><img src='images/edit.png' width=10px> Request to Modify</button>
                      <hr>";
                    } 
                    if($hasPending == false) {
                      echo "<i>You have received no pending requests at this time.</i>";
                      echo "<hr>";
                    }
                    echo "</div>";
                    echo "</br>";
                  } 
                ?>
                  <h3>Sent Requests</h3>
                  <hr>
                  <div class="content">
                  <?php
                    require_once("db.php");
                
                    $sql="SELECT `RName`, `RID` FROM `mealrequest` WHERE `RequestStatus` = 'Pending' AND `RequesterCID` = '$cid'";
                    $result = $mydb->query($sql);
                    while($row=mysqli_fetch_array($result)){
                      $hasSent = true;
                      echo "<label class='pendingRequest' onclick='goToDetail(".$row['1'].")'><a href='#'>" .$row['0'] ."</label></a>
                      <hr> ";
                    }
                    if($hasSent == false) {
                      echo "<i>You have not sent any requests at this time.</i>";
                      echo "<hr>";
                    }
                ?>
                  </div>

                </div>
                <div class="column">
                    <div id="progress">
                    <h3>Accepted Requests In Progress</h3>
                    <hr>
                    <div class="content" id="request1">
                      <?php
                        require_once("db.php");
                        if ($status == "Chef") {
                          $sql="SELECT `RName`, `RID`, `RequestDate` FROM `mealrequest` WHERE `RequestStatus` = 'Accepted' AND `CID` = '$cid'";
                          $result = $mydb->query($sql);
                            while($row=mysqli_fetch_array($result)) {
                              $hasAccepted = true;
                              $time = strtotime($row['2']);
                              $myFormatForView = date("m/d/y", $time);
                              echo "<label class='pendingRequest' id='request1Label' onclick='goToDetail(".$row['1'].")'><a href='#'>" .$row['0'] ."</label></a>
                              <button class='deliverButton' type='button' onclick='delivered(".$row['1'].")'>Delivered</button>
                              <button class='cancelButton' id='modButton' type='button' onclick='cancel(".$row['1'].")'>Cancel</button>
                              <p class='status' id='status1'>Accepted request on: ". $myFormatForView."</p>
                              <hr>
                              <script type='text/javascript'>
                                function cancelFunc() {
                                    var answer = window.confirm('Are you sure you want to cancel your meal order?');
                                    if (answer) {
                                        document.getElementById('request1').remove();
                                    }
                                }
                              </script>";
                            }
                            if($hasAccepted == false) {
                              echo "<i>You have not accepted any requests at this time.</i>";
                              echo "<hr>";
                            }
                          } else {
                            $sql="SELECT `RName`, `RID`, `RequestDate` FROM `mealrequest` WHERE `RequestStatus` = 'Accepted' AND `RequesterCID` = '$cid'";
                          $result = $mydb->query($sql);
                            while($row=mysqli_fetch_array($result)) {
                              $hasAccepted = true;
                              $time = strtotime($row['2']);
                              $myFormatForView = date("m/d/y", $time);
                              echo "<label class='pendingRequest' id='request1Label' onclick='goToDetail(".$row['1'].")'><a href='#'>" .$row['0'] ."</label></a>
                              <button class='cancelButton' id='modButton' type='button' onclick='cancel(".$row['1'].")'>Cancel</button>
                              <p class='status' id='status1'>Accepted request on: ". $myFormatForView."</p>
                              <hr>
                              <script type='text/javascript'>
                                function cancelFunc() {
                                    var answer = window.confirm('Are you sure you want to cancel your meal order?');
                                    if (answer) {
                                        document.getElementById('request1').remove();
                                    }
                                }
                              </script>";
                            }
                            if($hasAccepted == false) {
                              echo "<i>You have no accepted requests at this time.</i>";
                              echo "<hr>";
                            }
                          }
                      
                      ?>
                    </div>
                    </div>
                    </br>

                    <div id="completed">
                    <h3>Delivered Requests</h3>
                    <hr>
                    <div class="content">
                      <?php
                        require_once("db.php");
                        $sql="";
                        if ($status == "Chef") {
                          $sql="SELECT `RName`, `RID`, `RequestDate` FROM `mealrequest` WHERE `RequestStatus` = 'Delivered'AND `CID` = '$cid'";
                        } else {
                          $sql="SELECT `RName`, `RID`, `RequestDate` FROM `mealrequest` WHERE `RequestStatus` = 'Delivered'AND `RequesterCID` = '$cid'";
                        }
                        $result = $mydb->query($sql);
                        while($row=mysqli_fetch_array($result)) {
                          $hasDelivered = true;
                          $time = strtotime($row['2']);
                          $myFormatForView = date("m/d/y", $time);
                          echo "<label class='pendingRequest' onclick='goToDetail(".$row['1'].")'><a href='#'>" .$row['0'] ."</label></a>
                          <p class='status' id='status1'>Delivered on: ". $myFormatForView."</p>
                          <hr>";
                        }
                        if($hasDelivered == false && $status == "Chef") {
                          echo "<i>You have not delivered any requests at this time.</i>";
                          echo "<hr>";
                        }
                        if($hasDelivered == false && $status == "User") {
                          echo "<i>You have no delivered requests at this time.</i>";
                          echo "<hr>";
                        }
                      ?>
                    </div>
                    </br>
                    </div>
                    <h3>Request Phase Chart</h3>
                    <div id="graph">
         <svg width="450" height="450"></svg>
<script src="https://d3js.org/d3.v4.min.js"></script>
<script>

var svg = d3.select("svg"),
    margin = {top: 20, right: 20, bottom: 30, left: 40},
    width = +svg.attr("width") - margin.left - margin.right,
    height = +svg.attr("height") - margin.top - margin.bottom;

var x = d3.scaleBand().rangeRound([0, width]).padding(0.1),
    y = d3.scaleLinear().rangeRound([height, 0]);
    console.log(y(3));

var g = svg.append("g")
    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

//specify our data source
/*
d3.tsv("data.tsv", function(d) {
  d.frequency = +d.frequency;
  return d;
}, function(error, data) {
*/

d3.json("getRequestData.php", function(error, data){
   if(error) throw error;

  data.forEach(function(d){
    d.letter = d.RequestStatus;
    d.frequency = +d.numOfRequests;
  })

   console.log(data);

   if (error) throw error;

  x.domain(data.map(function(d) { return d.letter; }));
  y.domain([0, d3.max(data, function(d) { return d.frequency; })]);

  g.append("g")
      .attr("class", "axis axis--x")
      .attr("transform", "translate(0," + height + ")")
      .call(d3.axisBottom(x));

  g.append("g")
      .attr("class", "axis axis--y")
      .call(d3.axisLeft(y).ticks(4, "s"))
    .append("text")
      .attr("transform", "rotate(-90)")
      .attr("y", 6)
      .attr("dy", "0.71em")
      .attr("text-anchor", "end")
      .text("Frequency");

  g.selectAll(".bar")
    .data(data)
    .enter().append("rect")
      .attr("class", "bar")
      .attr("x", function(d) { return x(d.letter); })
      .attr("y", function(d) { return y(d.frequency); })
      .attr("width", x.bandwidth())
      .attr("height", function(d) { return height - y(d.frequency); });
});

</script>
</div>
                </div>

              </div>
            </div> 
         </div>
         <div id="title2"><h5 id="title">Have a problem? <a href = "submit_error_request.php">Submit a help ticket!</a></h1></div>

    </body>
</html>

<?php
  $searchQuery = "";
  if (isset($_POST["submit2"])) {
      if(isset($_POST["searchVal"])) {
        $searchQuery=$_POST["searchVal"];
      }

       header("HTTP/1.1 307 Temporary Redirect");
       header("Location: searchResults.php");
  }

  

?>


<!DOCTYPE html>
<html>
    <head>
        <title>Money Analysis Graph</title>
        <meta charset="utf-8" />
        <meta name="author" content="Sarah Deacon" />
        <meta name="keywords" content="money, analysis, day" />
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
            padding-bottom: 15px;
            padding-top: 2px;
            /*border: black 2px solid;*/
            margin-right: 50px;
            margin-left:50px;
            margin-bottom: 25px;
            border: 2px solid grey;
            border-top:none;
          }
          #title{
            text-align: center;
          }
          body{
            background-image: url('food.jpeg');
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
          
          .bar {
                fill: #ff6961;
            }

        .bar:hover {
                fill: pink;
            }
        #back{
            background-color:white;
            border:1px solid;
        }
      
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
              <img alt="Logo" src="logo3.png" width=90px>
            </a>
          </div>
      
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <li><a href="home.php">Home <span class="sr-only">(current)</span></a></li>
              <li><a href="exploreProfiles.php">Profiles</a></li>
              <li class="active"><a href="#">Meals</a></li>
              <li><a href="your_requests.php">Requests</a></li>
            </ul>
            <form class="navbar-form navbar-left" method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
              <div class="form-group">
                <input type="text" name="searchVal" class="form-control" placeholder="Search for a meal">
              </div>
              <button type="submit" name="submit2" class="btn btn-default">Search</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
            <li><a href="Profile.php">My Profile</a></li>
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
        </nav>

    <div id="title2"><h1 id="title">Money Analysis</h1></div>
    <div id="body">
        <h3>How much money you have spent per month:</h3>
        <svg width="960" height="500"></svg>

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

        <?php
            $user=0;
            if(isset($_GET['cid'])) $user=$_GET['cid'];
        ?>


        d3.json("getMoneyData.php?userid=<?php echo $user;?>", function(error, data){
        if(error) throw error;

        data.forEach(function(d){
            d.letter = d.requestday;
            d.frequency = +d.moneyCount;
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
<br><br>
<a href="getCID.php" id="back">&nbsp Go Back to User Selection &nbsp</a>

    </div>
    

</body>
</html>
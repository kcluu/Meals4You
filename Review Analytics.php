<!DOCTYPE html>
<html>
<head>
  <title>Review Analytics</title>
  <meta charset="utf-8">
  <meta name="author" content="Jack Hartmann" /> 
  <meta name="keywords" content="home, recipe, student, service, food" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="css/bootstrap.min.css" rel="stylesheet" />
  <link href="css/bootstrap.css" rel="stylesheet" />
  <script src="jquery-3.1.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
<style>
 *{
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
    margin-right: 5%;
    margin-left:5%;
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
    margin-right: 5%;
    margin-left:5%;
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
  .nav-pills > li.active > a, .nav-pills > li.active > a:focus {
    color:white;
    background-color:#AE0000;
  }
  .nav-pills > li.active > a:hover {
    color:white;
    background-color: #800000; 
  }
  .nav-pills > li.navbar-dark > a, .nav-pills > li.active > a:focus {
    color:black;
  }
</style>
</head>
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
<div id="title2"><h1 id="title">Review Analytics</h1></div>
    <div id="body"> 
    <form name="myForm" method="post" id="form1" action="<?php echo $_SERVER['PHP_SELF']?>">
    <nav>
      <ul class="nav nav-pills nav-justified">
        <li class="navbar-dark"><a href="Review List.php">Review List</a></li>
        <li class="active"><a href="Review Analytics.php">Review Analytics</a></li>
      </ul>
    </nav>
    <section>


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
      $cmid=0;
      if(isset($_GET['cmid'])) $cmid=$_GET['cmid'];
  ?>

  d3.json("reviewData.php?cmid=<?php echo $cmid; ?>", function(error, data){
    if(error) throw error;

    data.forEach(function(d){
      d.letter = d.meal;
      d.frequency = +d.AvgStar;
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
        .call(d3.axisLeft(y).ticks(5, "s"))
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
</script>
</body>
</html>
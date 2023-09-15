<!DOCTYPE html>
<html>
<head>
  <title>Bar Chart Example</title>



<meta charset="utf-8">
<style>
body {
  background-image: url("img/food.jpeg");
 }
.chart{
  margin: auto;
        width: 50%;
        border: 30px solid transparent;
    background-color: #f2eae8;
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

</style>
</head>



<body>
<div class = "chart">
<h1 style="color: rgb(240, 64, 85);">Employee # , Number of Responses</h1>
<svg width="800" height="500"></svg>
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

//display a barchart for a specefic supplier 
//first get the selected supplier id from index.php
//revise the getData.php to get the data for that supplier
<?php
    $empID = 0;
    if(isset($_GET["EID"])) $empID =$_GET["EID"];

?>



d3.json("getData.php?ed=<?php echo $empID;?>", function(error, data){
  if(error) throw error;

  data.forEach(function(d){
    d.letter = d.employeeID;
    d.frequency = +d.responses;
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
<a href="ExistingServiceRequests.php" style="color: rgb(240, 64, 85); background: #FFFFFF; border-style: outset; border-color:#FFFFFF;
     font: bold 15px arial,sans-serif;text-shadow:none;">Return to Requests</a>
</div>
</body>
</html>
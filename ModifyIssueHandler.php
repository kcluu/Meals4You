<!DOCTYPE html>
<html lang="en">
<head>   
<title>Confirmation Page</title>
            <meta charset="utf-8" />
            <meta name="author" content="Jacob Gann" /> 
            <meta name="keywords" content="issue, submission, error, request, meal" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link href="css/bootstrap.min.css" rel="stylesheet" />
            <link href="css/bootstrap.css" rel="stylesheet" />
            <script src="jquery-3.1.1.min.js"></script>
            <script src="js/bootstrap.min.js"></script>
    <style>
     body {
  background-image: url("images/food.jpeg");
 }
 .message{
    margin: auto;
        width: 50%;
        border: 30px solid transparent;
    background-color: #f2eae8;
    color: rgb(240, 64, 85);
 }
    </style>
</head>
<body>
<div class = "message">
<?php
$response = ""; 
$errorid = ""; 
$rid = 0;
if(isset($_POST["responseText"])) $response = $_POST['responseText'];
if(isset($_POST["ErrID"])) $errorid = $_POST['ErrID'];
if(isset($_POST["RID"])) $rid = $_POST["RID"];
require_once("db.php"); 

$sql = "UPDATE errorresponse SET responseText = '$response' Where RID = $rid ";
$result=$mydb->query($sql);

    echo "<p> Error Solution has been updated.</p>";
  
?>
<a href="ExistingServiceRequests.php">Return to Request Page</a>
</div>
</body>
</html>
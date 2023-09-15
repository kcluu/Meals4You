
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
$employeeid=""; 
$errorid = ""; 

if(isset($_POST["responseText"])) $response = $_POST['responseText'];
if(isset($_POST["EID"])) $employeeid = $_POST['EID'];
if(isset($_POST["ErrID"])) $errorid = $_POST['ErrID'];

require_once("db.php"); 

$sql = "INSERT INTO errorresponse(responseText, ErrID, EID)
        values('$response', '$errorid', '$employeeid')"; 
$result=$mydb->query($sql);

if ($result==1) {
    $sql = "UPDATE errorrequest SET ErrorRequestStatus = 1 WHERE ErrID = $errorid";
    $result=$mydb->query($sql);

    echo "<p> Error Solution has been recorded.</p>";
  }
?>
<a href="ExistingServiceRequests.php">Return to Request Page</a>
</div>
</body>
</html>
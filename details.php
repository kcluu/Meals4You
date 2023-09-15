<!DOCTYPE html>
<html lang="en">
<head>
    <title>details</title>
</head>
<body>
    <?php
        $errd = 0; 
        if(isset($_GET['ErrID'])) $errd = $_GET['ErrID']; 
        require_once("db.php"); 
        if($errd!=0){
        echo "<p style='color: rgb(240, 64, 85)'> Details: <br>"; 
        $sql="SELECT * FROM errorrequest Where ErrID = $errd";
        $result = $mydb->query($sql);
        while ($row = mysqli_fetch_array($result)) {
        echo "Date Time: ".$row['DateOfError'];
        echo "<br>";
        echo $row['ErrorRequestDescription'];
        
        }
        echo"</p>";
    }
    ?>
</body>
</html>
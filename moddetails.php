<!DOCTYPE html>
<html lang="en">
<head>
    <title>details</title>
</head>
<body>
    <?php
        $RID = 0; 
        if(isset($_GET['RID'])) $RID = $_GET['RID']; 
        require_once("db.php"); 
        if($RID!=0){
        echo "<p style='color: rgb(240, 64, 85)'> Existing Solution: <br>"; 
        $sql="SELECT * FROM errorresponse Where RID = $RID";
        $result = $mydb->query($sql);
        while ($row = mysqli_fetch_array($result)) {
        echo $row['responseText'];
        }
        echo"</p>";
    }
    ?>
</body>
</html>
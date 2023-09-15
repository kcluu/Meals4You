<?php
    require_once("db.php"); 
    $employeeid = 0; 

    if(isset($_GET["ed"])) $employeeid = $_GET["ed"];
     
    $sql = "select EID as 'employeeID', count(RID) as responses from errorresponse where EID=$employeeid";

        $result = $mydb->query($sql);

        $data = array(); 
        for($x=0; $x<mysqli_num_rows($result);$x++){
            $data[] = mysqli_fetch_assoc($result); 
        }

        echo json_encode($data);
?>
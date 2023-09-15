<?php

session_start();
$email = $_SESSION["email"];
$cid = 0;
$status = "";

require_once("db.php");
$sql="SELECT * FROM `user`
WHERE `email` ='$email'";
$result = $mydb->query($sql);
$row=mysqli_fetch_array($result);
$cid = $row['CID'];
$status = $row['Status'];
//This page gets the specified supplier id value from showProducts.php,
// queries the database to get the product names and total in-stock values 
// of the products provided by the specified supplier, and outputs the values in the JSON data format.

        require_once("db.php");
        $sql = "";
        if ($status == "Chef") {
            $sql="SELECT `RequestStatus`, COUNT(`RequestStatus`) as numOfRequests FROM `mealrequest`
            WHERE `CID` = '$cid'
            GROUP BY `RequestStatus`";
        } else {
            $sql="SELECT `RequestStatus`, COUNT(`RequestStatus`) as numOfRequests FROM `mealrequest`
            WHERE `RequesterCID` = '$cid'
            GROUP BY `RequestStatus`";
        }
        $result = $mydb->query($sql); 

        $data = array();
         for($x=0; $x<mysqli_num_rows($result); $x++) {
             $data[] = mysqli_fetch_assoc($result);
         }

         echo json_encode($data);

 ?>


<?php
  $mchoice = "";
  $quantity = "";
  $deadline = "";
  $modify = "";
  $cid = "";
  $price = "";
  $pay = "";
  
  $err = false;

  if (isset($_POST["submit"])) {
      if(isset($_POST["mealchoice"])) $mchoice=$_POST["mealchoice"];
      if(isset($_POST["quantity"])) $quantity=$_POST["quantity"];
      if(isset($_POST["deadline"])) $deadline=$_POST["deadline"];
      if(isset($_POST["modifications"])) $modify=$_POST["modifications"];
      if(isset($_POST["customer"])) $cid=$_POST["customer"];
      if(isset($_POST["payMethod"])) $pay=$_POST["payMethod"];

      

      if(!empty($quantity) && !empty($deadline) && !empty($mchoice) && !empty($cid) && !empty($pay)) {
        require_once('db.php');

        $today = date("Y-m-d");

        $sql5 = 'select price from mealchoices where meal="'.$mchoice.'"';
        $result5 =  $mydb->query($sql5);
        $row = mysqli_fetch_array($result5);
        $price = $row['price'] * $quantity;

        $sql6 = 'select cid from mealchoices where meal="'.$mchoice.'"';
        $result6 =  $mydb->query($sql6);
        $row = mysqli_fetch_array($result6);
        $cidchef = $row['cid'];

        $sql4 = "insert into `mealrequest`(`requestdate`,`rname`, `description`,`quantity`, `deadline`, `requeststatus`, `cid`, `price`, `requestercid`) 
        values('$today','$mchoice', '$modify', '$quantity', '$deadline', 'pending', '$cidchef', '$price', '$cid');";
        $result=$mydb->query($sql4);

        $sql6 = 'select rid from mealrequest where rname="'.$mchoice.'" and cid="'.$cidchef.'" and deadline="'.$deadline.'"';
        $result6 =  $mydb->query($sql6);
        $row = mysqli_fetch_array($result6);
        $rid = $row['rid'];

        

        if($pay=="cash"){
          $sql7="insert into `payment`(`paymentdate`, `paymentmethod`, `paymentstatus`, `rid`)
          values('$today', 'cash', 'pending', '$rid')";
          $result=$mydb->query($sql7);

        }
        else if($pay=="credit"){
          $sql8="insert into `payment`(`paymentdate`, `paymentmethod`, `paymentstatus`, `rid`)
          values('$today', 'credit', 'complete', '$rid')";
          $result=$mydb->query($sql8);
        }

        function function_alert($message) {
          echo "<script>alert('$message');";
          echo "window.location.href='exploreMeals.php';</script>";
          
        }
          function_alert("Success! Your meal request has been sent.");
        
      } else {
        $err = true;
        
          function function_alert($message) {
              echo "<script>alert('$message');</script>";
          }
          function_alert("Error! Correct your errors and submit again.");
                  
      }

      
  }
  
 ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Meal Request</title>
        <meta charset="utf-8" />
        <meta name="author" content="Sarah Deacon" />
        <meta name="keywords" content="form, buy, payment" />
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
            padding-top: 20px;
          }
          #background{
            background-color: white;
            padding-top: 25px;
          }
          #CreditPayment{
            display: none;
          }
          #title2{
            border: 2px solid grey;
            background-color: white;
            padding-bottom: 10px;
            margin-right: 50px;
            margin-left:50px;
            
          }
          #CashPayment{
            display: none;
          }
          .errlabel {color:red;}
      
          </style>

        <script src="jquery-3.1.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        
    
    

    <script type="text/javascript">

      function checkPayment() {
        var frmObject = document.getElementById("form1");
			  var z=document.getElementById("CreditPayment");
        var y=document.getElementById("CashPayment");
        if(frmObject.payMethod.value=="cash") {
					y.style.display = "block";
          z.style.display = "none";
        };
			  if(frmObject.payMethod.value=="credit") {
				  z.style.display = "block";
          y.style.display = "none";
				};  
        if(frmObject.payMethod.value==""){
          y.style.display = "none";
          z.style.display = "none";
        };
		  }
    
      function init() {
            var x = document.getElementById("form1");
            x.addEventListener("change", checkPayment);
        }
      


      document.addEventListener("DOMContentLoaded", init);
    </script>

    </head>

    <body>
      

      

        <?php
          require_once('db.php');



          $sql2 = 'select mealchoices.meal, user.FirstName, user.LastName from mealchoices inner join user on user.CID = mealchoices.CID;';
          $result2 =  $mydb->query($sql2);

          $sql3 = 'select cid from user where status="User" or status="Chef";';
          $result3 =  $mydb->query($sql3);
        ?>
        
        
        <div id="backgroun">
          <div id="title2"><h1 id="title">Meal Request</h1></div>
          <div id="body">
      <form id="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
          <section class="mealSec">

          <h3>Meal Information:</h3>
            <p>
              <strong>Who is buying?</strong> <select name="customer" id="chef">
                
                <option value="0">Select</option>";
                <?php
                  while($row = mysqli_fetch_array($result3)){
                    $cid = $row['cid'];
                    echo "<option value='".$cid."'>".$cid."</option>";
                  };
                ?>
              </select>

            </p>
            <p>
            <strong>What meal would you like to buy?</strong>
            <select name="mealchoice" id="mealchoice">
                <?php
                  echo "<option value='0'>Select</option>";
                  while($row = mysqli_fetch_array($result2)){
                    $mchoice = $row['meal'];
                    echo "<option value='".$mchoice."'>".$mchoice."</option>";
                  };
                ?>
            </select>
            </p>
            <p>
            <label for="quantity">Quantity: </label>
              <input type="number" name="quantity" id="quantity" min="1" value="<?php echo $quantity;?>">
              <?php
                if ($err && empty($quantity)) {
                    echo "<label class='errlabel'>Error: Please enter a quantity.</label>";
                  }
              ?>
            </p>
            <p>
            <label for="deadline">When do you need your meal by?</label>
              <input type="date" name="deadline" id="deadline" value="<?php echo $deadline;?>">
              <?php
                if ($err && empty($deadline)) {
                    echo "<label class='errlabel'>Error: Please enter a deadline.</label>";
                  }
              ?>
            </p>
            <p>
            <label>Would you like to change anything from the meal?</label> <br>
                <textarea name="modifications" rows="4" cols="50" id="mods">
                <?php echo $modify;?>
                </textarea>
            </p>
            
          </section>

          <section class="mealSec">
            <h3>Payment Information:</h3>

            <div id="payMethod"><strong>Payment Method:</strong>
              <select name="payMethod" id="creditOption" onchange="checkPayment()">
                  <option value="" <?php if($pay=="") echo "selected"; ?>>Select</option>
                  <option value="credit" <?php if($pay=="credit") echo "selected"; ?>>Credit Card</option>
                  <option value="cash" <?php if($pay=="cash") echo "selected"; ?>>Cash</option>
              </select>
              <?php
                if ($err && empty($pay)) {
                    echo "<label class='errlabel'>Error: Please enter a payment option.</label>";
                  }
              ?>
            </div>
            <br>
            <div id="CreditPayment">
              <p>
                <label>Name on Card:
                  <input type="text" name="name" placeholder="Jane Doe">
                </label>
              </p>

              <p>
              <label>Credit Card Number:
                <input type="password" name="creditnumber" size="20">
              </label>
              </p>

              <p>
                <label>Expiration Date:
                  <input type="month">
                </label>
              </p>
            </div>

            <div id="CashPayment">
              <p>
                <label>Address:
                  <input type="text" name="address" placeholder="123 Alexander Rd, Blacksburg, VA" size="30">
                </label>
              </p>
            </div>

          </section>

          <input type="submit" name="submit" value="Submit" onclick="return confirm('Are you ready to submit?')">
          <input type="reset" value="Reset">
          
        
        </section>
        </form>
      </div>
      </div>

    </body>
</html>
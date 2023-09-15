<?php
 $email="";
 $password="";
 $error = false;
 $loginOK = null;

 if(isset($_POST["submit"])){
       if(isset($_POST["email"])) $email=$_POST["email"];
       if(isset($_POST["password"])) $password=$_POST["password"];

       //echo ($username.".".$password.".".$remember);
       if(empty($email) || empty($password)) {
         $error=true;
       }


       if(!$error){
         //check username and password with the database record
         require_once("db.php");
         $sql = "select CPassword from user where Email='$email'";
         $result = $mydb->query($sql);
   
         $row=mysqli_fetch_array($result);
         if ($row){
           if(strcmp($password, $row["CPassword"]) ==0 ){
             $loginOK=true;
           } else {
             $loginOK = false;
           }
         }
       if($loginOK) {
         //set session variable to remember the username
         session_start();
         $_SESSION["email"] = $email;
         $_SESSION["password"] = $password;

         // SEND TO HOME PAGE AFTER LOGIN
         Header("Location:home.php");
          } 
        } 
  }
  if (isset($_POST["createAccount"])){
    session_start();
    Header("Location:CreateAccount.php");
  }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <meta charset="utf-8" />
        <meta name="author" content="Paige Zeidman" />
        <meta name="keywords" content="form" />
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
            padding-bottom: 25px;
            padding-top: 2px;
            /*border: black 2px solid;*/
            margin-right: 450px;
            margin-left:450px;
            margin-bottom: 25px;
            border: 2px solid grey;
            /*border-top:none;*/
          }
          #title{
            text-align: center;
          }
          body{
            background-image: url('food.jpeg');
          }
          #background{
            padding-left: 15px;
            padding-bottom: 25px;
            /*border: black 2px solid;*/
            margin-right: 25px;
            margin-left:25px;
            margin-bottom: 25px;
            border: 2px solid grey;
            /*border-top:none;*/
            background-color: white;
            padding-top: 25px;
          }
          #mealImg{
            position: fixed;
            right:12%;
            top:23%;
            width: 450px;
          }
          #centerForm {
            margin-left: 100px;
          }
          #centerPass {
            margin-left: 60px;
          }
          #createAccount, #login{
            display:inline-block;
          }
          #buttons{
            margin-left: 120px;
            font-size: 18px;
          }
          #makeButton{
            color: rgb(240, 64, 85);
            padding:15px;
            background-color: lightgrey;
            border-style: outset;
            border-color: black;
            text: black;
          }
          .errlabel {color:black};

          
      
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
              <img alt="Logo" src="logo.PNG" width=90px>
            </a>
          </div>
      
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              
          </div><!-- /.navbar-collapse -->
         </div><!-- /.container-fluid -->
        </nav>

        <div id="background">
          <div id="title2"><h1 id="title">LOGIN AND START COOKING!</h1></div>
        </div>

          

      <div id="body">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
          <div id="centerForm">
          <br />
          <br />
            <label><h3>EMAIL: </h3></label>
            <input type="text" name="email" value="<?php
              if(!empty($email))
                echo $email;
              else if(isset($_COOKIE['email'])) {
                echo $_COOKIE['email'];
              }
            ?>" /><?php if($error && empty($email)) echo "<span class='errlabel'> Please enter an Email</span>"; ?> 
            <br />
            <br />
          </div>
          <div id="centerPass">
            <label><h3>PASSWORD: </h3></label>
            <input name="password" type="password" value="<?php if(!empty($password))echo $password; ?>" /><?php if($error && empty($password)) echo "<span class='errlabel'> Please enter a Password</span>"; ?>
            <br />
            <br />
            <br />
            <?php if(!is_null($loginOK) && $loginOK==false) echo "<span class='errlabel'>Username and Password do not match.</span>"; ?>
        </div>
          <div id="buttons">
            <input name="submit" type="submit" value="Start Cooking!" />
            
            
            <a href="CreateAccount.php" style="color: rgb(240, 64, 85); background: #EFEFEF; border-color: #333333; border-style: solid; border-width: thin; padding: 3px; color: #333333">Create Account</a>
            
           
          </div>
          </form>
      </div>
    </body>

</html>

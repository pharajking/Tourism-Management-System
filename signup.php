<?php
include('includes/config.php');
error_reporting(0);
if(isset($_POST['submit']))
{
$fname=$_POST['fname'];
$mnumber=$_POST['mobilenumber'];
$email=$_POST['email'];
$password=$_POST['password'];
$conf_password = $_POST['confirmpassword'];
if ($password == $conf_password) {
    $password = md5($password);
    $sql="INSERT INTO  tblusers(FullName,MobileNumber,EmailId,Password) VALUES(:fname,:mnumber,:email,:password)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':fname',$fname,PDO::PARAM_STR);
    $query->bindParam(':mnumber',$mnumber,PDO::PARAM_STR);
    $query->bindParam(':email',$email,PDO::PARAM_STR);
    $query->bindParam(':password',$password,PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if($lastInsertId)
    {
    $msg="You are Successfully registered. Now you can login ";
    if (isset($_GET['pid'])) {
        $pckId = $_GET['pid'];
        echo "<script type='text/javascript'> document.location = 'signin.php?pid=$pckId&msg=$msg'; </script>";
    } else {
        header("location:signin.php?msg=$msg");
    }
    }
    else 
    {
    $_SESSION['msg']="Something went wrong. Please try again.";
    header('location:signup.php');
    }
} else {
    echo "<script>alert('Passwords dont Match!Please recheck your passwords.');</script>";
}

}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>TMS | Sign Up</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="applijewelleryion/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
<link href="css/font-awesome.css" rel="stylesheet">
<!-- Custom Theme files -->
<script src="js/jquery-1.12.0.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!--animate-->
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
<link rel="stylesheet" href="css/jquery-ui.css" />
	<script>
		 new WOW().init();
	</script>
	<script src="js/jquery-ui.js"></script>
	  <style>
		.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
		</style>				
</head>
<body>
<!-- top-header -->

<!--- /banner ---->
<!--- selectroom ---->
<div class="selectroom">
	<div class="container">	

        <div class="login-grids">
            <div class="login">
                <div class="login-left">
                    <ul>
                        <li><a class="fb" href="#"><i></i>Facebook</a></li>
                        <li><a class="goog" href="#"><i></i>Google</a></li>
                        
                    </ul>
                </div>
                <div class="login-right">
                    <form name="signup" method="post">
                        <h3>Create your account </h3>
                        <input type="text" value="" placeholder="Full Name" name="fname" autocomplete="off" required="">
                        <input type="text" value="" placeholder="Mobile number" maxlength="10" name="mobilenumber" autocomplete="off" required="">
                        <input type="text" value="" placeholder="Email id" name="email" id="email" onBlur="checkAvailability()" autocomplete="off"  required="">	
                        <span id="user-availability-status" style="font-size:12px;"></span> 
                        <input type="password" value="" placeholder="Password" name="password" required="">	
                        <input type="password" value="" placeholder="Confirm Password" name="confirmpassword" required="">
                        <input type="submit" name="submit" id="submit" value="CREATE ACCOUNT">
					</form>

                    <p>By logging in you agree to our <a href="page.php?type=terms">Terms and Conditions</a> and <a href="page.php?type=privacy">Privacy Policy</a></p>								
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</div>
<!--- /selectroom ---->
<<!--- /footer-top ---->

<!-- signup -->
</body>
</html>
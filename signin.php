<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (isset($_GET['pid'])) {
    $pckId = $_GET['pid'];
}
if(isset($_POST['signin']))
{
$email=$_POST['email'];
$password=md5($_POST['password']);
$sql ="SELECT EmailId,Password FROM tblusers WHERE EmailId=:email and Password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
    $_SESSION['login']=$_POST['email'];
    if (isset($_GET['pid'])) {
        $pckId = $_GET['pid'];
        echo "<script type='text/javascript'> document.location = 'package-details.php?pkgid=$pckId'; </script>";
    } else {
        echo "<script type='text/javascript'> document.location = 'package-list.php'; </script>";
    }
} else{
	// echo "<script>alert('Invalid Details');</script>";
    $sql ="SELECT UserName, Password FROM admin WHERE email=:email and Password=:password";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':email', $email, PDO::PARAM_STR);
    $query-> bindParam(':password', $password, PDO::PARAM_STR);
    $query-> execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0)
    {
    $_SESSION['mainadmin']=$_POST['email'];
    echo "<script type='text/javascript'> document.location = '/tms/admin/mainadmin-dashboard.php'; </script>";
    } else {
        echo "<script>alert('Invalid Details');</script>";

    }
}

}

?>
<!DOCTYPE HTML>
<html>
<head>
<title>TMS | Signin</title>
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
                        <form method="post">
                            <h3>Signin with your account </h3>
                            <input type="text" name="email" id="email" placeholder="Enter your Email"  required="">	
                            <input type="password" name="password" id="password" placeholder="Password" value="" required="">
                            Don't have an account? <?php if (isset($_GET['pid'])) {?><a href="signup.php?pid=<?php echo $pckId;?>">Sign Up</a>
                            <?php } else {?>
                            Don't have an account?<a href="signup.php">Sign Up</a>
                            <?php } ?>	
                            <h4><a href="forgot-password.php">Forgot password</a></h4>
                            
                            <input type="submit" name="signin" value="SIGNIN">
                        </form>
                        <?php
                            if (isset($_GET['msg'])) { ?>
                            <p><?php echo $_GET['msg'];?></p>
                        <?php } ?>
                        <p>By logging in you agree to our <a href="page.php?type=terms">Terms and Conditions</a> and <a href="page.php?type=privacy">Privacy Policy</a></p>								
                    </div>
                    <div class="clearfix"></div>								
            </div>
        </div>
    </div>
</div>

<!-- signup -->		
<!-- //signin -->
<!-- write us -->
</body>
</html>
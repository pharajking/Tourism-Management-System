<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['mainadmin']) == 0)
	{	
header('location:index.php');
}
else{
if(isset($_POST['submit']))
{
$afullname=$_POST['fullname'];
$ausername=$_POST['username'];	
$aemail=$_POST['adminemail'];
$amobile=$_POST['adminmobile'];	
$apassword=$_POST['adminpassword'];
$acpassword=$_POST['adminpassword2'];

if ($apassword == $acpassword) {
    $apassword = md5($apassword);
    $sql="INSERT INTO admin(fullname, UserName, email, mobilephone, Password) VALUES(:fullname,:username,:email,:mobile,:password)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':fullname',$afullname,PDO::PARAM_STR);
    $query->bindParam(':username',$ausername,PDO::PARAM_STR);
    $query->bindParam(':email',$aemail,PDO::PARAM_STR);
    $query->bindParam(':mobile',$amobile,PDO::PARAM_STR);
    $query->bindParam(':password',$apassword,PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if($lastInsertId)
    {
    $msg="Admin Created Successfully";
    }
    else 
    {
    $error="Something went wrong. Please try again";
    }
} else {
    $error="Passwords dont match!";
}

}

	?>
<!DOCTYPE HTML>
<html>
<head>
<title>TMS | Admin Creation</title>

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="css/morris.css" type="text/css"/>
<link href="css/font-awesome.css" rel="stylesheet"> 
<script src="js/jquery-2.1.4.min.js"></script>
<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'/>
<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
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
   <div class="page-container">
   <!--/content-inner-->
<div class="left-content">
	   <div class="mother-grid-inner">
              <!--header start here-->
<?php include('includes/adminheader.php');?>
							
				     <div class="clearfix"> </div>	
				</div>
<!--heder end here-->
	<ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a><i class="fa fa-angle-right"></i>Create Admin </li>
            </ol>
		<!--grid-->
 	<div class="grid-form">
 
<!---->
  <div class="grid-form1">
  	       <h3>Create Administrator</h3>
  	        	  <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
  	         <div class="tab-content">
						<div class="tab-pane active" id="horizontal-form">
							<form class="form-horizontal" name="package" method="post" enctype="multipart/form-data" onSubmit="validatePackage()">
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Admin FullName</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="fullname" id="packagename" placeholder="Admin FullName" required>
									</div>
								</div>
                                <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Admin UserName</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="username" id="packagetype" placeholder="Admin's Username" required>
									</div>
								</div>

                                <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Admin's Email</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="adminemail" id="packagelocation" placeholder=" Admin's Email" required>
									</div>
								</div>

                                <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Admin's Mobile Number</label>
									<div class="col-sm-8">
										<input type="text" maxlength="10" class="form-control1" autocomplete="off" name="adminmobile" id="packageprice" placeholder="Admin's Mobile No" required>
									</div>
								</div>

                                <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Admin's Password</label>
									<div class="col-sm-8">
										<input type="password" class="form-control1" name="adminpassword" id="packagefeatures" placeholder="Admin's Password" required>
									</div>
								</div>			
                                <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Confirm Admin's Password</label>
									<div class="col-sm-8">
										<input type="password" class="form-control1" name="adminpassword2" id="packagefeatures" placeholder="Confirm Admin's Password" required>
									</div>
								</div>
								<div class="row">
                                    <div class="col-sm-8 col-sm-offset-2">
                                        <button type="submit" name="submit" class="btn-primary btn">Create Admin</button>
                                    </div>
                                </div>						
						
						
					</div>
					
					</form>

     
      

      
      <div class="panel-footer">
		
	 </div>
    </form>
  </div>
 	</div>
 	<!--//grid-->

<!-- script-for sticky-nav -->
		<script>
		$(document).ready(function() {
			 var navoffeset=$(".header-main").offset().top;
			 $(window).scroll(function(){
				var scrollpos=$(window).scrollTop(); 
				if(scrollpos >=navoffeset){
					$(".header-main").addClass("fixed");
				}else{
					$(".header-main").removeClass("fixed");
				}
			 });
			 
		});

		</script>
		<!-- /script-for sticky-nav -->
<!--inner block start here-->
<div class="inner-block">

</div>
<!--inner block end here-->
<!--copy rights start here-->
<?php include('includes/footer.php');?>
<!--COPY rights end here-->
</div>
</div>
  <!--//content-inner-->
		<!--/sidebar-menu-->
					<?php include('includes/adminsidebarmenu.php');?>
							  <div class="clearfix"></div>		
							</div>
							<script>
							var toggle = true;
										
							$(".sidebar-icon").click(function() {                
							  if (toggle)
							  {
								$(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
								$("#menu span").css({"position":"absolute"});
							  }
							  else
							  {
								$(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
								setTimeout(function() {
								  $("#menu span").css({"position":"relative"});
								}, 400);
							  }
											
											toggle = !toggle;
										});
							</script>
<!--js -->
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<!-- Bootstrap Core JavaScript -->
   <script src="js/bootstrap.min.js"></script>
   <!-- /Bootstrap Core JavaScript -->	   

</body>
</html>
<?php } ?>
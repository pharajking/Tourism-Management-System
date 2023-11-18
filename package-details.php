<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['submit2']))
{
$pid=intval($_GET['pkgid']);
$fromdate=$_POST['fromdate'];
$todate=$_POST['todate'];
$comment=$_POST['comment'];
$conf_pay_status = "Incomplete";
$status=0;

// $dataform = date('Y-m-d');
$fromdatenew = new DateTime($fromdate);
$todatenew = new DateTime($todate);
$diff = $todatenew->diff($fromdatenew);
// $diffnew = $diff->format("%a");
$sql = "SELECT * from tbltourpackages where PackageId=:pid";
$query = $dbh->prepare($sql);
$query -> bindParam(':pid', $pid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{ 
	$tourdays = $result->tourduration;
}
if (intval($diff->format("%a")) == intval($tourdays) or intval($diff->format("%a")) < intval($tourdays)) {
	if ($_SESSION['login']){
		$useremail=$_SESSION['login'];
		$sql="INSERT INTO tblbooking(PackageId,UserEmail,FromDate,ToDate,Comment,status, pay_status) VALUES(:pid,:useremail,:fromdate,:todate,:comment,:status, :pay_status)";
		$query = $dbh->prepare($sql);
		$query->bindParam(':pid',$pid,PDO::PARAM_STR);
		$query->bindParam(':useremail',$useremail,PDO::PARAM_STR);
		$query->bindParam(':fromdate',$fromdate,PDO::PARAM_STR);
		$query->bindParam(':todate',$todate,PDO::PARAM_STR);
		$query->bindParam(':comment',$comment,PDO::PARAM_STR);
		$query->bindParam(':status',$status,PDO::PARAM_STR);
		$query->bindParam(':pay_status',$conf_pay_status,PDO::PARAM_STR);
		$query->execute();
		$lastInsertId = $dbh->lastInsertId();
		if($lastInsertId)
		{
		$msg="Booked Successfully";
		echo "<script type='text/javascript'> document.location = 'confirming-page.php'; </script>";
		}
		else 
		{
		$error="Something went wrong. Please try again";
		}
	} else {
		$_SESSION['pkgId'] = $pid;
		$_SESSION['fromdate'] = $_POST['fromdate'];
		$_SESSION['todate'] = $_POST['todate'];
		$_SESSION['comment'] = $_POST['comment'];
		echo "<script type='text/javascript'> document.location = 'signin.php?pid=$pid'; </script>";
	}
} else {
	echo "<script type='text/javascript'> alert('Please choose the number of days equivalent to the days offered for this package!'); </script>";
}
}
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>TMS | Package Details</title>
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
	<script>
		$(function() {
		$( "#datepicker,#datepicker1" ).datepicker();
		});
	</script>
	<?php 
	if (isset($_GET['guestSess'])) {
		echo "<script > $('#myModal4').modal('show'); </script>";
	}
	?>
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
<?php include('includes/header.php');?>
<div class="banner-3">
	<div class="container">
		<h1 class="wow zoomIn animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: zoomIn;"> TMS -Package Details</h1>
	</div>
</div>
<!--- /banner ---->
<!--- selectroom ---->
<div class="selectroom">
	<div class="container">	
		  <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
<?php 

$movedfromDate = "";
$movedcomment = "";
$movedtoDate = "";

if(isset($_SESSION['fromdate'])) {
	$movedfromDate = $_SESSION['fromdate'];	
}

if ($_SESSION['comment']) {
	$movedcomment = $_SESSION['comment'];
}

if ($_SESSION['todate']) {
	$movedtoDate = $_SESSION['todate'];
}

$pid=intval($_GET['pkgid']);
$sql = "SELECT * from tbltourpackages where PackageId=:pid";
$query = $dbh->prepare($sql);
$query -> bindParam(':pid', $pid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{	?>

<form name="book" method="post">
		<div class="selectroom_top">
			<div class="col-md-4 selectroom_left wow fadeInLeft animated" data-wow-delay=".5s">
				<img src="admin/pacakgeimages/<?php echo htmlentities($result->PackageImage);?>" class="img-responsive" alt="">
			</div>
			<div class="col-md-8 selectroom_right wow fadeInRight animated" data-wow-delay=".5s">
				<h2><?php echo htmlentities($result->PackageName);?></h2>
				<p class="dow">#PKG-<?php echo htmlentities($result->PackageId);?></p>
				<p><b>Package Type :</b> <?php echo htmlentities($result->PackageType);?></p>
				<p><b>Package Location :</b> <?php echo htmlentities($result->PackageLocation);?></p>
					<p><b>Features</b> <?php echo htmlentities($result->PackageFetures);?></p>
					<p><b>Duration: <?php echo htmlentities($result->tourduration) ?> Days</b></p>
					<div class="ban-bottom">
				<div class="bnr-right">
				<label class="inputLabel">From</label>
				<input class="date" id="datepicker" type="text" placeholder="dd-mm-yyyy"  name="fromdate" required=""
				value=<?php echo $movedfromDate;?>>
			</div>
			<div class="bnr-right">
				<label class="inputLabel">To</label>
				<input class="date" id="datepicker1" type="text" placeholder="dd-mm-yyyy" name="todate" required=""
				value=<?php echo $movedtoDate;?>>
			</div>
			</div>
						<div class="clearfix"></div>
				<div class="grand">
					<p>Grand Total</p>
					<h3>USD <?php echo htmlentities($result->PackagePrice);?></h3>  
				</div>
			</div>
		<h3>Package Details</h3>
				<p style="padding-top: 1%"><?php echo htmlentities($result->PackageDetails);?> </p>	
				<div class="clearfix"></div>
		</div>
		<div class="selectroom_top">
			<h2>Travels</h2>
			<div class="selectroom-info animated wow fadeInUp animated" data-wow-duration="1200ms" data-wow-delay="500ms" style="visibility: visible; animation-duration: 1200ms; animation-delay: 500ms; animation-name: fadeInUp; margin-top: -70px">
				<ul>
				  <?php if (!$_SESSION['login']) {?>
					<li class="spe">
						<label class="inputLabel">Comment</label>
						<input type="text" name="comment" required="" value="">
					</li>
					<?php } else {?>
					<li class="spe">
						<label class="inputLabel">Comment</label>
						<input class="special" type="text" name="comment" required="" value="I am expecting the best experience.">
					</li>
					<?php }?>
						<li class="spe" align="center">
					<button type="submit" name="submit2" class="btn-primary btn">Book</button>
						</li>
						<?php// } else {

							?>
							<!-- <li class="sigi" align="center" style="margin-top: 1%">
							<a href="#" data-toggle="modal" data-target="#myModal4" class="btn-primary btn" > Book</a></li> -->
							<?php //} ?>
					<div class="clearfix"></div>
				</ul>
			</div>
			
		</div>
		</form>
<?php }} ?>


	</div>
</div>
<!--- /selectroom ---->
<<!--- /footer-top ---->
<?php include('includes/footer.php');?>
<!-- signup -->
<?php include('includes/signup.php');?>			
<!-- //signu -->
<!-- signin -->
<?php include('includes/signin.php');?>			
<!-- //signin -->
<!-- write us -->
<?php include('includes/write-us.php');?>
</body>
</html>
<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['confirm']))
{
$fullname=$_POST['fullname'];
$mobilenumber=$_POST['mobilenumber'];
$email = $_SESSION['login'];
$conf_pay_status = "Complete";
$sql ="SELECT EmailId, FullName, MobileNumber FROM tblusers WHERE EmailId=:email and FullName=:fullname and MobileNumber=:mobilenumber";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':fullname', $fullname, PDO::PARAM_STR);
$query-> bindParam(':mobilenumber', $mobilenumber, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0) {
	$sql="update tblbooking set pay_status=:pay_status where UserEmail=:email";
	$query = $dbh->prepare($sql);
	$query->bindParam(':pay_status',$conf_pay_status,PDO::PARAM_STR);
	$query->bindParam(':email',$email,PDO::PARAM_STR);
	$query->execute();
	echo "<script type='text/javascript'> document.location = 'confirming-page.php?status=paymentpending&confirmstatus=0';</script>";
} else {
	echo "<script>alert('Invalid Details!Make sure to enter the correct credentials you registered with!');</script>";
}

}

?>
<script>
	function MM_jumpMenu(targ,selObj,restore){ //v3.0
	eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
	if (restore) selObj.selectedIndex=0;
	}
</script>


<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content modal-info">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>						
						</div>
						<div class="modal-body modal-spa">
							<div class="login-grids">
								<div class="login">
									<div class="login-left">
										Make Your Payments
										<div class="form-group">
											<label for="focusedinput" class="col-sm-6 control-label">Payment Method</label>
											<div class="col-sm-8 mt-2">
												<select name="menu1">
													<option value="Mobile">Mobile</option>
												</select>
											</div>
										</div>
									</div>
									<div class="login-right">
										<form method="post">
										    <input type="text" value="" placeholder="Full Name" name="fullname" required="">

                                            <input type="text" value="" placeholder="Mobile Number" maxlength="10" name="mobilenumber" autocomplete="off" required="">
											<p>Lipa Namba: 299129</p>
											<input type="submit" name="confirm" value="Confirm">
										</form>
									</div>
									<div class="clearfix"></div>								
								</div>
								<p>By logging in you agree to our <a href="page.php?type=terms">Terms and Conditions</a> and <a href="page.php?type=privacy">Privacy Policy</a></p>
							</div>
						</div>
                    </div>
                </div>
</div>


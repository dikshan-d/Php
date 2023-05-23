<?php
error_reporting(0);
if (isset($_POST['create'])) {
	$fname = trim($_POST['fname']);
	$mnumber = trim($_POST['mobilenumber']);
	$email = trim($_POST['email']);
	$temp = trim($_POST['password']);

	if (!empty($fname) and !empty($mnumber) and !empty($email) and !empty($temp)) {
		if (strlen($mnumber) >= 10){
			if (strlen($temp) > 6 ) {
				$password = md5($temp);
				$sql = "INSERT INTO  tblusers(FullName,MobileNumber,EmailId,Password) VALUES(:fname,:mnumber,:email,:password)";
				$query = $dbh->prepare($sql);
				$query->bindParam(':fname', $fname, PDO::PARAM_STR);
				$query->bindParam(':mnumber', $mnumber, PDO::PARAM_STR);
				$query->bindParam(':email', $email, PDO::PARAM_STR);
				$query->bindParam(':password', $password, PDO::PARAM_STR);
				$query->execute();
				$lastInsertId = $dbh->lastInsertId();
				if ($lastInsertId) {
					echo "<script type='text/javascript'> document.location = 'Create.php'; </script>";;
				} else {
					echo "<script>alert('Something went wrong. Please try again.');</script>";
				}
			} else {
				echo "<script>alert('Password should be more than 6 letters');</script>";
			}

		}else {
			echo "<script>alert('Phone number should be more than 9 letters');</script>";
		}

		
	} 
}
?>
<!--Javascript for check email availabilty-->
<script>
	function checkAvailability() {

		$("#loaderIcon").show();
		jQuery.ajax({
			url: "check_availability.php",
			data: 'emailid=' + $("#email").val(),
			type: "POST",
			success: function(data) {
				$("#user-availability-status").html(data);
				$("#loaderIcon").hide();
			},
			error: function() {}
		});
	}
</script>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<section>
				<div class="modal-body modal-spa">
					<div class="login-grids">
						<div class="login">
							<div class="login-left">
								<ul>
									<div style="width:200px;height:180px;border:9px outset #35a492;">
										<font color=#35a492>
											<h1> Welcome to Holiday Hype</h1>
										</font>
									</div>
								</ul>
							</div>
							<div class="login-right">
								<form name="signup" method="post">
									<h3>Create your account </h3>


									<input type="text" value="" placeholder="Full Name" name="fname" autocomplete="off" required="">
									<input type="text" value="" placeholder="Mobile number" maxlength="10" name="mobilenumber" autocomplete="off" required="">
									<input type="text" value="" placeholder="Email id" name="email" id="email" onBlur="checkAvailability()" autocomplete="off" required="">
									<span id="user-availability-status" style="font-size:12px;"></span>
									<input type="password" value="" placeholder="Password" name="password" required="">
									<input type="submit" name="create" id="create" value="CREATE ACCOUNT">
								</form>
							</div>
							<div class="clearfix"></div>
						</div>

					</div>
				</div>
			</section>
		</div>
	</div>
</div>
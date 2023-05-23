<?php
session_start();
if (isset($_POST['signin'])) {
	$email = trim($_POST['email']);
	$temp = trim($_POST['password']);
	if (!empty($email) and !empty($temp)) {
		$password = md5($_POST['password']);
		$sql = "SELECT EmailId,Password FROM tblusers WHERE EmailId=:email and Password=:password";
		$query = $dbh->prepare($sql);
		$query->bindParam(':email', $email, PDO::PARAM_STR);
		$query->bindParam(':password', $password, PDO::PARAM_STR);
		$query->execute();
		$results = $query->fetchAll(PDO::FETCH_OBJ);
		if ($query->rowCount() > 0) {
			$_SESSION['login'] = $_POST['email'];
			echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
		} else {

			echo "<script>alert('Invalid Details');</script>";
		}
	}else{
		echo "<script>alert('Fill all Details');</script>";

	}
}

?>

<div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content modal-info">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
			</div>
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
							<form method="post">
								<h3>Signin with your account </h3>
								<input type="text" name="email" id="email" placeholder="Enter your Email" required="">
								<input type="password" name="password" id="password" placeholder="Password" value="" required="">
								<h4><a href="forgot-password.php">Forgot password</a></h4>

								<input type="submit" name="signin" value="SIGNIN">
							</form>
						</div>
						<div class="clearfix"></div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
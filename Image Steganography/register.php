<?php
include_once 'functions/nav.php';
include_once 'functions/auth.php';
user_has_valid_cookie();
user_has_valid_cookie();
if(isset($_COOKIE['user'])){
	echo '<script>window.location.replace("index.php");</script>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>CP | register</title>
  <link rel="stylesheet" href="css/materialdesignicons.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="container-scroller">
    <?php main_nav(); ?>
    <div class="container-fluid page-body-wrapper">
    <?php side_nav(); ?>
      <div class="main-panel">
		<div class="content-wrapper align-items-center auth px-0">
			<div class="row w-100 mx-0">
			<?php
			if(isset($_POST['fname'])){
				register_attempt_errors();
			}
			?>
			  <div class="col-lg-6 mx-auto">
				<div class="auth-form-light text-left py-5 px-4 px-sm-5">
				  <h4>Register</h4>
				  <h6 class="font-weight-light">Using an account allows you to get more features</h6>
				  <?php
					if(isset($_POST['fname'])){
						$error = register_attempt();
					?>
					<form class="pt-3" method="POST" action="register.php">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group row">
							  <div class="col-sm-12">
								<input type="text" class="form-control" id="fname" placeholder="First name" name="fname" value="<?php echo $_POST['fname']; ?>" required>
							  </div>
							</div>
						  </div>
						  <div class="col-md-6">
							<div class="form-group row">
							  <div class="col-sm-12">
								<input type="text" class="form-control" id="lname" placeholder="Last name" name="lname" value="<?php echo $_POST['lname']; ?>" required>
							  </div>
							</div>
						  </div>
						</div>
					<div class="form-group">
					<?php
						if($error == "uname"){
							echo '<input type="text" class="form-control form-control-lg" id="uname" placeholder="Username" name="uname" style="border:1px solid red;" value="'.$_POST['uname'].'" required>';
						}else{
							echo '<input type="text" class="form-control form-control-lg" id="uname" placeholder="Username" name="uname" value="'.$_POST['uname'].'" required>';
						}
					?>
					</div>
					<div class="form-group">
					<?php
						if($error == "email"){
							echo '<input type="email" class="form-control form-control-lg" id="email" placeholder="Email" name="email" value="'.$_POST['email'].'" style="border:1px solid red;" required>';
						}else{
							echo '<input type="email" class="form-control form-control-lg" id="email" placeholder="Email" name="email" value="'.$_POST['email'].'" required>';
						}
					?>               
					</div>
					<div class="form-group">
					<?php
						if($error == "pass"){
							echo '<input type="password" class="form-control form-control-lg" id="pass1" placeholder="Password" style="border:1px solid red;" name="password" required>';
						}else{
							echo '<input type="password" class="form-control form-control-lg" id="pass1" placeholder="Password" name="password" required>';
						}
					?>
					</div>
					<div class="form-group">
					<?php
						if($error == "pass"){
							echo '<input type="password" class="form-control form-control-lg" id="pass2" placeholder="Repeat Password" name="password_repeat" style="border:1px solid red;" required>';
						}else{
							echo '<input type="password" class="form-control form-control-lg" id="pass2" placeholder="Repeat Password" name="password_repeat" required>';
						}
					?>
					</div>
					<div class="mt-3">
					  <input type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" value="Submit">
					</div>
					<div class="text-center mt-4 font-weight-light">
					  Already have an account? <a href="login.php" class="text-primary">Login</a>
					</div>
				  </form>
					<?php
					}else{
					?>
				  <form class="pt-3" method="POST" action="register.php">
				  <div class="row">
						<div class="col-md-6">
							<div class="form-group row">
							  <div class="col-sm-12">
								<input type="text" class="form-control" id="fname" placeholder="First name" name="fname" required>
							  </div>
							</div>
						  </div>
						  <div class="col-md-6">
							<div class="form-group row">
							  <div class="col-sm-12">
								<input type="text" class="form-control" id="lname" placeholder="Last name" name="lname" required>
							  </div>
							</div>
						  </div>
						</div>
					<div class="form-group">
					  <input type="text" class="form-control form-control-lg" id="uname" placeholder="Username" name="uname" required>
					</div>
					<div class="form-group">
					  <input type="email" class="form-control form-control-lg" id="email" placeholder="Email" name="email" required>
					</div>
					<div class="form-group">
					  <input type="password" class="form-control form-control-lg" id="pass1" placeholder="Password" name="password" required>
					</div>
					<div class="form-group">
					  <input type="password" class="form-control form-control-lg" id="pass2" placeholder="Repeat Password" name="password_repeat" required>
					</div>
					<div class="mt-3">
					  <input type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" value="Submit">
					</div>
					<div class="text-center mt-4 font-weight-light">
					  Already have an account? <a href="login.php" class="text-primary">Login</a>
					</div>
				  </form>
				  <?php
					}
					?>
				</div>
			  </div>
			</div>
        </div>
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2019 <a href="https://fri.uni-lj.si/sl" target="_blank">FRI</a> - Nejc Žun</span>
          </div>
        </footer>
      </div>
    </div>
  </div>
  <script src="js/jquery.js"></script>
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
</body>

</html>
<?php
include_once 'functions/nav.php';
include_once 'functions/auth.php';
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
    <?php main_nav();?>
    <div class="container-fluid page-body-wrapper">
      <?php side_nav(); ?>
      <div class="main-panel">
		<div class="content-wrapper align-items-center auth px-0">
			<?php
			if(isset($_GET['register'])){
				success("You have been registered. You can now login below.");
			}
			if(isset($_POST['username'])){
				login_attempt($_POST['username'], $_POST['password']);
			}
			?>
			<div class="row w-100 mx-0">
			  <div class="col-lg-6 mx-auto">
				<div class="auth-form-light text-left py-5 px-4 px-sm-5">
				  <h4>Login</h4>
				  <h6 class="font-weight-light">Sign in to continue.</h6>
				  <form class="pt-3" method="POST" action="login.php">
					<div class="form-group">
					  <input type="text" class="form-control form-control-lg" id="uname" placeholder="Username" name="username" required>
					</div>
					<div class="form-group">
					  <input type="password" class="form-control form-control-lg" id="password" placeholder="Password" name="password" required>
					</div>
					<div class="mt-3">
					  <input type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" value="Submit">
					</div>
					<div class="text-center mt-4 font-weight-light">
					  Don't have an account? <a href="register.php" class="text-primary">Register</a>
					</div>
				  </form>
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
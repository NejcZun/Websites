<?php
include_once '../functions/nav.php';
include_once '../functions/auth.php';
include_once '../functions/project.php';
user_has_valid_cookie();
if(! check_if_user_admin()){
	echo '<script>window.location.replace("../index.php");</script>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>CP | register</title>
  <link rel="stylesheet" href="../css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/table.css">
</head>
<body>
  <div class="container-scroller">
    <?php main_nav_admin();?>
    <div class="container-fluid page-body-wrapper">
      <?php side_nav_admin(); ?>
      <div class="main-panel">
		<div class="content-wrapper align-items-center auth px-0">
			<?php admin_display(); ?>
		  </div>
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2019 <a href="https://fri.uni-lj.si/sl" target="_blank">FRI</a> - Nejc Žun</span>
          </div>
        </footer>
      </div>
    </div>
  </div>
  <script src="../js/jquery.js"></script>
  <script src="../js/off-canvas.js"></script>
  <script src="../js/hoverable-collapse.js"></script>
</body>

</html>
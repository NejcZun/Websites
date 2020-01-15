<?php
include_once 'functions/nav.php';
include_once 'functions/auth.php';
include_once 'functions/project.php';
user_has_valid_cookie();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>CP | register</title>
  <link rel="stylesheet" href="css/materialdesignicons.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/table.css">
  <?php
  if(isset($_GET['open']) or isset($_GET['delete'])){
	  echo '<link rel="stylesheet" href="css/special-table.css">';
  }
  ?>
</head>
<body>
  <div class="container-scroller">
    <?php main_nav();?>
    <div class="container-fluid page-body-wrapper">
      <?php side_nav(); ?>
      <div class="main-panel">
		<div class="content-wrapper align-items-center auth px-0">
			<?php display_user_images(); ?>
		  </div>
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2019 <a href="https://fri.uni-lj.si/sl" target="_blank">FRI</a> - Nejc Žun</span>
          </div>
        </footer>
      </div>
    </div>
  </div>
	<div id="myModal" class="modal">
		  <span class="close">&times;</span>
		  <img class="modal-content" id="img01">
		  <div id="caption"></div>
	</div>
	<?php
	if(isset($_GET['open']) or isset($_GET['delete'])){
	?>
	<script>
	var modal = document.getElementById("myModal");
	var img = document.getElementById("myImg");
	var modalImg = document.getElementById("img01");
	var captionText = document.getElementById("caption");
	img.onclick = function(){
	  modal.style.display = "block";
	  modalImg.src = this.src;
	  captionText.innerHTML = this.alt;
	}
	var span = document.getElementsByClassName("close")[0];

	span.onclick = function() { 
	  modal.style.display = "none";
	}
  </script>
	<?php } ?>
  <script src="js/jquery.js"></script>
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
</body>

</html>
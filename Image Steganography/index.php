<?php 
include_once 'installation.php';
include_once 'functions/nav.php';
include_once 'functions/auth.php';
user_has_valid_cookie();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>CP | Home</title>
  <link rel="stylesheet" href="css/materialdesignicons.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="container-scroller">
    <?php main_nav(); ?>
    <div class="container-fluid page-body-wrapper">
      <?php side_nav(); ?>
      <div class="main-panel">
        <div class="content-wrapper">
		  <div class="row" id="input-error"></div>
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body dashboard-tabs p-0">
                  <ul class="nav nav-tabs px-12" role="tablist">
                    <li class="nav-item" style="width:50%; text-align:center;">
                      <a class="nav-link active" id="crypt-tab" data-toggle="tab" href="#crypt" role="tab" aria-controls="crypt" aria-selected="true">Crypt</a>
                    </li>
                    <li class="nav-item" style="width:50%; text-align:center;">
                      <a class="nav-link" id="decrypt-tab" data-toggle="tab" href="#decrypt" role="tab" aria-controls="decrypt" aria-selected="false">Decrypt</a>
                    </li>
                  </ul>
                  <div class="tab-content py-0 px-0">
                    <div class="tab-pane fade show active" id="crypt" role="tabpanel" aria-labelledby="crypt-tab">
                      <div class="d-flex flex-wrap justify-content-xl-between">
                        <div class="d-flex py-3 border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <div class="d-flex flex-column justify-content-around" style="width:90%;">
						   <!-- TUKI NOTR -->
                            <h4>Step 1: Select an image</h4>
							<div class="form-group">
							  <label>Upload an image (Must be bigger than 64x64)</label>
							  <input type="file" name="img[]" id="file" accept="image/*" class="file-upload-default" required>
							  <div class="input-group col-xs-12">
								<input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image">
								<span class="input-group-append">
								  <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
								</span>
							  </div>
							</div>
							<h4>Step 2: Choose an encryption level</h4>
							<div class="form-group">
								<label for="exampleFormControlSelect3">The bigger the level the higher the encryption</label>
								<select class="form-control form-control-sm" name="mode" id="mode">
									<option value="0" id="m0">Level 0</option>
									<option value="1" id="m1">Level 1</option>
									<option value="2" id="m2">Level 2</option>
									<option value="3" id="m3">Level 3</option>
									<option value="4" id="m4">Level 4</option>
									<option value="5" id="m5">Level 5</option>
								</select>
							</div>
							<h4>Step 3: Add a password to encrypt the image</h4>
							<div class="form-group">
								<label>Adds an aditional layer of security (optional)</label>
								<input type="text" class="form-control" placeholder="No password" aria-label="Password" value="" id="pass">
							</div>
							<h4>Message:</h4>
							<div class="form-group">
							  <label for="exampleTextarea1">Write the message below (amount of characters is dependant on the image size)</label>
							  <textarea class="form-control" id="msg" rows="4">Write a message that you wish to be encrypted!</textarea>
							</div>
							<a href="javascript: writeIMG()" class="btn btn-primary mr-2">Write message into image</a>
							<!-- TUKI NOTR -->
						  </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="decrypt" role="tabpanel" aria-labelledby="decrypt-tab">
                      <div class="d-flex flex-wrap justify-content-xl-between">
                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <div class="d-flex flex-column justify-content-around" style="width:90%;">
                            <!-- TUKI NOTR -->
                            <h4>Step 1: Select an image</h4>
							<div class="form-group">
							  <label>Upload an image</label>
							  <input type="file" name="img[]" id="file2" accept="image/*" class="file-upload-default" required>
							  <div class="input-group col-xs-12">
								<input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image">
								<span class="input-group-append">
								  <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
								</span>
							  </div>
							</div>
							<h4>Step 2: Choose an decryption level</h4>
							<div class="form-group">
								<label for="exampleFormControlSelect3">The level of decryption has to be equal to the encryption level of the image</label>
								<select class="form-control form-control-sm" name="mode" id="mode2">
									<option value="0" id="m0">Level 0</option>
									<option value="1" id="m1">Level 1</option>
									<option value="2" id="m2">Level 2</option>
									<option value="3" id="m3">Level 3</option>
									<option value="4" id="m4">Level 4</option>
									<option value="5" id="m5">Level 5</option>
								</select>
							</div>
							<h4>Step 3: Input the image password</h4>
							<div class="form-group">
								<label>If the encrypted image has a password you need it in order to get the correct data</label>
								<input type="text" class="form-control" placeholder="No password" aria-label="Password" value="" id="pass2">
							</div>
							<a href="javascript: readIMG()" class="btn btn-primary mr-2">Read message from image</a>
                          <!-- TUKI NOTR -->
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Results</p>
					<p>
					<div id="result" style="background-color: #009688; color:white; padding: 10px 10px 10px 10px;">Please finish step 1~3 above and click the button below. Your result will then show up here!</div>
					</p>
					<p style="text-align:center">
					<img id="resultimg" style="display:none" src="" style="width:100%;"/>
					<form>
					<input type="text" id="image_hidden" hidden="hidden" value=""/>
					</form>
					</p>
                </div>
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
  <script type="text/javascript" src="js/file-upload.js"></script>
  
  <script type="text/javascript" src="js/sha512.js"></script>
  <script type="text/javascript" src="js/utf_8.js"></script>
  <script type="text/javascript" src="js/crypto.js"></script>
  <script type="text/javascript" src="js/readimg.js"></script>
  <script type="text/javascript" src="js/setimg.js"></script>
  <script type="text/javascript" src="js/main.js"></script>
  <script type="text/javascript">
	function saveIMG(){
		
		
	}
	function writeIMG(){
		if($("#msg").val().length != 0){
			
			$("#resultimg").hide();
			$("#resultimg").attr('src','');
			$("#result").html('Processing...');
			function writefunc(){
				var selectedVal = '';
				var selected = $("#mode");
				if (selected.length > 0) {
					selectedVal = selected.val();
				}
				var t = writeMsgToCanvas('canvas',$("#msg").val(),$("#pass").val(),selectedVal);
				if(t!=null){ 
					var myCanvas = document.getElementById("canvas");  
					var image = myCanvas.toDataURL("image/png");    
					$("#resultimg").attr('src',image);
					$("#result").html('Success! Save the result image below.');
					$("#resultimg").show();
					<?php 
					if(isset($_COOKIE['user'])){
					?>
					//save to folder
					$("#image_hidden").attr('value',image);
					$.ajax({
					type: 'POST',
					url: 'functions/save-image.php',
					data: { select: selectedVal, data: image, message: $("#msg").val(), password: $("#pass").val()},
					success: function(response) {
						$('#image_hidden').html(response);
					}
					});
					<?php
					}
					?>
				}
			}
			loadIMGtoCanvas('file','canvas',writefunc,500);
			
		}else{
			let er = document.getElementById('input-error');
			er.innerHTML = '<div class="row w-100 mx-0"><div class="col-lg-12 mx-auto" style="margin-bottom:20px;"><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close" onClick="this.parentNode.parentNode.parentNode.remove();"><i class="mdi mdi-close"></i></button><span><b> Error - </b> You need to write a message</span></div></div></div>';
		}
	}
	function readIMG(){
		$("#resultimg").hide();
		$("#result").html('Processing...');
		function readfunc(){
			var selectedVal = '';
			var selected = $("#mode2");
			if (selected.length > 0) {
				selectedVal = selected.val();
			}
			var t= readMsgFromCanvas('canvas',$("#pass2").val(),selectedVal);
			if(t!=null){
				t=t.split('&').join('&amp;');
				t=t.split(' ').join('&nbsp;'); 
				t=t.split('<').join('&lt;');
				t=t.split('>').join('&gt;');
				t=t.replace(/(?:\r\n|\r|\n)/g, '<br />');
				$("#result").html(t);
			}else $("#result").html('ERROR REAVEALING MESSAGE!');
				 
		}
		loadIMGtoCanvas('file2','canvas',readfunc);
	}
	</script>
</body>

</html>


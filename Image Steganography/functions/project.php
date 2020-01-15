<?php
function display_user_images(){
	if(isset($_POST['delete'])){
		image_delete($_POST['delete']);
	}
	if(isset($_GET['open'])){
		if(check_if_user_owner($_GET['open'])){
			open_image($_GET['open']);
		}else{
			not_own_image();
		}
	}else if(isset($_GET['delete'])){
		if(check_if_user_owner($_GET['delete'])){
			delete_image($_GET['delete']);
		}else{
			not_own_image();
		}
	}else{
		display_images();
	}
}
function check_if_user_owner($id){
	global $db;
	$user_id = db_get_userId(get_username_from_cookie());
	$query = "SELECT EXISTS(SELECT * from images WHERE user_id={$user_id} and image_id = {$id}) AS checkExists";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch();
    if($result['checkExists'] == 1) return true;
    return false;	
}
function image_delete($id){
	global $db;
	
	/*DB*/
	$query = "Delete FROM images WHERE image_id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
	
	/*image*/
	$file = "images/images.json";
	$jsondata = file_get_contents($file);
	$num=0;
	$arr_data = json_decode($jsondata, true);
	for($i=0;$i<sizeof($arr_data); $i++){
		if($arr_data[$i]["id"] == $id){
			$num=$i;
			break;
		}
	}
	array_splice($arr_data, $num, 1);
	$jsondata = json_encode($arr_data, JSON_PRETTY_PRINT);
	file_put_contents($file, $jsondata);
	
}
function db_get_userId($user){
    global $db;

    $query = "SELECT id FROM user WHERE uname = :uname";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":uname", $user);
    $stmt->execute();
    $result = $stmt->fetch();
    return $result['id'];
}
function display_images(){
	$user_id = db_get_userId(get_username_from_cookie());
    global $db;	
	$str = "SELECT * from images where user_id = {$user_id}";
    $stmt = $db->prepare($str);
    $stmt->execute();
	if($stmt->rowCount() === 0){
		has_no_images();
	}else{
	/* build the table class below: */
		echo '<div class="table-responsive-vertical shadow-z-1" style="width:95%; margin:auto;">
			  <table id="table" class="table table-hover table-mc-light-blue">
				<thead>
					<tr>
						<th>Message</th>
						<th>Encryption</th>
						<th>Password</th>
						<th>Image</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>';
		
		while ($row = $stmt->fetch()) {
			echo '<tr>
				  <td data-title="Message" style="vertical-align:middle;">'.$row['message'].'</td>
				  <td data-title="Encryption" style="vertical-align:middle;" >'.$row['mode'].'</td>
				  <td data-title="Password" style="vertical-align:middle;" >'.$row['password'].'</td>
				  <td data-title="Image" style="vertical-align:middle;" ><img src="'.get_image($row['image_id']).'"></td>
				  <td data-title="Action">
					 <a href="history.php?open='.$row['image_id'].'" style="text-decoration:none;" class="btn btn-secondary btn-fw">Open</a>
					 <a href="history.php?delete='.$row['image_id'].'" style="text-decoration:none;" class="btn btn-danger btn-fw">Delete</a>
				  </td>
				</tr>';
		}
		  echo '</tbody>
			</table>
		</div>';
	}
}
function has_no_images(){
	echo '<div class="row w-100 mx-0">
			  <div class="col-lg-4 mx-auto">
				<div class="auth-form-light text-left py-5 px-4 px-sm-5">
				  <h4>No Images</h4>
				  <h6 class="font-weight-light" style="margin-top:15px;">Click <a href="index.php">here</a> to create your first encrypted image.</h6>
				</div>
			  </div>
			</div>';
	
}
function get_image($id){
	$file = "images/images.json";
	$jsondata = file_get_contents($file);
	$arr_data = json_decode($jsondata, true);
	foreach($arr_data as $element){
		if($element['id'] == $id){
			return $element['data'];
		};
	}
}
function open_image($id){
	$img=get_image($id);
    global $db;	
	$str = "SELECT * from images where image_id = {$id}";
    $stmt = $db->prepare($str);
    $stmt->execute();
	if($stmt->rowCount() === 0){
		echo "Image doesn't exist";
	}else{
	/* build the table class below: */
		echo '<div class="table-responsive-vertical shadow-z-1" style="width:95%; margin:auto;">
			  <table id="table" class="table table-hover table-mc-blue">
				<thead>
					<tr>
						<th>Message</th>
						<th>Encryption</th>
						<th>Password</th>
						<th>Image</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>';
		
		while ($row = $stmt->fetch()) {
			echo '<tr>
				  <td data-title="Message" style="vertical-align:middle;">'.$row['message'].'</td>
				  <td data-title="Encryption" style="vertical-align:middle;" >'.$row['mode'].'</td>
				  <td data-title="Password" style="vertical-align:middle;" >'.$row['password'].'</td>
				  <td data-title="Image" style="vertical-align:middle;" ><img id="myImg" src="'.$img.'" class="big-image" style="cursor:pointer;"></td>
				  <td data-title="Action">
					 <a href="history.php" style="text-decoration:none;" class="btn btn-secondary btn-fw">Back</a>
				  </td>
				</tr>';
		}
		  echo '</tbody>
			</table>
		</div>';
	}
}
function delete_image($id){
	$img=get_image($id);
    global $db;	
	$str = "SELECT * from images where image_id = {$id}";
    $stmt = $db->prepare($str);
    $stmt->execute();
	if($stmt->rowCount() === 0){
		has_no_projects();
	}else{
	/* build the table class below: */
		echo '<center><h4>Are you sure you want to delete this image?</h4></center><div class="table-responsive-vertical shadow-z-1" style="width:95%; margin:auto;">
			  <table id="table" class="table table-hover table-mc-blue">
				<thead>
					<tr>
						<th>Message</th>
						<th>Encryption</th>
						<th>Password</th>
						<th>Image</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>';
		
		while ($row = $stmt->fetch()) {
			echo '<tr>
				  <td data-title="Message" style="vertical-align:middle;">'.$row['message'].'</td>
				  <td data-title="Encryption" style="vertical-align:middle;" >'.$row['mode'].'</td>
				  <td data-title="Password" style="vertical-align:middle;" >'.$row['password'].'</td>
				  <td data-title="Image" style="vertical-align:middle;" ><img id="myImg" src="'.$img.'" class="big-image" style="cursor:pointer;"></td>
				  <td data-title="Action">
					<form method="POST" action="history.php">
					 <button type="submit" name="delete" style="text-decoration:none;" class="btn btn-danger btn-fw" value="'.$id.'">Yes</button>
					 <a href="history.php" style="text-decoration:none;" class="btn btn-success btn-fw">No</a>
					 </form>
					 
				  </td>
				</tr>';
		}
		  echo '</tbody>
			</table>
		</div>';
	}
}





/* ADMIN STUFF */
function admin_display(){
	if(isset($_POST['delete'])){
		delete_user($_POST['delete']);
	}
	//views:
	if(isset($_GET['edit'])){
		edit_user($_GET['edit']);
	}else if(isset($_GET['delete'])){
		display_user_delete($_GET['delete']);
	}else{
		display_users();
	}
}
function edit_user($id){
	if(isset($_POST['edit'])){
		update_user($id);
	}
	display_user($id);
}
function update_user($id){
	global $db;
	$str = "UPDATE user SET fname = :fname, lname = :lname, uname = :uname, email = :email, role_id = :role WHERE id = :id";
    $stmt = $db->prepare($str);
	$stmt->bindParam(":id", $id);
    $stmt->bindParam(":fname", $_POST['fname']);
	$stmt->bindParam(":lname", $_POST['lname']);
	$stmt->bindParam(":uname", $_POST['uname']);
	$stmt->bindParam(":email", $_POST['email']);
	$stmt->bindParam(":role", $_POST['rolename']);
    $stmt->execute();
}
function delete_user($id){
	global $db;
	
	/* delete from images */
	$stmt = $db->prepare("DELETE FROM images WHERE user_id = :id");
	$stmt->bindParam(':id', $id);
	$stmt->execute();
	/* delete from users */
	$stmt = $db->prepare("DELETE FROM user WHERE id = :id");
	$stmt->bindParam(':id', $id);
	$stmt->execute();
	
	
}
function display_user_delete($id){
    global $db;	
$str = "SELECT u.id, u.uname, u.fname, u.lname, u.email, r.rolename, r.role_id from user u join role r on r.role_id = u.role_id where u.id = {$id}";
    $stmt = $db->prepare($str);
    $stmt->execute();
	if($stmt->rowCount() === 0){
		user_doesnt_exist();
	}else{
		echo '<center><h4>Are you sure you want to delete this user? </h4></center><div class="table-responsive-vertical shadow-z-1" style="width:95%; margin:auto;">
			  <table id="table" class="table table-hover table-mc-light-blue">
				<thead>
					<tr>
						<th>Name</th>
						<th>Username</th>
						<th>Email</th>
						<th>Role</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>';
		
		while ($row = $stmt->fetch()) {
			echo '<tr>
				  <td data-title="Name" style="vertical-align:middle;">'.$row['fname'].' '.$row['lname'].'</td>
				  <td data-title="Username" style="vertical-align:middle;" >'.$row['uname'].'</td>
				  <td data-title="Email" style="vertical-align:middle;" >'.$row['email'].'</td>
				  <td data-title="Role" style="vertical-align:middle;" >'.$row['rolename'].'</td>
				  <td data-title="Action" class="material-table-td-action">
				 <form method="POST" action="index.php">
				 	<button type="submit" class="btn btn-danger btn-fw" style="min-width:80px;" name="delete" value="'.$row['id'].'">Yes</button>
					<a href="index.php" style="text-decoration:none;"><button type="button" class="btn btn-success btn-fw" style="min-width:80px;">No</button>
				  </form></td>
				</tr>';
		}
		  echo '</tbody>
			</table>
		</div>';
	}
}
function display_user($id){
	global $db;
	$str = "SELECT u.id, u.uname, u.fname, u.lname, u.email, r.rolename, r.role_id from user u join role r on r.role_id = u.role_id where u.id={$id}";
    $stmt = $db->prepare($str);
    $stmt->execute();
	if($stmt->rowCount() === 0){
		user_doesnt_exist();
	}else{
	/* build the table class below: */
		echo '<div class="table-responsive-vertical shadow-z-1" style="width:95%; margin:auto;">
			  <table id="table" class="table table-hover table-mc-light-blue table-big-boy">
				<thead>
					<tr>
						<th>Name</th>
						<th>Surname</th>
						<th>Username</th>
						<th>Email</th>
						<th>Role</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>';
		
		while ($row = $stmt->fetch()) {
			echo '<tr>
			<form method="POST" action="index.php?edit='.$id.'">
				 <td data-title="Name" style="vertical-align:middle; width:150px"><input type="text" value="'.$row['fname'].'" name="fname" class="form-control" required/></td>
				 <td data-title="Surname" style="vertical-align:middle; width:150px"><input type="text" value="'.$row['lname'].'" name="lname" class="form-control" required/></td>
				 <td data-title="Username" style="vertical-align:middle; width:200px"><input type="text" value="'.$row['uname'].'" name="uname" class="form-control" required/></td>
				 <td data-title="Email" style="vertical-align:middle; width:300px"><input type="email" value="'.$row['email'].'" name="email" class="form-control" required/></td>
				 <td data-title="Role" style="vertical-align:middle;">';
				 if($row['rolename']=='admin')display_active_select_admin();
				 else display_active_select_user(); 
				 echo '</td>
				 <td data-title="Action" class="material-table-td-action">
				 	<button type="submit" class="btn btn-success btn-fw" style="min-width:100px;" name="edit" value="'.$row['id'].'">Update</button>
					<a href="index.php" style="text-decoration:none;" class="btn btn-secondary btn-fw">Back</a>
				</td></form>
				</tr>';
		}
		  echo '</tbody>
			</table>
		</div>';
	}	
}
function display_active_select_admin(){
	echo '<select name="rolename" class="form-control">
			<option value="1" selected> Admin </option>
			<option value="2"> User </option>
		  </select>';
}
function display_active_select_user(){
	echo '<select name="rolename" class="form-control">
			<option value="1"> Admin </option>
			<option value="2" selected> User </option>
		  </select>';
}
function display_users(){
    global $db;	
	$str = "SELECT u.id, u.uname, u.fname, u.lname, u.email, r.rolename, r.role_id from user u join role r on r.role_id = u.role_id";
    $stmt = $db->prepare($str);
    $stmt->execute();
	if($stmt->rowCount() === 0){
		echo "No users!"; #paradox
	}else{
		echo '<div class="table-responsive-vertical shadow-z-1" style="width:95%; margin:auto;">
			  <table id="table" class="table table-hover table-mc-light-blue">
				<thead>
					<tr>
						<th>Name</th>
						<th>Username</th>
						<th>Email</th>
						<th>Role</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>';
		
		while ($row = $stmt->fetch()) {
			echo '<tr>
				  <td data-title="Name" style="vertical-align:middle;">'.$row['fname'].' '.$row['lname'].'</td>
				  <td data-title="Username" style="vertical-align:middle;" >'.$row['uname'].'</td>
				  <td data-title="Email" style="vertical-align:middle;" >'.$row['email'].'</td>
				  <td data-title="Role" style="vertical-align:middle;" >'.$row['rolename'].'</td>
				  <td data-title="Action">
					 <a href="index.php?edit='.$row['id'].'" style="text-decoration:none;" class="btn btn-secondary btn-fw">Edit</a>
					 <a href="index.php?delete='.$row['id'].'" style="text-decoration:none;" class="btn btn-danger btn-fw">Delete</a>
				  </td>
				</tr>';
		}
		  echo '</tbody>
			</table>
		</div>';
	}
}
function not_own_image(){
	echo '
            <div class="col-md-6 grid-margin stretch-card" style="margin:auto;">
              <div class="card">
                <div class="card-body">
                  <center><p class="card-title">You do not own this image</p></center>
				  <center><p>Please click <a href="history.php">here</a> to go back to your own history</p></center>
                </div>
              </div>
            </div>
		';
	
}
function user_doesnt_exist(){
	echo '
            <div class="col-md-6 grid-margin stretch-card" style="margin:auto;">
              <div class="card">
                <div class="card-body">
                  <center><p class="card-title">User doesn\'t exist</p></center>
				  <center><p>Please click <a href="index.php">here</a> to go back to your admin panel</p></center>
                </div>
              </div>
            </div>
		';
}
?>
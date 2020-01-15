<?php
include 'db_mysql.php';

function login_attempt(){
	if(username_exists($_POST['username'])) {
        if(user_login($_POST['username'], $_POST['password'])){
            setcookie('user', base64_encode($_POST['username']), time() + 86400*7); //echo base64_decode($_COOKIE['user']);
			echo '<script>window.location.replace("index.php");</script>';
        }else {
			error("Wrong username or password");
        }
    }else error("Wrong username or password");
}
function user_has_valid_cookie(){
	if(isset($_COOKIE['user'])){
		$user=base64_decode($_COOKIE['user']);
		if(!username_exists($user)){
			setcookie("user", "", time()-3600);
			echo '<script>window.location.replace("index.php");</script>';
		}
	}
}
function user_login($user, $pass){
    global $db;

    $salt = db_get_userSalt($user);
    $pass = hash_pbkdf2('sha3-256', $pass, $salt, 3);
    $query = "SELECT EXISTS(SELECT id from user WHERE uname = :uname AND password = :pw) AS checkLogin";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":uname", $user);
    $stmt->bindParam(":pw", $pass);
    $stmt->execute();
    $result = $stmt->fetch();
    if($result['checkLogin'] == 1) return true;
    return false;
}

function db_get_userSalt($user){
    global $db;

    $query = "SELECT salt FROM user WHERE uname = :uname";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":uname", $user);
    $stmt->execute();
    $result = $stmt->fetch();
    return $result['salt'];
}
function register_attempt(){
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$uname = $_POST['uname'];
	$email = $_POST['email'];
	$pass1 = $_POST['password'];
	$pass2 = $_POST['password_repeat'];
	if(username_exists($uname)){
		return "uname";
	}
	if(email_exists($email)){
		return "email";
	}
	if($pass1 != $pass2){
		return "pass";
	}
	register_user($fname, $lname, $uname, $email, $pass1);
	echo "<script>window.location.replace('login.php?register=completed')</script>";
}
function register_attempt_errors(){
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$uname = $_POST['uname'];
	$email = $_POST['email'];
	$pass1 = $_POST['password'];
	$pass2 = $_POST['password_repeat'];
	if(username_exists($uname)){
		error("Username exists");
		return "uname";
	}
	if(email_exists($email)){
		error("Email exists");
		return "email";
	}
	if($pass1 != $pass2){
		error("Passwords must match");
		return "pass";
	}
}
function generate_salt(){
    return bin2hex(random_bytes(20));
}
function register_user($fname, $lname, $uname, $email, $pass){
    global $db;
    $salt = generate_salt();
    $pass = hash_pbkdf2('sha3-256', $pass, $salt, 3);
    $role_id = "2";
    $query = "INSERT INTO user (email, uname, password, salt, fname, lname, role_id) VALUES (:email, :uname, :pass, :salt, :fname, :lname, :role)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":uname", $uname);
    $stmt->bindParam(":pass", $pass);
    $stmt->bindParam(":salt", $salt);
    $stmt->bindParam(":fname", $fname);
    $stmt->bindParam(":lname", $lname);
    $stmt->bindParam(":role", $role_id);
    $stmt->execute();
}
function email_exists($email){
	global $db;
	$query = "SELECT EXISTS(SELECT * from user WHERE email='{$email}') AS checkExists";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch();
    if($result['checkExists'] == 1) return true;
    return false;	
}
function username_exists($username){
	global $db;
	$query = "SELECT EXISTS(SELECT * from user WHERE uname='{$username}') AS checkExists";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch();
    if($result['checkExists'] == 1) return true;
    return false;	
}

function error($message){
	echo '<div class="row w-100 mx-0"><div class="col-lg-6 mx-auto" style="margin-bottom:20px;">
				<div class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close" onClick="this.parentNode.parentNode.parentNode.remove();">
						<i class="mdi mdi-close"></i>
					</button>
					<span><b> Error - </b> '.$message.'</span>
				</div>
		</div></div>';
}
function success($message){
	echo '<div class="row w-100 mx-0"><div class="col-lg-6 mx-auto" style="margin-bottom:20px;">
				<div class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close" onClick="this.parentNode.parentNode.parentNode.remove();">
						<i class="mdi mdi-close"></i>
					</button>
					<span>'.$message.'</span>
				</div>
		</div></div>';
}
function get_username_from_cookie(){
	return base64_decode($_COOKIE['user']);
}
function check_if_user_admin(){
	if(db_get_userRoleName(get_username_from_cookie()) == 'admin')return true;
	else return false;
}
/* user gets */
function db_get_firstName($user){
    global $db;

    $query = "SELECT fname FROM user WHERE uname = :uname";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":uname", $user);
    $stmt->execute();
    $result = $stmt->fetch();
    return $result['fname'];
}
function db_get_lastName($user){
    global $db;

    $query = "SELECT lname FROM user WHERE uname = :uname";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":uname", $user);
    $stmt->execute();
    $result = $stmt->fetch();
    return $result['lname'];
}
function db_get_userRoleName($user){
    global $db;

    $query = "SELECT r.rolename FROM role r join user u on u.role_id = r.role_id WHERE uname = :uname";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":uname", $user);
    $stmt->execute();
    $result = $stmt->fetch();
    return $result['rolename'];
}

?>
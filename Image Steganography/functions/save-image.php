<?php
include_once 'db_mysql.php';

$message = $_POST['message'];
$pass = $_POST['password']; 
$mode = $_POST['select'];
$src = $_POST['data'];
$user_id = db_get_userId(get_username_from_cookie());


$insert = "INSERT INTO images(message, user_id, mode, password) VALUES (:message, :user_id, :mode, :pass)";
$stmt = $db->prepare($insert);
$stmt->bindParam(':user_id', $user_id);
$stmt->bindParam(':message', $message);
$stmt->bindParam(':mode', $mode);
$stmt->bindParam(':pass', $pass);
$stmt->execute();


$file = "../images/images.json";


$formdata = array('id'=> get_last_image_id(),'data'=> $src); 
	   
$jsondata = file_get_contents($file);

$arr_data = json_decode($jsondata, true);

array_push($arr_data,$formdata);

$jsondata = json_encode($arr_data, JSON_PRETTY_PRINT);

if(file_put_contents($file, $jsondata)) {
	echo 'Data successfully saved';
}else{
echo "error";
}



function get_username_from_cookie(){
	return base64_decode($_COOKIE['user']);
}
function get_last_image_id(){
    global $db;

    $query = "select image_id from images order by image_id desc limit 1;";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":uname", $user);
    $stmt->execute();
    $result = $stmt->fetch();
    return $result['image_id'];
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
?>
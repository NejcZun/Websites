<?php
$host = "localhost";
$port = 3306;
$username = "root";
$password = "";
$database = "CP";

$db = new PDO("mysql:host=$host;port=$port",$username,$password);

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$db->exec("CREATE DATABASE IF NOT EXISTS `$database`");
$db->exec("use `$database`");


#builds the database and the tables + also adds 2 test users for admin and normal user
function tableExists($dbh, $id){
    $results = $dbh->query("SHOW TABLES LIKE '$id'");
    if(!$results) {
        return false;
    }
    if($results->rowCount() > 0) {
        return true;
    }
    return false;
}

$exists = tableExists($db, "role");

if(!$exists){
    $db->exec("CREATE TABLE role (role_id INTEGER PRIMARY KEY AUTO_INCREMENT,rolename VARCHAR(100) NOT NULL);");

    $roles = array('admin', 'user');

    $insertRoles = "INSERT INTO role (rolename) VALUES (:role)";
    $stmt = $db->prepare($insertRoles);

    $stmt->bindParam(':role', $role);

    foreach ($roles as $r){
        $role = $r;
        $stmt->execute();
    }
}
if(!$exists){
    // CREATE USER TABLE W/ PRESET ADMIN: admin / admin | LOGIN /w admin access role = 1
    $db->exec("CREATE TABLE user (
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        email VARCHAR(100) NOT NULL,
        uname VARCHAR(100) NOT NULL,
        password VARCHAR(1024) NOT NULL,
        salt VARCHAR(100) NOT NULL,
        fname VARCHAR(100) NOT NULL,
        lname VARCHAR(100) NOT NULL,
        role_id INTEGER,
        FOREIGN KEY (role_id) REFERENCES role(role_id)
        );");
		
		//dodaj se kaksnega uporabnika samo dodaj array 
        $users = array( array('email' => 'admin@admin.com',
                            'uname' => 'admin',
                            'password' => hash_pbkdf2('sha3-256', 'admin', 'adminSalt', 3),
                            'salt' => 'adminSalt',
                            'fname' => 'Admin',
                            'lname' => 'Admin',
                            'role_id' => 1 ),
						array('email' => 'user@user.com',
                            'uname' => 'user',
                            'password' => hash_pbkdf2('sha3-256', 'user', 'userSalt', 3),
                            'salt' => 'userSalt',
                            'fname' => 'User',
                            'lname' => 'User',
                            'role_id' => 2 ) 
                        );
        
        $insertUsers = "INSERT INTO user (email, uname, password, salt, fname, lname, role_id) VALUES (:email, :uname, :password, :salt, :fname, :lname, :role_id)";
        $stmt = $db->prepare($insertUsers);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':uname', $uname);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':salt', $salt);
        $stmt->bindParam(':fname', $fname);
        $stmt->bindParam(':lname', $lname);
        $stmt->bindParam(':role_id', $role_id);
    
        foreach ($users as $e) {
            $email = $e['email'];
            $uname = $e['uname'];
            $password = $e['password'];
            $salt = $e['salt'];
            $fname = $e['fname'];
            $lname = $e['lname'];
            $role_id = $e['role_id'];
            $stmt->execute();
        }
}
$exists = tableExists($db, "images");
if(!$exists){
    $db->exec("CREATE TABLE images (
        image_id INTEGER PRIMARY KEY AUTO_INCREMENT,
        message VARCHAR(300) NOT NULL,
		mode int NOT NULL,
		password VARCHAR(300) NOT NULL,
		user_id INTEGER,
        FOREIGN KEY (user_id) REFERENCES user(id)
    );");
}
date_default_timezone_set("Europe/Ljubljana");

?>
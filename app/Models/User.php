<?php

namespace App\Models;

use PDO;

class User
{
	public function __construct(
		private PDO $conn
	) {}

	public function CreateNewUser(array $data)
	{
		$query = "INSERT INTO users(
		firstname,
		middlename,
		lastname,
		username,
		password,
		avatar,
		user_type,
		date_added,
		date_updated
		)
		VALUES (:firstname,:middlename,:lastname,:username,:password,:avatar,:user_type,:date_added,:date_updated)";
		var_dump($data);
		$stmt = $this->conn->prepare($query);
		$stmt->bindValue(":firstname", $data['firstName']);
		$stmt->bindValue(":middlename", isset($data['middleName']) ? $data['middleName'] : null);
		$stmt->bindValue(":lastname", $data['lastName']);
		$stmt->bindValue(":username",  $data['userName']);
		$stmt->bindValue(":password", $data['password']);
		$stmt->bindValue(":avatar", isset($data['avatar']) ?  $data['avatar'] : "");
		$stmt->bindValue(":user_type", $data['userType']);
		$stmt->bindValue(":date_added", $data['date_added']);
		$stmt->bindValue(":date_updated", $data['date_updated']);
		$stmt->execute();
	}


	public function UpdateUser(array $data)
	{
		$query = "UPDATE users set firstname = :firstname, middlename = :middlename, lastname = :lastname, username = :username, password = :password, avatar = :avatar, user_type = :user_type where id = :id";
		$stmt = $this->conn->prepare($query);
		$stmt->bindValue(":firstname", $data['firstName']);
		$stmt->bindValue(":middlename", isset($data['middleName']) ? $data['middleName'] : null);
		$stmt->bindValue(":lastname", $data['lastName']);
		$stmt->bindValue(":username", $data['userName']);
		$stmt->bindValue(":password", $data['password']);
		$stmt->bindValue(":avatar", $data['avatar']);
		$stmt->bindValue(":user_type", $data['userType']);
		$stmt->bindValue(":id", $data['id']);
		$stmt->execute();
	}

	public function DeleteUser($id)
	{
		$query = "DELETE FROM users where id = :id";
		$stmt = $this->conn->prepare($query);
		$stmt->bindValue(":id", $id);
		$stmt->execute();
	}


	public function GetUserById($id, $conn)
	{
		$query = "SELECT * FROM users where id = :id";
		$stmt = $conn->prepare($query);
		$stmt->bindvalue(":id", $id);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	// public function login($username, $password, $conn)
	// {


	// 	$query = "SELECT * FROM users where username = :username and password = :password";
	// 	$stmt = $conn->prepare($query);
	// 	$stmt->bindvalue(":username", $username);
	// 	$stmt->bindvalue(":password", $password);
	// 	$stmt->execute();
	// 	return $stmt->fetch(PDO::FETCH_ASSOC);
	// }

	public function GetUserByUsername($username, $conn)
	{
		$query = "SELECT * FROM users where username = :username";
		$stmt = $conn->prepare($query);
		$stmt->bindvalue(":username", $username);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function getUserByEmail($email, $conn)
	{
		$query = "SELECT * FROM users where email = :email";
		$stmt = $conn->prepare($query);
		$stmt->bindvalue(":email", $email);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	// public function save_users(){
	// 	if(empty($_POST['password']))
	// 		unset($_POST['password']);
	// 	else
	// 	$_POST['password'] = md5($_POST['password']);
	// 	extract($_POST);
	// 	$data = '';
	// 	foreach($_POST as $k => $v){
	// 		if(!in_array($k,array('id'))){
	// 			if(!empty($data)) $data .=" , ";
	// 			$data .= " {$k} = '{$v}' ";
	// 		}
	// 	}
	// 	if(empty($id)){
	// 		$qry = $this->conn->query("INSERT INTO users set {$data}");
	// 		if($qry){
	// 			$id=$this->conn->insert_id;
	// 			$this->settings->set_flashdata('success','User Details successfully saved.');
	// 			foreach($_POST as $k => $v){
	// 				if($k != 'id'){
	// 					if(!empty($data)) $data .=" , ";
	// 					if($this->settings->userdata('id') == $id)
	// 					$this->settings->set_userdata($k,$v);
	// 				}
	// 			}
	// 			if(!empty($_FILES['img']['tmp_name'])){
	// 				if(!is_dir(base_app."uploads/avatars"))
	// 					mkdir(base_app."uploads/avatars");
	// 				$ext = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
	// 				$fname = "uploads/avatars/$id.png";
	// 				$accept = array('image/jpeg','image/png');
	// 				if(!in_array($_FILES['img']['type'],$accept)){
	// 					$err = "Image file type is invalid";
	// 				}
	// 				if($_FILES['img']['type'] == 'image/jpeg')
	// 					$uploadfile = imagecreatefromjpeg($_FILES['img']['tmp_name']);
	// 				elseif($_FILES['img']['type'] == 'image/png')
	// 					$uploadfile = imagecreatefrompng($_FILES['img']['tmp_name']);
	// 				if(!$uploadfile){
	// 					$err = "Image is invalid";
	// 				}
	// 				$temp = imagescale($uploadfile,200,200);
	// 				if(is_file(base_app.$fname))
	// 				unlink(base_app.$fname);
	// 				$upload =imagepng($temp,base_app.$fname);
	// 				if($upload){
	// 					$this->conn->query("UPDATE `users` set `avatar` = CONCAT('{$fname}', '?v=',unix_timestamp(CURRENT_TIMESTAMP)) where id = '{$id}'");
	// 					if($this->settings->userdata('id') == $id)
	// 					$this->settings->set_userdata('avatar',$fname."?v=".time());
	// 				}

	// 				imagedestroy($temp);
	// 			}
	// 			return 1;
	// 		}else{
	// 			return 2;
	// 		}

	// 	}else{
	// 		$qry = $this->conn->query("UPDATE users set $data where id = {$id}");
	// 		if($qry){
	// 			$this->settings->set_flashdata('success','User Details successfully updated.');
	// 			foreach($_POST as $k => $v){
	// 				if($k != 'id'){
	// 					if(!empty($data)) $data .=" , ";
	// 					if($this->settings->userdata('id') == $id)
	// 						$this->settings->set_userdata($k,$v);
	// 				}
	// 			}
	// 			if(!empty($_FILES['img']['tmp_name'])){
	// 				if(!is_dir(base_app."uploads/avatars"))
	// 					mkdir(base_app."uploads/avatars");
	// 				$ext = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
	// 				$fname = "uploads/avatars/$id.png";
	// 				$accept = array('image/jpeg','image/png');
	// 				if(!in_array($_FILES['img']['type'],$accept)){
	// 					$err = "Image file type is invalid";
	// 				}
	// 				if($_FILES['img']['type'] == 'image/jpeg')
	// 					$uploadfile = imagecreatefromjpeg($_FILES['img']['tmp_name']);
	// 				elseif($_FILES['img']['type'] == 'image/png')
	// 					$uploadfile = imagecreatefrompng($_FILES['img']['tmp_name']);
	// 				if(!$uploadfile){
	// 					$err = "Image is invalid";
	// 				}
	// 				$temp = imagescale($uploadfile,200,200);
	// 				if(is_file(base_app.$fname))
	// 				unlink(base_app.$fname);
	// 				$upload =imagepng($temp,base_app.$fname);
	// 				if($upload){
	// 					$this->conn->query("UPDATE `users` set `avatar` = CONCAT('{$fname}', '?v=',unix_timestamp(CURRENT_TIMESTAMP)) where id = '{$id}'");
	// 					if($this->settings->userdata('id') == $id)
	// 					$this->settings->set_userdata('avatar',$fname."?v=".time());
	// 				}

	// 				imagedestroy($temp);
	// 			}

	// 			return 1;
	// 		}else{
	// 			return "UPDATE users set $data where id = {$id}";
	// 		}

	// 	}
	// }
	// public function delete_users(){
	// 	extract($_POST);
	// 	$qry = $this->conn->query("DELETE FROM users where id = $id");
	// 	if($qry){
	// 		$this->settings->set_flashdata('success','User Details successfully deleted.');
	// 		if(is_file(base_app."uploads/avatars/$id.png"))
	// 			unlink(base_app."uploads/avatars/$id.png");
	// 		return 1;
	// 	}else{
	// 		return false;
	// 	}
	// }
	// function registration(){
	// 	if(!empty($_POST['password']))
	// 		$_POST['password'] = md5($_POST['password']);
	// 	else
	// 	unset($_POST['password']);
	// 	extract($_POST);
	// 	$main_field = ['firstname', 'middlename', 'lastname', 'gender', 'contact', 'email', 'status', 'password'];
	// 	$data = "";
	// 	$check = $this->conn->query("SELECT * FROM `customer_list` where email = '{$email}' ".($id > 0 ? " and id!='{$id}'" : "")." ")->num_rows;
	// 	if($check > 0){
	// 		$resp['status'] = 'failed';
	// 		$resp['msg'] = 'Email already exists.';
	// 		return json_encode($resp);
	// 	}
	// 	foreach($_POST as $k => $v){
	// 		$v = $this->conn->real_escape_string($v);
	// 		if(in_array($k, $main_field)){
	// 			if(!empty($data)) $data .= ", ";
	// 			$data .= " `{$k}` = '{$v}' ";
	// 		}
	// 	}
	// 	if(empty($id)){
	// 		$sql = "INSERT INTO `customer_list` set {$data} ";
	// 	}else{
	// 		$sql = "UPDATE `customer_list` set {$data} where id = '{$id}' ";
	// 	}
	// 	$save = $this->conn->query($sql);
	// 	if($save){
	// 		$uid = !empty($id) ? $id : $this->conn->insert_id;
	// 		$resp['status'] = 'success';
	// 		$resp['uid'] = $uid;
	// 		if(!empty($id))
	// 			$resp['msg'] = 'User Details has been updated successfully';
	// 		else
	// 			$resp['msg'] = 'Your Account has been created successfully';

	// 		if(!empty($_FILES['img']['tmp_name'])){
	// 			if(!is_dir(base_app."uploads/customers"))
	// 				mkdir(base_app."uploads/customers");
	// 			$ext = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
	// 			$fname = "uploads/customers/$uid.png";
	// 			$accept = array('image/jpeg','image/png');
	// 			if(!in_array($_FILES['img']['type'],$accept)){
	// 				$resp['msg'] = "Image file type is invalid";
	// 			}
	// 			if($_FILES['img']['type'] == 'image/jpeg')
	// 				$uploadfile = imagecreatefromjpeg($_FILES['img']['tmp_name']);
	// 			elseif($_FILES['img']['type'] == 'image/png')
	// 				$uploadfile = imagecreatefrompng($_FILES['img']['tmp_name']);
	// 			if(!$uploadfile){
	// 				$resp['msg'] = "Image is invalid";
	// 			}
	// 			$temp = imagescale($uploadfile,200,200);
	// 			if(is_file(base_app.$fname))
	// 			unlink(base_app.$fname);
	// 			$upload =imagepng($temp,base_app.$fname);
	// 			if($upload){
	// 				$this->conn->query("UPDATE `customer_list` set `avatar` = CONCAT('{$fname}', '?v=',unix_timestamp(CURRENT_TIMESTAMP)) where id = '{$uid}'");
	// 			}
	// 			imagedestroy($temp);
	// 		}
	// 		if(!empty($uid) && $this->settings->userdata('login_type') != 1){
	// 			$user = $this->conn->query("SELECT * FROM `customer_list` where id = '{$uid}' ");
	// 			if($user->num_rows > 0){
	// 				$res = $user->fetch_array();
	// 				foreach($res as $k => $v){
	// 					if(!is_numeric($k) && $k != 'password'){
	// 						$this->settings->set_userdata($k, $v);
	// 					}
	// 				}
	// 				$this->settings->set_userdata('login_type', '2');
	// 			}
	// 		}
	// 	}else{
	// 		$resp['status'] = 'failed';
	// 		$resp['msg'] = $this->conn->error;
	// 		$resp['sql'] = $sql;
	// 	}
	// 	if($resp['status'] == 'success' && isset($resp['msg']))
	// 	$this->settings->set_flashdata('success', $resp['msg']);
	// 	return json_encode($resp);
	// }
	// public function delete_customer(){
	// 	extract($_POST);
	// 	$avatar = $this->conn->query("SELECT avatar FROM customer_list where id = $id");
	// 	$qry = $this->conn->query("DELETE FROM customer_list where id = $id");
	// 	if($qry){
	// 		$this->settings->set_flashdata('success','Customer Details has been deleted successfully.');
	// 		$resp['status'] = 'success';
	// 		if($avatar->num_rows > 0){
	// 			$avatar = explode("?", $avatar->fetch_array()[0])[0];
	// 			if(is_file(base_app.$avatar)){
	// 				unlink(base_app.$avatar);
	// 			}
	// 		}
	// 	}else{
	// 		$resp['status'] = 'failed';
	// 		$resp['msg'] = $this->conn->error;
	// 	}

	// 	return json_encode($resp);
	// }

}

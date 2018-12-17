<?php	
	session_start();
	require('db_info.php');
	
	$email = $_POST['email'];
	$password = $_POST['password'];
	
	$stmt = $mysqli->prepare('Select id,name FROM users WHERE email = ? AND password = ?');
	$stmt->bind_param('ss', $email, $password);
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($id, $name);
	$stmt->fetch();
	if($name == null){
		die("hi");
		header('Location:store.php');
	}else{
		$_SESSION['logged_in'] = true;
		$_SESSION['name'] = $name;
		header('Location:home2.php');
	}
?>
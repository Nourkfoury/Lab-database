<?php
	session_start();
	require('db_info.php');
	$gender = $_POST['gender'];
	$name = $_POST['name'];
	$age = $_POST['age'];
	

		$z= $mysqli->prepare('INSERT INTO employees (name, gender, age) VALUES (?,?,?)');
		$z->bind_param('ssd', $name,$gender, $age);
		$z->execute();
		$_SESSION['added']= true;
		header('Location:home2.php');

?>
<?php
	session_start();
	require('db_info.php');
	$gender = $_POST['gender'];
	$name = $_POST['name'];
	$age = $_POST['age'];
	
	$y = $mysqli->prepare('Select id FROM employees WHERE name=?');
    $y->bind_param('s', $name);
	$y->execute();
	$y->store_result();
	$y->bind_result($employee_id);
	$y->fetch();
	
	if($employee_id==null){
	$_SESSION['wrong3']= true;
	header('Location:home2.php');
	}
	else{
		$z= $mysqli->prepare('DELETE FROM employees WHERE name=? AND gender=? AND age=?');
		$z->bind_param('ssd', $name,$gender, $age);
		$z->execute();
		$_SESSION['deleted']= true;
		header('Location:home2.php');
		
		
	}

?>
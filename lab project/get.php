<?php
    session_start();
	require('db_info.php');
	$date = $_POST['date'];
	$name = $_POST['name'];
	
	$y = $mysqli->prepare('Select id FROM employees WHERE name=?');
    $y->bind_param('s', $name);
	$y->execute();
	$y->store_result();
	$y->bind_result($employee_id);
	$y->fetch();
	
	if($employee_id==null){
	$_SESSION['wrong1']= true;
	header('Location:home1.php');
	}
	
	else{
		$z= $mysqli->prepare('Select reason FROM leaves WHERE employee_id=? AND date_leave=?');
		$z->bind_param('ds', $employee_id,$date);
		$z->execute();
		$z->store_result();
		$z->bind_result($reason);
		$z->fetch();
		if($reason==null){
			$_SESSION['exists1'] = true;
			header('Location:home1.php');	
		
		}
		else{
			
		$_SESSION['reason'] = $reason;
		header('Location:home1.php');
		}
		
		
	}


?>
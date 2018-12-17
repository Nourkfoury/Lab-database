<?php
	session_start();
	require('db_info.php');
	$myDate = date('Y-m-d');
	$name = $_POST['name'];
	$time = $_POST['time'];
	
	$y = $mysqli->prepare('Select id FROM employees WHERE name=?');
    $y->bind_param('s', $name);
	$y->execute();
	$y->store_result();
	$y->bind_result($employee_id);
	$y->fetch();
	
	if($employee_id==null){
	$_SESSION['wrong']= true;
	header('Location:home.php');
	}
	else{
		$z= $mysqli->prepare('Select id FROM attendance WHERE employee_id=? AND date_attendance=?');
		$z->bind_param('ds', $employee_id,$myDate);
		$z->execute();
		$z->store_result();
		$z->bind_result($id);
		$z->fetch();
		
		if($id==null){

		$x = $mysqli->prepare('Insert INTO attendance(date_attendance,time_from,employee_id)VALUES(?,?,?)');
		$x->bind_param('sss', $myDate,$time,$employee_id);
		$x->execute();
		
		$_SESSION['created'] = true;
		header('Location:home.php');
		}
		else{
			$_SESSION['exists']=true;
			header('Location:home.php');
		}		
	}

?>
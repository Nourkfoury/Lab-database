<?php
	session_start();
	require('db_info.php');
	$date = $_POST['date'];
	$name = $_POST['name'];
	$reason = $_POST['text'];
	
	$y = $mysqli->prepare('Select id FROM employees WHERE name=?');
    $y->bind_param('s', $name);
	$y->execute();
	$y->store_result();
	$y->bind_result($employee_id);
	$y->fetch();
	
	if($employee_id==null){
	$_SESSION['wrong']= true;
	header('Location:home1.php');
	}
	else{
		$z= $mysqli->prepare('Select id FROM attendance WHERE employee_id=? AND date_attendance=?');
		$z->bind_param('ds', $employee_id,$date);
		$z->execute();
		$z->store_result();
		$z->bind_result($id);
		$z->fetch();
		
		if($id==null){
			
			$n= $mysqli->prepare('SELECT id FROM leaves WHERE employee_id=? AND date_leave=?');
			$n->bind_param('ds', $employee_id,$date);
			$n->execute();
			$n->store_result();
			$n->bind_result($id1);
			$n->fetch();
			
		if($id1==null){
			$x = $mysqli->prepare('Insert INTO leaves(date_leave,employee_id,reason)VALUES(?,?,?)');
			$x->bind_param('sss', $date,$employee_id,$reason);
			$x->execute();
			
			$_SESSION['created'] = true;
			header('Location:home1.php');
		}
		else{
			$_SESSION['Lexists']=true;
			header('Location:home1.php');
		}
		}
		else{
			$_SESSION['Aexists']=true;
			header('Location:home1.php');
		}		
	}

?>
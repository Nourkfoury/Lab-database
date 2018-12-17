<!DOCTYPE html>
<html lang="en">
<?php
	session_start();
	$myDate = date('Y-m-d');
	$myMonth= date('m');
	$myDay=date('d');
	$myYear=date('Y');
	if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
	
	require('db_info.php');
	
	$stmt = $mysqli->prepare('SELECT name FROM employees WHERE id NOT IN (Select employee_id FROM attendance WHERE date_attendance=?)');
    $stmt->bind_param('s', $myDate);
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($ename);
	
	$x= $mysqli->prepare('SELECT id FROM leaves WHERE date_leave=? AND employee_id IN(SELECT id FROM employees WHERE name =?)');

	$y= $mysqli->prepare('Select employee_id FROM attendance WHERE date_attendance=?');
?>

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Yeppen</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/business-casual.min.css" rel="stylesheet">

  </head>

  <body>

    <h1 class="site-heading text-center text-white d-none d-lg-block">
      <span class="site-heading-upper text-primary mb-3">Beauty Company</span>
      <span class="site-heading-lower">Yeppeun</span>
	  </br></br>
	  <span class="site-heading-upper mb-3">Welcome <?= $_SESSION['name'] ?> !</span>
	  </br>
	  
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark py-lg-4" id="mainNav">
      <div class="container">
        <a class="navbar-brand text-uppercase text-expanded font-weight-bold d-lg-none" href="#">Start Bootstrap</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav mx-auto">
		  		 <li class="nav-item px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="home2.php">Enployees</a>
            </li>
		  
            <li class="nav-item px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="home.php">Attendance
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item active px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="home1.php">Absenses</a>
            </li>

          </ul>
        </div>
      </div>
    </nav>

    <section class="page-section cta">
      <div class="container">
        <div class="row">
          <div class="col-xl-9 mx-auto">
            <div class="cta-inner text-center rounded">
                 <section id="contact" style="background-image: none;">
      <div class="container">

        <div class="row">
          <div class="col-lg-12 text-center ">
		  <font color="black">
            <h2 class="section-heading text-uppercase">People who did not attend today</h2>
			</font>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-12">
              <div class="row">
			  
		<div class="col-md-12">
		  <font color="black">
		  <p>
		  <pre class="tab"><h5>name                    excused         Number of absenses</h5></pre>
		  </p>
		  </font>
			  
		  <?php while($stmt->fetch()){
			$x->bind_param('ss',$myDate,$ename);
			$x->execute();
			$x->store_result();
			$x->bind_result($excused);
			$x->fetch();
		  ?>
		  <?php
		  $count=0;
		
			for($i=1;$i<=$myDay;($i=$i+1)){
				$Date=$i."-".$myMonth."-".$myYear ;
				$y->bind_param('s',$Date);
				$y->execute();
				$y->store_result();
				$y->bind_result($idt);
				$y->fetch();
				if($idt==null){
					$count=$count+1;
				}
				
			}
		  
		  ?>
		  
		  
		  <font color="black">
		  
		  <?php if($excused==null){?>
		  <pre  class="space">
		  <h6><?=$ename?>                  no               <?=$count?></h6>
		  </pre>
		  <?php } 
		  else {?>
		  <pre  class="space">
		  <h6><?=$ename?>                        yes                   <?=$count?></h6>
			</pre>
		  <?php } ?>
		  </font>
		  <?php } ?>
			</div>
          </div>
        </div>

            </div>
          </div>
        </div>
      </div>
    </section>
	
	
	
	
	
	
		
	
	<section class="page-section cta">
      <div class="container">
        <div class="row">
          <div class="col-xl-9 mx-auto">
            <div class="cta-inner text-center rounded">
                 <section id="contact" style="background-image: none;">
      <div class="container">

        <div class="row">
          <div class="col-lg-12 text-center">
		  <font color="black">
            <h2 class="section-heading text-uppercase">What is the excuse?</h2>
			</font>
          </div>
        </div>
<br>

		<?php if(isset($_SESSION['wrong1']) && $_SESSION['wrong1']){ ?>
			<div class="alert alert-success">
			<h6>
			<strong>wrong name</strong>
			</h6>
			</div>
		<?php } ?>
		<?php if(isset($_SESSION['reason']) && $_SESSION['reason']!=null){ ?>
			<div class="alert alert-success">
			<h5>The Reason Is:</h5>
			<h6><?=$_SESSION['reason']?></h6>
			</div>
		<?php } ?>
		<?php if(isset($_SESSION['exists1']) && $_SESSION['exists1']){?>
			<div class="alert alert-success">
			<h6>
			  <strong>This employee is not excused for this day</strong>
			  </h6>
			</div>
		<?php } ?>
			<?php $_SESSION['wrong1']=false;?>
			<?php $_SESSION['exists1']=false;?>
			<?php $_SESSION['reason']=null;?>
			


		
        <div class="row">
          <div class="col-lg-12">
            <form method="POST" action="get.php">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <input class="form-control" name="name" id="name" type="name" placeholder="the employee's name" required="required" data-validation-required-message="Please enter the name.">
                    <p class="help-block text-danger"></p>
                  </div>
				<div class="form-group">
                    <input class="form-control" name="date" id="date" type="date" placeholder="the date:" required="required" data-validation-required-message="Please enter the date.">
                    <p class="help-block text-danger"></p>
                  </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-lg-12 text-center">
                  <div id="success"></div>
                  <button class="btn btn-primary btn-xl text-uppercase" type="submit">Enter</button>
                </div>
              </div>
            </form>
          </div>
        </div>

            </div>
          </div>
        </div>
      </div>
    </section>
	
	
	
	
	
	
	
	
	
	
	
	
		<section class="page-section cta">
      <div class="container">
        <div class="row">
          <div class="col-xl-9 mx-auto">
            <div class="cta-inner text-center rounded">
                 <section id="contact" style="background-image: none;">
      <div class="container">

        <div class="row">
          <div class="col-lg-12 text-center">
		  <font color="black">
            <h2 class="section-heading text-uppercase">add to the Leave sheet</h2>
			</font>
          </div>
        </div>
<br>
		<?php if(isset($_SESSION['created']) && $_SESSION['created']){ ?>
			<div class="alert alert-success">
			<h6>
			  <strong>added!</strong>:).
			  </h6>
			</div>
		<?php } ?>
		<?php if(isset($_SESSION['wrong']) && $_SESSION['wrong']){ ?>
			<div class="alert alert-success">
			<h6>
			<strong>wrong name</strong>
			</h6>
			</div>
		<?php } ?>
		<?php if(isset($_SESSION['Aexists']) && $_SESSION['Aexists']){?>
			<div class="alert alert-success">
			<h6>
			  <strong>employee already attended</strong>
			  </h6>
			</div>
		<?php } ?>
		<?php if(isset($_SESSION['Lexists']) && $_SESSION['Lexists']){?>
			<div class="alert alert-success">
			<h6>
			  <strong>excuse already admitted</strong>
			  </h6>
			</div>
		<?php } ?>
			<?php $_SESSION['wrong']=false;?>
			<?php $_SESSION['Aexists']=false;?>
			<?php $_SESSION['created']=false;?>	
			<?php $_SESSION['Lexists']=false;?>
        <div class="row">
          <div class="col-lg-12">
            <form method="POST" action="add2.php">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <input class="form-control" name="name" id="name" type="name" placeholder="the employee's name" required="required" data-validation-required-message="Please enter the name.">
                    <p class="help-block text-danger"></p>
                  </div>
				 <div class="form-group">
                    <input class="form-control" name="date" id="date" type="date" placeholder="the date ('Y-m-d')" required="required" data-validation-required-message="Please enter the date.">
                    <p class="help-block text-danger"></p>
                  </div>
				 <div class="form-group">
                    <input class="form-control" name="text" id="text" type="text" placeholder="reason why" required="required" data-validation-required-message="Please enter the reason.">
                    <p class="help-block text-danger"></p>
                  </div> 
                </div>
                <div class="clearfix"></div>
                <div class="col-lg-12 text-center">
                  <div id="success"></div>
                  <button class="btn btn-primary btn-xl text-uppercase" type="submit">Enter</button>
                </div>
              </div>
            </form>
          </div>
        </div>

            </div>
          </div>
        </div>
      </div>
    </section>


    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

  <!-- Script to highlight the active date in the hours list -->
  <script>
    $('.list-hours li').eq(new Date().getDay()).addClass('today');
  </script>
  </html>
  <?php }else{
	header('Location:store.php');
}
 ?>
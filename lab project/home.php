<!DOCTYPE html>
<html lang="en">
<?php
	session_start();
	$myDate = date('Y-m-d');
	if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
	
	require('db_info.php');
	
	$stmt = $mysqli->prepare('Select employee_id, time_from FROM attendance WHERE date_attendance=?');
    $stmt->bind_param('s', $myDate);
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($employee_id,$time);
	
	$x = $mysqli->prepare('Select name FROM employees WHERE id=?');

?>

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Yeppeun</title>

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
		  
            <li class="nav-item active px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="home.php">Attendance
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item px-lg-4">
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
            <h2 class="section-heading text-uppercase">People who attended today</h2>
			</font>
          </div>
        </div>
		<br>
        <div class="row">
          <div class="col-lg-12">
              <div class="row">
		<font color="black">
		  <pre class="tab"><h5>Name:                     Time:</h5></pre>
		  </font>
</div>		  
		  <?php while($stmt->fetch()){
			  
			$x->bind_param('d', $employee_id);
			$x->execute();
			$x->store_result();
			$x->bind_result($ename);
			$x->fetch();
		  ?>
			<div class="row">
		  <font color="black"> 
		 <p>
		  <pre class="tab"><h6><?=$ename?>        <?=$time?></h6></pre>
		  </p>
		  </font>
		  </div>
		  <?php } ?>
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
            <h2 class="section-heading text-uppercase">add to the Attendance sheet</h2>
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
		<?php if(isset($_SESSION['exists']) && $_SESSION['exists']){?>
			<div class="alert alert-success">
			<h6>
			  <strong>employee already added</strong>
			  </h6>
			</div>
		<?php } ?>	
			<?php $_SESSION['wrong']=false;?>
			<?php $_SESSION['exists']=false;?>
			<?php $_SESSION['created']=false;?>
        <div class="row">
          <div class="col-lg-12">
            <form method="POST" action="add1.php">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <input class="form-control" name="name" id="name" type="name" placeholder="the employee's name" required="required" data-validation-required-message="Please enter the name.">
                    <p class="help-block text-danger"></p>
                  </div>
				<div class="form-group">
                    <input class="form-control" name="time" id="time" type="time" placeholder="the time (hh:mm:ss)" required="required" data-validation-required-message="Please enter the time.">
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



<!DOCTYPE html>

<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Yeppeun</title

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
    </h1>

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
              <a class="nav-link text-uppercase text-expanded" href="index.php">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="about.php">About</a>
            </li>
            <li class="nav-item px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="products.php">Services</a>
            </li>
            <li class="nav-item active px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="store.php">Login</a>
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
          <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase">Login</h2>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <form method="POST" action="login.php">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <input class="form-control" name="email" id="email" type="email" placeholder="Your Email *" required="required" data-validation-required-message="Please enter your email address.">
                    <p class="help-block text-danger"></p>
                  </div>
                  <div class="form-group">
                    <input class="form-control" name="password" id="password" type="password" placeholder="Your Password *" required="required" data-validation-required-message="Please enter your phone number.">
                    <p class="help-block text-danger"></p>
                  </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-lg-12 text-center">
                  <div id="success"></div>
                  <button class="btn btn-primary btn-xl text-uppercase" type="submit">Login</button>
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

    <section class="page-section about-heading">
      <div class="container">
        <img class="img-fluid rounded about-heading-img mb-3 mb-lg-0" src="img/about.jpg" alt="">
        <div class="about-heading-content">
          <div class="row">
            <div class="col-xl-9 col-lg-10 mx-auto">
              <div class="bg-faded rounded p-5">
                <h2 class="section-heading mb-4">
                  <span class="section-heading-upper">Refreshing feeling, Best Looks</span>
                  <span class="section-heading-lower">About Our Company</span>
                </h2>
                <p>Founded in 1995 by the Kfoury sisters, our establishment has been serving the best Skin treatements, hair styles and makeup master pieces. We are dedicated to travelling the world, finding the newest looks, and bringing back to you here in our company.</p>
                <p class="mb-0">We guarantee that you will fall in <em>lust</em> with the feeling of relaxation you get from beeing inside our company. Join us for your daily routine, an outing with friends, or simply just to enjoy some alone time.</p>
                <p class="mb-0">
                <small>
                  <em>Call Anytime</em>
                </small>
                <br>
                (+961)76 933895
              </p>
			  </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <footer class="footer text-faded text-center py-5">
      <div class="container">
        <p class="m-0 small">Copyright &copy; Your Website 2018</p>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

  <!-- Script to highlight the active date in the hours list -->
  <script>
    $('.list-hours li').eq(new Date().getDay()).addClass('today');
  </script>

</html>
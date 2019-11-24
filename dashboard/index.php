<?php 
    require_once('../config/config.php'); // has config options and db connection details
    require_once('../global_functions.php'); // has usefull functions
    connect_to_db(); //connects to database defined in global_funtions.php
    require_once('../login/auth.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo $site_name;?> | Dashboard</title>

  <!-- Custom fonts for this theme -->
  <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

  <!-- flip clock -->
  <link rel="stylesheet" href="../assets/css/flipclock.css">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

  <!-- Theme CSS -->
  <link href="../assets/css/freelancer.min.css" rel="stylesheet">
  <link href="../assets/css/style.css" rel="stylesheet">

</head>

<body id="page-top ">

<!-- responses -->
<?php 
  // pages with forms or that submit data will have that data processed here
  security_check();
  include('responses.php'); 
?>

<?php 
  $user_id = 1;
  if(isset($_POST['user_id'])){
    $user_id = $_POST['user_id'];    
  }

  $user_id = $_SESSION['user_id'];

  $sql_query = "SELECT * FROM users WHERE id='$user_id'";
    $user_result = mysqli_query($db_connection,$sql_query);
    if (!$user_result) {
      echo "<div class=\"alert alert-danger mt-5\" role=\"alert\">";
              echo mysqli_error($db_connection);
          echo "</div>";
    }else{
      $user_details = mysqli_fetch_assoc($user_result);
      $username = $user_details['username'];
    }

?>
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="<?php echo $base_url;?>"><?php echo $site_name;?></a>
      <button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item mx-0 mx-lg-1">
            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#portfolio">Portfolio</a>
          </li>
          <li class="nav-item mx-0 mx-lg-1">
            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#about">About</a>
          </li>
          <li class="nav-item mx-0 mx-lg-1">
            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#contact">Contact</a>
          </li>
          <li class="nav-item mx-0 mx-lg-1 d-flex">
            <span class="text-white nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger px-1 py-1"><?php echo $username;?></span>
          </li>
          <li>
            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger px-1 py-1" href="<?php echo $base_url; ?>/login/logout.php">Logout</a>
          </li>

          <li class="nav-item mx-0 mx-lg-1">
	           <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="<?php echo $dashboard_url.'?inbox'; ?>">Inbox</a>
           </li>
          <li class="nav-item mx-0 mx-lg-1">
           <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger">user: <?php echo $_SESSION['username']; ?></a></li>
 
        </ul>
      </div>
    </nav>
    

  <!-- Masthead -->
  <header class="masthead bg-primary text-white text-center pt-5 pb-0 bg-white">
    <!-- content hidden -->
    <div class="container d-flex align-items-center flex-column hide">

      <!-- Masthead Avatar Image -->
      <img class="masthead-avatar mb-5" src="../assets/img/avataaars.svg" alt="">

      <!-- Masthead Heading -->
      <h1 class="masthead-heading text-uppercase mb-0">Start Bootstrap</h1>

      <!-- Icon Divider -->
      <div class="divider-custom divider-light">
        <div class="divider-custom-line"></div>
        <div class="divider-custom-icon">
          <i class="fas fa-star"></i>
        </div>
        <div class="divider-custom-line"></div>
      </div>

      <!-- Masthead Subheading -->
      <p class="masthead-subheading font-weight-light mb-0">Graphic Artist - Web Designer - Illustrator</p>

    </div>
    <!-- not hidden -->
    <div class="username pt-5 pb-3 bg-primary text-white ">
      <h1><?php echo $username;?></h1>
    </div>

    
    <div class="bg-primary">
        <button class="btn btn-secondary btn-lg justify-content-around mx-auto my-2">Refresh</button>
      </div>
    </div>
  </header>
  
<div class="bg-primary">
  <?php 
    if(isset($_SESSION['referenced'])) { //user has not payed referrer
        $sql_query = "SELECT * FROM refs WHERE id='$user_id'";
        $user_result = mysqli_query($db_connection,$sql_query);
        if (!$user_result) { //if error
            echo "<div class=\"alert alert-danger mt-5\" role=\"alert\">";
                echo mysqli_error($db_connection);
            echo "</div>";
        }else { //include details to pay referrer
            include('./components/pay_reference.php'); 
        }
    }else { //user has payed referrer
        $sql_query = "SELECT * FROM users WHERE id='$user_id'";
        $user_result = mysqli_query($db_connection,$sql_query);
        if (!$user_result) { //if error
            echo "<div class=\"alert alert-danger mt-5\" role=\"alert\">";
                echo mysqli_error($db_connection);
            echo "</div>";
        }else{ //include dashboard components
            $user_details = mysqli_fetch_assoc($user_result);
            $username = $user_details['username'];

            //including dashboard components based on user status
            switch($user_details['status']) {
                case 0://if user needs to select package
                    include('./components/package_selection.php');
                    break;
                case 1://if user needs to wait for verification
                    include('./components/verification.php'); 
                    break;
                case 2://if user has been allocated to pay another user
                    include('./components/allocated_to_pay.php'); 
                    break;
                case 3://if user has paid and is waiting for allocatiion to be paid
                    include('./components/wait_for_payment.php'); 
                    break;
                case 4://if user has been allocated to recieve payment
                    include('./components/allocated_to_recieve.php'); 
                    break;
                default:
                
            }

            // including section containing ref link
            // require_once('./components/inbox.php');
            // including section containing ref link
            require_once('./components/share_ref_link.php');
            //past transactions
            include('./components/past_transactions.php');
        }
    }
    
?>
</div>




    <!-- content is hidden -->
  <div class="hide"></div>
    <!-- About Section -->
    <section class="page-section bg-primary text-white mb-0 hide" id="about">
      <div class="container">

        <!-- About Section Heading -->
        <h2 class="page-section-heading text-center text-uppercase text-white">About</h2>

        <!-- Icon Divider -->
        <div class="divider-custom divider-light">
          <div class="divider-custom-line"></div>
          <div class="divider-custom-icon">
            <i class="fas fa-star"></i>
          </div>
          <div class="divider-custom-line"></div>
        </div>
        <!-- About Section Content -->
        <div class="row">
          <div class="col-lg-4 ml-auto">
            <p class="lead">Freelancer is a free bootstrap theme created by Start Bootstrap. The download includes the complete source files including HTML, CSS, and JavaScript as well as optional SASS stylesheets for easy customization.</p>
          </div>
          <div class="col-lg-4 mr-auto">
            <p class="lead">You can create your own custom avatar for the masthead, change the icon in the dividers, and add your email address to the contact form to make it fully functional!</p>
          </div>
        </div>

        <!-- About Section Button -->
        <div class="text-center mt-4">
          <a class="btn btn-xl btn-outline-light" href="https://startbootstrap.com/themes/freelancer/">
            <i class="fas fa-download mr-2"></i>
            Free Download!
          </a>
        </div>

      </div>
    </section>

    <!-- Contact Section -->
    <section class="page-section hide" id="contact">
      <div class="container">

        <!-- Contact Section Heading -->
        <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Contact Me</h2>

        <!-- Icon Divider -->
        <div class="divider-custom">
          <div class="divider-custom-line"></div>
          <div class="divider-custom-icon">
            <i class="fas fa-star"></i>
          </div>
          <div class="divider-custom-line"></div>
        </div>

        <!-- Contact Section Form -->
        <div class="row">
          <div class="col-lg-8 mx-auto">
            <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19. -->
            <form name="sentMessage" id="contactForm" novalidate="novalidate">
              <div class="control-group">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                  <label>Name</label>
                  <input class="form-control" id="name" type="text" placeholder="Name" required="required" data-validation-required-message="Please enter your name.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="control-group">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                  <label>Email Address</label>
                  <input class="form-control" id="email" type="email" placeholder="Email Address" required="required" data-validation-required-message="Please enter your email address.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="control-group">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                  <label>Phone Number</label>
                  <input class="form-control" id="phone" type="tel" placeholder="Phone Number" required="required" data-validation-required-message="Please enter your phone number.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="control-group">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                  <label>Message</label>
                  <textarea class="form-control" id="message" rows="5" placeholder="Message" required="required" data-validation-required-message="Please enter a message."></textarea>
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <br>
              <div id="success"></div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-xl" id="sendMessageButton">Send</button>
              </div>
            </form>
          </div>
        </div>

      </div>
    </section>

    <!-- Footer -->
    <footer class="footer text-center hide">
      <div class="container">
        <div class="row">

          <!-- Footer Location -->
          <div class="col-lg-4 mb-5 mb-lg-0">
            <h4 class="text-uppercase mb-4">Location</h4>
            <p class="lead mb-0">2215 John Daniel Drive
              <br>Clark, MO 65243</p>
          </div>

          <!-- Footer Social Icons -->
          <div class="col-lg-4 mb-5 mb-lg-0">
            <h4 class="text-uppercase mb-4">Around the Web</h4>
            <a class="btn btn-outline-light btn-social mx-1" href="#">
              <i class="fab fa-fw fa-facebook-f"></i>
            </a>
            <a class="btn btn-outline-light btn-social mx-1" href="#">
              <i class="fab fa-fw fa-twitter"></i>
            </a>
            <a class="btn btn-outline-light btn-social mx-1" href="#">
              <i class="fab fa-fw fa-linkedin-in"></i>
            </a>
            <a class="btn btn-outline-light btn-social mx-1" href="#">
              <i class="fab fa-fw fa-dribbble"></i>
            </a>
          </div>

          <!-- Footer About Text -->
          <div class="col-lg-4">
            <h4 class="text-uppercase mb-4">About Freelancer</h4>
            <p class="lead mb-0">Freelance is a free to use, MIT licensed Bootstrap theme created by
              <a href="http://startbootstrap.com">Start Bootstrap</a>.</p>
          </div>

        </div>
      </div>
    </footer>

    <!-- Copyright Section -->
    <section class="copyright py-4 text-center text-white hide">
      <div class="container">
        <small>Copyright &copy; Your Website 2019</small>
      </div>
    </section>

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-to-top d-lg-none position-fixed ">
      <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top">
        <i class="fa fa-chevron-up"></i>
      </a>
    </div>

    <!-- Portfolio Modals -->

    <!-- Portfolio Modal 1 -->
    <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-labelledby="portfolioModal1Label" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">
              <i class="fas fa-times"></i>
            </span>
          </button>
          <div class="modal-body text-center">
            <div class="container">
              <div class="row justify-content-center">
                <div class="col-lg-8">
                  <!-- Portfolio Modal - Title -->
                  <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">Log Cabin</h2>
                  <!-- Icon Divider -->
                  <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon">
                      <i class="fas fa-star"></i>
                    </div>
                    <div class="divider-custom-line"></div>
                  </div>
                  <!-- Portfolio Modal - Image -->
                  <img class="img-fluid rounded mb-5" src="../assets/img/portfolio/cabin.png" alt="">
                  <!-- Portfolio Modal - Text -->
                  <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur itaque. Nam.</p>
                  <button class="btn btn-primary" href="#" data-dismiss="modal">
                    <i class="fas fa-times fa-fw"></i>
                    Close Window
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Portfolio Modal 2 -->
    <div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" role="dialog" aria-labelledby="portfolioModal2Label" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">
              <i class="fas fa-times"></i>
            </span>
          </button>
          <div class="modal-body text-center">
            <div class="container">
              <div class="row justify-content-center">
                <div class="col-lg-8">
                  <!-- Portfolio Modal - Title -->
                  <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">Tasty Cake</h2>
                  <!-- Icon Divider -->
                  <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon">
                      <i class="fas fa-star"></i>
                    </div>
                    <div class="divider-custom-line"></div>
                  </div>
                  <!-- Portfolio Modal - Image -->
                  <img class="img-fluid rounded mb-5" src="../assets/img/portfolio/cake.png" alt="">
                  <!-- Portfolio Modal - Text -->
                  <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur itaque. Nam.</p>
                  <button class="btn btn-primary" href="#" data-dismiss="modal">
                    <i class="fas fa-times fa-fw"></i>
                    Close Window
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Portfolio Modal 3 -->
    <div class="portfolio-modal modal fade" id="portfolioModal3" tabindex="-1" role="dialog" aria-labelledby="portfolioModal3Label" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">
              <i class="fas fa-times"></i>
            </span>
          </button>
          <div class="modal-body text-center">
            <div class="container">
              <div class="row justify-content-center">
                <div class="col-lg-8">
                  <!-- Portfolio Modal - Title -->
                  <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">Circus Tent</h2>
                  <!-- Icon Divider -->
                  <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon">
                      <i class="fas fa-star"></i>
                    </div>
                    <div class="divider-custom-line"></div>
                  </div>
                  <!-- Portfolio Modal - Image -->
                  <img class="img-fluid rounded mb-5" src="../assets/img/portfolio/circus.png" alt="">
                  <!-- Portfolio Modal - Text -->
                  <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur itaque. Nam.</p>
                  <button class="btn btn-primary" href="#" data-dismiss="modal">
                    <i class="fas fa-times fa-fw"></i>
                    Close Window
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Portfolio Modal 4 -->
    <div class="portfolio-modal modal fade" id="portfolioModal4" tabindex="-1" role="dialog" aria-labelledby="portfolioModal4Label" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">
              <i class="fas fa-times"></i>
            </span>
          </button>
          <div class="modal-body text-center">
            <div class="container">
              <div class="row justify-content-center">
                <div class="col-lg-8">
                  <!-- Portfolio Modal - Title -->
                  <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">Controller</h2>
                  <!-- Icon Divider -->
                  <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon">
                      <i class="fas fa-star"></i>
                    </div>
                    <div class="divider-custom-line"></div>
                  </div>
                  <!-- Portfolio Modal - Image -->
                  <img class="img-fluid rounded mb-5" src="../assets/img/portfolio/game.png" alt="">
                  <!-- Portfolio Modal - Text -->
                  <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur itaque. Nam.</p>
                  <button class="btn btn-primary" href="#" data-dismiss="modal">
                    <i class="fas fa-times fa-fw"></i>
                    Close Window
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Portfolio Modal 5 -->
    <div class="portfolio-modal modal fade" id="portfolioModal5" tabindex="-1" role="dialog" aria-labelledby="portfolioModal5Label" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">
              <i class="fas fa-times"></i>
            </span>
          </button>
          <div class="modal-body text-center">
            <div class="container">
              <div class="row justify-content-center">
                <div class="col-lg-8">
                  <!-- Portfolio Modal - Title -->
                  <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">Locked Safe</h2>
                  <!-- Icon Divider -->
                  <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon">
                      <i class="fas fa-star"></i>
                    </div>
                    <div class="divider-custom-line"></div>
                  </div>
                  <!-- Portfolio Modal - Image -->
                  <img class="img-fluid rounded mb-5" src="../assets/img/portfolio/safe.png" alt="">
                  <!-- Portfolio Modal - Text -->
                  <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur itaque. Nam.</p>
                  <button class="btn btn-primary" href="#" data-dismiss="modal">
                    <i class="fas fa-times fa-fw"></i>
                    Close Window
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Portfolio Modal 6 -->
    <div class="portfolio-modal modal fade" id="portfolioModal6" tabindex="-1" role="dialog" aria-labelledby="portfolioModal6Label" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">
              <i class="fas fa-times"></i>
            </span>
          </button>
          <div class="modal-body text-center">
            <div class="container">
              <div class="row justify-content-center">
                <div class="col-lg-8">
                  <!-- Portfolio Modal - Title -->
                  <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">Submarine</h2>
                  <!-- Icon Divider -->
                  <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon">
                      <i class="fas fa-star"></i>
                    </div>
                    <div class="divider-custom-line"></div>
                  </div>
                  <!-- Portfolio Modal - Image -->
                  <img class="img-fluid rounded mb-5" src="../assets/img/portfolio/submarine.png" alt="">
                  <!-- Portfolio Modal - Text -->
                  <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur itaque. Nam.</p>
                  <button class="btn btn-primary" href="#" data-dismiss="modal">
                    <i class="fas fa-times fa-fw"></i>
                    Close Window
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript -->
  <script src="../assets/vendor/jquery/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Contact Form JavaScript -->
  <script src="../assets/js/jqBootstrapValidation.js"></script>
  <script src="../assets/js/contact_me.js"></script>

  <!-- flip clock -->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <script src="../assets/js/flipclock.min.js"></script>
  <script src="../assets/js/clock.js"></script>

  <!-- Custom scripts for this template -->
  <script src="../assets/js/freelancer.min.js"></script>
  <!-- refresh -->
  <script src="../refresh.js"></script>


</body>

</html>

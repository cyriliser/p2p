<?php
//include auth.php file on all secure pages
require_once("../config/config.php");
require_once("../global_functions.php");
connect_to_db();
include("../login/auth.php");


?>
<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Nhlaluko" >

  <title>Home Page</title>
 
  <!..........................................................................................................>
  <?php 
  

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


<!..........................................................................................................>


  <!-- Custom fonts for this theme -->
  <!-- <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"> -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

  <!-- Theme CSS -->
  <link href="../assets/css/freelancer.css" rel="stylesheet">

</head>
<body>
<nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="<?php echo $base_url; ?>">CASH BANKERS</a>
      <button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item mx-0 mx-lg-1">
            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#about">About</a>
          </li>
          <li class="nav-item mx-0 mx-lg-1">
            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#contact">Contact</a>
          </li>
	  <li class="nav-item mx-0 mx-lg-1">
            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="<?php echo $dashboard_url; ?>">Dashboard</a>
          </li>
	  <li class="nav-item mx-0 mx-lg-1">
            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="<?php echo "$base_url/login/logout.php";?>" >Logout</a>
          </li>
          <li class="nav-item mx-0 mx-lg-1">
           <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger">user: <?php echo $_SESSION['username']; ?></a></li>
 
        </ul>
      </div>
    </div>
    <!..........................................................................................................>



    <!..........................................................................................................>

  </nav>
  <header class="masthead bg-primary text-white text-center">
    <div class="container d-flex align-items-center flex-column">
      <!-- Masthead Heading -->
     <!-- <h1 class="masthead-heading text-uppercase mb-0">Welcome <?php// echo $_SESSION['username']; ?>!</h1> -->

      <!-- Icon Divider -->
      <div class="divider-custom divider-light">
        <div class="divider-custom-line"></div>
        <div class="divider-custom-icon">
          <i class="fas fa-star"></i>
        <!..........................................................................................................>





        <!DOCTYPE html>
<?php 
    require_once('../config/config.php'); // has config options and db connection details
    require_once('../global_functions.php'); // has usefull functions
    connect_to_db(); //connects to database defined in global_funtions.php
    require_once('../login/auth.php');
?>

    <body>
        <!-- responses -->
        <?php 
            // pages with forms or that submit data will have that data processed here
            include('responses.php'); 
        ?>
        
        <!-- header -->
        <!-- <div class="" id="dashboard-header">
             <?php// include('navbar.php'); ?>      
        </div> -->

        <!-- body content -->
        <div class="container">
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
                        require_once('./components/share_ref_link.php');
                        //past transactions
                        include('./components/past_transactions.php');
                    }
                }
                
            ?>
        </div>

    









        <!..........................................................................................................>
        </div>
        <div class="divider-custom-line"></div>
      </div>
    </div>
  </header>
<div class="form">

</div>




</section>

</body>
</html>
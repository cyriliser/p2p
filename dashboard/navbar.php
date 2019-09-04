<?php 
  // $user_id = 1;
  // if(isset($_POST['user_id'])){
  //   $user_id = $_POST['user_id'];    
  // }

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
<nav class="navbar fixed-top  navbar-dark bg-success ">
  <ul class="nav nav-justified d-flex justify-content-center">
    <li class="nav-item">
      <a class="nav-link navbar-brand active" href="<?php echo $base_url ?>">Cashbankers</a>
    </li>
  </ul>

  <!-- <div id="user-details">
      <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Users </button>

        <div class="dropdown-menu" aria-labelledby="dropdownMenu1">
          <?php 
            // $sql_query = "SELECT id, username FROM users";
            // if ($res = mysqli_query($db_connection, $sql_query)){
            //   if (mysqli_num_rows($res) > 0){
            //     while ($user = mysqli_fetch_array($res)) { 
            //       echo  "<a class=\"dropdown-item disabled\" href=\"$dashboard_url?user_id=$user[id]\"> $user[id] &nbsp; $user[username]</a>";
            //     }
            //   }else { 
            //       echo "No matching records are found."; 
            //   }
            //   // mysqli_free_res($res);  
            // }
          ?>
          
        </div>

    </div>
  </div> -->

  <div class="alert alert-primary" role="alert">
    Username:<strong> <?php echo $username; ?></strong>
    <a href="<?php echo "$base_url/login/logout.php"; ?>" class="btn btn-danger btn-sm">Log out</a> 
  </div>


  <!-- <div id="user_profile">
    <form action="" method="post">
      <input type="number" value="1" name="user_id" id="user_id" style="width:60px;">
      <button type="submit" class="btn btn-primary">submit</button>
    </form>
  </div> -->
</nav>



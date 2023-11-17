<?php session_start(); ?>
<?php include "Header.php" ?>
<?php include "functions/connectdb.php" ?>
<?php

if (isset($_POST['signin'])) {
  $con = connectdb();
  $email = test_input($con,$_POST['email']);
  $password = test_input($con,$_POST['password']);

  $query = 'SELECT * FROM users WHERE user_email = "'.$email.'"';
  $user = mysqli_query($con, $query);

  if (!$user) {
    die('query Failed' . mysqli_error($con));
  }

  while ($row = mysqli_fetch_array($user)) {
      $user_id = $row['user_id'];
      $user_name = $row['user_firstname'];
      $user_email = $row['user_email'];
      $user_password = $row['user_pass'];
  }
  if ($user_email == $email  &&  $user_password == $password) {

        $_SESSION['id'] = $user_id;       // Storing the value in session
        //! Session data can be hijacked. Never store personal data such as password, security pin, credit card numbers other important data in $_SESSION
        header('location: dashboard.php?id=' . $user_id);
  } else {
        header('location: login.php');
  }
}

function test_input($con,$data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  $data = mysqli_real_escape_string($con,$data);
  return $data;
}
?>
<div class="container col-4 border rounded bg-light mt-5" style='--bs-bg-opacity: .5;'>
  <h1 class="text-center">Sign In</h1>
  <hr>
  <form id="login" method="post">
    <div class="mb-3" id="emails">
      <label for="email" class="form-label">Email ID</label>
      <input type="email" class="form-control" name="email" placeholder="Enter your email" autocomplete="off" required>
      <small class="text-muted">Your email is safe with us.</small>
    </div>
    <div class="mb-3" id="pass">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" name="password" placeholder="Enter your password" required>
      <small class="text-muted">Do not share your password.</small>
    </div>
    <div class="mb-3">
      <input  type="submit" name="signin" value="Sign In" class="btn btn-primary">
    </div>
  </form>
</div>
<script>
    // function validator() {
    //  onclick="validator()"
    //     var email_input = $("input[name='email']").val();
    //     var password_input = $("input[name='password']").val();
        
    //     $.post("",
    //     { 
    //       email: "archies559@gmail.com",
    //       password: "abc1234",
    //       signin_check: true
    //     });
    // }
</script>

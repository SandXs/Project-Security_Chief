<?php session_start(); ?>
<?php include "Header.php" ?>
<?php include "functions/connectdb.php" ?>
<?php

if (isset($_POST['signin'])) {
    $con = connectdb();
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * from users WHERE user_email = '$email'";
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
        $_SESSION['name'] = $user_name;   // Storing the value in session
        $_SESSION['email'] = $user_email; // Storing the value in session
        //! Session data can be hijacked. Never store personal data such as password, security pin, credit card numbers other important data in $_SESSION
        header('location: dashboard.php?user_id=' . $user_id);
  } else {
        header('location: login.php');
  }
}
?>
<div class="container col-4 border rounded bg-light mt-5" style='--bs-bg-opacity: .5;'>
  <h1 class="text-center">Sign In</h1>
  <hr>
  <form id="login" action="" method="post">
    <div class="mb-3">
      <label for="email" class="form-label">Email ID</label>
      <input type="email" class="form-control" name="email" placeholder="Enter your email" autocomplete="off" required>
      <small class="text-muted">Your email is safe with us.</small>
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" name="password" placeholder="Enter your password" required>
      <small class="text-muted">Do not share your password.</small>
    </div>
    <div class="mb-3">
      <input onclick="validator()" type="submit" name="signin" value="Sign In" class="btn btn-primary">
    </div>
  </form>
</div>
<script>
    function validator() {
        var email = $("input[name='email']").val();
        var pass = $("input[name='password']").val();
        $.post( "", { 
            email: $("input[name='email']").val(),
            password: $("input[name='password']").val(),
            signin: true
        });
    }
</script>

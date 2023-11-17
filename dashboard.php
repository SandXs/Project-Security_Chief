<?php session_start();       // Start the session
include "Header.php";
include "tools.php";


if (!isset($_SESSION['id'])) {         // condition Check: if session is not set. 
  header('location: login.php');   // if not set the user is sendback to login page.
}
$con = connectdb();
$user = Get_user_info($con);

?>
<div class="container col-12 border rounded mt-3" style="z-index: 0;position:absolute;">
  <h1 class=" mt-3 text-center">Welcome, this is your dashboard!! </h1>
  <!-- A button to open the popup form -->
  <button class="open-button" onclick="openForm()">Open Form</button>
  <table class="table table-striped table-bordered table-hover">
    <thead class="table-dark">
      <tr>
        <th scope="col">ID</th>
      </tr>
    </thead>
    <tbody>
    <?php
    $row = Get_all_tickets();
    print_r($row);
    echo'
      <tr>
        <td>'. $_SESSION['id'] .'</td>
      </tr>
      ';
    ?>
    </tbody>
  </table>
  <form action="" method="post">
    <button type="submit" name='signout' class=" btn btn-warning mb-3"> Sign Out</button>
  </form>
</div>

<!-- The form -->
<div class="form-popup" id="myForm">
  <form method="post" class="form-container">
    <h1>Create ticket</h1>
    <br/>
    <label for="ticket_email"><b>Email</b></label>
    <br/>
    <input type="email" placeholder="Enter Email" name="ticket_email" required>
    <br/>
    <label for="ticket_subject"><b>Subject</b></label>
    <br/>
    <input type="text" placeholder="Enter Subject" name="ticket_subject" required>
    <br/>
    <button type="submit" class="btn">Send</button>
    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
  </form>
</div>

<script>
  function closeForm() {
    document.getElementById("myForm").style.display = "none";
  }

  function openForm() {
    document.getElementById("myForm").style.display = "block";
  }
</script>

<?php
if (isset($_POST['signout'])) {
  session_destroy();            //  destroys session 
  header('location: index.php');
}
function Get_user_info ($con){
  $query = 'SELECT * FROM users WHERE user_id = "'.$_SESSION['id'].'"';
  $result = mysqli_query($con, $query);
  $row = mysqli_fetch_array($result);
  return $row;
}
function Get_all_tickets(){
  $con = connectdb();
  $user = Get_user_info($con);
  $query = 'SELECT * FROM tickets WHERE ticket_email = "'.$user['user_email'].'"';
  $result = mysqli_query($con, $query);
  $row = mysqli_fetch_array($result);
  return $row;
}
?>

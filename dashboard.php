<?php session_start();       // Start the session
include("Header.php");



if (!isset($_SESSION['id'])) {         // condition Check: if session is not set. 
  header('location: login.php');   // if not set the user is sendback to login page.
}

?>
<body>
  <div class="container col-12 border rounded mt-3" style="z-index: 0;position:absolute;">
    <h1 class=" mt-3 text-center">Welcome, this is your dashboard!! </h1>
    <!-- A button to open the popup form -->
    <button class="open-button" onclick="openForm()">Open Form</button>
    <table class="table table-striped table-bordered table-hover">
      <thead class="table-dark">
        <tr>
          <td>ID</td>
          <td>Priority</td>
          <td>Type</td>
          <td>Subject</td>
          <td>Content</td>
          <td>Email</td>
          <td>Response</td>
        </tr>
      </thead>
      <?php
      Get_all_tickets();
      ?>
    </table>
    <form action="" method="post">
      <button type="submit" name='signout' class=" btn btn-warning mb-3"> Sign Out</button>
    </form>
  </div>

  <!-- The form -->
  <div class="form-popup" id="myForm">
    <form method="post" class="form-container">
      <h1>Create ticket</h1>
      <div>
        <label for="ticket_email"><b>Email</b></label>
        <input type="email" placeholder="Enter Email" name="ticket_email" required>
      </div>
      <div>
        <label for="ticket_subject"><b>Subject</b></label>
        <input type="text" placeholder="Enter Subject" name="ticket_subject" required>
      </div>
      <div>
        <label for="ticket_type"><b>Type</b></label>
        <!-- <input type="text" placeholder="Enter Subject" name="ticket_type" required> -->
        <select name="ticket_type" required>
          <option value="">--Please choose an option--</option>
          <?php
          for ($i = 0; $i < count($ticket_type_arr); $i++) { 
            echo '<option value="'.$i.'">'.$ticket_type_arr[$i].'</option> ';
          }
          ?>
        </select>
      </div>
      <div>
        <label for="ticket_priority"><b>Priority</b></label>
        <!-- <input type="text" placeholder="Enter Subject" name="ticket_priority" required> -->
        <select name="ticket_priority" required>
          <option value="">--Please choose an option--</option>
          <?php
          for ($i = 0; $i < count($ticket_priority_arr); $i++) { 
            echo '<option value="'.$i.'">'.$ticket_priority_arr[$i][0].'</option> ';
          }
          ?>
        </select>
      </div>
      <div>
        <label for="ticket_content"><b>Content</b></label>
        <text placeholder="Enter Content" name="ticket_content" required>
      </div>
      <button type="submit" name="create_ticket" class="btn">Send</button>
      <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
    </form>
  </div>
<body>
<script>
  function closeForm() {
    document.getElementById("myForm").style.display = "none";
  }

  function openForm() {
    document.getElementById("myForm").style.display = "block";
  }
</script>

<?php
if (isset($_POST['create_ticket'])) {
  $con = connectdb();
  $query = 'INSERT INTO tickets (ticket_email,ticket_subject,ticket_type,ticket_content,ticket_priority) VALUES ("'.test_input($con,$_POST['ticket_email']).'","'.test_input($con,$_POST['ticket_subject']).'",'.intval(test_input($con,$_POST['ticket_type'])).',"'.test_input($con,$_POST['ticket_content']).'",'.intval(test_input($con,$_POST['ticket_priority'])).')';
  mysqli_query($con, $query);
  echo"<script>closeForm()</script>";
  //Get_all_tickets();
}

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
  if($user['user_is_admin'] == 1){
    $query = 'SELECT * FROM tickets';
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
  } else {
    $query = 'SELECT * FROM tickets WHERE ticket_email = "'.$user['user_email'].'"';
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
  }
  $html = "<tbody>";
  while(isset($row)){
    $html .= '
      <tr>
        <td>'. $row['ticket_id'] .'</td>
        <td>'. $row['ticket_priority'] .'</td>
        <td>'. $row['ticket_type'] .'</td>
        <td>'. $row['ticket_subject'] .'</td>
        <td>'. $row['ticket_content'] .'</td>
        <td>'. $row['ticket_email'] .'</td>
        <td>'. (isset($row['ticket_response'])) ? $row['ticket_response'] : "" .'</td>
      </tr>
    ';
  }
  $html .= "<tbody/>";
  echo $html;
}

?>
<?php session_start();       // Start the session
include("Header.php");

if (!isset($_SESSION['id'])) {         // condition Check: if session is not set. 
  header('location: login.php');   // if not set the user is sendback to login page.
}

$user = Get_user_info();
?>
<body>
  <div class="container col-12 border rounded mt-3" style="z-index: 0;position:absolute;">
    <h1 class=" mt-3 text-center">Welcome, this is your dashboard!! </h1>
    <!-- A button to open the popup form -->
    <button class="open-button" onclick="openForm()">Create ticket</button>
    <button class="open-button" onclick="delTicket()">Delete</button>
    <h2><?php echo (($GLOBALS['user']['user_is_admin'] == 1) ? "All active tickets" : "My tickets");  ?></h2>
    <table id="ticketlist" class="table table-striped table-bordered table-hover">
      <thead class="table-dark">
        <tr>
          <td></td>
          <td>ID</td>
          <td>Priority</td>
          <td>Type</td>
          <td>Subject</td>
          <td>Content</td>
          <td>Email</td>
          <td>Response</td>
        </tr>
      </thead>
      <tbody>
      <?php
      echo Get_all_tickets();
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
      <?php
      if ($GLOBALS['user']['user_is_admin'] == 1) {
        echo '
        <div>
          <label for="ticket_subject"><b>Email</b></label>
          <input type="email" placeholder="Enter an Email" name="ticket_email" required>
        </div>';
      }
      ?>
      <div>
        <label for="ticket_subject"><b>Subject</b></label>
        <input type="text" placeholder="Enter Subject" name="ticket_subject" required>
      </div>
      <div>
        <label for="ticket_type"><b>Type</b></label>
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
        <textarea placeholder="Enter Content" name="ticket_content" required></textarea>
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

  //delete ticket
  function delTicket(){
    // var ticket_id = $(this).find('tr').data('ticket_id');
    // console.log(ticket_id);
    $("input:checkbox[name=type]:checked").each(function(){

    });
  };

  //edit ticket
  $('#ticketlist').on('click','tbody tr', function(){
    var ticket_id = $(this).data('ticket_id');
    console.log(ticket_id);
  });
</script>

<?php
if (isset($_POST['create_ticket'])) {
  $con = connectdb();
  $query = 'INSERT INTO tickets SET 
    ticket_email = "'.test_input($con,((isset($_POST['ticket_email']))?$_POST['ticket_email']:$GLOBALS['user']['user_email'])).'",
    ticket_subject = "'.test_input($con,$_POST['ticket_subject']).'",
    ticket_type = '.intval(test_input($con,$_POST['ticket_type'])).',
    ticket_content = "'.test_input($con,$_POST['ticket_content']).'",
    ticket_priority = '.intval(test_input($con,$_POST['ticket_priority'])).',
    ticket_del = 0';
  mysqli_query($con, $query);
  echo"<script>closeForm()</script>";
  Get_all_tickets();
}

if (isset($_POST['del_ticket'])) {
  $con = connectdb();
  $query = 'UPDATE tickets SET ticket_del = 0 WHERE ticket_id = 0 AND ticket_email = '.$GLOBALS['user']['user_email'];
  mysqli_query($con, $query);
}

if (isset($_POST['signout'])) {
  session_destroy();            //  destroys session 
  header('location: index.php');
}
function Get_user_info (){
  $con = connectdb();
  $query = 'SELECT * FROM users WHERE user_id = "'.$_SESSION['id'].'"';
  $result = mysqli_query($con, $query);
  $row = mysqli_fetch_array($result);
  return $row;
}
function Get_all_tickets(){
  $con = connectdb();
  if($GLOBALS['user']['user_is_admin'] == 1){
    $query = 'SELECT * FROM tickets WHERE ticket_del = 0';
    $result = mysqli_query($con, $query);
  } else {
    $query = 'SELECT * FROM tickets WHERE ticket_email = "'.$GLOBALS['user']['user_email'].'" AND ticket_del = 0';
    $result = mysqli_query($con, $query);
  }
  $html = '<tbody>';
  while($row = mysqli_fetch_array($result)){
    $html .= '
      <tr class="clickable-row" data-ticket_id="'. $row['ticket_id'] .'">
        <td><input type="checkbox" id="del_ticket"></td>
        <td>'. $row['ticket_id'] .'</td>
        <td>'. $row['ticket_priority'] .'</td>
        <td>'. $row['ticket_type'] .'</td>
        <td>'. $row['ticket_subject'] .'</td>
        <td>'. $row['ticket_content'] .'</td>
        <td>'. $row['ticket_email'] .'</td>
        <td>'. ((isset($row['ticket_response'])) ? $row['ticket_response'] : "") .'</td>
      </tr>
    ';
  }
  $html .= '<tbody/>';
  return $html;
}

?>
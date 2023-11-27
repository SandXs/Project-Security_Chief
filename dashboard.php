<?php session_start();       // Start the session
include("Header.php");

if (!isset($_SESSION['id'])) {         // condition Check: if session is not set. 
  header('location: login.php');   // if not set the user is sendback to login page.
}

$user = Get_user_info($_SESSION['id']);
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
  //loadTickets();
  $(document).ready(function() {
    loadTickets();
  });
  
  function closeForm() {
    document.getElementById("myForm").style.display = "none";
  }

  function openForm() {
    document.getElementById("myForm").style.display = "block";
  }

  function loadTickets() {
    $.post('functions/functionsTickets.php',{ 
      load_Tickets: '1'
    }).done(function(data){
      $("#ticketlist tbody").empty();
      $("#ticketlist tbody").last().append( data );
    });
  }

  //delete ticket
  function delTicket(){
    var ticket_ids = [];
    $("tbody tr input:checkbox").each(function(){
      var isChecked = $(this);
      if(isChecked.is(":checked")){
        ticket_ids.push(isChecked.attr("id"));
      }
    });
    $.post('functions/functionsTickets.php',{ 
      del_ticket: '1',
      ticket_id: ticket_ids 
    }).done(function(data) { loadTickets();});
  };

  function createTicket(){
    $.post('functions/functionsTickets.php',{ 
      create_ticket: '1',
      ticket_subject: $()
    }).done(function(data) { closeForm(); loadTickets();});
  }

  //edit ticket
  $('#ticketlist').on('click','tbody tr', function(){
    var ticket_id = $(this).data('ticket_id');
  });
</script>

<?php
// if (isset($_POST['create_ticket'])) {
//   $con = connectdb();
//   $query = 'INSERT INTO tickets SET 
//     ticket_email = "'.test_input($con,((isset($_POST['ticket_email']))?$_POST['ticket_email']:$GLOBALS['user']['user_email'])).'",
//     ticket_subject = "'.test_input($con,$_POST['ticket_subject']).'",
//     ticket_type = '.intval(test_input($con,$_POST['ticket_type'])).',
//     ticket_content = "'.test_input($con,$_POST['ticket_content']).'",
//     ticket_priority = '.intval(test_input($con,$_POST['ticket_priority'])).',
//     ticket_del = 0';
//   mysqli_query($con, $query);
//   echo"<script>closeForm()</script>";
// }

if (isset($_POST['signout'])) {
  session_destroy();            //  destroys session 
  header('location: index.php');
}
// function Get_user_info (){
//   $con = connectdb();
//   $query = 'SELECT * FROM users WHERE user_id = "'.$_SESSION['id'].'"';
//   $result = mysqli_query($con, $query);
//   $row = mysqli_fetch_array($result);
//   return $row;
// }
// if (isset($_POST['load_Tickets'])) {
//   $con = connectdb();
//   if($GLOBALS['user']['user_is_admin'] == 1){
//     $query = 'SELECT * FROM tickets WHERE ticket_del = 0';
//     $result = mysqli_query($con, $query);
//   } else {
//     $query = 'SELECT * FROM tickets WHERE ticket_email = "'.$GLOBALS['user']['user_email'].'" AND ticket_del = 0';
//     $result = mysqli_query($con, $query);
//   }
//   $ticket_row = '';
//   while($row = mysqli_fetch_array($result)){
//     $ticket_row .= '
//       <tr class="clickable-row" data-ticket_id="'. $row['ticket_id'] .'">
//         <td><input type="checkbox" id="'. $row['ticket_id'] .'"></td>
//         <td>'. $row['ticket_id'] .'</td>
//         <td>'. $row['ticket_priority'] .'</td>
//         <td>'. $row['ticket_type'] .'</td>
//         <td>'. $row['ticket_subject'] .'</td>
//         <td>'. $row['ticket_content'] .'</td>
//         <td>'. $row['ticket_email'] .'</td>
//         <td>'. ((isset($row['ticket_response'])) ? $row['ticket_response'] : "") .'</td>
//       </tr>
//     ';
//   }
//   echo $ticket_row;
// }

?>
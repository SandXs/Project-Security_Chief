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
          <td><?php (($GLOBALS['user']['user_is_admin'] == 1) ? "<input type='checkbox' id='checkAll'>" : "My tickets");  ?></td>
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
  <div class="form-popup" id="Ticket_Create_Dialog">
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
      <button type="submit" onclick="createTicket()" class="btn">Send</button>
      <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
    </form>
  </div>
<body>
<script>
  $(document).ready(function() {
    loadTickets();
  });
  
  function closeForm() {
    document.getElementById("Ticket_Create_Dialog").style.display = "none";
  }

  function openForm() {
    document.getElementById("Ticket_Create_Dialog").style.display = "block";
  }

  function loadTickets() {
    $.post('functions/dashboard_functions.php',{ 
      view: 'load_Tickets'
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
    $.post('functions/dashboard_functions.php',{ 
      view: 'del_ticket',
      ticket_id: ticket_ids 
    }).done(function(data) { loadTickets();});
  };

  function createTicket(){
    $.post('functions/dashboard_functions.php',{ 
      view: 'create_ticket',
      ticket_subject: $("#Ticket_Create_Dialog input[name='ticket_subject']").val(),
      ticket_type: $("#Ticket_Create_Dialog select[name='ticket_type']").val(),
      ticket_email: $("#Ticket_Create_Dialog input[name='ticket_email']").val(),
      ticket_priority: $("#Ticket_Create_Dialog select[name='ticket_priority']").val(),
      ticket_content: $("#Ticket_Create_Dialog textarea[name='ticket_content']").val()
    }).done(function(data) {
      closeForm();
      loadTickets();
      $("#Ticket_Create_Dialog input[name='ticket_subject']").val("");
      $("#Ticket_Create_Dialog select[name='ticket_type']").val("");
      $("#Ticket_Create_Dialog input[name='ticket_email']").val("");
      $("#Ticket_Create_Dialog select[name='ticket_priority']").val("");
      $("#Ticket_Create_Dialog textarea[name='ticket_content']").val("");
    });
  }

  //edit ticket
  $('#ticketlist').on('click','tbody tr', function(){
    var ticket_id = $(this).data('ticket_id');
  });

  $("#checkAll").click(function () {
    $('input:checkbox').not(this).prop('checked', this.checked);
  });
</script>

<?php
if (isset($_POST['signout'])) {
  session_destroy();            //  destroys session 
  header('location: index.php');
}
?>
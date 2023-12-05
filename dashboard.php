<?php session_start();       // Start the session
include("Header.php");

if (!isset($_SESSION['id'])) {         // condition Check: if session is not set. 
  header('location: login.php');   // if not set the user is sendback to login page.
}

$user = Get_user_info($_SESSION['id']);
?>
<body>
  <!-- <div class="menu">
    <button class="open-button" onclick="showTickets()">Tickets</button>
    <button class="open-button" onclick="showUsers();">Users</button>
    <form action="" method="post">
      <button type="submit" name="signout" class=" btn btn-warning mb-3"> Sign Out</button>
    </form>
  </div> -->
  <div style="z-index: 1;position:absolute;">
    <div id="tickets" class="container col-12 border rounded mt-3">
      <h1 class=" mt-3 text-center">Welcome, this is your dashboard!! </h1>
      <!-- A button to open the popup form -->
      <button class="open-button" onclick="openTicketCreate()">Create ticket</button>
      <button class="open-button" onclick="sure_del_ticket()">Delete ticket(s)</button>
      <h2><?php echo (($GLOBALS['user']['user_is_admin'] == 1) ? "All active tickets" : "My tickets");?></h2>
      <table id="ticketlist" class="table table-striped table-bordered table-hover">
        <thead class="table-dark">
          <tr>
            <td><?php echo (($GLOBALS['user']['user_is_admin'] == 1) ? "<input type='checkbox' id='checkAllTickets'>" : "");?></td>
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
    </div>
    <?php
    if($GLOBALS['user']['user_is_admin'] == 1){
      echo'
      <div id="users" class="container col-12 border rounded mt-3">
        <button class="open-button" onclick="openUserCreate()">Create ticket</button>
        <button class="open-button" onclick="sure_del_user()">Delete user(s)</button>
        <h2>All users</h2>
        <table id="userslist" class="table table-striped table-bordered table-hover">
          <thead class="table-dark">
            <tr>
              <td><input type="checkbox" id="checkAllUsers"></td>
              <td>ID</td>
              <td>Name</td>
              <td>Company</td>
              <td>Email</td>
              <td></td>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
      <script>
      $(document).ready(function() {
        loadUsers();
      });
      </script>
      ';
    }
    ?>
  </div>
  <div class="popups" style="height:100%;width:100%;"></div>
</body>
<script>
  $(document).ready(function() {
    loadTickets();
  });
  
  function closePopup() {
    $(".popups").empty();
    $("body .popups").css({ "position" : "", "z-index": "" });
    
  }

  function openTicketCreate() {
    load_popup("popup_ticket_create");
  }

  function load_popup (type_popup,functions) {
    $.post("functions/dashboard_functions.php",{ 
      function: "popups",
      type_popup: type_popup
    }).done(function(data){
      $("body .popups").last().append(data);
      $("body .popups").css({"position": "absolute","z-index": "999"});
      if(functions!== null){
        functions
      }
    });
  }

  function loadTickets() {
    $.post("functions/dashboard_functions.php",{ 
      function: "load_Tickets"
    }).done(function(data){
      $("#ticketlist tbody").empty();
      $("#ticketlist tbody").last().append(data);
    });
  }

  function sure_del_ticket(){
    load_popup("popup_sure_del_ticket");
  }

  //delete ticket
  function delTicket(){
    var ticket_ids = [];
    $("#ticketlist tbody tr input:checkbox").each(function(){
      var isChecked = $(this);
      if(isChecked.is(":checked")){
        ticket_ids.push(isChecked.attr("id"));
      }
    });
    $.post("functions/dashboard_functions.php",{ 
      function: "del_ticket",
      ticket_id: ticket_ids 
    }).done(function(data) {
      loadTickets();
      $("#checkAllTickets").prop( "checked", false );
    });
  }

  function createTicket(){
    $.post("functions/dashboard_functions.php",{ 
      function: "create_ticket",
      ticket_subject: $("#Ticket_Create_Dialog input[name='ticket_subject']").val(),
      ticket_type: $("#Ticket_Create_Dialog select[name='ticket_type']").val(),
      ticket_email: $("#Ticket_Create_Dialog input[name='ticket_email']").val(),
      ticket_priority: $("#Ticket_Create_Dialog select[name='ticket_priority']").val(),
      ticket_content: $("#Ticket_Create_Dialog textarea[name='ticket_content']").val()
    }).done(function(data) {
      $("#Ticket_Create_Dialog input[name='ticket_subject']").val("");
      $("#Ticket_Create_Dialog select[name='ticket_type']").val("");
      $("#Ticket_Create_Dialog input[name='ticket_email']").val("");
      $("#Ticket_Create_Dialog select[name='ticket_priority']").val("");
      $("#Ticket_Create_Dialog textarea[name='ticket_content']").val("");
      closePopup();
      loadTickets();
    });
  }

  function save_edited_ticket(){
    $.post("functions/dashboard_functions.php",{ 
      function: "save_edited_ticket",
      ticket_id: $("#Ticket_Edit_Dialog input[name='ticket_id']").val(),
      ticket_subject: $("#Ticket_Edit_Dialog input[name='ticket_subject']").val(),
      ticket_type: $("#Ticket_Edit_Dialog select[name='ticket_type']").val(),
      ticket_email: $("#Ticket_Edit_Dialog input[name='ticket_email']").val(),
      ticket_priority: $("#Ticket_Edit_Dialog select[name='ticket_priority']").val(),
      ticket_content: $("#Ticket_Edit_Dialog textarea[name='ticket_content']").val(),
      ticket_response: $("#Ticket_Edit_Dialog textarea[name='ticket_response']").val()
    }).done(function(data) {
      console.log(data);
      $("#Ticket_Edit_Dialog input[name='ticket_subject']").val("");
      $("#Ticket_Edit_Dialog select[name='ticket_type']").val("");
      $("#Ticket_Edit_Dialog input[name='ticket_email']").val("");
      $("#Ticket_Edit_Dialog select[name='ticket_priority']").val("");
      $("#Ticket_Edit_Dialog textarea[name='ticket_content']").val("");
      $("#Ticket_Edit_Dialog textarea[name='ticket_response']").val("");
      closePopup();
      loadTickets();
    });
  }

  //edit ticket
  $("#ticketlist").on("click","tbody tr", function(){
    $.post("functions/dashboard_functions.php",{ 
      function: "popups",
      type_popup: "popup_ticket_edit",
      ticket_id: $(this).data("ticket_id")
    }).done(function(data){
      $("body .popups").last().append(data);
      $("body .popups").css({"position": "absolute","z-index": "999"});
    });
  });

  $("#checkAll").click(function () {
    $("input:checkbox").not(this).prop("checked", this.checked);
  });

  function loadUsers() {
    $.post("functions/dashboard_functions.php",{ 
      function: "load_Users"
    }).done(function(data){
      $("#userslist tbody").empty();
      $("#userslist tbody").last().append(data);
    });
  }

  function openUserCreate() {
    load_popup("popup_user_create");
  }

  function sure_del_user(){
    load_popup("popup_sure_del_user");
  }

  //delete ticket
  function delUsers(){
    var user_ids = [];
    $("#userslist tbody tr input:checkbox").each(function(){
      var isChecked = $(this);
      if(isChecked.is(":checked")){
        user_ids.push(isChecked.attr("id"));
      }
    });
    $.post("functions/dashboard_functions.php",{ 
      function: "del_user",
      user_id: user_ids 
    }).done(function(data) {
      loadUsers();
      $("#checkAllUsers").prop( "checked", false );
    });
  }

  function createUser(){
    $.post("functions/dashboard_functions.php",{ 
      function: "create_user",
      user_email: $("#User_Create_Dialog input[name='user_email']").val(),
      user_firstname: $("#User_Create_Dialog input[name='user_firstname']").val(),
      user_lastname: $("#User_Create_Dialog input[name='user_lastname']").val(),
      user_company: $("#User_Create_Dialog input[name='user_company']").val(),
      user_is_admin: $("#User_Create_Dialog input[name='user_is_admin']").val()
    }).done(function(data) {
      $("#User_Create_Dialog input[name='user_email']").val("");
      $("#User_Create_Dialog input[name='user_firstname']").val("");
      $("#User_Create_Dialog input[name='user_lastname']").val("");
      $("#User_Create_Dialog input[name='user_company']").val("");
      $("#User_Create_Dialog input[name='user_is_admin']").val("");
      closePopup();
      loadUsers();
    });
  }
</script>

<?php
if (isset($_POST['signout'])) {
  session_destroy();            //  destroys session 
  header('location: index.php');
}
?>
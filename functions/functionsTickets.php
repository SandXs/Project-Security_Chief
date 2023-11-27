<?php session_start();       // Start the session
require("../tools.php");

$user = Get_user_info($_SESSION['id']);

if (isset($_POST['load_Tickets'])) {
    $con = connectdb();
    if($GLOBALS['user']['user_is_admin'] == 1){
        $query = 'SELECT * FROM tickets WHERE ticket_del = 0';
        $result = mysqli_query($con, $query);
    } else {
        $query = 'SELECT * FROM tickets WHERE ticket_del = 0 AND ticket_email = "'.$GLOBALS['user']['user_email'].'"';
        $result = mysqli_query($con, $query);
    }
    $ticket_row = '';
    while($row = mysqli_fetch_array($result)){
        $ticket_row .= '
        <tr class="clickable-row" data-ticket_id="'. $row['ticket_id'] .'">
            <td><input type="checkbox" id="'. $row['ticket_id'] .'"></td>
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
    echo $ticket_row;
}

if (isset($_POST['del_ticket'])) {
    $con = connectdb();
    $query = 'UPDATE tickets SET ticket_del = 1 WHERE ticket_id IN ('.implode(",",$_POST['ticket_id']).')';
    mysqli_query($con, $query);
}
?>
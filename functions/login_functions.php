<?php require("../tools.php");

switch($_POST['function']) {
    case "login":
        $con = connectdb();
        $email = strtolower(test_input($con,$_POST['email']));
        $password = test_input($con,$_POST['password']);
        
        $query = 'SELECT * FROM users WHERE user_email = "'.$email.'"';
        $result = mysqli_query($con, $query);
        $user = mysqli_fetch_array($result);

        if (!$user) {
            //echo'login failed';
            exit;
        }
        
        if (!password_verify($password,$user['user_pass'])) {
            echo'/login.php';
            
        } else {
            session_start();
            $_SESSION['id'] = $user['user_id'];       // Storing the value in session
            //! Session data can be hijacked. Never store personal data such as password, security pin, credit card numbers other important data in $_SESSION
            echo'/dashboard.php?id=' . $user['user_id'];
        }

        break;
};
?>
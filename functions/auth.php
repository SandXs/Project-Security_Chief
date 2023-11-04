<?php    
        include('connectdb.php');  

        echo $_POST['email'];
        echo "<br/>";
        echo $_POST['pass'];

        $con = connectdb();
      
            // //to prevent from mysqli injection  
            // $email = stripcslashes($email);  
            // $unencrypted_password = stripcslashes($unencrypted_password);  
            // $email = mysqli_real_escape_string($con, $email);  
            // $unencrypted_password = mysqli_real_escape_string($con, $unencrypted_password);  

            // $hashed_pass = ($unencrypted_password, PASSWORD_DEFAULT);
            
            $query = "select * from users";  
            $result = mysqli_query($con, $query); 
            foreach($result as $user) {
                echo "<pre>";
                print_r($user);
                echo "</pre>";
                if($user['user_email']== $_POST['email']){
                    $_SESSION['valid'] = true;
                    $_SESSION['timeout'] = time();
                    $_SESSION['username'] = '';
                }
            }
            
              
            // if($count == 1){  
            //     echo "<h1><center> Login successful </center></h1>";  
            // }  
            // else{  
            //     echo "<h1> Login failed. Invalid username or password.</h1>";  
            // }     
    ?>  
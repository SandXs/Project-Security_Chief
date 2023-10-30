<?php      
        include('connectdb.php');  
        $con = connectdb()
        $email = $_POST['email'];  
        $unencrypted_password = $_POST['pass'];  
          
            //to prevent from mysqli injection  
            $email = stripcslashes($email);  
            $unencrypted_password = stripcslashes($unencrypted_password);  
            $email = mysqli_real_escape_string($con, $email);  
            $unencrypted_password = mysqli_real_escape_string($con, $unencrypted_password);  

            $hashed_pass = ($unencrypted_password, PASSWORD_DEFAULT);

            $sql = "select * from login where email = '$email'";  
            $result = mysqli_query($con, $sql);  
            if($result) {
                print_r($result);
                echo $hashed_pass;
            }
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
            $count = mysqli_num_rows($result);  
              
            if($count == 1){  
                echo "<h1><center> Login successful </center></h1>";  
            }  
            else{  
                echo "<h1> Login failed. Invalid username or password.</h1>";  
            }     
    ?>  
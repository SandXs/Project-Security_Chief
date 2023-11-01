<?php      
        $host = " 127.0.0.1 ";  
        $user = "DBAdmin";  
        $password = 'ABC1234';  
        $db_name = "secchief";  
          
        //$con = connectdb();
        function connectdb() {
            mysqli_connect($host, $user, $password, $db_name);  
            if(mysqli_connect_errno()) {  
                die("Failed to connect with MySQL: ". mysqli_connect_error());  
            }  
        }
    ?>  
<?php 
include "tools.php";
?>

<html>  
    <head>  
        <title>PHP login system</title>  
        // insert style.css file inside index.html  
        <link rel = "stylesheet" type = "text/css" href = "style.css">   
    </head>  
    <body>  
        <div id = "frm">  
            <h1>Login</h1>  
            <form name="login" action = "authentication.php" onsubmit = "return validation()" method = "POST">  
                <p>  
                    <label> UserName: </label>  
                    <input type="text" id="email" name ="user" />  
                </p>  
                <p>  
                    <label> Password: </label>  
                    <input type="password" id="pass" name="pass" />  
                </p>  
                <p>     
                    <input type="submit" id="btn" value="Login" />  
                </p>  
            </form>  
        </div>  
        // validation for empty field   
        <script>  
                function validation()  
                {  
                    var email=document.login.email.value;  
                    var password=document.login.pass.value;  
                    if(email.length=="" && password.length=="") {  
                        alert("User Name and Password fields are empty");  
                        return false;  
                    }  
                    else  
                    {  
                        if(email.length=="") {  
                            alert("User Name is empty");  
                            return false;  
                        }   
                        if (password.length=="") {  
                        alert("Password field is empty");  
                        return false;  
                        }  
                    }                             
                }  
            </script>  
    </body>     
</html>  
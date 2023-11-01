
<html>  
    <head>  
        <title>PHP login system</title>  
        <link rel = "stylesheet" type = "text/css" href = "CSS/main.css">
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    </head>  
    <body>  
        <div id = "frm">  
            <h1>Login</h1>  
            <form name="login" action = "functions/auth.php" onsubmit = "return validation()" method = "POST">  
                <p>  
                    <label> Email: </label>  
                    <input type="text" id="email" name ="email" />  
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
                            alert("Email field is empty");  
                            return false;  
                        } 
                        else if (password.length=="") 
                        {  
                            alert("Password field is empty");  
                            return false;  
                        } 
                        else 
                        {
                            $.post("functions/auth.php", {
                                email: email,
                                pass: password
                            });
                        }
                    }                             
                }  
            </script>  
    </body>     
</html>  
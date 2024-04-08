<?php
//session_start();
include("Header.php");

?>
  <script>
    function login() {
      $.post("functions/login_functions.php", {
        function: "login",
        email: $("input#email").val(),
        password: $("input#password").val()
      }).done(function(data) {
        window.location.href = data;
        //console.log(data);
        });
    }
  </script>
  <section class="login-container">
    <div class="form_container login_form">
        <h1 class="loginTitle"> Login</h1>
            <form id="login">
                <div class="from_input">
                    <input type="text" name="email" id="email" placeholder="email"  required>
                    <input type="password" name="password" id="password" placeholder="WachtWoord"  autocomplete="off" required>
                </div>
                <div class="submit_btn">
                    <div onclick="login()" name="signin" id='signin'>Signin</div>
                </div>
            </form >
            <!-- <p><a href="#">Vergeet Wachtwoord </a> </p> -->
            <p>Heb je geen account dan ? <a href="./contact.php">Contact ons</a> </p>
    </div>
  </section>

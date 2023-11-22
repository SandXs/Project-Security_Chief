<!DOCTYPE html>
<html lang="en">
<?php 
include './Header.php';
?>

<script>
// setTimeout(function() {
//     window.location.reload(1);
// }, 5000);
</script>
    <section class="login-container">
        <div class="form_container login_form">
            <h1> LogIn</h1>
                <form action="">
                    <div class="from_input">
                        <input type="text" name="Email" id="name" placeholder="Email">
                        <input type="password" name="password" id="fullName" placeholder="WachtWoord">
                    </div>
                  
                </form>
                <div class="submit_btn">
                        <button type="submit">Inlogen</button>
                    </div>
                <p><a href="#">Vergeet Wachtwoord </a> </p>
                <p>Heb je geen accaunt dan ? <a href="./contact.php">Contact ons</a> </p>
        </div>
    </section>
</body>
</html>
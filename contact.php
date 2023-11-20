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
    <section class="contact-container">
        <div class="form_container">
            <h1>Contact ons voor meer nieuws en betere beveiliging </h1>
                <form action="">
                    <div class="from_input">
                        <input type="text" name="Email" id="name" placeholder="Email">
                        <select name="aanmeld_option" id="aanmeld_option">
                            <option value="1">Acount Aanvragen</option>
                            <option value="2">Test Aanvragen</option>
                            <option value="3">Q&A</option>
                            <option value="4">Probleem aanmelden</option>
                        </select>
                        <input type="text" name="Full name" id="fullName" placeholder="Voor-AchterNaam">
                        <input type="text" name="companyName" id="companyName" placeholder="Bedrijf naam">
                        <input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;" name="Nummber" id="Nummber" placeholder="Telefoon nummer">
                    </div>
                    <div class="description_input">
                        <textarea name="omschrijving" id="omschrijving" cols="50" rows="5" placeholder="Omschrijving..."></textarea>
                    </div>
                </form>
        </div>
    </section>
</body>
</html>
<h2 style="font-family: Arial, Helvetica, sans-serif; font-weight: bold; text-align: center; font-size: large; padding-top: 10px;">Zmień swoje hasło</h2>

<form action="" method="post">
    <p style="font-family: Arial, Helvetica, sans-serif; font-weight: bold; padding-top: 25px;">Wpisz aktualne hasło: </p><input type = "password" name = "current_pass" style="margin-bottom: 15px;" required>
    <p style="font-family: Arial, Helvetica, sans-serif; font-weight: bold;">Wpisz nowe hasło: </p><input type = "password" name = "new_pass" style="margin-bottom: 15px;" required>
    <p style="font-family: Arial, Helvetica, sans-serif; font-weight: bold;">Ponownie wpisz nowe hasło: </p><input type = "password" name = "new_pass_2" style="margin-bottom: 15px;" required><br>
    <input type="submit" name="change_pass" value="Zaktualizuj hasło"/>
</form>

<?php
include("includes/db_connect.php");

    //sprawdzanie wykonania kliknięcia przez klienta
    if(isset($_POST['change_pass']))
    {
        $user = $_SESSION['uzytkownik_email'];
        //pobieranie do zmiennych lokalnych wpisanych wartości
        $current_pass = $_POST['current_pass'];
        $new_pass = $_POST['new_pass'];
        $new_again = $_POST['new_pass_2'];

        //zapytanie do bazy danych
        $sel_pass = "SELECT * FROM uzytkownicy WHERE uzytkownik_pass = '$current_pass' AND uzytkownik_email = '$user'";

        //wykonywanie zapytania w bazie danych
        $run_pass = mysqli_query($con, $sel_pass);

        //sprawdzanie hasła użytkownika
        $check_pass = mysqli_num_rows($run_pass);

        //sprawdzanie poprawności wpisanych danych
        if($check_pass==0)
        {
            echo "<script>alert('Twoje aktualne hasło jest inne niż podane.')</script>";
        }

        if($new_pass!=$new_again)
        {
            echo "<script>alert('Podane hasła nie są takie same.')</script>";
        }

        if($new_pass==$new_again && $check_pass!=0)
        {
            //aktualizowanie hasła jeżeli wszystko jest dobrze
            $update_pass = "UPDATE uzytkownicy SET uzytkownik_pass = '$new_pass' WHERE uzytkownik_email = '$user'";

            //wysyłanie zapytania
            $run_update = mysqli_query($con, $update_pass);

            echo "<script>alert('Hasło zostało pomyślnie zaktualizowane.')</script>";
            echo "<script>window.open('my_account.php', '_self')</script>";
        }
    }
?>
<h2 style="font-family: Arial, Helvetica, sans-serif; font-weight: bold; text-align: center; font-size: large; padding-bottom: 25px; padding-top: 10px;">Usuń swoje konto</h2>

<form action="" method="post">
    <p style="font-family: Arial, Helvetica, sans-serif; font-weight: bold;">Wpisz swoje hasło: </p><input type = "password" name = "pass" style="margin-bottom: 15px;" required>
    <p style="font-family: Arial, Helvetica, sans-serif; font-weight: bold;">Ponownie wpisz hasło: </p><input type = "password" name = "pass_2" style="margin-bottom: 15px;" required><br>
    <input type="submit" name="delete_acc" value="Usuń konto"/>
</form>

<?php
include("includes/db_connect.php");

    //sprawdzanie wykonania kliknięcia przez klienta
    if(isset($_POST['delete_acc']))
    {
        $user = $_SESSION['uzytkownik_email'];
        //pobieranie do zmiennych lokalnych wpisanych wartości
        $pass = $_POST['pass'];
        $pass_again = $_POST['pass_2'];

        //zapytanie do bazy danych
        $sel_pass = "SELECT * FROM uzytkownicy WHERE uzytkownik_pass = '$pass' AND uzytkownik_email = '$user'";

        //wykonywanie zapytania w bazie danych
        $run_pass = mysqli_query($con, $sel_pass);

        //sprawdzanie hasła użytkownika
        $check_pass = mysqli_num_rows($run_pass);

        //sprawdzanie poprawności wpisanych danych
        if($check_pass==0)
        {
            echo "<script>alert('Hasło nie jest zgodne, spróbuj ponownie.')</script>";
        }

        if($pass!=$pass_again)
        {
            echo "<script>alert('Hasła nie pokrywają się, spróbuj ponownie.')</script>";
        }
        
        if($pass==$pass_again && $check_pass!=0)
        {
            //usuwanie konta jeżeli wszystko jest dobrze
            $delete_account = "DELETE FROM uzytkownicy WHERE uzytkownik_email = '$user'";

            //wysyłanie zapytania
            $run_delete = mysqli_query($con, $delete_account);

            echo "<script>alert('Konto zostało pomyślnie usunięte. Przekierujemy Cię na stronę główną.')</script>";
            echo "<script>window.open('../index.php', '_self')</script>";
        }
    }
?>
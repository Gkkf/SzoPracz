<?php
    include('Includes/db_connect.php');
?>

<div>
    <form method="post" action="">
        <table width="500" align="center" bgcolor="#C5C5C5" style="font-family: Arial, Helvetica, sans-serif; font-weight: bold;">
            <tr align="center">
                <td colspan="4"><h2 style="padding-bottom: 15px; padding-top: 15px;">Zaloguj/Zarejestruj się</h2></td>
            </tr>
            <tr>
                <td align="right">Email:</td>
                <td><input type="text" name="email" required/></td>
            </tr>
            <tr>
                <td align="right">Hasło:</td>
                <td style="padding-top: 5px;"><input type="password" name="pass" required/></td>
            </tr>
            <tr>
                <td colspan="3" style="padding-top: 10px; padding-bottom: 10px;"><input type="submit" name="login" value="Login"/></td>
            </tr>
        </table>

            <h2 style="float: right; font-family: Arial, Helvetica, sans-serif; margin-right: 425px; margin-top: 20px;"><a href="customer_register.php" style="text-decoration: none;">Nowy? Zarejestruj się tutaj</a></h2>
    </form>

    <?php
        if(isset($_POST['login']))
        {
            $c_email = $_POST['email'];
            $c_pass = $_POST['pass'];

            //zapytanie w lokalnej zmiennej
            $sel_c = "SELECT * FROM uzytkownicy WHERE uzytkownik_pass='$c_pass' AND uzytkownik_email = '$c_email'";

            //zmienna wykonująca zapytanie w bazie
            $run_c = mysqli_query($con, $sel_c);

            //zmienna z sprawdzaniem czy jest taki użytkownik
            $check_customer = mysqli_num_rows($run_c);

            //zapytanie jeżeli użytkownik nie istnieje
            if($check_customer == 0)
            {
                echo "<script>alert('Email lub hasło są niepoprawne. Spróbuj ponownie!')</script>";
                //reszta kodu nie zostanie wykonana
                exit();
            }

            $ip = GetIP();

            //zapytanie do bazy danych które weryfikuje co dany klient miał w koszyku
            $sel_cart = "SELECT * FROM koszyk WHERE ip_add='$ip'";

            //zmienna wykonująca zapytanie
            $run_cart = mysqli_query($con, $sel_cart);

            //sprawdzanie czy klient ma jakieś przedmioty w koszyku
            $check_cart = mysqli_num_rows($run_cart);

            if($check_customer>0 && $check_cart==0)
            {
                //sesja dla zarejestrowanego użytkownika
                $_SESSION['uzytkownik_email']=$c_email;

                echo "<script>alert('Logowanie przebiegło pomyślnie!')</script>";
                echo "<script>window.open('User/my_account.php', '_self')</script>";
            }
            else
            {
                //sesja dla zarejestrowanego użytkownika
                $_SESSION['uzytkownik_email']=$c_email;

                echo "<script>alert('Logowanie przebiegło pomyślnie!')</script>";
                echo "<script>window.open('payment.php', '_self')</script>";
            }
        }
    ?>
</div>
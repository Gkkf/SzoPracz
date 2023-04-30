<?php
    include("includes/db_connect.php");
    $user = $_SESSION['uzytkownik_email'];

    //zapytanie do bazy
    $get_customer = "SELECT * FROM uzytkownicy WHERE uzytkownik_email = '$user'";

    //wysyłanie zapytania do bazy
    $run_customer = mysqli_query($con, $get_customer);

    //tablica z danymi z bazy
    $row_customer = mysqli_fetch_array($run_customer);

    //zmienne z danymi użytkownika
    $c_id = $row_customer['uzytkownik_id'];
    $name = $row_customer['uzytkownik_nazwa'];
    $email = $row_customer['uzytkownik_email'];
    $pass = $row_customer['uzytkownik_pass'];
    $kodp = $row_customer['uzytkownik_kodp'];
    $city = $row_customer['uzytkownik_miasto'];
    $adres = $row_customer['uzytkownik_adres'];
    $number = $row_customer['uzytkownik_numer'];
    $image = $row_customer['uzytkownik_zdjecie'];
?>
                
                <form action="" method="post" enctype="multipart/form-data">
                    <table align="center" width="750px" bgcolor="#C5C5C5" style="font-family: Arial, Helvetica, sans-serif; font-weight: bold;">
                        <tr>
                            <td colspan="4" align="center"><h2 style="padding-bottom: 15px; padding-top: 15px;">Edytuj konto</h2></td>
                        </tr>
                        <tr>
                            <td align="right" style="padding-bottom: 10px;">Nazwa użytkownika:</td>
                            <td><input type="text" name="c_name" value="<?php echo $name ?>" required/></td>
                        </tr>
                        <tr>
                            <td align="right" style="padding-bottom: 10px;">Email:</td>
                            <td><input type="text" name="c_email" value="<?php echo $email ?>" required/></td>
                        </tr>
                        <tr>
                            <td align="right" style="padding-bottom: 10px;">Hasło:</td>
                            <td><input type="password" name="c_pass" value="<?php echo $pass ?>" readonly/></td>
                        </tr>
                        <tr>
                            <td align="right" style="padding-bottom: 10px;">Kod pocztowy:</td>
                            <td><input type="text" name="c_postcode" value="<?php echo $kodp ?>" required/></td>
                        </tr>
                        <tr>
                            <td align="right" style="padding-bottom: 10px;">Miasto:</td>
                            <td><input type="text" name="c_city" value="<?php echo $city ?>" required/></td>
                        </tr>
                        <tr>
                            <td align="right" style="padding-bottom: 10px;">Adres:</td>
                            <td><input type="text" name="c_adres" value="<?php echo $adres ?>" required/></td>
                        </tr>
                        <tr>
                            <td align="right" style="padding-bottom: 10px;">Numer telefonu:</td>
                            <td><input type="tel" name="c_number" value="<?php echo $number ?>" required/></td>
                        </tr>
                        <tr>
                            <td align="right" style="padding-bottom: 10px;">Zdjęcie profilowe:</td>
                            <td><input type="file" name="c_image" required/><img src="user_images/<?php echo $image?>" width="50px" height="50px"/></td>
                        </tr>
                        <tr>
                            <td colspan="3" style="padding-top: 10px; padding-bottom: 10px;" align="center"><input type="submit" name="update" value="Edytuj konto"/></td>
                        </tr>
                    </table>
                </form>
<?php
    //zapytanie sprawdzające czy przycisk został kliknięty
    if(isset($_POST['update']))
    {
        //pobieranie IP klienta do zmiennej lokalnej
        $ip = GetIP();

        //zapisywanie wszystkich danych do zmiennych
        $c_name = $_POST['c_name'];
        $c_email = $_POST['c_email'];
        $c_pass = $_POST['c_pass'];
        $c_postcode = $_POST['c_postcode'];
        $c_city = $_POST['c_city'];
        $c_adres = $_POST['c_adres'];
        $c_number = $_POST['c_number'];
        $c_image = $_FILES['c_image']['name'];
        $c_image_tmp = $_FILES['c_image']['tmp_name'];

        //przesłanie zdjęcia do folderu użytkownika
        move_uploaded_file($c_image_tmp, "user_images/$c_image");

        //zapytanie do edytowania użytkownika do bazy danych
        $update_c = "UPDATE uzytkownicy SET uzytkownik_nazwa = '$c_name', uzytkownik_email = '$c_email', uzytkownik_pass = '$pass', uzytkownik_kodp = '$c_postcode', uzytkownik_miasto = '$c_city', uzytkownik_adres = '$c_adres', uzytkownik_numer = '$c_number', uzytkownik_zdjecie = '$c_image' WHERE uzytkownik_id = '$c_id'";
        
        //zmienna wykonujące zapytanie w bazie danych
        $run_update = mysqli_query($con, $update_c);

        if($run_update)
        {
            echo "<script>alert('Konto zostało pomyślnie zaktualizowane.')</script>";
            echo "<script>window.open('my_account.php', '_self')</script>";
        }
    }

?>
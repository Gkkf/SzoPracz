<!DOCTYPE html>
<!--Podłączenie pliku z funkcją połączenia z bazą danych-->
<?php
    include("includes/db_connect.php");
    if(!isset($_SESSION['user_email']))
    {
        echo "<script>window.open('login.php', '_self')</script>";
    }
    else
    {
    if(isset($_GET['edit_user']))
    {
        $get_id = $_GET['edit_user'];

        //tworzenie zapytania i wysyłanie go do bazy
        $get_pro = "SELECT * FROM uzytkownicy WHERE uzytkownik_id = '$get_id'";
        $run_pro = mysqli_query($con, $get_pro);

        //tablica z danymi i pobieranie ich z tablicy
        $row_pro = mysqli_fetch_array($run_pro);

        $pro_id = $row_pro['uzytkownik_id'];
        $pro_nazwa = $row_pro['uzytkownik_nazwa'];
        $pro_email = $row_pro['uzytkownik_email'];
        $pro_pass = $row_pro['uzytkownik_pass'];
        $pro_kodp = $row_pro['uzytkownik_kodp'];
        $pro_miasto = $row_pro['uzytkownik_miasto'];
        $pro_adres = $row_pro['uzytkownik_adres'];
        $pro_numer = $row_pro['uzytkownik_numer'];
        $pro_zdjecie = $row_pro['uzytkownik_zdjecie'];
    }
?>

<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edytowanie użytkownika</title>
</head>
<body bgcolor="#dbd3d3">
    <!--Główny formularz do dodwania produktów-->
    <form method="POST" enctype="multipart/form-data">
        <!--Tabela do dodwania produktów-->
        <table align="center" width="795" height="600" border="2" bgcolor="#f2e8d5">
            <tr align="center">
                <td colspan="8"><h2 style="font-family: Arial, Helvetica, sans-serif; font-size: 30px; margin-top: 20px;" >Edytuj użytkownika:</h2></td>
            </tr>

            <tr>
                <td align="right" style="font-family: Arial, Helvetica, sans-serif;"><b>Nazwa:</b></td>
                <td><input type="text" name="nazwa" size="60" value="<?php echo $pro_nazwa; ?>" required></td>
            </tr>

            <tr>
                <td align="right" style="font-family: Arial, Helvetica, sans-serif;"><b>Email:</b></td>
                <td><input type="text" name="email" size="60" value="<?php echo $pro_email; ?>" required></td>
            </tr>

            <tr>
                <td align="right" style="font-family: Arial, Helvetica, sans-serif;"><b>Hasło:</b></td>
                <td><input type="text" name="pass" size="60" value="<?php echo $pro_pass; ?>" required></td>
            </tr>

            <tr>
                <td align="right" style="font-family: Arial, Helvetica, sans-serif;"><b>Kod pocztowy:</b></td>
                <td><input type="text" name="kodp" value="<?php echo $pro_kodp; ?>" required></td>
            </tr>

            <tr>
                <td align="right" style="font-family: Arial, Helvetica, sans-serif;"><b>Miasto:</b></td>
                <td><input type="text" name="miasto" size="60" value="<?php echo $pro_miasto; ?>" required></td>
            </tr>

            <tr>
                <td align="right" style="font-family: Arial, Helvetica, sans-serif;"><b>Adres:</b></td>
                <td><input type="text" name="adres" value="<?php echo $pro_adres; ?>" required></td>
            </tr>

            <tr>
                <td align="right" style="font-family: Arial, Helvetica, sans-serif;"><b>Numer:</b></td>
                <td><input type="text" name="numer" size="60" value="<?php echo $pro_numer; ?>" required></td>
            </tr>

            <tr>
                <td align="right" style="font-family: Arial, Helvetica, sans-serif;"><b>Zdjęcie:</b></td>
                <td><input type="file" name="zdjecie" required><img src="../User/user_images/<?php echo $pro_zdjecie; ?>" width="45px" height="45px"/></td>
            </tr>

            <tr align="center">
                <td colspan="8"><input style="margin-top: 10px; margin-bottom: 10px; width: 250px; height: 50px;" type="submit" name="update_user" value="Aktualizuj"></td>
            </tr>
        </table>
    </form>
</body>
</html>

<?php

    //Kod do przesłania danych produktu do bazy danych

    if(isset($_POST['update_user']))
    {
        //Lokalne zmienne pobierające dane z formularza

        $update_id = $pro_id;

        $product_title = $_POST['nazwa'];
        $product_type = $_POST['email'];
        $product_cat = $_POST['pass'];
        $product_price = $_POST['kodp'];
        $product_desc = $_POST['miasto'];
        $product_amount = $_POST['adres'];
        $product_size = $_POST['numer'];

        //Lokalna zmienna pobierająca dane zdjęcia
        $product_image = $_FILES['zdjecie']['name'];
        $product_image_tmp = $_FILES['zdjecie']['tmp_name'];

        //Wysyłanie zdjęcia do folderu
        move_uploaded_file($product_image_tmp, "../user_images/$product_image");

        //Wysyłanie danych do zmiennej, następnie do bazy danych
        $update_product="UPDATE uzytkownicy SET uzytkownik_nazwa='$product_title', uzytkownik_email='$product_type', uzytkownik_pass='$product_cat', uzytkownik_kodp='$product_price', uzytkownik_miasto='$product_desc', uzytkownik_adres='$product_amount', uzytkownik_numer='$product_size', uzytkownik_zdjecie='$product_image' WHERE uzytkownik_id='$update_id'";
        $update= mysqli_query($con, $update_product);

        //Komunikat o edycji konta, oraz blokowanie duplikacji parametrów
        if($update)
        {
            echo "<script>alert('Pomyślnie edytowano użytkownika.')</script>";
            echo "<script>window.open('index.php?view_customers', '_self')</script>";
        }
    }
}
?>
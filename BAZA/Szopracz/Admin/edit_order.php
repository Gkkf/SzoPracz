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


    if(isset($_GET['edit_order']))
    {
        $get_id = $_GET['edit_order'];

        //tworzenie zapytania i wysyłanie go do bazy
        $get_cat = "SELECT * FROM zamowienia WHERE zamowienie_id = '$get_id'";
        $run_cat = mysqli_query($con, $get_cat);

        //tablica z danymi i pobieranie ich z tablicy
        $row_cat = mysqli_fetch_array($run_cat);

        $or_id = $row_cat['zamowienie_id'];
        $or_prod = $row_cat['zamowienie_prod'];
        $or_data = $row_cat['data'];
        $or_price = $row_cat['kwota'];
        $or_pro = $row_cat['produkt'];
        $or_status = $row_cat['status'];
    }
?>

<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edytowanie zamówienia</title>
</head>
<body bgcolor="#dbd3d3">
    <!--Główny formularz do edytowania kategorii-->
    <form method="POST" enctype="multipart/form-data">
        <!--Tabela do edytowania kategorii-->
        <table align="center" width="795" height="600" border="2" bgcolor="#f2e8d5">
            <tr align="center">
                <td colspan="8"><h2 style="font-family: Arial, Helvetica, sans-serif; font-size: 30px; margin-top: 20px;" >Edytuj kateogorię:</h2></td>
            </tr>

            <tr>
                <td align="right" style="font-family: Arial, Helvetica, sans-serif;"><b>Powiązane z:</b></td>
                <td><input type="text" name="pow" size="60" value="<?php echo $or_prod; ?>" required></td>
            </tr>
            <tr>
                <td align="right" style="font-family: Arial, Helvetica, sans-serif;"><b>Data:</b></td>
                <td><input type="date" name="data" size="60" value="<?php echo $or_data; ?>" required></td>
            </tr>
            <tr>
                <td align="right" style="font-family: Arial, Helvetica, sans-serif;"><b>Kwota:</b></td>
                <td><input type="text" name="price" size="60" value="<?php echo $or_price; ?>" required></td>
            </tr>
            <tr>
                <td align="right" style="font-family: Arial, Helvetica, sans-serif;"><b>Produkt:</b></td>
                <td><input type="text" name="pro" size="60" value="<?php echo $or_pro; ?>" required></td>
            </tr>
            <tr>
                <td align="right" style="font-family: Arial, Helvetica, sans-serif;"><b>Status zamówienia:</b></td>
                <td>
                    <select style="width: 175px;" name='status' required>
                        <option value='<?php $or_status; ?>'><?php echo $or_status; ?></option>
                        <option value='W trakcie realizacji'>W trakcie realizacji</option>
                        <option value='Zakończone'>Zakończone</option>
                        <option value='Anulowane'>Anulowane</option>
                    </select>
                </td>  
            </tr>
            <tr align="center">
                <td colspan="8"><input style="margin-top: 10px; margin-bottom: 10px; width: 250px; height: 50px;" type="submit" name="update_or" value="Aktualizuj"></td>
            </tr>
        </table>
    </form>
</body>
</html>

<?php

    //Kod do przesłania danych zamówienia do bazy danych

    if(isset($_POST['update_or']))
    {
        //Lokalne zmienne pobierające dane z formularza

        $update_id = $or_id;
        $prod = $_POST['pow'];
        $data = $_POST['data'];
        $kwota = $_POST['price'];
        $produkt = $_POST['pro'];
        $status = $_POST['status'];

        //Wysyłanie danych do zmiennej, następnie do bazy danych
        $update_cat="UPDATE zamowienia SET zamowienie_prod='$prod', data='$data', kwota='$kwota', produkt='$produkt', status='$status' WHERE zamowienie_id='$update_id'";
        $update= mysqli_query($con, $update_cat);

        //Komunikat o edytowaniu zamówienia, oraz blokowanie duplikacji parametrów
        if($update)
        {
            echo "<script>alert('Pomyślnie edytowano zamówienie.')</script>";
            echo "<script>window.open('index.php?view_orders', '_self')</script>";
        }
    }
}
?>
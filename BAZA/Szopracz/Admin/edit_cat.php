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


    if(isset($_GET['edit_cat']))
    {
        $get_id = $_GET['edit_cat'];

        //tworzenie zapytania i wysyłanie go do bazy
        $get_cat = "SELECT * FROM kategoria WHERE kategoria_id = '$get_id'";
        $run_cat = mysqli_query($con, $get_cat);

        //tablica z danymi i pobieranie ich z tablicy
        $row_cat = mysqli_fetch_array($run_cat);

        $cat_id = $row_cat['kategoria_id'];
        $cat_name = $row_cat['kategoria_nazwa'];
    }
?>

<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edytowanie kategorii</title>
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
                <td align="right" style="font-family: Arial, Helvetica, sans-serif;"><b>Nazwa kategorii:</b></td>
                <td><input type="text" name="nazwa" size="60" value="<?php echo $cat_name; ?>" required></td>
            </tr>
            <tr align="center">
                <td colspan="8"><input style="margin-top: 10px; margin-bottom: 10px; width: 250px; height: 50px;" type="submit" name="update_cat" value="Aktualizuj"></td>
            </tr>
        </table>
    </form>
</body>
</html>

<?php

    //Kod do przesłania danych kategorii do bazy danych

    if(isset($_POST['update_cat']))
    {
        //Lokalne zmienne pobierające dane z formularza

        $update_id = $cat_id;
        $cate_name = $_POST['nazwa'];

        //Wysyłanie danych do zmiennej, następnie do bazy danych
        $update_cat="UPDATE kategoria SET kategoria_nazwa='$cate_name' WHERE kategoria_id='$update_id'";
        $update= mysqli_query($con, $update_cat);

        //Komunikat o edytowaniu kategorii, oraz blokowanie duplikacji parametrów
        if($update)
        {
            echo "<script>alert('Pomyślnie edytowano kategorię.')</script>";
            echo "<script>window.open('index.php?view_cats', '_self')</script>";
        }
    }
}
?>
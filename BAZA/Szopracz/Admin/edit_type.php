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

    if(isset($_GET['edit_type']))
    {
        $get_id = $_GET['edit_type'];

        //tworzenie zapytania i wysyłanie go do bazy
        $get_type = "SELECT * FROM rodzaj WHERE rodzaj_id = '$get_id'";
        $run_type = mysqli_query($con, $get_type);

        //tablica z danymi i pobieranie ich z tablicy
        $row_cat = mysqli_fetch_array($run_type);

        $type_id = $row_cat['rodzaj_id'];
        $type_name = $row_cat['rodzaj_nazwa'];
    }
?>

<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edytowanie rodzaju</title>
</head>
<body bgcolor="#dbd3d3">
    <!--Główny formularz do edytowania kategorii-->
    <form method="POST" enctype="multipart/form-data">
        <!--Tabela do edytowania kategorii-->
        <table align="center" width="795" height="600" border="2" bgcolor="#f2e8d5">
            <tr align="center">
                <td colspan="8"><h2 style="font-family: Arial, Helvetica, sans-serif; font-size: 30px; margin-top: 20px;" >Edytuj rodzaj:</h2></td>
            </tr>

            <tr>
                <td align="right" style="font-family: Arial, Helvetica, sans-serif;"><b>Nazwa rodzaju:</b></td>
                <td><input type="text" name="nazwa" size="60" value="<?php echo $type_name; ?>" required></td>
            </tr>
            <tr align="center">
                <td colspan="8"><input style="margin-top: 10px; margin-bottom: 10px; width: 250px; height: 50px;" type="submit" name="update_type" value="Aktualizuj"></td>
            </tr>
        </table>
    </form>
</body>
</html>

<?php

    //Kod do przesłania danych rodzaju do bazy danych

    if(isset($_POST['update_type']))
    {
        //Lokalne zmienne pobierające dane z formularza

        $update_id = $type_id;
        $type_name = $_POST['nazwa'];

        //Wysyłanie danych do zmiennej, następnie do bazy danych
        $update_type="UPDATE rodzaj SET rodzaj_nazwa='$type_name' WHERE rodzaj_id='$update_id'";
        $update= mysqli_query($con, $update_type);

        //Komunikat o edytowaniu kategorii, oraz blokowanie duplikacji parametrów
        if($update)
        {
            echo "<script>alert('Pomyślnie edytowano rodzaj.')</script>";
            echo "<script>window.open('index.php?view_types', '_self')</script>";
        }
    }
}
?>
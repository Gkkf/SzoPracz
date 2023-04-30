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
    if(isset($_GET['edit_pro']))
    {
        $get_id = $_GET['edit_pro'];

        //tworzenie zapytania i wysyłanie go do bazy
        $get_pro = "SELECT * FROM produkty WHERE produkt_id = '$get_id'";
        $run_pro = mysqli_query($con, $get_pro);

        //tablica z danymi i pobieranie ich z tablicy
        $row_pro = mysqli_fetch_array($run_pro);

        $pro_id = $row_pro['produkt_id'];
        $pro_type = $row_pro['produkt_rodzaj'];
        $pro_cat = $row_pro['produkt_kategoria'];
        $pro_img = $row_pro['produkt_zdjecie'];
        $pro_title = $row_pro['produkt_nazwa'];
        $pro_price = $row_pro['produkt_cena'];
        $pro_desc = $row_pro['produkt_opis'];
        $pro_qty = $row_pro['produkt_ilosc'];
        $pro_size = $row_pro['produkt_rozmiar'];
        $pro_kw = $row_pro['produkt_skluczowe'];

        //zapytanie pobierające nazwę kategorii
        $get_cat = "SELECT * FROM kategoria WHERE kategoria_id = '$pro_type'";

        $run_cat = mysqli_query($con, $get_cat);

        //wysyłanie kategorii do tabeli i pobieranie jej
        $row_cat=mysqli_fetch_array($run_cat);

        $cat_name = $row_cat['kategoria_nazwa'];

        //zapytanie pobierające nazwę typu
        $get_type = "SELECT * FROM rodzaj WHERE rodzaj_id = '$pro_cat'";

        $run_type = mysqli_query($con, $get_type);

        //wysyłanie rodzaki do tabeli i pobieranie jej
        $row_type=mysqli_fetch_array($run_type);

        $type_name = $row_type['rodzaj_nazwa'];
    }
?>

<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edytowanie produktu</title>
</head>
<body bgcolor="#dbd3d3">
    <!--Główny formularz do dodwania produktów-->
    <form method="POST" enctype="multipart/form-data">
        <!--Tabela do dodwania produktów-->
        <table align="center" width="795" height="600" border="2" bgcolor="#f2e8d5">
            <tr align="center">
                <td colspan="8"><h2 style="font-family: Arial, Helvetica, sans-serif; font-size: 30px; margin-top: 20px;" >Edytuj produkt:</h2></td>
            </tr>

            <tr>
                <td align="right" style="font-family: Arial, Helvetica, sans-serif;"><b>Nazwa produktu:</b></td>
                <td><input type="text" name="nazwa" size="60" value="<?php echo $pro_title; ?>" required></td>
            </tr>

            <tr>
                <td align="right" style="font-family: Arial, Helvetica, sans-serif;"><b>Rodzaj produktu:</b></td>
                <td><select style="width: 175px;" name='rodzaj' required>
                    <option value='<?php $pro_type ?>'><?php echo $type_name; ?></option>
                    <?php 
                        $get_types = "SELECT * FROM rodzaj";

                        //wywołanie zapytania
                        $run_types = mysqli_query($con, $get_types);
                    
                        //pętla do pobierania danych z bazy i wyświetlania ich dynamicznie
                        while($row_types = mysqli_fetch_array($run_types))
                        {
                            $type_id = $row_types['rodzaj_id'];
                            $type_title = $row_types['rodzaj_nazwa'];
                    
                            echo "<option value='$type_id'>$type_title</option>";
                        } 
                    ?>
                </select>
                </td>  
            </tr>

            <tr>
                <td align="right" style="font-family: Arial, Helvetica, sans-serif;"><b>Kategoria produktu:</b></td>
                <td><select style="width: 175px;" name='kategoria' required>
                    <option value='<?php $pro_cat; ?>'><?php echo $cat_name; ?></option>
                    <?php 
                        $get_cats = "SELECT * FROM kategoria";

                        //wywołanie zapytania
                        $run_cats = mysqli_query($con, $get_cats);
                    
                        //pętla do pobierania danych z bazy i wyświetlania ich dynamicznie
                        while($row_cats = mysqli_fetch_array($run_cats))
                        {
                            $cat_id = $row_cats['kategoria_id'];
                            $cat_title = $row_cats['kategoria_nazwa'];
                    
                            echo "<option value='$cat_id'>$cat_title</option>";
                        } 
                    ?>
                </select>
                </td>  
            </tr>

            <tr>
                <td align="right" style="font-family: Arial, Helvetica, sans-serif;"><b>Cena produktu:</b></td>
                <td><input type="text" name="cena" value="<?php echo $pro_price; ?>" required></td>
            </tr>

            <tr>
                <td align="right" style="font-family: Arial, Helvetica, sans-serif;"><b>Opis produktu:</b></td>
                <td><textarea name="opis" cols="30" rows="10"><?php echo $pro_desc; ?></textarea></td>
            </tr>

            <tr>
                <td align="right" style="font-family: Arial, Helvetica, sans-serif;"><b>Ilość produktu:</b></td>
                <td><input type="text" name="ilosc" value="<?php echo $pro_qty; ?>" required></td>
            </tr>

            <tr>
                <td align="right" style="font-family: Arial, Helvetica, sans-serif;"><b>Rozmiar produktu:</b></td>
                <td><input style="text-transform: uppercase;" type="text" name="rozmiar" value="<?php echo $pro_size; ?>" placeholder="XS, S, M, L, XL" required></td>
            </tr>

            <tr>
                <td align="right" style="font-family: Arial, Helvetica, sans-serif;"><b>Zdjęcie produktu:</b></td>
                <td><input type="file" name="zdjecie" required><img src="product_images/<?php echo $pro_img; ?>" width="45px" height="45px"/></td>
            </tr>

            <tr>
                <td align="right" style="font-family: Arial, Helvetica, sans-serif;"><b>Słowo kluczowe produktu:</b></td>
                <td><input type="text" name="skluczowe" size="60" value="<?php echo $pro_kw; ?>" required></td>
            </tr>

            <tr align="center">
                <td colspan="8"><input style="margin-top: 10px; margin-bottom: 10px; width: 250px; height: 50px;" type="submit" name="update_product" value="Aktualizuj"></td>
            </tr>
        </table>
    </form>
</body>
</html>

<?php

    //Kod do przesłania danych produktu do bazy danych

    if(isset($_POST['update_product']))
    {
        //Lokalne zmienne pobierające dane z formularza

        $update_id = $pro_id;

        $product_title = $_POST['nazwa'];
        $product_type = $_POST['rodzaj'];
        $product_cat = $_POST['kategoria'];
        $product_price = $_POST['cena'];
        $product_desc = $_POST['opis'];
        $product_amount = $_POST['ilosc'];
        $product_size = $_POST['rozmiar'];
        $product_keyword = $_POST['skluczowe'];

        //Lokalna zmienna pobierająca dane zdjęcia
        $product_image = $_FILES['zdjecie']['name'];
        $product_image_tmp = $_FILES['zdjecie']['tmp_name'];

        //Wysyłanie zdjęcia do folderu
        move_uploaded_file($product_image_tmp, "product_images/$product_image");

        //Wysyłanie danych do zmiennej, następnie do bazy danych
        $update_product="UPDATE produkty SET produkt_rodzaj='$product_type', produkt_kategoria='$product_cat', produkt_nazwa='$product_title', produkt_cena='$product_price', produkt_opis='$product_desc', produkt_ilosc='$product_amount', produkt_rozmiar='$product_size', produkt_zdjecie='$product_image', produkt_skluczowe='$product_keyword' WHERE produkt_id='$update_id'";
        $update= mysqli_query($con, $update_product);

        //Komunikat o dodaniu produktu, oraz blokowanie duplikacji parametrów
        if($update)
        {
            echo "<script>alert('Pomyślnie edytowano produkt.')</script>";
            echo "<script>window.open('index.php?view_products', '_self')</script>";
        }
    }
}
?>
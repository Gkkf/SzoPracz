<!DOCTYPE html>
<!--Podłączenie pliku z funkcją połączenia z bazą danych-->
<?php
    include("includes/db_connect.php");
?>

<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodawanie produktu</title>
    <!--Podłączenie skryptu z funkcją edycji zdjęcia-->
    <link href="styles/imagesend.css" media="all">
</head>
<body bgcolor="#dbd3d3">
    <!--Główny formularz do dodwania produktów-->
    <form action="insert_product.php" method="POST" enctype="multipart/form-data">
        <!--Tabela do dodwania produktów-->
        <table align="center" width="795" height="600" border="2" bgcolor="#f2e8d5">
            <tr align="center">
                <td colspan="8"><h2 style="font-family: Arial, Helvetica, sans-serif; font-size: 30px; margin-top: 20px;" >Dodaj nowy produkt:</h2></td>
            </tr>

            <tr>
                <td align="right" style="font-family: Arial, Helvetica, sans-serif;"><b>Nazwa produktu:</b></td>
                <td><input type="text" name="nazwa" size="60" required></td>
            </tr>

            <tr>
                <td align="right" style="font-family: Arial, Helvetica, sans-serif;"><b>Rodzaj produktu:</b></td>
                <td><select style="width: 175px;" name='rodzaj' required>
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
                <td><input type="text" name="cena" required></td>
            </tr>

            <tr>
                <td align="right" style="font-family: Arial, Helvetica, sans-serif;"><b>Opis produktu:</b></td>
                <td><textarea name="opis" cols="30" rows="10"></textarea></td>
            </tr>

            <tr>
                <td align="right" style="font-family: Arial, Helvetica, sans-serif;"><b>Ilość produktu:</b></td>
                <td><input type="text" name="ilosc" required></td>
            </tr>

            <tr>
                <td align="right" style="font-family: Arial, Helvetica, sans-serif;"><b>Rozmiar produktu:</b></td>
                <td><input style="text-transform: uppercase;" type="text" name="rozmiar" placeholder="XS, S, M, L, XL" required></td>
            </tr>

            <tr>
                <td align="right" style="font-family: Arial, Helvetica, sans-serif;"><b>Zdjęcie produktu:</b></td>
                <td><input type="file" name="zdjecie"></td>
            </tr>

            <tr>
                <td align="right" style="font-family: Arial, Helvetica, sans-serif;"><b>Słowo kluczowe produktu:</b></td>
                <td><input type="text" name="skluczowe" size="60" required></td>
            </tr>

            <tr align="center">
                <td colspan="8"><input style="margin-top: 10px; margin-bottom: 10px; width: 250px; height: 50px;" type="submit" name="insert_product" value="Dodaj Produkt"></td>
            </tr>
        </table>
    </form>
</body>
</html>

<?php

    //Kod do przesłania danych produktu do bazy danych

    if(isset($_POST['insert_product']))
    {
        //Lokalne zmienne pobierające dane z formularza
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
        $insert_product="INSERT INTO produkty (produkt_rodzaj, produkt_kategoria, produkt_nazwa, produkt_cena, produkt_opis, produkt_ilosc, produkt_rozmiar, produkt_zdjecie, produkt_skluczowe) VALUES ('$product_type', '$product_cat', '$product_title', '$product_price', '$product_desc', '$product_amount', '$product_size', '$product_image', '$product_keyword')";
        $insert = mysqli_query($con, $insert_product);

        //Komunikat o dodaniu produktu, oraz blokowanie duplikacji parametrów
        if($insert)
        {
            echo "<script>alert('Pomyślnie dodano produkt.')</script>";
            echo "<script>window.open('index.php?insert_product', '_self')</script>";
        }
    }
?>
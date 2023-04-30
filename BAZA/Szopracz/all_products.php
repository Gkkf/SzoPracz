<!DOCTYPE html>
<!--Podłączenie pliku z funkcjami PHP-->
<?php
    session_start();
    include("Functions/functions.php");
?>

<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Szopracz</title>
    <!--Podłączenie pliku ze stylami CSS, działające dla każdego urządzenia-->
    <link rel="stylesheet" href="styles/style.css" media="all">
</head>
<body>
    <!--Główny div z klasą CSS, w którym stworzone są pozostałe sekcje-->
    <div class="main">

        <!--Sekcja nagłówka-->
        <div class="header">
            <img style="width:1000px; height:225px;" id="logo" src="Images/logo.jpg">
        </div>
        <!--Koniec sekcji nagłówka-->

        <!--Sekcja paska menu-->
        <div class="menubar">
            <ul id="menu">
                <li><a href="index.php">Główna Strona</a></li>
                <li><a href="all_products.php">Wszystkie Produkty</a></li>
                <li><a href="User/my_account.php">Konto</a></li>
                <li><a href="customer_register.php">Zarejestruj się</a></li>
                <li><a href="cart.php">Koszyk</a></li>
                <!--Obszar paska wyszukiwania-->
                <form id="form" method="get" action="results.php" enctype="multipart/form-data">
                    <input type="text" name="search" placeholder="Wyszukaj produkt">
                    <input type="submit" name="button_search" value="Wyszukaj">
                </form>
            </ul>
        </div>
        <!--Koniec sekcji menu-->

        <!--Sekcja zawartości oraz paska bocznego-->
        <div class="content">

            <!--Sekcja paska bocznego-->
            <div id="sidebar">
                <!--Obszar tytułu rodzajów paska bocznego-->
                <div id="sidebar_title">Rodzaje</div>

                <!--Lista rodzajów paska bocznego-->
                <ul id="categories">
                    <!--Wersja robocza
                        <select style="width: 190px; height: 30px; margin-left: 5px;" name='rodzaj'>
                        <?php getTypes(); ?>
                    </select>-->
                    <ul id="categories" style="text-align: center;  color: white; font-size: 19px; font-family: Arial, Helvetica, sans-serif;">
                        <?php getTypes(); ?>
                    </ul>
                </ul>

                <!--Obszar tytułu kategorii paska bocznego-->
                <div id="sidebar_title">Kategorie</div>

                <!--Lista kategorii paska bocznego-->
                <ul id="categories" style="text-align: center;  color: white; font-size: 19px; font-family: Arial, Helvetica, sans-serif;">
                    <?php getCategories(); ?>
                </ul>

                <!--Obszar filtrów paska bocznego-->
                <div id="sidebar_title">Filtry</div>

                <!--Lista filtrów paska bocznego-->
                <ul id="categories">
                    <li><a href="index.php?order=cros">- Rosnąco wg. ceny</a></li>
                    <li><a href="index.php?order=cmal">- Malejąco wg. ceny</a></li>
                    <li><a href="index.php?order=iros">- Rosnąco wg. ilości</a></li>
                    <li><a href="index.php?order=imal">- Malejąco wg. ilości</a></li>
                    <li><a href="index.php?order=rros">- Rosnąco wg. rozmiar</a></li>
                    <li><a href="index.php?order=rmal">- Malejąco wg. rozmiar</a></li>
                </ul>
            </div>
            <!--Koniec sekcji paska bocznego-->
            
            <!--Obszar zawartości-->
            <div id="content_area">
                <!--Obszar paska koszyka-->
                <div id="shopping_cart"> 
                    <span style="font-size: 18px; padding: 8px; margin: 5px;; line-height: 40px;">
                    <?php
                        if(isset($_SESSION['uzytkownik_email']))
                        {
                            echo "Witaj " . $_SESSION['uzytkownik_email'] . "!";
                        }
                        else
                        {
                            echo "Witaj Gość!";
                        }
                    ?>
                        <b style="color: #f2e8d5; padding-left: 175px;">Koszyk &nbsp-&nbsp  </b> <b>Ilość: <?php Total_Items(); ?> &nbsp Koszt: <?php Total_Price(); ?> </b> <a href="cart.php" style="color: #f2e8d5; text-decoration: none; float: right; padding-right: 8px; margin-right: 5px;">Idź do koszyka</a>
                    <?php
                        if(!isset($_SESSION['uzytkownik_email']))
                        {
                            echo "<a href='checkout.php' style='text-decoration: none'>&nbsp Zaloguj</a>";
                        }
                        else
                        {
                            echo "<a href='logout.php' style='text-decoration: none'>&nbsp Wyloguj</a>";
                        }
                    ?>
                    </span>
                </div>
                <!--Koniec obszaru paska koszyka-->
                <div id="products_box">
                <?php
                    //Zapytanie sprawdzające czy wartości są możliwe do pobrania
                    if(!isset($_GET['cat']))
                    {
                        if(!isset($_GET['type']))
                        {
                            global $con;

                            //pobieranie wszystkich produktów i wyświetlanie na stronie głównej z bazy danych
                            $get_pro = "SELECT * FROM produkty";

                            $run_pro = mysqli_query($con, $get_pro);

                            //pętla do pobierania danych z bazy i wyświetlanie na stronie
                            while($row_pro = mysqli_fetch_array($run_pro))
                            {
                                $pro_id = $row_pro['produkt_id'];
                                $pro_type = $row_pro['produkt_rodzaj'];
                                $pro_cat = $row_pro['produkt_kategoria'];
                                $pro_title = $row_pro['produkt_nazwa'];
                                $pro_price = $row_pro['produkt_cena'];
                                $pro_image = $row_pro['produkt_zdjecie'];
                                
                                $pro_qty = $row_pro['produkt_ilosc'];

                                if($pro_qty>0)
                                {
                                    echo "
                                    <div id='single_product' style='float: left; margin-left: 20px; padding: 10px; text-align: center;'>
                                        <a href='details.php?pro_id=$pro_id'><img src='Admin/product_images/$pro_image' style='border: 2px solid black;' width='180px' height='180px'></img></a>
                                        <p style='font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>$pro_title</p>
                                        <p style='font-family: Arial, Helvetica, sans-serif; padding-top: 2px; padding-bottom: 5px;'>$pro_price zł</p>
                                        <a href='index.php?add_cart=$pro_id'><button style='float: center; width: 175px; height: 25px;'>Dodaj do koszyka</button></a>
                                    </div>
                                    ";
                                }
                                else
                                {
                                    echo "
                                    <div id='single_product' style='float: left; margin-left: 20px; padding: 10px; text-align: center;'>
                                        <a href='details.php?pro_id=$pro_id'><img src='Admin/product_images/$pro_image' style='border: 2px solid black;' width='180px' height='180px'></img></a>
                                        <p style='font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>$pro_title</p>
                                        <p style='font-family: Arial, Helvetica, sans-serif; padding-top: 2px; padding-bottom: 5px;'>$pro_price zł</p>
                                        <a href=''><button style='float: center; width: 175px; height: 25px;' disabled>Braki w magazynie</button></a>
                                    </div>
                                    ";
                                }
                            }
                        }
                    }
                ?>
                </div>
            </div>
            <!--Koniec obszaru paska-->
        </div>
        <!--Koniec sekcji zawartości oraz paska bocznego-->

        <!--Sekcja stopki-->
        <div id="footer">

        <h2 style="padding-top: 40px; font-size: 12px; text-align: center; color: white">&copy; 2022 Copyright  by Szopracz.pl</h2>

        </div>
        <!--Koniec sekcji stopki-->
    </div>
    <!--Koniec głównego div'a-->
</body>
</html>
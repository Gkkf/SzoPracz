<!DOCTYPE html>
<!--Podłączenie pliku z funkcjami PHP-->
<?php
    //rozpoczęcie sesji
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
                <?php Cart(); ?>
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
                    <form action="" method="post" enctype="multipart/form-data">
                        <table align="center" width="700px" bgcolor="#C5C5C5" style="padding-top: 5px;">
                            <tr align="center" style="font-family: Arial, Helvetica, sans-serif; font-weight: bold;">
                                <th>Usuń</th>
                                <th>Produkt/y</th>
                                <th>Ilość</th>
                                <th>Cena</th>
                            </tr>
                            <?php
                                //zmienna wyświetlająca ilość
                                $db_qty = array();

                                //zmienna do wypisywania ilości
                                $qty_i = 0;
                                
                                //zmienna lokalna do wyświetlania na głównej stronie
                                $total = 0;
                            
                                //zmienna globalna do połączenia z bazą danych
                                global $con;
                            
                                //zmienna lokalna w której przypisywane jest IP klienta
                                $ip = GetIP();

                                //zmienna z zapytaniem do pobierania przedmiotów od poszczególnego klienta
                                $sel_price = "SELECT * FROM koszyk WHERE ip_add='$ip'";
                            
                                //zmienna wykonująca zapytanie
                                $run_price = mysqli_query($con, $sel_price);
                            
                                $run_title = "SELECT produkt_id, produkt_nazwa, produkt_ilosc FROM produkty JOIN koszyk ON produkt_id = p_id WHERE ip_add = '$ip'";

                                $title = mysqli_query($con, $run_title);

                                $_SESSION['produkty'] = array();
                                $_SESSION['prod_id'] = array();

                                $prod_qty = array();

                                while($titli=mysqli_fetch_array($title))
                                {
                                    $tot = $titli['produkt_nazwa'];
                                    array_push($_SESSION['produkty'], $tot);
                                    
                                    $tat = $titli['produkt_id'];
                                    array_push($_SESSION['prod_id'], $tat);

                                    $pro_qty = $titli['produkt_ilosc'];
                                    array_push($prod_qty, $pro_qty);
                                }

                                //pętla do pobierania cen do tabeli poprzez połączenie tabel
                                while($pro_price=mysqli_fetch_array($run_price))
                                {
                                    $pro_id = $pro_price['p_id'];
                                    
                                    $get_qty = "SELECT qty FROM koszyk WHERE p_id = '$pro_id'";
                                
                                    $run_get_qty = mysqli_query($con, $get_qty);
    
                                    while($qty_q=mysqli_fetch_array($run_get_qty))
                                    {
                                        array_push($db_qty, $qty_q['qty']);
                                    }

                                    //zmienna z zapytaniem od bazy
                                    $p_price = "SELECT * FROM produkty WHERE produkt_id='$pro_id'";
                                    
                                    //zmienna wykonująca zapytanie
                                    $run_pro_price = mysqli_query($con, $p_price);
                                    
                                    //pętla do pobierania danych cen z tabeli
                                    while($pp_price = mysqli_fetch_array($run_pro_price))
                                    {
                                        //dodawanie wszystkich cen produktów do jednej tabeli, oraz pobieranie nazwy ze zdjęciem
                                        $product_price = array($pp_price['produkt_cena']);                                        
                                        $product_title = $pp_price['produkt_nazwa'];
                                        $product_image = $pp_price['produkt_zdjecie'];

                                        //wyświetlanie osobnej ceny do produktu
                                        $single_price = $pp_price['produkt_cena'];

                                        //zliczanie całkowitej wartości w tabeli do lokalnej zmiennej
                                        $values = array_sum($product_price);
                            
                                        //przekazywanie do głównej zmiennej wartości cen dodanych produtków, aby następnie wyświetlić je na głównej stronie
                                        $total += $values;
                            ?>
                            <tr align="center">
                                <td><input type="checkbox" name="remove[]" value="<?php echo $pro_id; ?>"/></td>
                                <td style="padding-top: 5px; padding-bottom: 5px;"><img src="Admin/product_images/<?php echo $product_image; ?>" width="60px" height="60px"/> <br><?php echo $product_title; ?></td>
                                <td><input type="number" name="<?php echo $pro_id; ?>" size="3px" value="<?php if($db_qty[$qty_i]<=$prod_qty[$qty_i]){ echo $db_qty[$qty_i]; } else { echo $prod_qty[$qty_i]; $_POST[$pro_id] = $prod_qty[$qty_i]; } $qty_i++; ?>"/></td>
                                <?php
                                    if(isset($_POST['update_cart']))
                                    {
                                        //zmienna pobierająca ilość która została wpisana
                                        $qty = $_POST[$pro_id];

                                        //wywołanie zapytania
                                        $update_qty = "UPDATE koszyk SET qty = '$qty' WHERE p_id = '$pro_id'";

                                        //wysłanie zapytania do bazy danych
                                        $run_update_qty = mysqli_query($con, $update_qty);

                                        //zwiększenie całkowitej wyświetlanej ceny
                                        $total = $total + ($values * $qty);

                                        echo "<script>window.open('cart.php', '_self')</script>";
                                    }
                                ?>
                                <td><?php echo $single_price." zł"; ?></td>
                            </tr>
                            <?php } } ?>
                            <tr>
                                <td colspan="3" style="padding-top: 20px; font-weight: bold; text-align: right;">
                                    Całkowita Cena:
                                </td>
                                <td>
                                    <?php echo $total." zł"; ?>
                                </td>
                            </tr>
                            <tr align="center">
                                <td colspan="2" style="padding-top: 20px; padding-bottom: 15px;"><input type="submit" name="update_cart" value="Zaktualizuj koszyk"/></td>
                                <td><input type="submit" name="continue" value="Wróć do zakupów"/></td>
                            <?php if(count($_SESSION['produkty'])>0) { ?>
                            
                                <td><button><a href="cart.php?checkout" style="text-decoration: none; color: black;">Płatność</a></button></td>
                            </tr>
                            <?php } else { ?>
                                <td><button><a href="index.php" style="text-decoration: none; color: black;">Brak produktów w koszyku</a></button></td>
                            </tr>
                            <?php }?>
                        </table>
                    </form>

                    <?php
                    if(isset($_GET['checkout']))
                    {
                        $_SESSION['total'] = $total;

                        echo "<script>window.open('checkout.php', '_self')</script>";
                    }

                    function update_Cart()
                    {
                        global $con;
                        //zmienna do pobierania IP klienta
                        $ip = GetIP();                

                        //sprawdzanie jaka czynność została wykonana (kliknięcie zaktualizowania koszyka)
                        if(isset($_POST['update_cart']))
                        {
                            //pętla do sprawdzania ile produktów jest do usunięcia
                            foreach($_POST['remove'] as $remove_id)
                            {
                                //zmienna lokalna z zapytaniem do bazy danych
                                $delete_product = "DELETE FROM koszyk WHERE p_id='$remove_id' AND ip_add='$ip'";

                                //zmienna do wykonania zapytania w bazie danych
                                $run_delete = mysqli_query($con, $delete_product);

                                //odświeżenie strony po usunięciu produktu
                                if($run_delete)
                                {
                                    echo "<script>window.open('cart.php', '_self')</script>";
                                }
                            }
                        }

                        //sprawdzanie jaka czynność została wykonana (kliknięcie kontynuowania zakupów)
                        if(isset($_POST['continue']))
                        {
                            //powrót do strony głównej w celu kontynuowania zakupów
                            echo "<script>window.open('index.php', '_self')</script>";
                        }
                    }
                    //unikanie błędu jeżeli funkcja nie jest aktywna
                    echo @$up_cart = update_Cart();
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
<!DOCTYPE html>
<!--Podłączenie pliku z funkcjami PHP-->
<?php
if(!isset($_SESSION))
{
    session_start();
}
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
                                
                    <form method="post" enctype="multipart/form-data">
                        <table align="center" width="750px" bgcolor="#C5C5C5" style="font-family: Arial, Helvetica, sans-serif; font-weight: bold;">
                            <tr>
                                <td colspan="4" align="center"><h2 style="padding-bottom: 15px; padding-top: 15px;">Formularz Płatności</h2></td>
                            </tr>
                            <tr>
                                <td align="center"><h2 style="padding-bottom: 15px; padding-top: 15px;">Dane do wysyłki:</h2></td>
                            </tr>
                            <tr>
                                <td align="right" style="padding-bottom: 10px;">Imie i nazwisko:</td>
                                <td><input type="text" name="c_name" value="<?php echo $name ?>" required/></td>
                            </tr>
                            <tr>
                                <td align="right" style="padding-bottom: 10px;">Adres:</td>
                                <td><input type="text" name="c_adres" value="<?php echo $adres ?>" required/></td>
                            </tr>
                            <tr>
                                <td align="right" style="padding-bottom: 10px;">Miasto:</td>
                                <td><input type="text" name="c_city" value="<?php echo $city ?>" required/></td>
                            </tr>
                            <tr>
                                <td align="right" style="padding-bottom: 10px;">Kod pocztowy:</td>
                                <td><input type="text" name="c_postcode" value="<?php echo $kodp ?>" required/></td>
                            </tr>
                            <tr>
                                <td align="right" style="padding-bottom: 10px;">Numer telefonu:</td>
                                <td><input type="tel" name="c_number" value="<?php echo $number ?>" required/></td>
                            </tr>
                            <tr>
                                <td align="right" style="padding-bottom: 10px;">Email:</td>
                                <td><input type="text" name="c_email" value="<?php echo $email ?>" required/></td>
                            </tr>
                        </table>
                        <table align="center" width="750px" bgcolor="#C5C5C5" style="font-family: Arial, Helvetica, sans-serif; font-weight: bold;">
                            <tr>
                                <td align="left"><h2 style="padding-bottom: 15px; padding-top: 15px; padding-left: 90px;">Forma dostawy:</h2></td>
                            </tr>
                            <td>
                                <select style="width: 175px;" name='dostawa' required>
                                    <option value='kurier'>Kurier (15zł)</option>
                                    <option value='paczkomat'>Najbliższy Paczkomat (5zł)</option>
                                    <option value='kurierp'>Kurier Pobranie (20zł)</option>
                                </select>
                            </td>  
                            <tr>
                                <td align="left"><h2 style="padding-bottom: 15px; padding-top: 15px; padding-left: 90px;">Forma płatności:</h2></td>
                            </tr>
                            <td>
                                <select style="width: 175px;" required>
                                    <option>Przelew</option>
                                    <option>BLIK</option>
                                    <option>Za pobraniem</option>
                                </select>
                            </td>  
                            <tr>
                                <td colspan="3" style="padding-top: 40px; padding-bottom: 10px;" align="center"><?php echo 'Kwota: ' . $_SESSION['total'] . ' zł + dostawa'?></td>
                            </tr>
                            <tr>
                                <td colspan="3" style="padding-top: 40px; padding-bottom: 10px;" align="center"><input type="submit" name="pay" value="Opłać zamówienie"/></td>
                            </tr>
                        </table>
                    </form>
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
<?php
    //zapytanie sprawdzające czy przycisk został kliknięty
    if(isset($_POST['pay']))
    {
        //pobieranie IP klienta do zmiennej lokalnej
        $ip = GetIP();
        $date = date('Y-m-d');
        $price = $_SESSION['total'];
        $produkti = $_SESSION['produkty'];
        $produkti_id = $_SESSION['prod_id'];
        
        //zapisywanie wszystkich danych do zmiennych
        $c_name = $_POST['c_name'];
        $c_email = $_POST['c_email'];
        $c_postcode = $_POST['c_postcode'];
        $c_city = $_POST['c_city'];
        $c_adres = $_POST['c_adres'];
        $c_number = $_POST['c_number'];
        $c_dostawa = $_POST['dostawa'];

        if($c_dostawa=='kurier')
        {
            $price = $price + 15;
        }
        else if($c_dostawa=='paczkomat')
        {
            $price = $price + 5;
        }
        else if($c_dostawa=='kurierp')
        {
            $price = $price + 20;
        }

        $c_liczba = 0;

        $run_check = "SELECT zamowienie_prod FROM zamowienia ORDER BY zamowienie_prod DESC LIMIT 1";

        $check = mysqli_query($con, $run_check);

        while($cheking=mysqli_fetch_array($check))
        {
            $c_liczba = $cheking['zamowienie_prod'];
        }

        $akt_il = 0;

        for($i=0; $i<count($produkti); $i++)
        {
            if($c_liczba==0)
            {
                //zapytanie do dodania zamówienia do bazy danych
                $update_c = "INSERT INTO zamowienia (`zamowienie_prod`, `ip`, `data`, `kwota`, `produkt`, `status`) VALUES ('1', '$ip', '$date', '$price', '$produkti[$i]' , 'W trakcie realizacji')";
                //zmienna wykonujące zapytanie w bazie danych
                $run_update = mysqli_query($con, $update_c);
                
                //zmienianie ilości produktu o ilość kupionych produktów
                $get_up_pro = "SELECT produkt_ilosc, koszyk.qty FROM produkty JOIN koszyk ON p_id = produkt_id WHERE produkt_id = $produkti_id[$i]";
                $run_up = mysqli_query($con, $get_up_pro);

                //przypisywanie do tablicy zmiennych z zapytania i przesyłanie ich do lokalnej zmiennej
                while($up=mysqli_fetch_array($run_up))
                {
                    $il = $up['produkt_ilosc'];
                    $q = $up['qty'];

                    $akt_il = $il - $q;
                }

                //edytowanie danych w bazie
                $up_pro = "UPDATE produkty SET produkt_ilosc=$akt_il WHERE produkt_id=$produkti_id[$id]";
                $run_up_pro = mysqli_query($con, $up_pro);
            }
            else
            {
                //zapytanie do dodania zamówienia do bazy danych
                $update_c = "INSERT INTO zamowienia (`zamowienie_prod`, `ip`, `data`, `kwota`, `produkt`, `status`) VALUES ('". ($c_liczba + 1) ."', '$ip', '$date', '$price', '$produkti[$i]' , 'W trakcie realizacji')";
                //zmienna wykonujące zapytanie w bazie danych
                $run_update = mysqli_query($con, $update_c);

                //zmienianie ilości produktu o ilość kupionych produktów
                $get_up_pro = "SELECT produkt_ilosc, koszyk.qty FROM produkty JOIN koszyk ON p_id = produkt_id WHERE produkt_id = $produkti_id[$i]";
                $run_up = mysqli_query($con, $get_up_pro);

                //przypisywanie do tablicy zmiennych z zapytania i przesyłanie ich do lokalnej zmiennej
                while($up=mysqli_fetch_array($run_up))
                {
                    $il = $up['produkt_ilosc'];
                    $q = $up['qty'];

                    $akt_il = $il - $q; 
                }

                //edytowanie danych w bazie
                $up_pro = "UPDATE produkty SET produkt_ilosc=$akt_il WHERE produkt_id=$produkti_id[$i]";
                $run_up_pro = mysqli_query($con, $up_pro);
            }
        }

        if($run_update)
        {
            echo "<script>alert('Pomyślnie zakupiono.')</script>";
            
            $delete_c = 'DELETE FROM `koszyk` WHERE ip_add=\''.$ip.'\'';
            $run_delete = mysqli_query($con, $delete_c);

            echo "<script>window.open('index.php', '_self')</script>";
        }   
    }
?>
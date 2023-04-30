<?php

//Połączenie z bazą danych

$con = mysqli_connect("localhost", "root", "", "szopracz");
$con->set_charset('utf8');

//Koniec połączenia z bazą danych

//Funkcja do pobierania IP (potrzebne i używane do możliwości koszystania z koszyka przez wiele osób w różnym czasie online)

function GetIP()
{
    $ip = $_SERVER['REMOTE_ADDR'];

    if(!empty($_SERVER['HTTP_CLIENT_IP']))
    {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
    {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }

    return $ip;
}

//Koniec funkcji do pobierania IP

//Funkcja koszyka

function Cart()
{
    //zapytanie sprawdzające wykonanie czynności
    if(isset($_GET['add_cart']))
    {
        //zmienna globalna do połączenia z bazą danych
        global $con;

        //przypisanie lokalnej zmiennej wartości z funkcji $_GET
        $pro_id = $_GET['add_cart'];

        //przypisanie zmiennej IP z funkcji do pobierania jej
        $ip = GetIP();

        //zmienna sprawdzająca czy dany produkt został już uprzednio dodany do koszyka
        $check_pro = "SELECT * FROM koszyk WHERE ip_add='$ip' AND p_id = '$pro_id'";

        //zmienna wywołująca zapytanie w bazie danych
        $run_check = mysqli_query($con, $check_pro);

        //zapytanie sprawdzające czy dany produkt został już dodany - jeżeli nie, zostaje on wysłany do koszyka
        if(mysqli_num_rows($run_check)>0)
        {
            echo "";
        }
        else
        {
            //zmienna z zapytaniem wysyłanym do bazy o dodanie produktu
            $insert_pro = "INSERT INTO koszyk (p_id, ip_add) VALUES ('$pro_id', '$ip')";

            //zmienna wykonująca zapytanie
            $run_pro = mysqli_query($con, $insert_pro);

            //kod skryptu JS do przeładowania strony i powrotu użytkownika do strony index.php
            echo "<script>window.open('index.php', '_self')</script>";
        }
    }
}

//Koniec funkcji koszyka

//Funkcja wyświetlania ilości przedmiotów w koszyku

function Total_Items()
{
    //sprawdzanie czy czynność została wykonana
    if(isset($_GET['add_cart']))
    {
        //globalna zmienna do połączenia z bazą
        global $con;

        //zmienna lokalna w której przypisywane jest IP klienta
        $ip = GetIP();

        //zmienna z zapytaniem do pobierania przedmiotów od poszczególnego klienta
        $get_items = "SELECT * FROM koszyk WHERE ip_add='$ip'";

        //zmienna wykonująca zapytanie
        $run_items = mysqli_query($con, $get_items);

        //zmienna do zliczania przedmiotów
        $count_items = mysqli_num_rows($run_items);
    }
    //aby zaktualizować ponownie przedmioty klienta
    else
    {
        //globalna zmienna do połączenia z bazą
        global $con;

        //zmienna lokalna w której przypisywane jest IP klienta
        $ip = GetIP();

        //zmienna z zapytaniem do pobierania przedmiotów od poszczególnego klienta
        $get_items = "SELECT * FROM koszyk WHERE ip_add='$ip'";

        //zmienna wykonująca zapytanie
        $run_items = mysqli_query($con, $get_items);

        //zmienna do zliczania przedmiotów
        $count_items = mysqli_num_rows($run_items);
    }
    echo $count_items;
}

//Koniec funkcji do wyświetlania ilości przedmiotów w koszyku

//Funkcja wyświetlania całkowitego kosztu przedmiotów w koszyku

function Total_Price()
{
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

    //pętla do pobierania cen do tabeli poprzez połączenie tabel
    while($pro_price=mysqli_fetch_array($run_price))
    {
        $pro_id = $pro_price['p_id'];

        //zmienna z zapytaniem od bazy
        $p_price = "SELECT * FROM produkty WHERE produkt_id='$pro_id'";
        
        //zmienna wykonująca zapytanie
        $run_pro_price = mysqli_query($con, $p_price);

        //pętla do pobierania danych cen z tabeli
        while($pp_price = mysqli_fetch_array($run_pro_price))
        {
            //dodawanie wszystkich cen produktów do jednej tabeli
            $product_price = array($pp_price['produkt_cena']);

            //zliczanie całkowitej wartości w tabeli do lokalnej zmiennej
            $values = array_sum($product_price);

            //przekazywanie do głównej zmiennej wartości cen dodanych produtków, aby następnie wyświetlić je na głównej stronie
            $total += $values;
        }
    }
    echo $total." zł";
}

//Koniec funkcji do wyświetlania całkowitego kosztu przedmiotów w koszyku

//Funkcja do dynamicznego pobierania i wyświetlania rodzajów

function getTypes()
{
    //ustawienie połączenia w funkcji na globalny
    global $con;

    //tworzenie zapytania
    $get_types = "SELECT * FROM rodzaj";

    //wywołanie zapytania
    $run_types = mysqli_query($con, $get_types);

    //pętla do pobierania danych z bazy i wyświetlania ich dynamicznie
    while($row_types = mysqli_fetch_array($run_types))
    {
        $type_id = $row_types['rodzaj_id'];
        $type_title = $row_types['rodzaj_nazwa'];

        //echo "<option value='$type_id'>$type_title</option>";
        echo "<li><a href='index.php?type=$type_id'>$type_title</a></li>";
    }
}

//Koniec funkcji do dynamicznego pobierania i wyświetlania rodzajów

//Funkcja do dynamicznego pobierania i wyświetlania kategorii

function getCategories()
{
    //ustawienie połączenia w funkcji na globalny
    global $con;

    //tworzenie zapytania
    $get_cats = "SELECT * FROM kategoria";

    //wywołanie zapytania
    $run_cats = mysqli_query($con, $get_cats);

    //pętla do pobierania danych z bazy i wyświetlania ich dynamicznie
    while($row_cats = mysqli_fetch_array($run_cats))
    {
        $cat_id = $row_cats['kategoria_id'];
        $cat_title = $row_cats['kategoria_nazwa'];

        //echo "<input type='checkbox' value='$cat_id' checked style='float: left; margin-left: 10px; margin-top: 6px; width: 20px; height: 20px'><li>$cat_title</li></input>";
        echo "<li><a href='index.php?cat=$cat_id'>$cat_title</a></li>";
    }
}

//Koniec funkcji do dynamicznego pobierania i wyświetlania kategorii

//Funkcja do wyświetlania produktów z bazy danych na głównej stronie

function getPro()
{
    //Zapytanie sprawdzające czy wartości są możliwe do pobrania
    if(!isset($_GET['cat']))
    {
        if(!isset($_GET['type']))
        {

            global $con;

            //pobieranie losowych produktów od 0 do 6 na stronie głównej z bazy danych
            $get_pro = "SELECT * FROM produkty ORDER BY RAND() LIMIT 0, 9";

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
}

//Koniec funkcji do wyświetlania produktów z bazy danych

//Funkcja do wyświetlania produktów z wybranej kategorii

function getCatPro()
{
    //Zapytanie weryfikujące czy pobrana została wartość
    if(isset($_GET['cat']))
    {
        //Pobieranie i ustawianie ID kategorii do lokalnej zmiennej
        $cat_id = $_GET['cat'];

        global $con;

        //pobieranie z bazy produktów z wybraną kategorią
        $get_cat_pro = "SELECT * FROM produkty WHERE produkt_kategoria = '$cat_id'";

        $run_cat_pro = mysqli_query($con, $get_cat_pro);

        //pętla do pobierania danych z bazy i wyświetlanie na stronie
        while($row_cat_pro = mysqli_fetch_array($run_cat_pro))
        {
            $pro_id = $row_cat_pro['produkt_id'];
            $pro_type = $row_cat_pro['produkt_rodzaj'];
            $pro_cat = $row_cat_pro['produkt_kategoria'];
            $pro_title = $row_cat_pro['produkt_nazwa'];
            $pro_price = $row_cat_pro['produkt_cena'];
            $pro_image = $row_cat_pro['produkt_zdjecie'];

            $pro_qty = $row_cat_pro['produkt_ilosc'];

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

//Koniec funckji do wyświetlania produktów z wybranej kategorii

//Funkcja do wyświetlania produktów z wybranego rodzaju

function getTypePro()
{
    //Zapytanie weryfikujące czy pobrana została wartość
    if(isset($_GET['type']))
    {
        //Pobieranie i ustawianie ID rodzaju do lokalnej zmiennej
        $type_id = $_GET['type'];

        global $con;

        //pobieranie z bazy produktów z wybranym rodzajem
        $get_type_pro = "SELECT * FROM produkty WHERE produkt_rodzaj = '$type_id'";

        $run_type_pro = mysqli_query($con, $get_type_pro);

        //pętla do pobierania danych z bazy i wyświetlanie na stronie
        while($row_type_pro = mysqli_fetch_array($run_type_pro))
        {
            $pro_id = $row_type_pro['produkt_id'];
            $pro_type = $row_type_pro['produkt_rodzaj'];
            $pro_cat = $row_type_pro['produkt_kategoria'];
            $pro_title = $row_type_pro['produkt_nazwa'];
            $pro_price = $row_type_pro['produkt_cena'];
            $pro_image = $row_type_pro['produkt_zdjecie'];

            $pro_qty = $row_type_pro['produkt_ilosc'];

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

//Koniec funckji do wyświetlania produktów z wybranej kategorii


//Funkcja do filtrów

function getFilter()
{   
    //Zapytanie weryfikujące czy pobrana została wartość
    if(isset($_GET['order']))
    {
        global $con;

        if($_GET['order']=='cros')
        {
            //pobieranie z bazy produktów z wybranym filtrem
            $get_filter = "SELECT * FROM `produkty` ORDER BY `produkt_cena` ASC";

            $run_filter = mysqli_query($con, $get_filter);
        }
        
        if($_GET['order']=='cmal')
        {
            //pobieranie z bazy produktów z wybranym filtrem
            $get_filter = "SELECT * FROM `produkty` ORDER BY `produkt_cena` DESC";

            $run_filter = mysqli_query($con, $get_filter);
        }

        if($_GET['order']=='iros')
        {
            //pobieranie z bazy produktów z wybranym filtrem
            $get_filter = "SELECT * FROM `produkty` ORDER BY `produkt_ilosc` ASC";

            $run_filter = mysqli_query($con, $get_filter);
        }

        if($_GET['order']=='imal')
        {
            //pobieranie z bazy produktów z wybranym filtrem
            $get_filter = "SELECT * FROM `produkty` ORDER BY `produkt_ilosc` DESC";

            $run_filter = mysqli_query($con, $get_filter);
        }

        if($_GET['order']=='rros')
        {
            //pobieranie z bazy produktów z wybranym filtrem
            $get_filter = "SELECT * FROM `produkty` ORDER BY `produkt_rozmiar` ASC";

            $run_filter = mysqli_query($con, $get_filter);
        }

        if($_GET['order']=='rmal')
        {
            //pobieranie z bazy produktów z wybranym filtrem
            $get_filter = "SELECT * FROM `produkty` ORDER BY `produkt_rozmiar` ASC";

            $run_filter = mysqli_query($con, $get_filter);
        }

        //pętla do pobierania danych z bazy i wyświetlanie na stronie
        while($row_type_pro = mysqli_fetch_array($run_filter))
        {
            $pro_id = $row_type_pro['produkt_id'];
            $pro_type = $row_type_pro['produkt_rodzaj'];
            $pro_cat = $row_type_pro['produkt_kategoria'];
            $pro_title = $row_type_pro['produkt_nazwa'];
            $pro_price = $row_type_pro['produkt_cena'];
            $pro_image = $row_type_pro['produkt_zdjecie'];

            $pro_qty = $row_type_pro['produkt_ilosc'];

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

//Koniec funkcji do filtrów
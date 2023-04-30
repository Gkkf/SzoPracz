<!DOCTYPE html>
<!--Podłączenie pliku z funkcjami PHP-->
<?php
    session_start();
    include("Functions/functions.php");

if(!isset($_SESSION['uzytkownik_email']))
{
    echo "<script>window.open('../checkout.php', '_self')</script>";
}
else
{
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
                <li><a href="../index.php">Główna Strona</a></li>
                <li><a href="../all_products.php">Wszystkie Produkty</a></li>
                <li><a href="my_account.php">Konto</a></li>
                <li><a href="../customer_register.php">Zarejestruj się</a></li>
                <li><a href="../cart.php">Koszyk</a></li>
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
                <div id="sidebar_title">Moje Konto</div>

                <!--Lista rodzajów paska bocznego-->
                <ul id="categories">
                    <?php
                        $user = $_SESSION['uzytkownik_email'];

                        //zapytanie do bazy
                        $get_img = "SELECT * FROM uzytkownicy WHERE uzytkownik_email = '$user'";

                        //wysyłanie zapytania do bazy
                        $run_img = mysqli_query($con, $get_img);

                        //tablica z danymi z bazy
                        $row_img = mysqli_fetch_array($run_img);

                        //pobieranie zdjęcia danego użytkownika do zmiennej lokalnej
                        $c_img = $row_img['uzytkownik_zdjecie'];

                        //pobieranie nazwy użytkownika do zmiennej lokalnej
                        $c_name = $row_img['uzytkownik_nazwa'];

                        echo "<p style='text-align: center;'><img src='user_images/$c_img' width='150px' height='150px'/></p>";
                    ?>
                    <ul id="categories" style="text-align: center;  color: white; font-size: 19px; font-family: Arial, Helvetica, sans-serif;">
                        <li><a href="my_account.php?edit_account">Edytuj konto</a></li>
                        <li><a href="my_account.php?change_pass">Zmień hasło</a></li>
                        <li><a href="my_account.php?view_orders">Zobacz zamówienia</a></li>
                        <li><a href="my_account.php?delete_account">Usuń konto</a></li>
                    </ul>
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
                    <?php
                        if(!isset($_SESSION['uzytkownik_email']))
                        {
                            echo "<a href='checkout.php' style='text-decoration: none'>&nbsp&nbsp&nbsp Zaloguj</a>";
                        }
                        else
                        {
                            echo "<a href='logout.php' style='text-decoration: none'>&nbsp&nbsp&nbsp Wyloguj</a>";
                        }
                    ?>
                    </span>
                </div>
                <!--Koniec obszaru paska koszyka-->
                <div id="products_box">
                    <?php
                    if(!isset($_GET['my_orders']))
                    {
                        if(!isset($_GET['edit_account']))
                        {
                            if(!isset($_GET['change_pass']))
                            {
                                if(!isset($_GET['delete_account']))
                                {
                                    if(!isset($_GET['view_orders']))
                                    {
                                        echo '<h2 style="padding: 20px; font-family: Arial, Helvetica, sans-serif;">Witaj '; echo "$c_name </h2><br>";
                                        echo '<p style="font-weight: bold; font-family: Arial, Helvetica, sans-serif;">Niezbędne informacje i możliwość edycji znajdziesz na pasku po prawej stronie ekranu.</p>';
                                    }
                                }
                            }
                        }
                    }
                    ?>

                    <?php
                        if(isset($_GET['edit_account']))
                        {
                            include("edit_account.php");
                        }

                        if(isset($_GET['change_pass']))
                        {
                            include("change_pass.php");
                        }

                        if(isset($_GET['delete_account']))
                        {
                            include("delete_account.php");
                        }

                        if(isset($_GET['view_orders']))
                        {
                            include("view_orders.php");
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

<?php } ?>
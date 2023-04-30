<?php 

session_start();

if(!isset($_SESSION['user_email']))
{
    echo "<script>window.open('login.php', '_self')</script>";
}
else
{
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Szopracz - Admin Panel</title>
    <link rel="stylesheet" href="styles/style.css" media="all"/>
</head>
<body>
    <!--Główny DIV strony-->
    <div class="main">
        <!--Część nagłówka-->
        <div id="header"><h2 style="text-align: center; color: white; font-size: 19px; font-family: Arial, Helvetica, sans-serif; padding-top: 75px; font-size: 60px;">Admin Panel</h2></div>

        <div id="right">
            <h2 style="text-align: center; font-size: 19px; font-family: Arial, Helvetica, sans-serif; padding-top: 5px; font-weight: bold;">Zarządzaj zawartością:</h2>
            <ul id="categories" style="text-align: center;  color: white; font-size: 19px; font-family: Arial, Helvetica, sans-serif;">
                <li style="padding-top: 20px;"><a href="index.php?insert_product">Dodaj nowy produkt</a></li>
                <li><a href="index.php?view_products">Wyświetl produkty</a></li>
                <li><a href="index.php?insert_cat">Dodaj nowe kategorie</a></li>
                <li><a href="index.php?view_cats">Wyświetl kategorie</a></li>
                <li><a href="index.php?insert_type">Dodaj nowy rodzaj</a></li>
                <li><a href="index.php?view_types">Wyświetl rodzaje</a></li>
                <li><a href="index.php?view_customers">Wyświetl klientów</a></li>
                <li><a href="index.php?view_orders">Wyświetl zamówienia klientów</a></li>
                <li style="padding-top: 140px;"><a href="logout.php">Wyloguj</a></li>
            </ul>
        </div>

        <div id="left">
            <?php
                //sprawdza czy przycisk dodawania nowego produktu został wciśnięty
                if(isset($_GET['insert_product']))
                {
                    //wyświetlanie strony dodawania produktu
                    include('insert_product.php');
                }

                //sprawdza czy przycisk wyświetlania produktów został wciśnięty
                if(isset($_GET['view_products']))
                {
                    //wyświetlanie strony z wszystkimi produktami
                    include('view_products.php');
                }

                //sprawdza czy przycisk edytowania produktu został wciśnięty
                if(isset($_GET['edit_pro']))
                {
                    //wyświetlanie strony z edycją produktu
                    include('edit_pro.php');
                }

                //sprawdza czy przycisk dodania kategorii został wciśnięty
                if(isset($_GET['insert_cat']))
                {
                    //wyświetlanie strony z dodawaniem kategorii
                    include('insert_cat.php');
                }

                //sprawdza czy przycisk wyświetlenia kategorii został wciśnięty
                if(isset($_GET['view_cats']))
                {
                    //wyświetlanie strony z wszystkimi kategoriami
                    include('view_cats.php');
                }

                //sprawdza czy przycisk edycji kategorii został wciśnięty
                if(isset($_GET['edit_cat']))
                {
                    //wyświetlanie strony z edycją kategorii
                    include('edit_cat.php');
                }

                //sprawdza czy przycisk dodawania rodzaju został wciśnięty
                if(isset($_GET['insert_type']))
                {
                    //wyświetlanie strony z dodawaniem rodzaju
                    include('insert_type.php');
                }

                //sprawdza czy przycisk wyświetlania rodzajów został wciśnięty
                if(isset($_GET['view_types']))
                {
                    //wyświetlanie strony z wszystkimi rodzajami
                    include('view_types.php');
                }

                //sprawdza czy przycisk edycji rodzaju został wciśnięty
                if(isset($_GET['edit_type']))
                {
                    //wyświetlanie strony z edycją rodzaju
                    include('edit_type.php');
                }

                //sprawdza czy przycisk wyświetlenia użytkowników został wciśnięty
                if(isset($_GET['view_customers']))
                {
                    //wyświetlanie strony z wszystkimi użytkownikami
                    include('view_customers.php');
                }

                //sprawdza czy przycisk edycji użytkownika został wciśnięty
                if(isset($_GET['edit_user']))
                {
                    //wyświetlanie strony z edycją użytkownika
                    include('edit_user.php');
                }

                //sprawdza czy przycisk wyświetlenia zamówień został wciśnięty
                if(isset($_GET['view_orders']))
                {
                    //wyświetlanie strony z wszystkimi zamówieniami
                    include('view_orders.php');
                }

                //sprawdza czy przycisk edycji zamówienia został wciśnięty
                if(isset($_GET['edit_order']))
                {
                    //wyświetlanie strony z edycją zamówienia
                    include('edit_order.php');
                }
            ?>
        </div>
    </div>
</body>
</html>

<?php
}
?>
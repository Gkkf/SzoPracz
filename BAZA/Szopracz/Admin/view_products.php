<?php 
if(!isset($_SESSION['user_email']))
{
    echo "<script>window.open('login.php', '_self')</script>";
}
else
{
    ?>
<table width="795" border="2" bgcolor="#f2e8d5">

    <tr align="center">
        <td colspan="8"><h2 style="font-family: Arial, Helvetica, sans-serif; font-size: 30px; margin-top: 20px; margin-bottom: 20px;" >Wszystkie dodane produkty:</h2></td>
    </tr>

    <tr bgcolor="white">
        <td align="right" style="font-family: Arial, Helvetica, sans-serif; font-weight: bold; text-align: center;">ID:</td>
        <td align="right" style="font-family: Arial, Helvetica, sans-serif; font-weight: bold; text-align: center;">Zdjęcie:</td>
        <td align="right" style="font-family: Arial, Helvetica, sans-serif; font-weight: bold; text-align: center;">Nazwa:</td>
        <td align="right" style="font-family: Arial, Helvetica, sans-serif; font-weight: bold; text-align: center;">Cena:</td>
        <td align="right" style="font-family: Arial, Helvetica, sans-serif; font-weight: bold; text-align: center;">Ilość:</td>
        <td align="right" style="font-family: Arial, Helvetica, sans-serif; font-weight: bold; text-align: center;">Rozmiar:</td>
        <td align="right" style="font-family: Arial, Helvetica, sans-serif; font-weight: bold; text-align: center;">Edycja</td>
        <td align="right" style="font-family: Arial, Helvetica, sans-serif; font-weight: bold; text-align: center;">Usuwanie</td>
    </tr>
    <?php
        include("includes/db_connect.php");

        //tworzenie zapytania i wysyłanie go do bazy
        $get_pro = "SELECT * FROM produkty";
        $run_pro = mysqli_query($con, $get_pro);

        //pętla do tablicy z danymi i pobieranie danych z tablicy
        while($row_pro = mysqli_fetch_array($run_pro))
        {
            $pro_id = $row_pro['produkt_id'];
            $pro_img = $row_pro['produkt_zdjecie'];
            $pro_title = $row_pro['produkt_nazwa'];
            $pro_price = $row_pro['produkt_cena'];
            $pro_qty = $row_pro['produkt_ilosc'];
            $pro_size = $row_pro['produkt_rozmiar'];
        
    ?>
    <tr align="center">
        <td><?php echo $pro_id; ?></td>
        <td><img src="product_images/<?php echo $pro_img; ?>" width="45" height="45"/></td>
        <td><?php echo $pro_title; ?></td>
        <td><?php echo $pro_price; ?></td>
        <td><?php echo $pro_qty; ?></td>
        <td><?php echo $pro_size; ?></td>
        <td><a href="index.php?edit_pro=<?php echo $pro_id; ?>">Edytuj</a></td>
        <td><a href="delete_pro.php?delete_pro=<?php echo $pro_id; ?>" onclick="return confirm('Czy na pewno usunąć produkt?')">Usuń</a></td>
    </tr>
    <?php } ?>

</table>

<?php } ?>
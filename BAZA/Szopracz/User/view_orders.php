<?php
include("includes/db_connect.php");
$user = $_SESSION['uzytkownik_email'];
?>

<table width="750px" border="2" bgcolor="#f2e8d5">

<tr align="center">
    <td colspan="8"><h2 style="font-family: Arial, Helvetica, sans-serif; font-size: 30px; margin-top: 20px; margin-bottom: 20px;" >Wszystkie zamówienia:</h2></td>
</tr>

<tr bgcolor="white">
    <td align="right" style="font-family: Arial, Helvetica, sans-serif; font-weight: bold; text-align: center;">ID:</td>
    <td align="right" style="font-family: Arial, Helvetica, sans-serif; font-weight: bold; text-align: center;">Powiązane z:</td>
    <td align="right" style="font-family: Arial, Helvetica, sans-serif; font-weight: bold; text-align: center;">Data:</td>
    <td align="right" style="font-family: Arial, Helvetica, sans-serif; font-weight: bold; text-align: center;">Kwota:</td>
    <td align="right" style="font-family: Arial, Helvetica, sans-serif; font-weight: bold; text-align: center;">Produkt:</td>
    <td align="right" style="font-family: Arial, Helvetica, sans-serif; font-weight: bold; text-align: center;">Status:</td>
</tr>
<?php
    $ip = GetIP();
    //tworzenie zapytania i wysyłanie go do bazy
    $get_pro = "SELECT * FROM zamowienia WHERE ip='$ip'";
    $run_pro = mysqli_query($con, $get_pro);

    //pętla do tablicy z danymi i pobieranie danych z tablicy
    while($row_pro = mysqli_fetch_array($run_pro))
    {
        $or_id = $row_pro['zamowienie_id'];
        $or_pow = $row_pro['zamowienie_prod'];
        $or_date = $row_pro['data'];
        $or_price = $row_pro['kwota'];
        $or_pro = $row_pro['produkt'];
        $or_status = $row_pro['status'];
    
?>
<tr align="center">
    <td><?php echo $or_id; ?></td>
    <td><?php echo $or_pow; ?></td>
    <td><?php echo $or_date; ?></td>
    <td><?php echo $or_price; ?></td>
    <td><?php echo $or_pro; ?></td>
    <td><?php echo $or_status; ?></td>
</tr>
<?php } ?>
</table>
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
    <td colspan="8"><h2 style="font-family: Arial, Helvetica, sans-serif; font-size: 30px; margin-top: 20px; margin-bottom: 20px;" >Wszystkie konta użytkowników:</h2></td>
</tr>

<tr bgcolor="white">
    <td align="right" style="font-family: Arial, Helvetica, sans-serif; font-weight: bold; text-align: center;">ID:</td>
    <td align="right" style="font-family: Arial, Helvetica, sans-serif; font-weight: bold; text-align: center;">Nazwa:</td>
    <td align="right" style="font-family: Arial, Helvetica, sans-serif; font-weight: bold; text-align: center;">Email:</td>
    <td align="right" style="font-family: Arial, Helvetica, sans-serif; font-weight: bold; text-align: center;">Numer:</td>
    <td align="right" style="font-family: Arial, Helvetica, sans-serif; font-weight: bold; text-align: center;">Edycja</td>
    <td align="right" style="font-family: Arial, Helvetica, sans-serif; font-weight: bold; text-align: center;">Usuwanie</td>
</tr>
<?php
    include("includes/db_connect.php");

    //tworzenie zapytania i wysyłanie go do bazy
    $get_pro = "SELECT * FROM uzytkownicy";
    $run_pro = mysqli_query($con, $get_pro);

    //pętla do tablicy z danymi i pobieranie danych z tablicy
    while($row_pro = mysqli_fetch_array($run_pro))
    {
        $user_id = $row_pro['uzytkownik_id'];
        $pro_name = $row_pro['uzytkownik_nazwa'];
        $pro_title = $row_pro['uzytkownik_email'];
        $pro_price = $row_pro['uzytkownik_numer'];
    
?>
<tr align="center">
    <td><?php echo $user_id; ?></td>
    <td><?php echo $pro_name; ?></td>
    <td><?php echo $pro_title; ?></td>
    <td><?php echo $pro_price; ?></td>
    <td><a href="index.php?edit_user=<?php echo $user_id; ?>">Edytuj</a></td>
    <td><a href="delete_user.php?delete_user=<?php echo $user_id; ?>" onclick="return confirm('Czy na pewno usunąć użytkownika?')">Usuń</a></td>
</tr>
<?php } ?>

</table>
<?php } ?>
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
    <td colspan="8"><h2 style="font-family: Arial, Helvetica, sans-serif; font-size: 30px; margin-top: 20px; margin-bottom: 20px;" >Wszystkie dodane rodzaje:</h2></td>
</tr>

<tr bgcolor="white">
    <td align="right" style="font-family: Arial, Helvetica, sans-serif; font-weight: bold; text-align: center;">ID:</td>
    <td align="right" style="font-family: Arial, Helvetica, sans-serif; font-weight: bold; text-align: center;">Nazwa:</td>
    <td align="right" style="font-family: Arial, Helvetica, sans-serif; font-weight: bold; text-align: center;">Edycja</td>
    <td align="right" style="font-family: Arial, Helvetica, sans-serif; font-weight: bold; text-align: center;">Usuwanie</td>
</tr>
<?php
    include("includes/db_connect.php");

    //tworzenie zapytania i wysyłanie go do bazy
    $get_type = "SELECT * FROM rodzaj";
    $run_type = mysqli_query($con, $get_type);

    //pętla do tablicy z danymi i pobieranie danych z tablicy
    while($row_type = mysqli_fetch_array($run_type))
    {
        $type_id = $row_type['rodzaj_id'];
        $type_name = $row_type['rodzaj_nazwa'];
    
?>
<tr align="center">
    <td><?php echo $type_id; ?></td>
    <td><?php echo $type_name; ?></td>
    <td><a href="index.php?edit_type=<?php echo $type_id; ?>">Edytuj</a></td>
    <td><a href="delete_type.php?delete_type=<?php echo $type_id; ?>" onclick="return confirm('Czy na pewno usunąć?')">Usuń</a></td>
</tr>
<?php } ?>

</table>

<?php } ?>
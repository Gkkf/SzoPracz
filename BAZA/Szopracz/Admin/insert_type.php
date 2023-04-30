<?php
?>
<form action="" method="post" style="padding: 80px;">
    <b>Dodaj nowy rodzaj: </b>
    <input type="text" name="new_type" required/>
    <input type="submit" name="add_type" value="Dodaj rodzaj"/>
</form>

<?php
include("includes/db_connect.php");

if(isset($_POST['add_type']))
{

    //przypisywanie nowej zmiennej wartości z formularza
    $new_type = $_POST['new_type'];

    //zapytanie wysyłane do bazy
    $insert_type = "INSERT INTO rodzaj (rodzaj_nazwa) VALUES ('$new_type')";

    $run_type = mysqli_query($con, $insert_type);

    //przenoszenie do strony z kategoriami
    if($run_type)
    {
        echo "<script>alert('Rodzaj został dodany.')</script>";
        echo "<script>window.open('index.php?view_types', '_self')</script>";
    }
}
?>
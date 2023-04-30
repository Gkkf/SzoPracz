
<form action="" method="post" style="padding: 80px;">
    <b>Dodaj nową kategorię: </b>
    <input type="text" name="new_cat" required/>
    <input type="submit" name="add_cat" value="Dodaj kategorię"/>
</form>

<?php
include("includes/db_connect.php");

if(isset($_POST['add_cat']))
{

    //przypisywanie nowej zmiennej wartości z formularza
    $new_cat = $_POST['new_cat'];

    //zapytanie wysyłane do bazy
    $insert_cat = "INSERT INTO kategoria (kategoria_nazwa) VALUES ('$new_cat')";

    $run_cat = mysqli_query($con, $insert_cat);

    //przenoszenie do strony z kategoriami
    if($run_cat)
    {
        echo "<script>alert('Kategoria została dodana.')</script>";
        echo "<script>window.open('index.php?view_cats', '_self')</script>";
    }
}
?>
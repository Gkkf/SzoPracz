<?php
include("includes/db_connect.php");

    //sprawdzenie czy usuwanie jest aktywowane
    if(isset($_GET['delete_user']))
    {
        //pobieranie id do usunięcia
        $delete_id = $_GET['delete_user'];

        $delete_pro = "DELETE FROM uzytkownicy WHERE uzytkownik_id='$delete_id'";

        $run_delete = mysqli_query($con, $delete_pro);

        if($run_delete)
        {
            echo "<script>window.open('index.php?view_customers', '_self')</script>";
        }
        
    }
?>
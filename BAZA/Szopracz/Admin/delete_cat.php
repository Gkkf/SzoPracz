<?php
include("includes/db_connect.php");

    //sprawdzenie czy usuwanie jest aktywowane
    if(isset($_GET['delete_cat']))
    {
        //pobieranie id do usunięcia
        $delete_id = $_GET['delete_cat'];

        $delete_cat = "DELETE FROM kategoria WHERE kategoria_id='$delete_id'";

        $run_delete = mysqli_query($con, $delete_cat);

        if($run_delete)
        {
            echo "<script>window.open('index.php?view_cats', '_self')</script>";
        }
        
    }
?>
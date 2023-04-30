<?php
include("includes/db_connect.php");

    //sprawdzenie czy usuwanie jest aktywowane
    if(isset($_GET['delete_type']))
    {
        //pobieranie id do usunięcia
        $delete_id = $_GET['delete_type'];

        $delete_type = "DELETE FROM rodzaj WHERE rodzaj_id='$delete_id'";

        $run_delete = mysqli_query($con, $delete_type);

        if($run_delete)
        {
            echo "<script>window.open('index.php?view_types', '_self')</script>";
        }
        
    }
?>
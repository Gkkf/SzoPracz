<?php
include("includes/db_connect.php");

    //sprawdzenie czy usuwanie jest aktywowane
    if(isset($_GET['delete_pro']))
    {
        //pobieranie id do usunięcia
        $delete_id = $_GET['delete_pro'];

        $delete_pro = "DELETE FROM produkty WHERE produkt_id='$delete_id'";

        $run_delete = mysqli_query($con, $delete_pro);

        if($run_delete)
        {
            echo "<script>window.open('index.php?view_products', '_self')</script>";
        }
        
    }
?>
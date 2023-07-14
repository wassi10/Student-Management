<?php
    if(isset($_GET["id"])){
        $id = $_GET["id"];

        include 'db.php';

         $sql = "DELETE FROM `register_form` WHERE id=$id";
         $conn->query($sql);

    }

    // TO ALLOW USER TO REDIRECT TO INDEX.PHP FILE
    header("location: admin_dashboard.php");
    exit;

?>
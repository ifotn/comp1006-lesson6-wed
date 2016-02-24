<?php ob_start();

// identity the record the user wants to delete
$beer_id = null;
$beer_id = $_GET['beer_id'];

if (is_numeric($beer_id)) {
    // connect
    $conn = new PDO('mysql:host=127.0.0.1;dbname=gcrfreeman', 'root', '');

    // prepare and execute the SQL DELETE command
    $sql = "DELETE FROM beers WHERE beer_id = :beer_id";

    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':beer_id', $beer_id, PDO::PARAM_INT);
    $cmd->execute();

    // disconnect
    $conn = null;

    // redirect back to the updated beers.php
    header('location:beers.php');
}

ob_flush(); ?>
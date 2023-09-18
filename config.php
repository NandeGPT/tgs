<?php

    $databaseHost = 'localhost';
    $databaseName = 'crud_php';
    $databaseUsername = 'root';
    $databasePassword = '';
    
    $mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName); 

    if (!$mysqli) {
        die("Koneksi gagal: " . mysqli_connect_error());
    } else {
        echo "Koneksi ke Database berhasil!";
    }

?>
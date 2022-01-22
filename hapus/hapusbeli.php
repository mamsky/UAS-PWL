<?php
session_start();
    include '../config/conf.php';
    $id_produk=$_GET["id"];
    unset($_SESSION["beli"][$id_produk]);

    echo "<script>alert('Produk Berhasil Dihapus')</script>";
    echo "<script>location='../pembayaran/bayar.php'</script>";

?>
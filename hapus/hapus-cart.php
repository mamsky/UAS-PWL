<?php
session_start();
    include '../config/conf.php';
    $id_produk=$_GET["id"];
    unset($_SESSION["keranjang"][$id_produk]);

    echo "<script>alert('Produk Berhasil Dihapus')</script>";
    echo "<script>location='../keranjang/keranjang.php'</script>";

?>
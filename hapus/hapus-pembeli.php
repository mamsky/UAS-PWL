<?php
    include '../config/conf.php';
    if(isset($_GET['id'])){
        $produk =mysqli_query($conn, "SELECT image FROM pembayaran WHERE id = '".$_GET['id']."' ");
        $p = mysqli_fetch_object($produk);

        unlink('../image/'.$p->image_product);

        $delete = mysqli_query($conn, "DELETE FROM pembayaran WHERE id = '".$_GET['id']."' ");
        echo '<script>window.location="../admin/pembeli.php"</script>';
    }

?>
<?php
    include '../config/conf.php';
    if(isset($_GET['id'])){
        $produk =mysqli_query($conn, "SELECT image_product FROM tb_product WHERE id_product = '".$_GET['id']."' ");
        $p = mysqli_fetch_object($produk);

        unlink('../image/'.$p->image_product);

        $delete = mysqli_query($conn, "DELETE FROM tb_product WHERE id_product = '".$_GET['id']."' ");
        echo '<script>window.location="../produk/produk.php"</script>';
    }

?>
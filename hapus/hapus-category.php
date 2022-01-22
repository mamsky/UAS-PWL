<?php
    include '../config/conf.php';
    if(isset($_GET['id'])){
        $delete = mysqli_query($conn, "DELETE FROM tb_category WHERE id_category = '".$_GET['id']."' ");
        echo '<script>window.location="../category/data-category.php"</script>';
    }
?>
<?php
    session_start();
    include '../config/conf.php';
    if($_SESSION['status_login_user'] != true){
        echo '<script>window.location="../admin/login.php"</script>';
    }
    $kontak = mysqli_query($conn, "SELECT telp_admin, email_admin, address_admin FROM tb_admin WHERE id_admin = 1");
    $a = mysqli_fetch_object($kontak);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="../image/ico.jpg">
        <title>
            HANTU THRIFT
        </title>
        <link rel="stylesheet" type="text/css" href="../style/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
        <script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
    </head>
    <body>
       <!--header-->
       <header>
           <div class="container">
                <h1><a href="../index.php">HANTU THRIFT</a></h1>
                <ul>
                    <li><a href="../produk.php">Produk</a></li>
                    <li><a href="keranjang.php">Cart</a></li>
                    <?php 
                    if(isset($_SESSION['status_login_user'])){
                        ?>
                        <li><a href="../logout/logout-user.php">Logout</a></li>
                        
                   <?php }else{
                        ?>
                        <li><a href="../user/login.php">Login</a></li>
                        
                    <?php } ?>
                </ul>
           </div>
       </header>
       <!-- Content -->
       <div class="section">
           <div class="container">
               <h3>Verifikasi Pembayaran</h3>
               <div class="box">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="text" name="nama" class="input-control" placeholder="Nama" required>
                        <input type="text" name="harga" class="input-control" placeholder="Harga" required>
                        <input type="file" name="gambar" class="input-control" required>
                        <input type="text" name="nohp" class="input-control" value="<?php echo $_SESSION['u_global']->no_telp ?>">
                        <input type="submit" name="submit" value="Submit" class="btn">
                    </form>  
                    <?php
                        if(isset($_POST['submit'])){
                            $nama       = $_POST['nama'];
                            $harga      = $_POST['harga'];
                            $notelp      = $_POST['nohp'];

                            $filename = $_FILES['gambar']['name'];
                            $tmp_name = $_FILES['gambar']['tmp_name'];

                            $type1 = explode('.', $filename);
                            $type2 = $type1[1];

                            $newname = 'bayar'.time().'.'.$type2;
 
                            $tipe_diizinikan = array('jpg', 'jpeg', 'png', 'gif');

                            // validasi format file
                            if(!in_array($type2, $tipe_diizinikan)){
                                //jika format file tidak ada didalam tipe diizinkan
                                echo '<script>alert("Format File Tidak Diizinkan")</script>';
                            }else{
                                //jika format file sesuai dengan yang ada di dalam array tipe diizinkan
                                // prses upload file sekaligus insert ke database
                                move_uploaded_file($tmp_name, '../image/'.$newname);

                                $insert =mysqli_query($conn, "INSERT INTO pembayaran Values (
                                                    null,
                                                    '".$nama."',
                                                    '".$harga."',
                                                    '".$newname."',
                                                    '".$notelp."'
                                                        )");

                                if($insert){
                                    echo '<script>alert("verifikasi akan di proses")</script>';
                                    echo '<script>window.location="../index.php"</script>';
                                }else{
                                    echo 'gagal '.mysqli_error($conn);
                                }
                            }  
                        }
                    ?>
               </div>
           </div>
       </div>
    </body>
</html>
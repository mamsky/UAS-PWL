<?php
    session_start();
    include '../config/conf.php';
    if($_SESSION['status_login'] != true){
        echo '<script>window.location="../admin/login.php"</script>';
    }

    $produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE id_product ='".$_GET['id']."' ");
    if(mysqli_num_rows($produk) == 0){
        echo '<script>window.location="data-produk"</script>';
    }
    $p = mysqli_fetch_object($produk);
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
                <h1><a href="dashboard">HANTU THRIFT</a></h1>
                <ul>
                    <li><a href="../admin/dashboard.php">Dashboard</a></li>
                    <li><a href="../admin/pembeli.php">pembeli</a></li>
                    <li><a href="../admin/edit-profile.php">Profile</a></li>
                    <li><a href="../category/data-category.php">Data Kategori</a></li>
                    <li><a href="produk.php">Data Produk</a></li>
                    <li><a href="../logout/logout-admin.php">Keluar</a></li>
                </ul>
           </div>
       </header>
       <!-- Content -->
       <div class="section">
           <div class="container">
               <h3>Edit Data Product</h3>
               <div class="box">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <select class="input-control" name="kategori" required>
                            <option value="">--Pilih--</option>
                            <?php
                                $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY id_category DESC");
                                while($r = mysqli_fetch_array($kategori)){
                            ?>
                            <option value="<?php echo $r['id_category'] ?>" <?php echo($r['id_category'] == $p->id_category)? 'selected':''; ?>><?php echo $r['name_category'] ?></option>
                            <?php } ?>
                        </select>

                        <input type="text" name="nama" class="input-control" placeholder="Nama Produk" value="<?php echo $p->name_product ?>" required>
                        <input type="text" name="harga" class="input-control" placeholder="Harga" value="<?php echo $p->price_product ?>" required>
                        
                        <img src="../image/<?php echo $p->image_product ?>" width="100px">
                        <input type="hidden" name="foto" value="<?php echo $p->image_product ?>">
                        <input type="file" name="gambar" class="input-control">
                        <textarea class="input-control" name="deskripsi" placeholder="Deskripsi"><?php echo $p->description_product ?></textarea><br>
                        <select class="input-control" name="status"> 
                            <option value="">--Pilih--</option>
                            <option value="1" <?php echo ($p->status_product == 1)? 'selected':''; ?>>Aktif</option>
                            <option value="0" <?php echo ($p->status_product == 0)? 'selected':''; ?>>Tidak Aktif</option>
                        </select>
                        <input type="submit" name="submit" value="Submit" class="btn">
                    </form>  
                    <?php
                        if(isset($_POST['submit'])){
                            $kategori   = $_POST['kategori'];
                            $nama       = $_POST['nama'];
                            $harga      = $_POST['harga'];
                            $deskripsi  = $_POST['deskripsi'];
                            $status     = $_POST['status'];
                            $foto       = $_POST['foto'];

                            $filename = $_FILES['gambar']['name'];
                            $tmp_name = $_FILES['gambar']['tmp_name'];

                            if($filename != ''){
                                $type1 = explode('.', $filename);
                                $type2 = $type1[1];

                                $newname = 'produk'.time().'.'.$type2;

                                $tipe_diizinikan = array('jpg', 'jpeg', 'png', 'gif');

                                if(!in_array($type2, $tipe_diizinikan)){
                                    echo '<script>alert("Format File Tidak Diizinkan")</script>';
                                }else{
                                    unlink('../image/'.$foto);
                                    move_uploaded_file($tmp_name, '../image/'.$newname);
                                    $namagambar = $newname;
                                }
                            }else{
                                //jika admin tidak ganti gambar
                                $namagambar = $foto;

                            }

                            //query update data produk 
                            $update = mysqli_query($conn, "UPDATE tb_product SET
                                                id_category         = '".$kategori."',
                                                name_product        = '".$nama."',
                                                price_product       = '".$harga."', 
                                                description_product   = '".$deskripsi."',
                                                image_product       = '".$namagambar."',
                                                status_product      = '".$status."'
                                                WHERE id_product = '".$p->id_product."' ");
                            if($update){
                                echo '<script>alert("Ubah Data Berhasil")</script>';
                                echo '<script>window.location="produk.php"</script>';
                            }else{
                                echo 'gagal '.mysqli_error($conn);
                            }                                                          
                            
                        }
                    ?>
               </div>
           </div>
       </div>
 
       <!-- Footer -->
       <div class="footer">
            <div class="col-6">
                <h3>Hubungi Kami</h3>
                    <ul class="address">
                        <li><i class="fas fa-map-marker-alt"></i>Yogyakarta, Indonesia</li>
                        <li><i class="fas fa-envelope"></i><a href="mailto:info@email">info@email</a></li>
                        <li><i class="fas fa-phone"></i><a href="https://api.whatsapp.com/send?phone=<?php echo $a->telp_admin ?>&text=Hai, saya tertarik dengan produk Anda." target="_blank">+62 8157 5900 148</a></li>
                    </ul>
            </div>
            <div class="col-6">
                <h3>Tentang Kami</h3>
                    <ul class="address">
                        <li><i class="fas fa-arrow-right"></i><a href="about">About Us</a></li>
                    </ul>
            </div>
        </div>
        <script>
            CKEDITOR.replace( 'deskripsi' );
        </script>
    </body>
</html>
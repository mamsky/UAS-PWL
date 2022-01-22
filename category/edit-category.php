<?php
    session_start();
    include '../config/conf.php';
    if($_SESSION['status_login'] != true){
        echo '<script>window.location="../admin/login.php"</script>';
    }

    $kategori = mysqli_query($conn, "SELECT * FROM tb_category WHERE id_category = '".$_GET['id']."' ");
    if(mysqli_num_rows($kategori) == 0){
        echo '<script>window.location="data-kategori"</script>';
    }
    $k = mysqli_fetch_object($kategori);
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
        <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,400;1,300&display=swap" rel="stylesheet">
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
                    <li><a href="data-category.php">Data Kategori</a></li>
                    <li><a href="../produk/produk.php">Data Produk</a></li>
                    <li><a href="../logout/logout-admin.php">Keluar</a></li>
                </ul>
           </div>
       </header>

       <!-- Content -->
       <div class="section">
           <div class="container">
               <h3>Edit Data Kategori</h3>
               <div class="box">
                    <form action="" method="POST">
                        <input type="text" name="nama" placeholder="Nama Kategori" class="input-control" value="<?php echo $k->name_category ?>" required>
                        <input type="submit" name="submit" value="Submit" class="btn">
                    </form>  
                    <?php
                        if(isset($_POST['submit'])){

                            $nama = ucwords($_POST['nama']);

                            $update = mysqli_query($conn, "UPDATE tb_category SET
                                                    name_category = '".$nama."' 
                                                    WHERE id_category = '".$k->id_category."' ");

                            if($update){
                                echo '<script>alert("Edit Data Berhasil")</script>';
                                echo '<script>window.location="data-category.php"</script>';
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

    </body>
</html>

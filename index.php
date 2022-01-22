<?php 
    include '../uaspwl/config/conf.php';
    session_start();
    $kontak = mysqli_query($conn, "SELECT telp_admin, email_admin, address_admin FROM tb_admin WHERE id_admin = 1");
    $a = mysqli_fetch_object($kontak);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="/image/ico.jpg"/>
        <title>
            HANTU THRIFT
        </title>
        <link rel="stylesheet" type="text/css" href="./style/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,400;1,300&display=swap" rel="stylesheet">
    </head>
    <body>
       <!--header-->
       <header>
           <div class="container">
                <h1><a href="index.php">HANTU THRIFT</a></h1>
                <ul>
                    <li><a href="produk.php">Produk</a></li>
                    <li><a href="./keranjang/keranjang.php">Cart</a></li>
                    <?php 
                    if(isset($_SESSION['status_login_user'])){
                        ?>
                        <li><a href="../uaspwl/logout/logout-user.php">Logout</a></li>
                        
                   <?php }else{
                        ?>
                        <li><a href="user/login.php">Login</a></li>
                        
                    <?php } ?>
                </ul>
           </div>
       </header>

       <!-- SEARCH -->
       <div class="search">
            <div class="container">
                <form action="produk.php">
                    <input type="text" name="search" placeholder="Cari Produk">
                    <input type="submit" name="cari" value="Cari Produk">
                </form>
            </div>
       </div>

       <!-- Category -->
       <div class="section">
           <div class="container">
               <h3>Kategori</h3>
               <div class="box">
                   <?php
                        $kategori =mysqli_query($conn, "SELECT * FROM tb_category ORDER BY id_category DESC");
                        if(mysqli_num_rows($kategori) > 0){
                            while($k = mysqli_fetch_array($kategori)){
                   ?>
                        <a href="produk.php?kat=<?php echo $k['id_category'] ?>">
                            <div class="col-5">
                                <img src="./image/list.png" width="40px"style="margin-bottom:5px;">
                                <p><?php echo $k['name_category'] ?></p>
                            </div>
                        </a>
                   <?php }}else{ ?>
                        <p>Kategori Tidak Ada</p>
                    <?php } ?>
               </div>
           </div>
       </div>

       <!-- New Product -->
       <div class="section">
           <div class="container">
               <h3>Produk Terbaru</h3>
               <div class="box">
                   <?php 
                        $produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE status_product = 1 ORDER BY id_product DESC LIMIT 8");
                        if(mysqli_num_rows($produk) > 0){
                            while($p = mysqli_fetch_array($produk)){
                   ?>
                        <a href="detail-produk.php?id=<?php echo $p['id_product'] ?>">
                            <div class="col-4">
                                <img src="./image/<?php echo $p['image_product'] ?>" >
                                <p class="nama"><?php echo substr($p['name_product'], 0, 30) ?></p>
                                <p class="harga">Rp. <?php echo number_format($p['price_product']) ?></p>
                            </div>
                        </a>
                    <?php }}else{ ?>
                        <p>Produk Tidak Ada</p>
                    <?php } ?>
               </div>
           </div>
       </div>

       <!-- Footer -->
        <div class="footer">
            <div class="col-6">
                <h3>Hubungi Kami</h3>
                    <ul class="address">
                        <li><i class="fas fa-envelope"></i><a href="mailto:info@email">info@email</a></li>
                        <li><i class="fas fa-phone"></i><a href="https://api.whatsapp.com/send?phone=<?php echo $a->telp_admin ?>&text=Hai, saya tertarik dengan produk Anda." target="_blank">+62 8157 5900 148</a></li>
                        <li><i class="fab fa-instagram"></i><a href="https://www.instagram.com/shintanabl_" target="_blank">Instagram</a></li>
                    </ul>
            </div>
            <div class="col-6">
                <h3>Tentang Kami</h3>
                    <ul class="address">
                        <li><i class="fas fa-arrow-right"></i><a href="about" target="_blank">About Us</a></li>
                    </ul>
            </div>
        </div>

    </body>
</html>

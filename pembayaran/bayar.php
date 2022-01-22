<?php 
    error_reporting(0);
    include '../config/conf.php';
    session_start();
    if($_SESSION['status_login_user'] != true){
        echo '<script>window.location="../user/login.php"</script>';
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="../image/ico.jpg">
        <title>
            Keranjang | HANTU THRIFT
        </title>
        <link rel="stylesheet" type="text/css" href="../style/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,400;1,300&display=swap" rel="stylesheet">
    </head>
    <body>
       <!--header-->
       <header>
           <div class="container">
                <h1><a href="../index.php">HANTU THRIFT</a></h1>
                <ul>
                    <li><a href="../produk.php">Produk</a></li>
                    <li><a href="../keranjang/keranjang.php">Cart</a></li>
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
       <div class="section">
           <div class="container">
               <h3>Keranjang</h3>
               <div class="box">
                   <table border="1" cellspacing="0" class="table">
                       <thead>
                           <tr>
                               <th width="60px">No</th>
                               <th>Nama Produk</th>
                               <th>Harga</th>
                               <th>Gambar</th>
                               <th width="150px">Status</th>
                           </tr>
                       </thead>
                       <tbody>
                           <?php foreach($_SESSION["keranjang"] as $id_produk =>$jumblah):{
                               ?>
                               <?php 
                                $query= mysqli_query($conn, "SELECT * FROM tb_product WHERE id_product = $id_produk");
                                $p = mysqli_fetch_assoc($query);
                                $no = 1;
                                ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $p['name_product'] ?></td>      
                                    <td><?php echo $p['price_product'] ?></td>
                                    <td><img src="../image/<?php echo $p['image_product'] ?>" width="80px"></td>
                                    <td> X </td> 
                                </tr>
                              <?php }?>
                               <?php endforeach ?>
                       </tbody>
                   </table><br><br>
                   </div>
               </div>
           </div>
       </div>
       <div class="container">
           <div class="sec">
                <div class="box">
                       <div class="b1">
                            <img src="../image/bni.png" width="20%">
                            <h5>No Rek      : 16512318931</h5>
                            <h5>Atas Nama   : Paste Prosmana</h5> 
                       </div>
                       <br>
                       <div class="b1">
                            <img src="../image/bri.jpg" width="20%">
                            <h5>No Rek      : 165156464531</h5>
                            <h5>Atas Nama   : Shinta Nabilla</h5> 
                       </div><br>
                       <div class="b1">
                            <img src="../image/mandiri.jpg" width="15%">
                            <h5>No Rek      : 444961265451</h5>
                            <h5>Atas Nama   : Nibras Fawas</h5> 
                        </b1><br>
                </div>
            </div>
       </div>
       <a href="pembayaran.php" class="btn btn-primary">verifikasi Pembayaran</a><br><br><br><br>

    </body>
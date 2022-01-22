<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="../image/ico.jpg">
        <title>
            Login | HANTU THRIFT
        </title>
        <link rel="stylesheet" type="text/css" href="../style/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,400;1,300&display=swap" rel="stylesheet">
    </head>
    <body id="bg-login">
        <div class="box-login">
            <h2>Login</h2>
            <form action="" method="POST">
                <input type="text" name="user" placeholder="Username" class="input-control"> 
                <input type="password" name="pass" placeholder="Password" class="input-control">
                <input type="submit" name="submit" placeholder="Login" class="btn">
            </form>
            <?php
                if(isset($_POST['submit'])){
                    session_start();
                    include '../config/conf.php';

                    $user = mysqli_real_escape_string($conn, $_POST['user']);
                    $pass = mysqli_real_escape_string($conn, $_POST['pass']);

                    $cek = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '".$user."' AND password = '".MD5($pass)."'");
                    if(mysqli_num_rows($cek) > 0){
                        $d = mysqli_fetch_object($cek);
                        $_SESSION['status_login_user'] = true;
                        $_SESSION['u_global'] = $d;
                        $_SESSION['id'] = $d->id_user;

                        if (isset($_SESSION["keranjang"]) OR !empty($_SESSION["keranjang"])){
                            echo '<script>window.location="../keranjang/keranjang.php"</script>';
                        }else{
                            echo '<script>window.location="history.php"</script>';
                        }

                    }else{
                        echo '<script>alert("Username atau Password Anda Salah")</script>';
                    }
                }
            ?>
        </div>
    </body>
</html>
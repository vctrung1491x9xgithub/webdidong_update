<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Varela+Round&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../Style_admin/style_user_login.css">
    <title>Form Login</title>
</head>
<body>
    <?php
        session_start();
        include '../connect_db.php';
       
        if(isset($_POST['user_login_submit'])) {

            $taikhoan_user = $_POST['username'];
            $matkhau_user = $_POST['password'];

            $query = "SELECT * FROM tai_khoan as tk , khach_hang as kh WHERE tk.tk_nguoi_dung ='$taikhoan_user' 
                    and tk.mk_nguoi_dung = md5('$matkhau_user') and tk.ma_kh = kh.ma_kh";
            $result = mysqli_query($conn,$query) or die (mysqli_error($conn));

            if(mysqli_num_rows($result) != 0) {
                $user = mysqli_fetch_array($result);
                $_SESSION['current_user'] = $user;
                $current_user = $_SESSION['current_user'];
                header('Location: ../index2.php');
            } else {
                include '../modal_index/modal.php';
                echo   '<script>
                            document.getElementById("modal_title").innerHTML = "THÔNG BÁO LỖI!";
                            document.getElementById("doc").innerHTML = "Sai tên đăng nhập hoặc mật khẩu!";
                            var modal = document.getElementById("myModal");
                            var span = document.getElementsByClassName("close")[0];
                            modal.classList.add("mystyle");
                            span.onclick = function() {
                                modal.classList.remove("mystyle");
                            }
                            window.onclick = function(event) {
                                if (event.target == modal) {
                                    modal.classList.remove("mystyle");
                                }
                            }
                        </script>';
            }
        }
    ?>  
            <div class="wraper">
                <div class="title">
                    <h1>USER</h1><span style="font-weight: 100;font-size: 30px;"> login</span>
                    <p>Hệ thống quản lý website bán hàng</p>
                </div>
                <div class="content">
                    <!-- <div class="form-left">
                        <div class="avatar">
                            <img src="../images/audio_frame.gif" alt="">
                            <iframe autoplay src="https://www.youtube.com/embed/h415_i5qBWs?autoplay=1" frameborder="0" 
                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                            </iframe>
                            <img class="like" src="../images/like.gif" alt="">
                        </div>
                    </div> -->
                    <div class="form-right">
                        <form method="post" acction="../index2.php">
                            <div class="input-box">
                                <input type="text" name="username" required>
                                <label>Username</label>
                            </div>
                            <div class="input-box">
                                <input type="password" name="password" required>
                                <label>Password</label>
                            </div>
                            <input type="submit" name="user_login_submit" value="Đăng nhập">
                            <div class="pass">
                                <a class="register" href="user_register.php">Đăng ký ngay!</a>
                                <a class="pass-forget" href="#">Quên mật khẩu?</a>
                            </div>
                        </form>
                      
                        <div class="login_with">
                            <span style="color:#fff;font-weight:600;">Hoặc</span>
                            <div class="box-content">
                                <div class="box">
                                    <a class="box-fb" href="#"></a>
                                </div>
                                <div class="box">
                                    <a class="box-gg" href="#"></a>
                                </div>
                                <div class="box">
                                    <a class="box-zalo" href="#"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</body>
</html>
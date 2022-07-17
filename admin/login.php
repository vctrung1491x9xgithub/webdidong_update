<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Varela+Round&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../Style_admin/style_admin_login.css">
    <!-- <link rel="stylesheet" href="../Style_admin/style_notify_error.css"> -->
    <title>Form Login</title>
</head>

<body>
    <?php
    session_start();
    include '../connect_db.php';
    include '../modal_index/modal.php'; // import cái bảng thông báo lỗi vào
    if (isset($_GET['resetpassword'])) {
        if (isset($_POST['submit_reset'])) {
            $username = $_POST['username'];
            $old_pass = ($_POST['old_password']);
            $new_pass = ($_POST['new_password']);

            $admin = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username' and password = '$old_pass'");
            $row = mysqli_num_rows($admin);
            if ($row != 0) {
                $arr = mysqli_fetch_array($admin);
                if ($arr['password'] == $new_pass) {
                    echo    '<script>
                                // document.getElementById("doc").innerHTML = "Vui lòng nhập mật khẩu mới hoàn toàn!";
                                // var modal = document.getElementById("myModal");
                                // var span = document.getElementsByClassName("close")[0];
                                // modal.classList.add("mystyle");
                                // span.onclick = function() {
                                //     modal.classList.remove("mystyle");
                                // }
                                // window.onclick = function(event) {
                                //     if (event.target == modal) {
                                //         modal.classList.remove("mystyle");
                                //     }
                                // }
                                alert("Vui lòng nhập mật khẩu mới hoàn toàn!");
                            </script>';
                } else {
                    $update = mysqli_query($conn, "UPDATE admin SET password = '$new_pass'");
                    if ($update) {
                        echo   '<script>
                                    // document.getElementById("doc").innerHTML = "Cập nhật thành công!";
                                    // var modal = document.getElementById("myModal");
                                    // var span = document.getElementsByClassName("close")[0];
                                    // modal.classList.add("mystyle");
                                    // span.onclick = function() {
                                    //     modal.classList.remove("mystyle");
                                    // }
                                    // window.onclick = function(event) {
                                    //     if (event.target == modal) {
                                    //         modal.classList.remove("mystyle");
                                    //     }
                                    // }
                                alert("Cập nhật thành công!");

                                </script>';
                    }
                }
            } else {
                echo    '<script>
                            // document.getElementById("doc").innerHTML = "Tài khoản hoặc mật khẩu cũ không đúng!";
                            // var modal = document.getElementById("myModal");
                            // var span = document.getElementsByClassName("close")[0];
                            // modal.classList.add("mystyle");
                            // span.onclick = function() {
                            //     modal.classList.remove("mystyle");
                            // }
                            // window.onclick = function(event) {
                            //     if (event.target == modal) {
                            //         modal.classList.remove("mystyle");
                            //     }
                            // }
                            alert("Tài khoản hoặc mật khẩu cũ không đúng!");

                        </script>';
            }
        }
    ?>
        <div class="wraper" style="margin-top: 30px;">
            <div class="title">
                <h1>ADMIN</h1><span style="font-weight: 100;font-size: 30px;"> reset password</span>
                <p>Hệ thống quản lý website bán hàng</p>
            </div>
            <div class="form-top">
                <div class="left">
                    <h3>Thay đổi mật khẩu</h3>
                </div>
                <div class="right">
                    <img src="../images/admin_login.png" alt="">
                </div>
            </div>
            <div class="form-bottom">
                <form method="post" acction="login.php">
                    <div class="input-box">
                        <input type="text" name="username" required>
                        <label>Username</label>
                    </div>
                    <div class="input-box">
                        <input type="password" name="old_password" required>
                        <label>Old Password</label>
                    </div>
                    <div class="input-box">
                        <input type="password" name="new_password" required>
                        <label>New Password</label>
                    </div>
                    <input type="submit" name="submit_reset" value="Đổi mật khẩu">
                </form>
                <a href="login.php">Đăng nhập</a>
            </div>
        </div>
    <?php exit;
    } else if (isset($_POST['login_submit'])) {
        $taikhoanadmin = $_POST['username'];
        $makhauadmin = md5($_POST['password']);

        $query = "SELECT * FROM admin WHERE username = '$taikhoanadmin' and password = ('$makhauadmin')";
        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
        //==================================================================================
        $admin = mysqli_fetch_array($result);
        //==================================================================================
        $_SESSION['current_admin'] = $admin; // Khai báo SESSION chứa toàn bộ dữ liệu đã select
        //==================================================================================
        $num_rows = mysqli_num_rows($result);
        if ($num_rows != 0) {
            header('Location: admin_manager.php');
        } else {
            echo    '<script>
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
        <div class="title " style="background: red;border-radius:7px;padding:10px 0">
            <h1>ADMIN</h1><span style="font-weight: 100;font-size: 30px;"> login</span>
            <p>Hệ thống quản lý website bán hàng</p>
        </div>
        <div class="form-top" style="background: red;">
            <div class="left">
                <h3>Đăng nhập hệ thống</h3>
                <p>Người dùng cần đăng nhập để sử dụng các chức năng dành riêng cho người quản lý</p>
            </div>
            <div class="right">
                <img src="../images/admin_login.png" alt="">
            </div>
        </div>
        <div class="form-bottom" style="background: red;">
            <form method="post">
                <div class="input-box">
                    <input type="text" name="username" required>
                    <label>Username</label>
                </div>
                <div class="input-box">
                    <input type="password" name="password" required>
                    <label>Password</label>
                </div>
                <input type="submit" name="login_submit" value="Đăng nhập">
                <!-- <input type="submit" name="reset_pass_submit" value="Đăng nhập"> -->
                <!-- <input class="buttonX" type="submit" name="login_change_pass" value="Đổi mật khẩu"> -->
            </form>
            <a href="login.php?resetpassword">Đổi mật khẩu</a>
        </div>
    </div>
</body>

</html>
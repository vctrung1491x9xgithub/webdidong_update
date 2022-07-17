<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Varela+Round&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../Style_admin/style_user_register.css">
    <title>Form Register</title>
    <style>
        .mystyle {
            display: flex;
        }
    </style>
</head>

<body>
    <?php
    session_start();
    include '../connect_db.php';
    include '../modal_index/modal.php';
    $error = false;
    if (isset($_POST['register_submit'])) {

        $surname = $_POST['surname'];
        $name = $_POST['name'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $re_password = $_POST['re-password'];
        $mail = $_POST['mail'];
        $number_phone = $_POST['number-phone'];
        $address = $_POST['address'];
        echo $username;
        echo '<br>';
        echo $password;
        echo '<br>';
        echo $re_password;
        echo '<br>';
        $result = mysqli_query($conn, "SELECT * FROM tai_khoan") or die(mysqli_error($conn));

        //================ XÉT ĐIỀU KIỆN ĐĂNG KÝ================================
        while ($row = mysqli_fetch_array($result)) {
            if ($row['tk_nguoi_dung'] == $username) {
                $error = true;
            }
        }
        if ($error) {
            echo '<script>
                                            alert("TÀI KHOẢN ĐÃ TỒN TẠI")

                            </script>';
        } else
                        if ($re_password !== $password) {
            echo '<script>
            alert("Mật khẩu trùng")

                                </script>';
        } else
                            if (strlen((string)$number_phone) < 10  || strlen((string)$number_phone) > 11) {
            echo '<script>
            alert("SĐT sai")

                                </script>';
        } else {

            $maKH =  mysqli_query($conn, "SELECT ma_kh FROM khach_hang");
            $All_maKH = mysqli_fetch_array($maKH);

            $new_maKH = "KH" . substr(md5(Rand()), 0, 3);

            if ($All_maKH != $new_maKH) {
                $newUser = mysqli_query($conn, "INSERT INTO khach_hang (ma_kh,ho_lot,ten_kh,sdt_kh, email_kh, dia_chi_kh,diem_kh,ngay_cap_nhat )
                                                          VALUES ('$new_maKH','$surname','$name','$number_phone','$mail','$address',0, now());");

                if ($newUser) {
                    $newAccount = mysqli_query($conn, "INSERT INTO tai_khoan (ma_tk, tk_nguoi_dung, mk_nguoi_dung,ma_kh,ngay_tao)
                                    VALUES (NULL,'$username','" . md5($password) . "','$new_maKH',now());");
                    echo '<script>
                                alert("Tạo tài khoản thành công")
                                    </script>';
                } else {
                    echo '<script>
                    alert("Tạo tài khoản không thành công")
                                    </script>';
                }
            }
        }
    }
    ?>
    <div class="container">
        <div class="main">
            <div class="title">
                <h1>KHÁC HÀNG</h1><span style="font-weight: 100;font-size: 30px;"> đăng ký</span>
                <p>Hệ thống bán hàng web di động</p>
            </div>
            <div class="content">
                <div class="form-container">
                    <form method="post" acction="../index2.php">
                        <div>
                            <div class="input-box">
                                <label>Họ lót</label>
                                <input type="text" name="surname" placeholder="Nhập họ lót" required>
                            </div>
                            <div class="input-box">
                                <label>Nhập Tên</label>
                                <input type="text" name="name" placeholder="Nhập tên" required>
                            </div>
                            <div class="input-box">
                                <label>Số điện thoại liên hệ</label>
                                <input type="number" name="number-phone" placeholder="Nhập số điện thoại" required>
                            </div>
                            <div class="input-box box-address">
                                <label>Địa chỉ</label>
                                <input type="text" name="address" placeholder="Nhập địa chỉ giao hàng" required>
                            </div>
                        </div>
                        <div>
                            <div class="input-box">
                                <label>Tên tài khoản</label>
                                <input type="text" name="username" placeholder="Nhập tên tài khoản" required>
                            </div>

                            <div class="input-box">
                                <label>Mật khẩu</label>
                                <input type="password" name="password" placeholder="Nhập mật khẩu" required>
                            </div>
                            <div class="input-box">
                                <label>Xác nhận mật khẩu</label>
                                <input type="password" name="re-password" placeholder="Xác nhận lại mật khẩu" required>
                            </div>
                            <div class="input-box">
                                <label>Email</label>
                                <input type="email" name="mail" placeholder="Nhập email" required>
                            </div>
                        </div>
                        <input type="submit" name="register_submit" value="Đăng Ký">
                    </form>
                </div>

                <div class="pass">
                    <a class="register" href="user_login.php">Đăng nhập</a>
                    <a class="pass-forget" href="#">Quên mật khẩu?</a>
                </div>
                <span style="margin:20px auto 0">Hoặc đăng nhập với</span>
                <div class="login_with">
                    <div class="box ">
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


</body>

</html>
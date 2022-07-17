
<?php 
     include './web/header.php';
     
     if(isset($current_user)) {
        $makh = $current_user['ma_kh'];
        
?>
		<!-- ===================================================================================-->
		<!-- MAIN-CONTAINT -->
			<div id="containt">
				<div class="info_user_container" style="background:#fff;margin-top:20px;padding-bottom:20px;border-radius:7px;overflow:hidden">
                    <h1><a href="index2.php" style="color: #FFF;">Trang chủ</a> / <b>Thông tin cá nhân</b></h1>
                    <div class="info_user" style="display:flex;justify-content:space-around;flex-wrap:wrap;">
                        <div class="">
                            <form action="#" method="POST">
                                <table class="table1" >
                                    <caption style="caption-side:top;color:#111;margin-bottom:10px"><b>THÔNG TIN HỒ SƠ</b></caption>
                                    <tr>
                                        <td>Họ lót</td>
                                        <td>Tên</td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" name="holot" value="<?=$current_user['ho_lot'];?>" minlength="2"></td>
                                        <td><input type="text" name="ten" value="<?=$current_user['ten_kh'];?>" minlength="2"></td>
                                    </tr>
                                    <tr>
                                        <td>Số điện thoại</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><input type="text" name="sdt" value="<?=$current_user['sdt_kh'];?>" minlength="10" maxlength="11"></td>
                                        <p class="point">Điểm: <b><?=$current_user['diem_kh'];?></b> 💎</p>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><input type="email" name="email" value="<?=$current_user['email_kh'];?>"></td>
                                    </tr>
                                    <tr>
                                        <td>Địa chỉ</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><input type="text" name="diachi" value="<?=$current_user['dia_chi_kh'];?>"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="g-recaptcha" data-sitekey="6Ldgd6wZAAAAAABgKStAHu2VqteG2CFhwOTPpxUw"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" id="error3" class="error"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><input style="margin-top: 10px;" type="submit" value="Cập nhật" name="capnhat_thongtin"></td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                            <?php 
                            
                                if(isset($_POST['capnhat_thongtin'])) {
                                    $holot = $_POST['holot'];
                                    $ten = $_POST['ten'];
                                    $sdt = $_POST['sdt'];
                                    $email = $_POST['email'];
                                    $diachi = $_POST['diachi'];

                                    
                                    
                                    if(isset($_POST['g-recaptcha-response'])) {
                                        $captcha = $_POST['g-recaptcha-response'];
                                    }
                                    if(!$captcha){
                                        $error = "Vui lòng xác nhận Captcha!";
                                        echo '<script>document.getElementById("error3").innerHTML = "Vui lòng xác nhận CAPTCHA!" </script>';
                                    }else {
                                        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Ldgd6wZAAAAAA2WpUjyFg8X33tkLH3JReEetF5V=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
                                        if($response == false){
                                            echo '<h2>SPAM!</h2>';
                                            $error="SPAM!";
                                        }
                                    }
                                    if(!empty($holot) && !empty($ten) && !empty($sdt) && !empty($email) && !empty($diachi) && !isset($error)) {
                                        
                                        $capnhat_thongtin = mysqli_query($conn,"UPDATE khach_hang
                                        SET ho_lot = '$holot', ten_kh = '$ten', sdt_kh = '$sdt', 
                                        email_kh = '$email', dia_chi_kh = '$diachi', ngay_cap_nhat = now()
                                        WHERE ma_kh = '$makh';");

                                        if($capnhat_thongtin !=0) {

                                            $_SESSION['current_user']['ho_lot'] = $holot;
                                            $_SESSION['current_user']['ten_kh'] = $ten;
                                            $_SESSION['current_user']['sdt_kh'] =  $sdt;
                                            $_SESSION['current_user']['dia_chi_kh'] = $diachi;
                                            $_SESSION['current_user']['email_kh'] = $email;

                                            header('Location: my_info.php');
                                        } else {
                                            echo "<script>alert('Cập nhật hồ sơ thất bại');</script>";
                                        }
                                    
                                    }
                                }
                            ?>
                        <!-- THÔNG TIN TÀI KHOẢN -->
                        <div class="">
                            <?php 
                                $taikhoan = mysqli_query($conn,"SELECT * FROM tai_khoan WHERE ma_kh = '$makh'");
                                $taikhoan = mysqli_fetch_array($taikhoan);
                            ?>
                            <form action="#" method="POST">
                                <table>
                                    <caption style="caption-side:top;color:#111;margin-bottom:10px"><b>THÔNG TIN TÀI KHOẢN</b></caption>
                                    <tr>
                                        <td>Tài khoản</td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" value="<?= $taikhoan['tk_nguoi_dung'];?>"></td>
                                    </tr>
                                    <tr>
                                        <td>Mật khẩu cũ &emsp;<span id="error1" class="error" required> </span></td>
                                    </tr>
                                    <tr>
                                        <td><input type="password" name="matkhau_cu" required></td>
                                    </tr>
                                    <tr>
                                        <td>Mật khẩu mới</td>
                                    </tr>
                                    <tr>
                                        <td><input type="password" name="matkhau_moi" minlength="3" required></td>
                                    </tr>
                                    <tr>
                                        <td>Nhập lại mật khẩu &emsp;<span id="error" class="error" required> </span></td>
                                    </tr>
                                    <tr>
                                        <td><input type="password" name="matkhaunhaplai"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="g-recaptcha" data-sitekey="6Ldgd6wZAAAAAABgKStAHu2VqteG2CFhwOTPpxUw"></td>
                                    </tr>
                                    <tr>
                                        <td id="error2" class="error"></td>
                                    </tr>
                                    <tr>
                                        <td><input style="margin-top: 10px;" type="submit" value="Cập nhật" name="capnhat_mk"></td>
                                    </tr>
                                </table>
                            </form>
                            <?php
                            if(isset($_POST['capnhat_mk'])) {

                                $matkhau = $taikhoan['mk_nguoi_dung'];
                                $matkhau_cu =  md5($_POST['matkhau_cu']);
                                $matkhau_moi = $_POST['matkhau_moi'];
                                $matkhaunhaplai = $_POST['matkhaunhaplai'];
                                
                                if($matkhau != $matkhau_cu) {
                                    $error="Mật khẩu cũ không đúng!";
                                    echo '<script>document.getElementById("error1").innerHTML = "Mật khẩu cũ không đúng!";</script>';
                                } 
                                if($matkhau_moi != $matkhaunhaplai) {
                                    $error="Mật khẩu không trùng khớp!";
                                    echo '<script>document.getElementById("error").innerHTML = "Mật khẩu không trùng khớp!";</script>';
                                } 
                                if(isset($_POST['g-recaptcha-response'])) {
                                    $captcha = $_POST['g-recaptcha-response'];
                                }
                                if(!$captcha){
                                    echo '<script>document.getElementById("error2").innerHTML = "Vui lòng xác nhận Captcha!";</script>';
                                }else {
                                    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Ldgd6wZAAAAAA2WpUjyFg8X33tkLH3JReEetF5V=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
                                    if($response == false){
                                        echo '<h2>SPAM!</h2>';
                                        $error="SPAM!";
                                    }
                                }
                                if(!isset($error)) {
                                    $matkhaunhaplai = md5($matkhaunhaplai);
                                    $capnhat_TK = mysqli_query($conn,"UPDATE tai_khoan SET mk_nguoi_dung = '$matkhaunhaplai'
                                    WHERE ma_kh = '$makh';");
                               
                                    if($capnhat_TK !=0) {
                                        echo "<script>alert('Cập nhật tài khoản thành công');</script>";
                                    } else {
                                        echo "<script>alert('Cập nhật tài khoản thất bại');</script>";
                                    }
                                }
                            }
                        ?>
                        </div>
                    </div>
                </div>
				<!-- ALL-PHONE-CONTAINER-->
                <style>
                    .info_user > div {
                        width: 400px;
                        margin: 10px;
                        padding: 0 10px 10px;
                        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2),
                        inset 0px 1px 2px rgba(255, 255, 255, 1), 
                        inset 0 -1px 0 rgba(39, 39, 39, 0.15);
                    }
                    td { padding: 0 10px;}
                    table {
                        margin: 0 auto;
                    }
                    table input {
                        box-shadow: 0 0px 2px rgb(0,0,0,.6);
                        border: none;
                        width: 100%;
                        font-size: 13px;
                        padding: 7px 10px; margin: 2px 0 10px 0;
                    }
                    table input:focus {
                        box-shadow: 0 0px 3px rgb(255, 83, 71), 
                        inset 1px 1px 1px rgba(255, 255, 255, 0.5);
                    }
                    table input[type="submit"] { background: #6D78CF;color: #FFF;font-weight: 600;}
                    h1 { 
                        padding: 7px 10px;
                        color: #fff;
                        display: block;
                        background: #6D78CF;
                    }
                    .error {
                        font-size: 12px;
                        color: red;
                    }
                    table { margin-top: 20px;}
                    .info_user_container { position: relative;}
                    .info_user {margin-top: 40px;}
                    .point { 
                        position: absolute;
                        top: 35px;right: 1px;
                        border: 1.5px solid #6D78CF;
                        padding: 5px 10px;}
                    @media screen and (max-width: 550px) {
                        .table1 {
                            max-width: 325px;
                        }
                        .g-recaptcha {
                            transform:scale(0.80);
                            transform-origin:0 0;
                        }
                        @media screen and (max-width: 370px) { 
                            table td { max-width: 270px;}
                        }
                    }
                </style>          
            </div>

            <a href="#" class="back-to-top" id="back-to-top"></a>
            <!-- <div class="night-mod-button" >
                <img class="logo-bt-nm" src="./images/lododarkmode-open-sun5.png" title="Change theme">
            </div> -->
			
		<!--END-MAIN-CONTAINT-->
        <!--FOOTER-->
        <?php include './web/footer.php'; ?>
		<!--FOOTER-->
	</div>
		<!--CONTAINER-->
    <link id="dark-mode" rel="stylesheet" type="text/css" href="">
	<script src="./js/slide.js"></script>
	<script type="text/javascript" src="./js/index.js"></script>
</body>
</html>
<?php  } else header('Location: index2.php') ?>              	
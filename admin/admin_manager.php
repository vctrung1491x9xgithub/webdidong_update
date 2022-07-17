<!DOCTYPE html>
<html>
    <head>
        <title>TRANG CHỦ ADMIN</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../Style_admin/admin_home.css" >
    </head>
    <body>
            <?php 
                session_start();
                if(!empty($_SESSION['current_admin'])) {
                    $current_admin = $_SESSION['current_admin'];
            ?>
            <div class="manager-container">
                <div class="header">
                    <marquee behavior="" direction="">Xin chào <span class="text-style"><i><?= $current_admin['username'] ?></i></span></marquee>
                    <!-- <div style="display:flex;align-items:center;justify-content:center">
                        <a href="../index2.php"><div style="width:150px;"><img style="width:120px" src="../images/logoindex.png"></div></a>
                    </div> -->
                </div>
                <div class="content">
                    <div class="box-content item1">
                        <a class="box dashboard-manager" href="./dashboard.php">
                            <span>DashBoard</span>
                            <img src="../images/dashboard-manager.png" alt="">
                        </a>
                    </div>
                    <div class="box-content item2">
                        <a class="box products-manager" href="javascript:void(0)">
                            <span>Quản lý sản phẩm</span>
                            <img src="../images/icon-product-manager.png" alt="">
                        </a>
                        <div>
                        <ul class="item2-child">
                            <li><a href="./phone_listing.php">Danh sách điện thoại</a></li>
                            <li><a href="./tablet_listing.php">Danh sách tablet</a></li>
                            <li><a href="./laptop_listing.php">Danh sách laptop</a></li>
                            <li><a href="./pc_listing.php">Danh sách PC</a></li>
                            <li><a href="./phukien_listing.php">Danh sách phụ kiện</a></li>
                            <li><a href="./sound_listing.php">Danh sách thiết bị âm thanh</a></li>
                            <li><a href="./watch_listing.php">Danh sách đông hồ</a></li>
                            <li><a href="./comments_listing.php">Danh sách bình luận</a></li>
                        </ul>
                        </div>
                    </div>
                    <div class="box-content item3">
                        <a class="box users-manager" href="./user_listing.php">
                            <span> Quản lý người dùng</span>
                            <img src="../images/icon-user-manager.png" alt="">
                        </a>
                    </div>
                    <div class="box-content item4">
                        <a class="box bills-manager" href="./order_listing.php">
                            <span>Quản lý Đơn hàng</span>
                            <img src="../images/icon-bill-manager.png" alt="">
                        </a>
                    </div>
                    <div class="box-content item5">
                        <a class="box change-pass" href="login.php?resetpassword">
                            <span>Đổi mật khẩu</span>
                            <img src="../images/icon-changepass.png" alt="">
                        </a>
                    </div>
                    <div class="box-content item6">
                        <a class="box admin-logout" href="./logout.php">
                            <span>Đăng xuất</span>
                            <img src="../images/chodilui.gif" alt="">
                        </a>
                    </div>
                </div>
                <div class="footer">
                    Designed &copy Coppyright 2020
                </div>
            </div>
                <?php } else { ?>
                   <?php
                        include 'error.php';
                    ?>
                <?php } ?>

            <style>
                .text-style {
                    font-weight:600;
                    text-shadow: 0 0 5px #78DFFD;
                    color:#78DFFD;
                }
            </style>
    </body>
</html>
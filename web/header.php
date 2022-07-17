<?php
ob_start();
session_start();
include './connect_db.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>webdidong.com</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--BOOSTRAP-->
    <script src="./bootstrap/jquery/jquery-3.5.1.slim.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="./bootstrap/bootstrap_css/bootstrap.min.css">
    <script src="./bootstrap/bootstrap_js/bootstrap.min.js"></script>
    <!--OWL CAROUSEL-->
    <link rel="stylesheet" type="text/css" href="./bootstrap/OwlCarousel2-2.3.4.v2/css/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="./bootstrap/OwlCarousel2-2.3.4.v2/css/owl.theme.default.css">
    <!-- GOOGLE FONTS-->
    <link rel="stylesheet" href="./font_google/fontawesome-free-5.13.1-web/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css"> -->

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="./Style_admin/reset.css">
    <link rel="stylesheet" type="text/css" href="./Style_index/style.css">
    <link rel="stylesheet" type="text/css" href="./Style_index/styleJS.css">
    <link rel="stylesheet" type="text/css" href="./Style_admin/style_product_info.css">
    <link rel="stylesheet" type="text/css" href="./Style_index/style-slide2.css">
    <link rel="stylesheet" type="text/css" href="./Style_index/responsive.css">
    <!--JavaScript-->
    <!-- <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script> -->
    <script src="./bootstrap/OwlCarousel2-2.3.4.v2/Js/owl.carousel.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body>
    <div id="container">
        <!-- HEADER -->
        <div id="contact-header-container">
            <div class="contact-header">
                <div class="hot-line">
                    <i class="fas fa-phone"></i>
                    <a href="#" style="color: #fff;">Gọi mua hàng: 0774787675</a>
                </div>
                <div class="text-white">|</div>
                <div class="mail-address">
                    <i class="fas fa-envelope"></i>
                    <a href="mailto:fpt.vu13544@gmail.com" style="color: #fff;">Email hỗ trợ : vctrung.it@gmail.com</a>
                </div>
                <div class="social-network" style="position: absolute; right: 0;">
                    <a href="#" style="color: #fff;margin-right:10px"><i class="fab fa-facebook"></i>Facebook</a>
                    <a href="#" style="color: #fff;"><i class="fab fa-youtube"></i>Youtube</a>
                </div>
            </div>
        </div>
        <div id="header-container">
            <div class="header">
                <div class="sidebar">
                    <!-- RESPONSIVE -->
                    <div class="user-icon-container" onclick="myFunction_button_menu()">
                        <i class="fas fa-bars icon-user"></i>
                    </div>
                    <!-- ------- -->
                    <div class="user-menu-responsive" id="my-account">
                        <div class="module">
                            <div class="clickX" onclick="myFunction_button_menu()">
                                <i style="color: red" class="far fa-times-circle"></i>
                            </div>
                            <div class="top-menu">
                                <?php
                                if (!empty($_SESSION['current_user'])) {
                                    $current_user = $_SESSION['current_user'];
                                ?>
                                <i class="fas fa-user-circle user-icon"></i>
                                <div class="current_user1">
                                    <div class="login"
                                        style="background:#fff;padding:5px 10px;margin-left:20px;border-radius:7px">
                                        <?= $current_user['tk_nguoi_dung'] ?>&nbsp; <i class="fas fa-caret-right"></i>
                                    </div>
                                    <div class="popup_info1">
                                        <div>
                                            <a href="my_info.php"><img src="./images/user-db.png">Hồ sơ</a>
                                        </div>
                                        <div>
                                            <a href="index2.php?logout" onclick="return confirm('Bạn sẽ đăng xuất?');">
                                                <img src="./images/logout.png">Đăng xuất</a>
                                        </div>
                                        <?php
                                            if (isset($_GET['logout'])) {
                                                unset($_SESSION['current_user']);
                                                header('Location: index2.php');
                                            }
                                            ?>
                                    </div>
                                </div>
                                <script>
                                document.querySelector('.current_user1').onclick = function() {
                                    document.querySelector(".popup_info1").classList.toggle("abc1");
                                }
                                </script>
                                <?php } else { ?>
                                <i class="fas fa-user-circle user-icon"></i>
                                <span><a href="./user/user_login.php">Đăng nhập</a></span>
                                <?php } ?>
                            </div>
                            <div class="bottom-menu">
                                <ul>
                                    <li>
                                        <a href="don_hang_cua_toi.php">
                                            <span class="material-icons">wysiwyg</span>Đơn hàng của bạn
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#phone-container">
                                            <span class="material-icons">smartphone </span>Điện thoại
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#laptop-container">
                                            <span class="material-icons">laptop_mac</span>Laptop
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#laptop-container">
                                            <span class="material-icons">tablet</span>Máy tính bản
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#laptop-container">
                                            <span class="material-icons">headset</span>Phụ kiện
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#laptop-container">
                                            <span class="material-icons">watch</span>Đồng hồ
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#laptop-container">
                                            <span class="material-icons">mobile_screen_share</span>Máy cũ
                                        </a>
                                    </li>
                                    <!-- <li>
										<a href="#laptop-container">
											<span class="material-icons">wysiwyg</span>Tin tức
										</a>
									</li> -->
                                    <!-- <li>
										<a href="#laptop-container">
											<span class="material-icons">devices_other</span>Khác
										</a>
									</li> -->
                                </ul>
                            </div>
                        </div>
                    </div>
                    <script>
                    function myFunction_button_menu() {
                        var x = document.getElementById("my-account");
                        if (x.className === "user-menu-responsive") {
                            x.className += " clicked";
                        } else {
                            x.className = "user-menu-responsive";
                        }
                    };
                    </script>
                    <!-- LEFT -->
                    <div class="left">
                        <div class="logo">
                            <a href="index2.php"><img class="avartar" src="./images/WEBDIDONG.gif"></a>
                        </div>
                    </div>
                    <!-- CENTER -->
                    <!-- SEARCH -->
                    <div class="center">
                        <form class="search">
                            <!-- class="fa fa-search"  -->
                            <button type="submit" title="Tìm ngay"><img
                                    src="https://static.apkpure.com/www/static/imgs/search.png"></button>
                            <input class="input-search" type="text" name="search" id="search"
                                placeholder="Tìm kiếm sản phẩm" required>
                            <div id="display"></div>
                        </form>
                    </div>
                    <!-- SEARCH RESPONSIVE -->
                    <div class="icon-search-container" onclick="myFunction_button_search()">
                        <i class="fas fa-search icon-search"></i>
                    </div>
                    <div class="search-responsive" id="search-responsive">
                        <input type="search" name="search-responsive" placeholder="Tìm sản phẩm">
                        <button type="button" class="find">Tìm</button>
                    </div>

                    <script type="text/javascript">
                    function myFunction_button_search() {
                        var x = document.getElementById("search-responsive");
                        if (x.className === "search-responsive") {
                            x.className += " search-responsive-show";
                        } else {
                            x.className = "search-responsive";
                        }
                    };
                    </script>
                    <!-- SEARCH RESPONSIVE -->
                    <div class="basket">
                        <a href="shopping_cart.php">
                            <div class="my-basket">
                                <span class="material-icons icon-shopping-cart">shopping_cart</span><span
                                    class="ten_gio_hang">Giỏ hàng</span>
                                <div class="amount-cart">
                                    <?php
                                    if (!empty($current_user)) {
                                        echo  isset($_SESSION['gio_hang_san_pham']) ? $_SESSION['gio_hang_san_pham'] : 0;
                                    } else {
                                        echo  isset($_SESSION['san_pham_gio_hang']) ? $_SESSION['san_pham_gio_hang'] : 0;
                                    }
                                    ?>
                                </div>
                                <div class="ping-cart"></div>
                            </div>
                        </a>
                    </div>
                    <!-- RIGHT -->
                    <div class="right">
                        <?php
                        if (!empty($_SESSION['current_user'])) {
                            $current_user = $_SESSION['current_user'];
                        ?>
                        <div class="account">
                            <!-- <a href="#">
									<div class="register" style="background:#fff;color:#111;border:none">Xin chào,</div>
								</a> -->
                            <div class="current_user">
                                <div class="login" style="background:#fff;color:#111;padding: 0 10px;">
                                    <?= $current_user['tk_nguoi_dung'] ?>&nbsp; <i class="fas fa-caret-right"></i>
                                </div>
                                <div class="popup_info">
                                    <div>
                                        <a href="my_order.php"><img src="./images/user-db.png">Đơn hàng</a>
                                    </div>
                                    <div>
                                        <a href="my_info.php"><img src="./images/user-db.png">Hồ sơ</a>
                                    </div>
                                    <div>
                                        <a href="index2.php?logout" onclick="return confirm('Bạn sẽ đăng xuất?');">
                                            <img src="./images/logout.png">Đăng xuất</a>
                                    </div>
                                    <?php
                                        if (isset($_GET['logout'])) {
                                            session_destroy($_SESSION['current_user']);
                                            session_destroy($_SESSION['gio_hang_san_pham']);
                                            header('Location: index2.php');
                                        }
                                        ?>
                                </div>
                            </div>
                        </div>
                        <script>
                        document.querySelector('.current_user').onclick = function() {
                            document.querySelector(".popup_info").classList.toggle("abc");
                        }
                        </script>
                        <style>
                        .current_user,
                        .current_user1 {
                            position: relative;
                            cursor: pointer;
                            -moz-user-select: none;
                            -webkit-user-select: none;
                        }

                        .current_user i {
                            transform: rotate(90deg);
                        }

                        .popup_info,
                        .popup_info1 {
                            position: absolute;
                            bottom: -150px;
                            right: 0;
                            min-width: 150px;
                            padding: 5px 10px;
                            background: #FFF;
                            border-radius: 7px;
                            box-shadow: 0 0 0 1px rgb(0 0 0 / 5%),
                                0 30px 20px -20px rgb(0 0 0 / 25%),
                                0 4px 20px 0 rgb(0 0 0 / 20%);
                            background: #fff;
                            display: none;
                        }

                        .popup_info1 {
                            right: -75px;
                        }

                        .popup_info.abc,
                        .popup_info1.abc1 {
                            display: block;
                            animation: animatetop .5s;
                        }

                        .popup_info img,
                        .popup_info1 img {
                            width: 20px;
                            display: inline-block;
                            vertical-align: top;
                            margin-right: 10px;
                        }

                        .popup_info div,
                        .popup_info1 div {

                            margin: 5px;
                            border-bottom: 1px solid #eeeeee;
                        }

                        .popup_info div a,
                        .popup_info1 div a {
                            display: block;
                            padding: 5px;
                        }

                        @keyframes animatetop {
                            from {
                                opacity: 0
                            }

                            to {
                                opacity: 1
                            }
                        }
                        </style>
                        <?php } else { ?>
                        <div class="account">
                            <a href="./user/user_login.php">
                                <div class="login">Đăng nhập</div>
                            </a>
                            <a href="./user/user_register.php">
                                <div class="register logout">Đăng ký</div>
                            </a>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
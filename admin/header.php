<?php
session_start();
include '../connect_db.php';
include '../function.php';
include '../modal_index/modal.php';
date_default_timezone_set("Asia/Bangkok");
if (!empty($_SESSION['current_admin'])) {
    $current_admin = $_SESSION['current_admin']; //Kiểm tra xem đã đăng nhập chưa?//
?>
<!DOCTYPE html>
<html>

<head>
    <title>Admin manager</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../bootstrap/bootstrap_css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../Style_admin/reset.css">
    <link rel="stylesheet" type="text/css" href="../Style_admin/admin_style.css">
    <link rel="stylesheet" type="text/css" href="../Style_admin/datatables.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/themify-icons/0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />

    <link href="https://fonts.googleapis.com/css?family=Varela+Round&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/e6722f6b4b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet"
        href="https://www.jqueryscript.net/demo/jQuery-Plugin-SVG-Progress-Circle/progresscircle.css">
    <script src="../bootstrap/jquery/jquery-3.4.1.js"></script>
    <script src="../bootstrap/bootstrap_js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>

</head>

<body>
    <div class="wraper">
        <div id="admin-header-panel">
            <div class="container-header">
                <div class="right-panel">
                    <div class="notifi">
                        <a href="#"><img src="../images/mess.png" alt=""></a>
                        <a href="#"><img src="../images/letter.png" alt=""></a>
                        <a href="#"><img src="../images/notification.png" alt=""> </a>
                    </div>
                    <!--  -->
                    <div class="account">
                        <div class="ping"></div>&nbsp; <?= $current_admin['username'] ?>
                        <img width="30px" src="../images/admin-ui.png" alt="">
                        <!--  -->
                        <div id="popup_info" class=" border border-warning">
                            <div>
                                <a href="my_info.php"><img src="../images/user-db.png">Hồ sơ</a>
                            </div>
                            <div>
                                <a href="logout.php" onclick="return confirm('Bạn sẽ đăng xuất?');">
                                    <img src="../images/logout.png">Đăng xuất</a>
                            </div>
                        </div>
                    </div>
                    <!--  -->
                    <script>
                    document.querySelector('.account').onclick = function() {
                        document.getElementById("popup_info").classList.toggle("abc");
                    }
                    </script>
                    <style>
                    .account {
                        position: relative;
                        cursor: pointer;
                        color: #111;
                        -moz-user-select: none;
                        -webkit-user-select: none;
                    }

                    #current_user i {
                        transform: rotate(90deg);
                    }

                    #popup_info {
                        position: absolute;
                        bottom: -70px;
                        right: 0;
                        width: 140px;
                        padding: 5px;
                        background: #FFF;
                        border-radius: 5px;
                        box-shadow: 0 1px 3px rgb(200 200 202),
                            inset 1px 1px 1px rgb(255 255 255 / 50%);
                        background: #fff;
                        display: none;
                    }

                    #popup_info a {
                        color: #111;
                    }

                    #popup_info.abc {
                        display: block;
                        animation: animatetop .5s;
                    }

                    #popup_info img {
                        width: 20px;
                        vertical-align: middle;
                        margin-right: 10px;
                    }

                    #popup_info div {
                        line-height: 2.5 !important;
                        padding: 0 5px;
                        border-radius: 5px;
                    }

                    #popup_info div:hover {
                        background: #F5F5F5;
                    }

                    @keyframes animatetop {
                        from {
                            transform: scale(0);
                            opacity: 0
                        }

                        to {
                            transform: scale(1.05);
                            opacity: 1
                        }
                    }

                    .submenu-active {
                        background: #f1f1f1;
                        color: #263544 !important;
                        border-radius: 7px;
                        font-weight: 600;
                    }
                    </style>
                    <!--  -->
                </div>
            </div>
        </div>
        <div id="content-wrapper">
            <div class="container_ctn">
                <div class="menu-admin">
                    <div class="menu-admin-heading"">
                            <a href=" admin_manager.php">
                        <img height="50" src="../images/admin-pixels.png" />
                        </a>
                        <div id="menu-icon" style="padding: 5px 10px;">
                            <img id="img_icon" width="25px" src="../images/close_menu.png" alt="">
                        </div>
                    </div>
                    <script>
                    var menu_icon = document.getElementById("menu-icon");
                    var att = true;
                    menu_icon.onclick = function() {
                        var menu = document.querySelector(".menu-admin");
                        var menu_clone = document.querySelector(".clone-left");
                        var icon_item = document.querySelectorAll(".icon-item");
                        var img_icon = document.getElementById("img_icon");

                        menu.classList.toggle("hide_menu");
                        menu_clone.classList.toggle("hide_menu_clone");

                        for (var i = 0; i < icon_item.length; i++) {
                            icon_item[i].classList.toggle("icon_item");
                        }
                        if (att) {
                            img_icon.src = "../images/open-menu.png";
                            att = false;
                        } else {
                            img_icon.src = "../images/close_menu.png";
                            att = true;
                        }

                    }
                    </script>
                    <style>
                    .hide_menu {
                        left: -180px !important;
                        transition: all .5s;
                    }

                    .menu-items.hide_menu {
                        display: none;
                    }

                    .hide_menu_clone {
                        min-width: 75px !important;
                        transition: all .5s;
                    }

                    .icon_item {
                        display: none;
                        transition: all .5s;
                    }
                    </style>
                    <div class="menu-items pt-3">
                        <!-- <ul class="items_father">
                                <li>
                                    <div>
                                        <i class=" ti-home" style="color: #2196f3;"></i>
                                        <span>Trang chủ</span>
                                    </div>
                                    <i class="icon-item fas fa-caret-right"></i>
                                    <ul class="item-child">
                                        <li><a href="dashboard.php">Trang chủ</a></li>
                                        <li><a href="#">Cài đặt</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <div>
                                        <i class=" ti-home" style="color: #2196f3;"></i>
                                        <span><a href="slide_listing.php">Quản lý slide</a></span>
                                    </div>
                                </li>
                                <li class="active">
                                    <div>
                                        <i class=" ti-home" style="color: #2196f3;"></i>
                                        <span>Quản lý sản phẩm</span>
                                    </div>
                                    <i class="icon-item fas fa-caret-right"></i>
                                    <ul>
                                        <li class="d-flex align-items-center align-middle"><span><i class="ti-mobile"></i></span><a href="product_listing.php">Quản lý chung</a></li>
                                        <li class="d-flex align-items-center align-middle"><span><i class="ti-mobile"></i></span><a href="phone_listing.php">Danh sách điện thoại</a></li>
                                        <li class="d-flex align-items-center align-middle"><span><i class="ti-mobile"></i></span><a href="laptop_listing.php">Danh sách Laptop</a></li>
                                        <li class="d-flex align-items-center align-middle"><span><i class="ti-mobile"></i></span><a href="pc_listing.php">Danh sách PC</a></li>
                                        <li class="d-flex align-items-center align-middle"><span><i class="ti-mobile"></i></span><a href="phukien_listing.php">Danh sách phụ kiện</a></li>
                                        <li class="d-flex align-items-center align-middle"><span><i class="ti-mobile"></i></span><a href="watch_listing.php">Danh sách đồng hồ</a></li>
                                        <li class="d-flex align-items-center align-middle"><span><i class="ti-mobile"></i></span><a href="sound_listing.php">Danh sách âm thanh</a></li>

                                    </ul>
                                </li>
                                <li>
                                    <div>
                                        <i class=" ti-home" style="color: #2196f3;"></i>
                                        <span>Đơn hàng</span>
                                    </div>
                                    <i class="icon-item fas fa-caret-right"></i>
                                    <ul>
                                        <li><a href="order_listing.php">Danh sách đơn hàng</a></li>
                                        <li><a href="#">Cài đặt</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <div>
                                        <i class=" ti-home" style="color: #2196f3;"></i>
                                        <span> Khách hàng</span>
                                    </div>
                                    <i class="icon-item fas fa-caret-right"></i>
                                    <ul>
                                        <li><a href="user_listing.php">Quản lý khách hàng</a></li>
                                        <li><a href="#">Cài đặt</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <div>
                                        <i class=" ti-home" style="color: #2196f3;"></i>
                                        <span>Thông tin</span>
                                    </div>
                                    <i class="icon-item fas fa-caret-right"></i>
                                    <ul>
                                        <li><a href="#">Hồ sơ admin</a></li>
                                        <li><a href="logout.php" onclick="return confirm('Bạn sẽ đăng xuất?')">Đăng xuất</a></li>
                                    </ul>
                                </li>
                            </ul> -->
                        <ul>
                            <li class="multi-child">
                                <p class="border-bottom border-secondary pb-2 text-light">TRANG CHỦ</p>
                                <ul>
                                    <li class="mt-2">
                                        <a href="dashboard.php">
                                            <span class="material-icons align-middle">
                                                home
                                            </span>Trang chủ
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="multi-child mt-2">
                                <p class="border-bottom border-secondary pb-2 text-light">QUẢN LÝ SẢN PHẨM</p>
                                <ul>
                                    <li class="mt-2">
                                        <a href="phone_listing.php">
                                            <span class="material-icons align-middle">
                                                smartphone
                                            </span>
                                            Danh sách điện thoại
                                        </a>
                                    </li>
                                    <li class="mt-2">
                                        <a href="tablet_listing.php">
                                            <span class="material-icons align-middle">
                                                tablet
                                            </span>
                                            Danh sách tablet
                                        </a>
                                    </li>
                                    <li class="mt-2">
                                        <a href="laptop_listing.php">
                                            <span class="material-icons align-middle">
                                                laptop
                                            </span>
                                            Danh sách laptop
                                        </a>
                                    </li>
                                    <li class="mt-2">
                                        <a href="pc_listing.php">
                                            <span class="material-icons align-middle">
                                                desktop_windows
                                            </span>
                                            Danh sách PC
                                        </a>
                                    </li>
                                    <li class="mt-2">
                                        <a href="accessory_listing.php">
                                            <span class="material-icons align-middle">
                                                headset
                                            </span>
                                            Danh sách phụ kiện
                                        </a>
                                    </li>
                                    <li class="mt-2">
                                        <a href="sound_listing.php">
                                            <span class="material-icons align-middle">
                                                speaker_group
                                            </span>
                                            Danh sách âm thanh
                                        </a>
                                    </li>
                                    <li class="mt-2">
                                        <a href="watch_listing.php">
                                            <span class="material-icons align-middle">
                                                watch
                                            </span>
                                            Danh sách đồng hồ
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="multi-child mt-2">
                                <p class="border-bottom border-secondary pb-2 text-light">SLIDE</p>
                                <ul>
                                    <li class="mt-2">
                                        <a href="slide_listing.php">
                                            <span class="material-icons align-middle">
                                                present_to_all
                                            </span>
                                            Quản lý slide
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="multi-child mt-2">
                                <p class="border-bottom border-secondary pb-2  text-light">ĐƠN HÀNG</p>
                                <ul>
                                    <li class="mt-2">
                                        <a href="order_listing.php">
                                            <span class="material-icons align-middle">
                                                price_change
                                            </span>
                                            Quản lý đơn hàng</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="multi-child mt-2">
                                <p class="border-bottom border-secondary pb-2  text-light">KHÁCH HÀNG</p>
                                <ul>
                                    <li class="mt-2">
                                        <a href="user_listing.php">
                                            <span class="material-icons align-middle">
                                                people
                                            </span>Quản lý khách hàng</a>
                                    </li>
                                </ul>
                            </li>
                            <!--  -->
                            <li class="multi-child mt-2">
                                <p class="border-bottom border-secondary pb-2  text-light">BÌNH LUẬN</p>
                                <ul>
                                    <li class="mt-2">
                                        <a href="comments_listing.php">
                                            <span class="material-icons align-middle">
                                                comment
                                            </span>Quản lý bình luận</a>
                                    </li>
                                </ul>
                            </li>
                            <!--  -->
                            <li class="multi-child mt-2">
                                <p class="border-bottom border-secondary pb-2  text-light">DANH MỤC</p>
                                <ul>
                                    <li class="mt-2">
                                        <a href="category_listing.php">
                                            <span class="material-icons">
                                                segment
                                            </span>Quản lý danh mục</a>
                                    </li>
                                </ul>
                            </li>
                            <!--  -->
                            <li class="multi-child mt-2">
                                <p class="border-bottom border-secondary pb-2 text-light">HỆ THỐNG</p>
                                <ul class="mt-2">
                                    <li>
                                        <a href="logout.php" class=" text-light">
                                            <span class="material-icons align-middle">
                                                logout
                                            </span>
                                            Đăng xuất</a>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                        <script>
                        jQuery(function($) {
                            var path = window.location.href; // 
                            $('.multi-child a').each(function() {
                                if (this.href === path) {
                                    $(this).addClass('submenu-active');
                                }
                            });
                        });
                        // const btn = document.querySelectorAll('.items_father > li');
                        // var att = true;

                        // for (let i = 0; i < btn.length; i++) {
                        //     btn[i].addEventListener("click", function() {
                        //         if (att) {
                        //             this.children[2].style.height = "auto";
                        //             this.children[1].style.transform = "rotate(90deg)";
                        //             att = !att;
                        //         } else {
                        //             this.children[2].style.height = "0";
                        //             this.children[1].style.transform = "rotate(0deg)";
                        //             att = !att;
                        //         }
                        //     });
                        // }
                        </script>
                    </div>
                </div>
                <div class="clone-left"></div>
                <?php } ?>
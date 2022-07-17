<?php
include './web/header.php';
if (empty($_SESSION['current_user'])) {

    if (!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = array();
    }
    if (isset($_GET['action'])) {
        // Hàm cập nhật lại sản phẩm
        function update_cart($add = false)
        {

            foreach ($_POST['quantity'] as $id => $quantity) {
                if ($quantity == 0) {
                    unset($_SESSION['cart'][$id]);
                } else {
                    if ($add) {
                        $_SESSION["cart"][$id] += $quantity;
                    } else {
                        $_SESSION["cart"][$id] = $quantity;
                    }
                }
            }
        }
        //Chọn biến action trên query (URL)
        switch ($_GET['action']) {
                //Chọn biến action trên query
            case "add":
                update_cart(true);
                header('Location: ./shopping_cart.php');
                break;
                //Chọn biến action trên query
            case "delete":
                if (isset($_GET['id'])) {
                    unset($_SESSION["cart"][$_GET['id']]);
                }
                header('Location: ./shopping_cart.php');
                break;
            case "submit":
                if (isset($_POST['update'])) {
                    // Cập nhật số lượng sp
                    update_cart();
                    header('Location: ./shopping_cart.php');
                } else if (isset($_POST['order'])) {
                    $tenkhachhang = $_POST['tenkhachhang'];
                    // Cắt chuỗi tên 
                    $vitricat = strrpos($tenkhachhang, ' ');
                    $ten_kh = trim(substr($tenkhachhang, $vitricat));
                    $ho_lot = trim(substr($tenkhachhang, 0, $vitricat));
                    // 
                    $sdt_kh = $_POST['sdt'];
                    $diachigiaohang = $_POST['diachigiaohang'];
                    $ghichu = $_POST['ghichu'];

                    // Thêm khách hàng vào hệ thống
                    $ma_kh = "KH" . substr(md5(Rand()), 0, 3);
                    $maKH =  mysqli_query($conn, "SELECT ma_kh FROM khach_hang");
                    foreach ($maKH as $value) {
                        while ($ma_kh == $value) {
                            $ma_kh = "KH" . substr(md5(Rand()), 0, 3);
                        }
                    }
                    $inserKhachHang = $conn->query("INSERT INTO khach_hang (ma_kh, ho_lot, ten_kh, sdt_kh, email_kh, dia_chi_kh, diem_kh, ngay_cap_nhat )
                                                    VALUES ('$ma_kh','$ho_lot','$ten_kh','$sdt_kh','','$diachigiaohang',0, now());");

                    //XỬ LÝ ĐẶT HÀNG
                    $product_inCart = mysqli_query($conn, "SELECT * FROM san_pham  WHERE id_san_pham IN (" . implode(",", array_keys($_POST['quantity'])) . ")");

                    $tongtien = 0;
                    $DonHangSanPham = array();

                    while ($row = mysqli_fetch_array($product_inCart)) {
                        $DonHangSanPham[] = $row; // Lưu dư liệu vào mảng
                        $tongtien += $row['gia_ban'] * $_POST['quantity'][$row['id_san_pham']];
                    }
                    if ($inserKhachHang) {
                        $false = true;
                        $insert_order = $conn->query("INSERT INTO don_hang (id_don_hang, ma_kh, tong_tien, ghi_chu, thoi_gian_dat, trang_thai)
                                                        VALUES (NULL, '$ma_kh', '$tongtien','$ghichu', now(),'Đang chờ');");
                        // INSERT VÀO CHI TIẾT GIỎ HÀNG 
                        if ($insert_order) {
                            $IDdonHang = $conn->insert_id; // Lấy id đơn hàng
                            $soSanpham = "";
                            foreach ($DonHangSanPham as $key => $product_inCart) {
                                $soSanpham .= "(NULL, '" . $IDdonHang . "', '" . $product_inCart['id_san_pham'] . "', '" . $_POST['quantity'][$product_inCart['id_san_pham']] . "', '" . $product_inCart['gia_ban'] . "', now())";
                                if ($key != count($DonHangSanPham) - 1) {
                                    $soSanpham .= ",";
                                }
                            }
                            // INSERT CHI TIẾT ĐƠN HÀNG
                            $insert_orderChitiet = $conn->query("INSERT INTO chi_tiet_don_hang (id_chi_tiet, id_don_hang, id_san_pham, so_luong, tong_tien, thoi_gian_dat) 
                            VALUES " . $soSanpham . ";");
                            if ($insert_orderChitiet) {
                                $false =  false;
                                unset($_SESSION['cart']);
                            }
                        }
                        if (!$false) {
                            $_SESSION['san_pham_gio_hang'] = 0;
                            $dathangthanhcong = "Đặt hàng thành công";
                        }
                    } else {
                        echo "<scrit>alert('Vui lòng nhập đúng thông tin');window.location.back()</scrit>";
                    }
                    break;
                }
        }
    }
?>
    <!-- ===================================================================================-->
    <!-- MAIN-CONTAINT -->
    <div id="main-containt">
        <div id="containt">
            <div class="rowtop">
                <div class="bread-crumb">
                    <span>
                        <a href="index2.php">Trang chủ</a>
                        /
                        <a style="font-weight:600;color:tomato;" href="shopping_cart.php">Giỏ hàng</a>
                    </span>
                </div>
            </div>
            <?php
            if (isset($dathangthanhcong)) {
            ?>
                <div class="order-success">
                    <h1><?= $dathangthanhcong ?></h1>
                    <div style="width:100px;margin-top:20px"><img src="./images/icon-order-success.gif" alt=""></div>
                    <a href="./index2.php">Tiếp tục mua hàng</a>
                    <p>Nếu cần trợ giúp vui lòng gọi <b>0774787675</b> để được hỗ trợ (7:30 - 17:00).</p>
                </div>
            <?php } else {
            ?>
                <!-- Main Shopping_cart -->
                <div class="shopping_cart_container">
                    <h1 class="cart_title">Giỏ hàng của bạn</h1>
                    <?php
                    if (!empty($_SESSION["cart"])) {
                        $current_product = mysqli_query($conn, "SELECT * FROM san_pham WHERE id_san_pham
                                            IN (" . implode(",", array_keys($_SESSION["cart"])) . ")");
                    ?>
                        <form action="shopping_cart.php?action=submit" method="POST">
                            <!--  -->
                            <div class="w-75 mx-auto ">
                                <?php
                                $tong_tien = 0;
                                $_SESSION['san_pham_gio_hang'] = 0;
                                while ($row = mysqli_fetch_array($current_product)) {
                                    ++$_SESSION['san_pham_gio_hang'];
                                ?>
                                    <div class="d-flex border-bottom pb-5 pt-3">
                                        <div style="width: 150px;" class="mr-4"><img src="./<?= $row['hinh_anh'] ?>"></div>
                                        <div class="w-100">
                                            <div>
                                                <p class="font-weight-bold"><?= $row['ten_san_pham'] ?></p>
                                            </div>
                                            <div class="text-danger my-2">
                                                <span><?= number_format($row['gia_ban'], 0, ",", ".") ?>đ</span>
                                            </div>
                                            <div>
                                                <label>Khuyến mãi:</label>
                                                <ul class="px-3">
                                                    <li>- <?= $row['noi_dung'] ?></li>
                                                </ul>
                                            </div>
                                            <div class="mt-3 w-100 d-flex justify-content-between">
                                                <div class="btn-soluong">
                                                    <input class="giam is-form" type="button" value="-">
                                                    <input class="input-amount" type="number" id="soluong[<?= $row['id_san_pham'] ?>]" min="1" max="10" value="<?= $_SESSION["cart"][$row['id_san_pham']] ?>" name="quantity[<?= $row['id_san_pham'] ?>]" aria-quality="quantity" readonly>
                                                    <input class="tang is-form" type="button" value="+">
                                                </div>
                                                <div>
                                                    <a class="btn btn-sm border border-warning" href="./shopping_cart.php?action=delete&id=<?= $row['id_san_pham'] ?>">X</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                    $tong_tien += $row['gia_ban'] * $_SESSION["cart"][$row['id_san_pham']];
                                }
                                ?>
                                <div class="py-3 border-bottom d-flex justify-content-between">
                                    <b>- Tổng tiền: <span class="text-danger"><?= number_format($tong_tien, 0, ",", ".") ?> đ</span></b>
                                    <input class="btn btn-sm btn-success" type="submit" name="update" value="Cập nhật">
                                </div>
                                <!-- MODEL XÁC NHẬN MUA HÀNG -->
                                <div>
                                    <div class="d-flex justify-content-end my-2">
                                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#thongtinKhModal">Tiếp tục</button>
                                    </div>
                                    <div class="modal fade" id="thongtinKhModal" role="dialog">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header p-2">
                                                    <p class="modal-title mt-1 px-2 h5">Xác nhận mua hàng</p>
                                                    <button type="button" class="btn shadow-none" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <h4 class="mb-2"><b>Thông tin khách hàng</b></h4>
                                                    <div class="rounded border border-success p-3 my-2">
                                                        <div class="row">
                                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                                                                <label><b>Tên khách hàng</b></label><br>
                                                                <input type="text" class="w-100 my-2 px-2 py-1" name="tenkhachhang" placeholder="Nhập tên khác hàng">
                                                            </div>
                                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                                                                <label><b>Số điện thoại</b></label><br>
                                                                <input type="text" class="w-100 my-2 px-2 p-1" name="sdt" placeholder="Nhập số điện thoại">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                                <label><b>Địa chỉ giao hàng:</b></label><br>
                                                                <input type="text" class="w-100 my-2 px-2 py-1" name="diachigiaohang" placeholder="Nhập địa chỉ">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                                <label><b>Ghi chú</b></label><br>
                                                                <input type="text" class="w-100 my-2 px-2 p-1" name="ghichu" placeholder="Nhập ghi chú">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h4><b>Thông tin sản phẩm</b></h4>
                                                    <div class="rounded border border-success p-3 my-2">
                                                        <p>Tổng sản phẩm: <b><?= $_SESSION['san_pham_gio_hang']; ?></b></p>
                                                        <?php
                                                        foreach ($current_product as $key => $value) :
                                                        ?>
                                                            <div class="d-flex align-tems-center border-bottom mt-2">
                                                                <div class="m-3"><span class="badge badge-success d-inine-block"><?= $key + 1 ?></span></div>
                                                                <div class="mx-3">
                                                                    <p><?= $value['ten_san_pham'] ?></p>
                                                                    <p class="my-1">Đơn giá:
                                                                        <span class="text-danger mr-2"> <b><?= number_format($value['gia_ban'], 0, ",", ".") ?>đ</b></span>
                                                                        Số lượng: <span class="text-danger"><b><?= $_SESSION["cart"][$value['id_san_pham']] ?></b></span>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        <?php endforeach;
                                                        ?>
                                                        <div class="mt-3">
                                                            <p>- Tổng tiền: <b class="text-danger"><?= number_format($tong_tien, 0, ",", ".") ?> đ</b></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-warning" name="order">Mua hàng</button>
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Huỷ</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script>
                                $('input.input-amount').each(function() {
                                    let $this = $(this),
                                        amount = $this.parent().find('.is-form'),
                                        min = Number($this.attr('min')),
                                        max = Number($this.attr('max')),
                                        d = Number($this.val());

                                    $(amount).on('click', function() {
                                        if ($(this).hasClass('giam')) {
                                            if (d > min) {
                                                d += -1;
                                            }
                                        } else if ($(this).hasClass('tang')) {
                                            var x = Number($this.val());
                                            if (x < max) {
                                                d += 1;
                                            }
                                        }
                                        $this.attr('value', d).val(d);
                                    })
                                });
                            </script>
                        </form>
                    <?php } else {
                        $_SESSION['san_pham_gio_hang'] = 0;
                    ?>
                        <div class="empty_cart">
                            <p class="mb-3">( ͡° ͜ʖ ͡°)</p>
                            <h1>Hiện tại bạn không có sản phẩm nào trong Giỏ hàng!</h1>
                            <a href="index2.php">Mua ngay!</a>
                            <p>Nếu cần trợ giúp vui lòng gọi <b>0774787675</b> để được hỗ trợ (7:30 - 17:00).</p>
                        </div>
                    <?php } ?>
                </div>
            <?php
            }
        } else {
            // --------ISSET USER--------------------

            $current_user = $_SESSION['current_user'];
            $ma_kh = $current_user['ma_kh'];
            if (isset($_GET['action']) && isset($_GET['id'])) {
                //Chọn biến action trên query (URL)
                function update_cart($id, $soluong, $ma_kh, $conn)
                {
                    $selectGioHang = $conn->query("SELECT * FROM gio_hang WHERE id_san_pham = '$id'");
                    if ($selectGioHang->num_rows > 0) {
                        $rowSoLuong = mysqli_fetch_array($selectGioHang);
                        $soluong += $rowSoLuong['san_pham_so_luong'];

                        $conn->query("  UPDATE `gio_hang` 
                                        SET `san_pham_so_luong` = '$soluong' WHERE `gio_hang`.`id_san_pham` = $id
                                             and `gio_hang`.`ma_kh` = '$ma_kh'");
                    } else {
                        $conn->query("  INSERT INTO `gio_hang` (`id_gio_hang`, `san_pham_so_luong`, `id_san_pham`,`ma_kh`) 
                                        VALUES (NULL, '$soluong', '$id', '$ma_kh');");
                    }
                }
                if (isset($_POST['soluong'])) {
                    $soluong = $_POST['soluong'] <= 0 ? '1' : $_POST['soluong'];
                } else {
                    $soluong = 0;
                }
                $id = $_GET['id'];
                switch ($_GET['action']) {
                        //Chọn biến action trên query 
                    case "add":
                        update_cart($id, $soluong, $ma_kh, $conn);
                        header('Location: ./shopping_cart.php');
                        break;
                        //Chọn biến action trên query
                    case "delete":
                        $a = $conn->query("DELETE FROM `gio_hang` WHERE `gio_hang`.`id_san_pham` = '$id' and ma_kh = '$ma_kh'");
                        header('Location: ./shopping_cart.php');
                        break;
                }
            }
            function cap_nhat_gio_hang($conn, $ma_kh)
            {
                $soluongtang = $_POST['soluong'];
                $id = $_POST['sanpham'];
                foreach ($soluongtang as $index => $value) {
                    $conn->query("  UPDATE gio_hang SET san_pham_so_luong = $value
                    WHERE id_san_pham = $id[$index] and ma_kh = '$ma_kh'");
                }
                header('Location: ./shopping_cart.php');
            }
            if (isset($_POST['tangsoluong'])) {
                // 
                cap_nhat_gio_hang($conn, $ma_kh);
                // 
            } else if (isset($_POST['giamsoluong'])) {
                // 
                cap_nhat_gio_hang($conn, $ma_kh);
                // 
            }
            // Đặt hàng
            $false = true;
            if (isset($_POST['dathang'])) {
                $ghichu = $_POST['ghichu'];
                $tong_tien = $_POST['tongtien'];
                // INSER DON_HANG
                $id = $_POST['sanpham'];
                $insertDonHang = $conn->query(" INSERT 
                                            INTO `don_hang` (`id_don_hang`, `ma_kh`, `tong_tien`, `ghi_chu`, `thoi_gian_dat`, `trang_thai`)
                                            VALUES (NULL, '$ma_kh', '$tong_tien', '$ghichu', now(), 'Đang chờ');");
                if ($insertDonHang) {
                    $id_don_hang = $conn->insert_id;
                    $so_luong = $_POST['soluong'];
                    $gia_ban =  $_POST['giaban'];

                    foreach ($id as $index => $sanpham) {
                        $tong_tien =  $so_luong[$index] * $gia_ban[$index];
                        $insertChiTietDonhang = $conn->query("  INSERT INTO `chi_tiet_don_hang` (`id_chi_tiet`, `id_don_hang`, `id_san_pham`, `so_luong`, `tong_tien`, `thoi_gian_dat`) 
                                    VALUES (NULL, '$id_don_hang', '$sanpham', '$so_luong[$index]', '$tong_tien', now());");
                        // Xoá giỏ hàng
                        if ($insertChiTietDonhang) {
                            $deleteGioHang = $conn->query("   DELETE FROM gio_hang WHERE id_san_pham = '$sanpham' and ma_kh = '$ma_kh'");
                            if ($deleteGioHang) {
                                $false = false;
                            }
                        }
                    }
                    if (!$false) {
                        $_SESSION['san_pham_gio_hang'] = 0;
                        $dathangthanhcong = "Đặt hàng thành công";
                    }
                }
            } ?>
            <div id="main-containt">
                <div id="containt">
                    <div class="rowtop">
                        <div class="bread-crumb">
                            <span>
                                <a href="index2.php">Trang chủ</a>
                                /
                                <a style="font-weight:600;color:tomato;" href="shopping_cart.php">Giỏ hàng</a>
                            </span>
                        </div>
                    </div>
                    <!-- Main Shopping_cart -->
                    <?php
                    if (isset($dathangthanhcong)) { ?>
                        <div class="order-success">
                            <h1><?= $dathangthanhcong ?></h1>
                            <div style="width:100px;margin-top:20px"><img src="./images/icon-order-success.gif" alt=""></div>
                            <a href="./index2.php">Tiếp tục mua hàng</a>
                            <p>Nếu cần trợ giúp vui lòng gọi <b>0774787675</b> để được hỗ trợ (7:30 - 17:00).</p>
                        </div>
                    <?php } else {
                    ?>
                        <div class="shopping_cart_container">
                            <h1 class="cart_title">Giỏ hàng của bạn</h1>

                            <?php
                            $select_gio_hang = $conn->query("   SELECT  *
                                                                FROM    gio_hang  AS g, khach_hang AS k, san_pham AS s
                                                                WHERE   s.id_san_pham = g.id_san_pham and k.ma_kh = g.ma_kh
                                                                        and k.ma_kh = '$ma_kh'");

                            if ($select_gio_hang->num_rows > 0) {
                            ?>
                                <form method="POST">
                                    <div class="w-75 mx-auto ">
                                        <?php
                                        $tong_tien = 0;
                                        $tong_so_luong = 0;
                                        $_SESSION['gio_hang_san_pham'] = 0;
                                        foreach ($select_gio_hang as $key => $value) :
                                            ++$_SESSION['gio_hang_san_pham'];
                                        ?>
                                            <div class="d-flex border-bottom pb-5 pt-3">
                                                <div style="width: 150px;" class="mr-4"><img src="./<?= $value['hinh_anh'] ?>"></div>
                                                <div class="w-100">
                                                    <div>
                                                        <p class="font-weight-bold"><?= $value['ten_san_pham'] ?></p>
                                                        <input type="hidden" name="sanpham[]" value="<?= $value['id_san_pham'] ?>" readonly>
                                                    </div>
                                                    <div class="text-danger my-2">
                                                        <span><?= number_format($value['gia_ban'], 0, ",", ".") ?>đ</span>
                                                    </div>
                                                    <div>
                                                        <label>Khuyến mãi:</label>
                                                        <ul class="px-3">
                                                            <li>- <?= $value['noi_dung'] ?></li>
                                                        </ul>
                                                    </div>
                                                    <div class="mt-3 w-100 d-flex justify-content-between">
                                                        <div class="btn-soluong">
                                                            <input class="giam is-form" type="submit" name="giamsoluong" value="-">
                                                            <input class="input-amount" type="number" min="1" max="10" value="<?= $value['san_pham_so_luong']; ?>" name="soluong[]" readonly>
                                                            <input class="tang is-form" type="submit" name="tangsoluong" value="+">
                                                        </div>
                                                        <div>
                                                            <a class="btn btn-sm border border-warning" href="./shopping_cart.php?action=delete&id=<?= $value['id_san_pham'] ?>">X</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                            $tong_tien += $value['gia_ban'] *  $value['san_pham_so_luong'];
                                            $tong_so_luong += $value['san_pham_so_luong'];
                                        endforeach; ?>
                                        <div class="py-3 border-bottom">
                                            <b>- Tổng tiền: <span class="text-danger"><?= number_format($tong_tien, 0, ",", ".") ?> đ</span></b>
                                        </div>
                                        <div>
                                            <div class="d-flex justify-content-end my-2">
                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#thongtinKhModal">Tiếp tục</button>
                                            </div>
                                            <div class="modal fade" id="thongtinKhModal" role="dialog">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header p-2">
                                                            <p class="modal-title mt-1 px-2 h5">Xác nhận mua hàng</p>
                                                            <button type="button" class="btn shadow-none" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h4><b>Thông tin sản phẩm</b></h4>
                                                            <div class="rounded border border-success p-3 my-2">
                                                                <p>Tổng sản phẩm: <b><?= $_SESSION['gio_hang_san_pham']; ?></b></p>
                                                                <?php
                                                                foreach ($select_gio_hang as $key => $value) :
                                                                ?>
                                                                    <div class="d-flex align-tems-center border-bottom mt-2">
                                                                        <div class="m-3"><span class="badge badge-success d-inine-block"><?= $key + 1 ?></span></div>
                                                                        <div class="mx-3">
                                                                            <p><?= $value['ten_san_pham'] ?></p>
                                                                            <p class="text-danger my-1"><?= number_format($value['gia_ban'], 0, ",", ".") ?>đ</p>
                                                                            <input type="hidden" name="giaban[]" value="<?= $value['gia_ban']; ?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                <?php endforeach;
                                                                ?>
                                                                <div class="mt-3">
                                                                    <p>- Tổng tiền: <span class="text-danger"><?= number_format($tong_tien, 0, ",", ".") ?> đ</span></p>
                                                                </div>
                                                            </div>
                                                            <h4 class="mb-2"><b>Thông tin khách hàng</b></h4>
                                                            <div class="rounded border border-success p-3 my-2">
                                                                <div class="d-flex">
                                                                    <p><b>Khách hàng:</b> <?= $current_user['ho_lot'] . " " . $current_user['ten_kh']; ?> </p>
                                                                    <p class="mx-3"><b>Số điện thoại:</b> <?= $current_user['sdt_kh'] ?></p>
                                                                </div>
                                                                <div class="my-2">
                                                                    <p><b>Địa chỉ giao hàng:</b> <?= $current_user['dia_chi_kh'] ?></p>
                                                                </div>
                                                                <div>
                                                                    <p><b>Ghi chú: </b> <br> <input type="text" name="ghichu" class="border border-info w-100 p-1 mt-1"></p>
                                                                </div>
                                                                <div>
                                                                    <p><input type="hidden" value="<?= $tong_tien; ?>" name="tongtien" readonly></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-warning" name="dathang">Mua hàng</button>
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Huỷ</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        $('input.input-amount').each(function() {
                                            let $this = $(this),
                                                amount = $this.parent().find('.is-form'),
                                                min = Number($this.attr('min')),
                                                max = Number($this.attr('max')),
                                                d = Number($this.val());

                                            $(amount).on('click', function() {
                                                if ($(this).hasClass('giam')) {
                                                    if (d > min) {
                                                        d += -1;
                                                    }
                                                } else if ($(this).hasClass('tang')) {
                                                    var x = Number($this.val());
                                                    if (x < max) {
                                                        d += 1;
                                                    }
                                                }
                                                $this.attr('value', d).val(d);
                                            })
                                        });
                                    </script>
                                </form>
                            <?php } else {
                                $_SESSION['gio_hang_san_pham'] = 0;
                            ?>
                                <div class="empty_cart">
                                    <p class="mb-3">( ͡° ͜ʖ ͡°)</p>
                                    <h1>Hiện tại bạn không có sản phẩm nào trong Giỏ hàng!</h1>
                                    <a href="index2.php">Mua ngay!</a>
                                    <p>Nếu cần trợ giúp vui lòng gọi <b>0774787675</b> để được hỗ trợ (7:30 - 17:00).</p>
                                </div>
                            <?php } ?>
                        </div>
                <?php }
                } ?>
                </div>
                <a href="#" class="back-to-top" id="back-to-top"></a>
                <!-- <div class="night-mod-button">
                    <img class="logo-bt-nm" src="./images/lododarkmode-open-sun5.png" title="Change theme">
                </div> -->
                <?php include './web/footer.php'; ?>
            </div>
            </body>

            </html>
            <?php
            if (isset($false) && !$false) {
                $_SESSION['gio_hang_san_pham'] = 0;
            }
            ?>
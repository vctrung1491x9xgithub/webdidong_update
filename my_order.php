<?php
include './web/header.php';
if (empty($_SESSION['current_user'])) {
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
                        <a style="font-weight:600;color:tomato;" href="don_hang_cua_toi.php">Tra cứu đơn hàng</a>
                    </span>
                </div>
            </div>
            <!-- Main Shopping_cart -->
            <div class="shopping_cart_container">
                <h1 class="cart_title">Đơn hàng của bạn</h1>
                <div class="w-75 mx-auto ">
                    <?php
                    if (isset($_POST['sdt']) && !empty($_POST['sdt'])) {
                        $sdt = $_POST['sdt'];
                        $soLuong_don_hang = $conn->query(" SELECT * FROM don_hang as d, khach_hang as k WHERE  k.ma_kh = d.ma_kh and k.sdt_kh = '$sdt'");
                    ?>
                        <div class="d-flex justify-content-between align-items-center">
                            <span><b>Kết quả tìm kiếm</b>: <?= $sdt; ?></span>
                            <span class="border border-warning px-2 py-1"><a href="don_hang_cua_toi.php">Trở về </a></span>
                        </div>
                        <?php
                        if ($soLuong_don_hang->num_rows > 0) {
                            $tong_tien = 0;
                            $tong_so_luong = 0;
                            foreach ($soLuong_don_hang as $key => $don_hang) :
                                $id_don_hang =  $don_hang['id_don_hang'];
                                $trang_thai = $don_hang['trang_thai'];
                                $ma_kh = $don_hang['ma_kh'];
                        ?>
                                <div>
                                    <p class="mt-3"><b>Đơn hàng thứ: <?= $key + 1 ?></b></p>
                                    <div class="border border-success rounded py-3 px-2 mt-2">
                                        <?php
                                        $select_don_hang =
                                            $conn->query("  SELECT  *
                                                        FROM    khach_hang AS k, san_pham AS s, chi_tiet_don_hang AS c
                                                        WHERE   s.id_san_pham = c.id_san_pham  and c.id_don_hang = '$id_don_hang'
                                                                and k.ma_kh = '$ma_kh'
                                                    ");
                                        foreach ($select_don_hang as $key => $value) :
                                        ?>
                                            <div class="ml-2">
                                                <p><?= $key != 0 ? "<hr>" : '' ?><span class="badge badge-success">Sản phẩm <?= $key + 1; ?></span></p>
                                            </div>
                                            <div class="row my-2 mx-0">
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9 d-flex align-items-center">
                                                    <div style="width: 80px;" class="mr-4"><img src="./<?= $value['hinh_anh'] ?>"></div>
                                                    <div class="w-100">
                                                        <div>
                                                            <p class="font-weight-bold"><?= $value['ten_san_pham'] ?></p>
                                                        </div>
                                                        <div class="my-2">
                                                            <span class="text-danger "><?= number_format($value['gia_ban'], 0, ",", ".") ?>đ</span>
                                                            <span class="mx-2">Số lượng: <?= $value['so_luong']; ?> </span>
                                                        </div>
                                                        <div>
                                                            <label>Khuyến mãi:</label>
                                                            <ul class="px-3">
                                                                <li>- <?= $value['noi_dung'] ?></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 d-flex flex-column justify-content-between">
                                                    <p class="mt-2"><b>Tổng tiền:</b> <span class="text-danger"><?= $value['gia_ban'] * $value['so_luong']; ?>đ</span></p>
                                                    <p><b>Thời gian: </b><?= date("d-m-Y H:i:s", strtotime($value['thoi_gian_dat'])) ?></p>
                                                    <p class=" ">Trạng thái: <span class="badge badge-danger"><?= $trang_thai; ?></span></p>
                                                </div>
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mt-3">
                                                    <small><b>Ghi chú của bạn: </b><i><?= $don_hang['ghi_chu']; ?></i></small>
                                                </div>
                                            </div>
                                        <?php
                                        endforeach; ?>
                                    </div>
                                </div>
                            <?php
                                $tong_tien += $value['gia_ban'] *  $value['so_luong'];
                                $tong_so_luong += $value['so_luong'];

                            endforeach; ?>
                            <div class="py-3 border-bottom">
                                <b>- Tổng tiền: <span class="text-danger"><?= number_format($tong_tien, 0, ",", ".") ?> đ</span></b>
                            </div>

                        <?php
                        } else { ?>
                            <div class="empty_cart">
                                <p class="mb-3">( ͡° ͜ʖ ͡°)</p>
                                <h1>Không tìm thấy đơn hàng nào cho số điện thoại: <?= $sdt; ?>.</h1>
                                <a href="index2.php">Mua ngay!</a>
                                <p>Nếu cần trợ giúp vui lòng gọi <b>0774787675</b> để được hỗ trợ (7:30 - 17:00).</p>
                            </div>
                        <?php   }
                    } else {
                        ?>
                        <form action="don_hang_cua_toi.php?action=submit" method="POST">
                            <!--  -->
                            <div class="w-75 mx-auto d-flex flex-column justify-content-center align-items-center">
                                <label class="h5">Tra cứu đơn hàng</label>
                                <input type="text" type="tel" name="sdt" class="m-3 p-2 w-100 border-success rounded" style="max-width: 300px" pattern="(\+84|0)\d{9,10}" required placeholder="Nhập số điện thoại">
                                <input type="submit" class="btn btn-sm btn-success mb-3" value="Tra cứu">
                                <p>* Hệ thống sẽ tìm những đơn hàng được đặt bằng số điện thoại của bạn</p>
                            </div>
                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
<?php
} else {
    // --------ISSET USER-------------------- 
    $current_user = $_SESSION['current_user'];
    $ma_kh = $current_user['ma_kh'];
?>
    <div id="main-containt">
        <div id="containt">
            <div class="rowtop">
                <div class="bread-crumb">
                    <span>
                        <a href="index2.php">Trang chủ</a>
                        /
                        <a style="font-weight:600;color:tomato;" href="shopping_cart.php">Đơn hàng của bạn</a>
                    </span>
                </div>
            </div>
            <!-- Main Shopping_cart -->
            <div class="shopping_cart_container">
                <h1 class="cart_title">Đơn hàng của bạn</h1>
                <form method="POST">
                    <div class="w-75 mx-auto ">
                        <?php
                        $soLuong_don_hang = $conn->query("  SELECT  * FROM don_hang WHERE ma_kh = '$ma_kh'");
                        if ($soLuong_don_hang->num_rows > 0) {
                            $tong_tien = 0;
                            $tong_so_luong = 0;
                            foreach ($soLuong_don_hang as $key => $don_hang) :
                                $id_don_hang =  $don_hang['id_don_hang'];
                                $trang_thai = $don_hang['trang_thai']
                        ?>
                                <div>
                                    <p class="mt-3"><b>Đơn hàng thứ: <?= $key + 1 ?></b></p>
                                    <div class="border border-success rounded py-3 px-2 mt-2">
                                        <?php
                                        $select_don_hang =
                                            $conn->query("  SELECT  *
                                                            FROM    khach_hang AS k, san_pham AS s, chi_tiet_don_hang AS c
                                                            WHERE   s.id_san_pham = c.id_san_pham  and c.id_don_hang = '$id_don_hang'
                                                                    and k.ma_kh = '$ma_kh'
                                                        ");
                                        foreach ($select_don_hang as $key => $value) :
                                        ?>
                                            <div class="ml-2">
                                                <p><?= $key != 0 ? "<hr>" : '' ?><span class="badge badge-success">Sản phẩm <?= $key + 1; ?></span></p>
                                            </div>
                                            <div class="row my-2 mx-0">
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9 d-flex align-items-center">
                                                    <div style="width: 80px;" class="mr-4"><img src="./<?= $value['hinh_anh'] ?>"></div>
                                                    <div class="w-100">
                                                        <div>
                                                            <p class="font-weight-bold"><?= $value['ten_san_pham'] ?></p>
                                                        </div>
                                                        <div class="my-2">
                                                            <span class="text-danger "><?= number_format($value['gia_ban'], 0, ",", ".") ?>đ</span>
                                                            <span class="mx-2">Số lượng: <?= $value['so_luong']; ?> </span>
                                                        </div>
                                                        <div>
                                                            <label>Khuyến mãi:</label>
                                                            <ul class="px-3">
                                                                <li>- <?= $value['noi_dung'] ?></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 d-flex flex-column justify-content-between">
                                                    <p class="mt-2"><b>Tổng tiền:</b> <span class="text-danger"><?= $value['gia_ban'] * $value['so_luong']; ?>đ</span></p>
                                                    <p><b>Thời gian: </b><?= date("d-m-Y H:i:s", strtotime($value['thoi_gian_dat'])) ?></p>
                                                    <p class=" ">Trạng thái: <span class="badge badge-danger"><?= $trang_thai; ?></span></p>
                                                </div>
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mt-3">
                                                    <small><b>Ghi chú của bạn: </b><i><?= $don_hang['ghi_chu']; ?></i></small>
                                                </div>
                                            </div>
                                        <?php
                                        endforeach; ?>
                                    </div>
                                </div>
                            <?php
                                $tong_tien += $value['gia_ban'] *  $value['so_luong'];
                                $tong_so_luong += $value['so_luong'];

                            endforeach; ?>
                            <div class="py-3 border-bottom">
                                <b>- Tổng tiền: <span class="text-danger"><?= number_format($tong_tien, 0, ",", ".") ?> đ</span></b>
                            </div>

                        <?php } else { ?>
                            <div class="empty_cart">
                                <p class="mb-3">( ͡° ͜ʖ ͡°)</p>
                                <h1>Hiện tại bạn không có đơn hàng nào!</h1>
                                <a href="index2.php">Mua ngay!</a>
                                <p>Nếu cần trợ giúp vui lòng gọi <b>0774787675</b> để được hỗ trợ (7:30 - 17:00).</p>
                            </div>
                        <?php } ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php  } ?>
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
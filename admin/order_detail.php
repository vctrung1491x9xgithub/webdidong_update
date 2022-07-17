<?php
include './header.php';
if (!empty($_SESSION['current_admin'])) {
    $iddonhang = $_GET['id'];
    $result_order = mysqli_query($conn, "SELECT * FROM chi_tiet_don_hang as dh, san_pham as sp WHERE dh.id_san_pham = sp.id_san_pham and id_don_hang = '$iddonhang'") or die("loi");
?>
    <div class="framework">
        <div class="breadcrumb bg-white p-2 m-0 mb-3 shadow-sm">
            <h1><i class="fas fa-home text-secondary"></i><span class="mx-2">&#10095;</span><a href=""> Quản lý đơn hàng</a><span class="mx-2">&#10095;</span><span class="font-weight-bold">Chi tiết đơn hàng</span></h1>
        </div>
        <div class="table-responsive-lg p-2 bg-white shadow-sm border border-success" id="tbl-order-listing">
            <table class="table table-hover"">
                <caption class="pb-2 border-bottom mb-2 font-weight-bold">
                Thông tin Đơn hàng số <?= $_GET['id'] ?>
                </caption>
                <thead style="background: #008776; color:#FFF">
                    <tr>
                        <th>Mã đơn hàng</th>
                        <th>Mã sản phẩm</th>
                        <th colspan="2" >Sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Thời gian đặt hàng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_array($result_order)) {
                    ?>
                        <tr>
                            <td style="width: 10%;"><?= $row['id_don_hang'] ?></td>
                            <td style="width: 10%;"><?= $row['id_san_pham'] ?></td>
                            <td style="width: 10%;">
                                <img width="80px" src="..<?= $row['hinh_anh'] ?>" alt="">
                            </td>
                            <td style="width: auto;"> <?= $row['ten_san_pham'] ?></td>
                            <td style="width: 10%;"><?= $row['so_luong'] ?></td>
                            <td style="width: 10%;"><?= number_format($row['tong_tien'], 0, ",", ".") ?> đ</td>
                            <td style="width: 10%;"><?= date('d/m/Y H:i', strtotime($row['thoi_gian_dat'])) ?></td>
                        </tr>

                        <!-- THÔNG TIN TÀI KHOẢN -->
                    <?php } ?>
                </tbody>
            </table>
        </div>
    <?php include './footer.php';
} ?>
    </div>
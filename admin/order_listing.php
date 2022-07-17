<?php
include './header.php';
if (!empty($_SESSION['current_admin'])) {
?>
    <div class="framework">
        <div class="breadcrumb bg-white p-2 m-0 mb-3 shadow-sm">
            <h1><i class="fas fa-home text-secondary"></i><span class="mx-2">&#10095;</span><a href=""> Quản lý đơn hàng</a><span class="mx-2">&#10095;</span><span class="font-weight-bold">Danh sách đơn hàng</span></h1>
        </div>
        <form action="#" class="find mb-2" method="post">
            <div class="d-flex flex-wrap align-items-center">
                <div class="find-box d-flex flex-column mr-5 mb-2">
                    <label class="mb-2 font-weight-bold">Phân loại: </label>
                    <select id="sortType" name="sort-type">
                        <option value="" selected>--Chọn hình thức--</option>
                        <option value="new">Đơn hàng mới</option>
                        <option value="old">Đơn hàng đã xác nhận</option>
                    </select>
                </div>
                <div class="find-box d-flex flex-column mr-5 mb-2">
                    <label class="mb-2 font-weight-bold">Tìm kiếm theo:</label>
                    <input type="text" name="txtSearch" id="txtSearch" placeholder="Tên người dùng, địa chỉ">
                </div>
                <div class="find-box d-flex flex-column ">
                    <button class="mt-3 btn btn-find" type="submit" name="btn-find"><i class="fas fa-search"></i>Tìm</button>
                </div>
            </div>
        </form>
        <div class="table-responsive-lg p-2 bg-white shadow-sm border border-success" id="tbl-order-listing">
            <?php

            $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 6;
            $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
            $offset = ($current_page - 1) * $item_per_page;

            $totalRecords = mysqli_query($conn, "   SELECT * FROM don_hang as dh, khach_hang as kh 
                                                    WHERE dh.ma_kh = kh.ma_kh and dh.trang_thai = 'Đang chờ'");
            $totalRecords = $totalRecords->num_rows;
            $totalPages = ceil($totalRecords / $item_per_page);
            $orders = mysqli_query($conn, "   SELECT * FROM don_hang as dh, khach_hang as kh 
                                                WHERE dh.ma_kh = kh.ma_kh and dh.trang_thai = 'Đang chờ' 
                                                ORDER BY id_don_hang DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
            if ($orders->num_rows > 0) { ?>
                <table class="table table-hover"">
                    <caption class="border-bottom pb-2 mb-2 font-weight-bold"><span>Danh sách đơn hàng</span></caption>
                    <thead style="background: #008776; color:#FFF">
                        <tr class="product-item-content">
                            <td style="width: 5%">Mã DH</td>
                            <td colspan="2">Tên khách hàng</td>
                            <td style="width: 10%">SĐT</td>
                            <td>Địa chỉ</td>
                            <td style="width: 10%">Tổng tiền</td>
                            <td>Ghi chú</td>
                            <td style="width: 10%">Thời gian đặt</td>
                            <td style="width: 15%">Thao tác</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($orders as $row) :
                        ?>
                            <tr>
                                <td class=""><?= $row['id_don_hang'] ?></td>
                                <td class=""><?= $row['ho_lot'] ?></td>
                                <td class=""><?= $row['ten_kh'] ?></td>
                                <td class=""><?= $row['sdt_kh'] ?></td>
                                <td class=""><?= $row['dia_chi_kh'] ?></td>
                                <td class=""><?= number_format($row['tong_tien'], 0, ",", ".") ?> đ</td>
                                <td class=""><?= $row['ghi_chu'] ?></td>
                                <td class=""><?= date('d/m/Y H:i', strtotime($row['thoi_gian_dat'])) ?></td>
                                <td>
                                    <a class="btn btn-sm shadow-sm btn-primary" href="order_detail.php?id=<?= $row['id_don_hang'] ?>">Xem</a>
                                    <?php
                                    if ($row['trang_thai'] == "Xác nhận") {
                                        echo '<a class="btn btn-sm shadow-sm text-success">Xác nhận ✔</a>';
                                    } else { ?>
                                        <a class="btn btn-sm btn-danger shadow-sm" href="accept_order.php?id=<?= $row['id_don_hang'] ?>" onclick="return confirm('Xác nhận đơn hàng')"><?= $row['trang_thai'] ?> ↺</a>
                                    <?php } ?>
                                </td>

                            </tr>
                        <?php
                        endforeach;
                        ?>
                    </tbody>
                </table>
                <?php
                include '../pagination/order_pagination.php';
                ?>
            <?php  } else {
                echo "<p class='text-center'>Không tìm thấy đươn hàng!</p>";
            }
            ?>
        </div>
    <?php
}
include './footer.php';
    ?>
    </div>
    <script>
        $(document).on('change', '#sortType', function() {
            var sortType = $(this).val();
            var txtSearch = $("#txtSearch").val();
            $.ajax({
                url: "../ajax_admin/ajax_order_cbb_filter.php",
                data: {
                    "sortType": sortType,
                    "txtSearch": txtSearch,
                },
                dataType: "html",
                type: "post",
                success: function(data) {
                    $('#tbl-order-listing').html(data);

                }
            });
        });
        $(document).on('keyup', '#txtSearch', function() {
            var sortType = $("#sortType").val();
            var txtSearch = $(this).val();
            $.ajax({
                url: "../ajax_admin/ajax_order_input_filter.php",
                data: {
                    "sortType": sortType,
                    "txtSearch": txtSearch,
                },
                dataType: "html",
                type: "post",
                success: function(data) {
                    $('#tbl-order-listing').html(data);
                }
            });
        });
    </script>
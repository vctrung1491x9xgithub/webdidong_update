<?php
include '../connect_db.php';
if (isset($_POST['per_page'])  && isset($_POST['page']) && isset($_POST['sortType'])  && isset($_POST['txtSearch'])) {

    $item_per_page = (!empty($_POST['per_page'])) ? $_POST['per_page'] : 6;
    $current_page = (!empty($_POST['page'])) ? $_POST['page'] : 1;

    $sortType = $_POST['sortType'];
    $txtSearch = $_POST['txtSearch'];
    // 
    $IDMH = (!empty($_POST['IDMH'])) ? $_POST['IDMH'] : '';
    $offset = ($current_page - 1) * $item_per_page;

    if (!empty($txtSearch) && empty($sortType)) {

        $select_order = "   SELECT * FROM don_hang as dh, khach_hang as kh 
                            WHERE dh.ma_kh = kh.ma_kh and (ten_kh LIKE N'%$txtSearch%' or ho_lot LIKE N'%$txtSearch%' or dia_chi_kh LIKE N'%$txtSearch%')";
        $page_order = "     SELECT * FROM don_hang as dh, khach_hang as kh 
                            WHERE dh.ma_kh = kh.ma_kh and (ten_kh LIKE N'%$txtSearch%' or ho_lot LIKE N'%$txtSearch%' or dia_chi_kh LIKE N'%$txtSearch%')
                            ORDER BY id_don_hang DESC LIMIT " . $item_per_page . " OFFSET " . $offset;
        $thongbao = "Kết quả tìm kiếm: " . "' $txtSearch '";
    } else if (empty($txtSearch) && empty($sortType)) {

        $select_order = "   SELECT * FROM don_hang as dh, khach_hang as kh 
                            WHERE dh.ma_kh = kh.ma_kh and dh.trang_thai = 'Đang chờ'";

        $page_order =   "   SELECT * FROM don_hang as dh, khach_hang as kh 
                            WHERE dh.ma_kh = kh.ma_kh and dh.trang_thai = 'Đang chờ'
                            ORDER BY id_don_hang DESC LIMIT " . $item_per_page . " OFFSET " . $offset;
    } else // SẮP XẾP 
        if (!empty($sortType)) {
            if ($sortType == 'new' && empty($txtSearch)) {

                $select_order =     "   SELECT * FROM don_hang as dh, khach_hang as kh 
                                        WHERE dh.ma_kh = kh.ma_kh and dh.trang_thai = 'Đang chờ'";

                $page_order = "         SELECT * FROM don_hang as dh, khach_hang as kh 
                                        WHERE dh.ma_kh = kh.ma_kh and dh.trang_thai = 'Đang chờ'
                                        ORDER BY id_don_hang DESC LIMIT " . $item_per_page . " OFFSET " . $offset;
                $thongbao = "Kết quả tìm kiếm cho: 'đơn hàng mới'.";
            } else  // SẮP XẾP
                if ($sortType == 'old' && empty($txtSearch)) {

                    $select_order =  "  SELECT * FROM don_hang as dh, khach_hang as kh WHERE dh.ma_kh = kh.ma_kh and dh.trang_thai = 'Xác nhận'";

                    $page_order = "     SELECT * FROM don_hang as dh, khach_hang as kh WHERE dh.ma_kh = kh.ma_kh and dh.trang_thai = 'Xác nhận'
                                        ORDER BY id_don_hang DESC LIMIT " . $item_per_page . " OFFSET " . $offset;
                    $thongbao = "Kết quả tìm kiếm cho: 'đơn hàng đã Xác nhận'.";
                } else   // SẮP XẾP 
                    if ($sortType == 'new' && !empty($txtSearch)) {

                        $select_order = "   SELECT  * FROM don_hang as dh, khach_hang as kh
                                            WHERE   dh.ma_kh = kh.ma_kh and (ten_kh LIKE N'%$txtSearch%' or ho_lot LIKE N'%$txtSearch%' or dia_chi_kh LIKE N'%$txtSearch%')
                                                    and dh.trang_thai = 'Đang chờ'";

                        $page_order = "     SELECT  * FROM don_hang as dh, khach_hang as kh
                                            WHERE   dh.ma_kh = kh.ma_kh and (ten_kh LIKE N'%$txtSearch%' or ho_lot LIKE N'%$txtSearch%' or dia_chi_kh LIKE N'%$txtSearch%')
                                                    and dh.trang_thai = 'Đang chờ'
                                            ORDER BY id_don_hang DESC LIMIT " . $item_per_page . " OFFSET " . $offset;
                        $thongbao = "Kết quả tìm kiếm đơn hàng: " . "' $txtSearch '" . " mới";
                    } else // SẮP XẾP 
                        if ($sortType == 'old' && !empty($txtSearch)) {
                            $select_order =  "  SELECT  * FROM don_hang as dh, khach_hang as kh 
                                                WHERE   dh.ma_kh = kh.ma_kh and 
                                                        (ten_kh LIKE N'%$txtSearch%' or ho_lot LIKE N'%$txtSearch%' or dia_chi_kh LIKE N'%$txtSearch%')
                                                        and trang_thai = 'Xác nhận'";

                            $page_order = "     SELECT  * FROM don_hang as dh, khach_hang as kh 
                                                WHERE   dh.ma_kh = kh.ma_kh and 
                                                        (ten_kh LIKE N'%$txtSearch%' or ho_lot LIKE N'%$txtSearch%' or dia_chi_kh LIKE N'%$txtSearch%')
                                                        and trang_thai = 'Xác nhận'
                                                ORDER BY id_don_hang DESC LIMIT " . $item_per_page . " OFFSET " . $offset;

                            $thongbao = "Kết quả tìm kiếm đơn hàng: " . "' $txtSearch '" . " đã xác nhận";
                        }
        }


    $offset = ($current_page - 1) * $item_per_page;
    $totalRecords = mysqli_query($conn, $select_order);
    $totalRecords = $totalRecords->num_rows;
    $totalPages = ceil($totalRecords / $item_per_page);
    $orders = mysqli_query($conn,  $page_order);

    if ($orders->num_rows > 0) { ?>
        <table class="table table-hover"">
        <caption class="pb-2 border-bottom mb-2 font-weight-bold">Danh sách đơn hàng <?= isset($thongbao) ? " - " . $thongbao : ""; ?></caption>
            <thead style="background: #008776; color:#FFF">
                <tr class="product-item-content">
                    <td class="prop">Mã DH</td>
                    <td class="prop" colspan="2">Tên khách hàng</td>
                    <td class="prop">SĐT</td>
                    <td class="prop">Địa chỉ</td>
                    <td class="prop">Tổng tiền</td>
                    <td class="prop">Ghi chú</td>
                    <td class="prop">Thời gian đặt</td>
                    <td colspan="2" class="prop">Thao tác</td>
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
                        <a class="btn btn-sm shadow-sm text-info" href="order_detail.php?id=<?= $row['id_don_hang'] ?>"> xem</a>
                        <?php
                        if ($row['trang_thai'] == "Xác nhận") {
                            echo '<a class="btn btn-sm shadow-sm text-success">Xác nhận ✔</a>';
                        } else { ?>
                            <a class="btn btn-sm shadow-sm text-danger" href="accept_order.php?id=<?= $row['id_don_hang'] ?>" onclick="return confirm('Xác nhận đơn hàng')"><?= $row['trang_thai'] ?> ↺</a>
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
        echo "<p class='text-center'>Không tìm thấy đơn hàng!</p>";
    }
}
?>
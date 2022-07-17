<?php
include '../connect_db.php';
if (isset($_POST['IDTH']) && isset($_POST['txtSearch']) && isset($_POST['IDMH'])) {
    $IDTH = $_POST['IDTH'];
    $IDMH = $_POST['IDMH'];
    $txtSearch = $_POST['txtSearch'];

    $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 2;
    $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $offset = ($current_page - 1) * $item_per_page;

    if (empty($IDTH)) {
        $select_Product = " SELECT * 
                            FROM san_pham as sp, danh_muc_thuong_hieu as dmth 
                            WHERE sp.id_thuong_hieu = dmth.id_thuong_hieu and sp.id_mat_hang = '$IDMH'
                            and ten_san_pham LIKE N'%$txtSearch%'";

        $page_Product = "   SELECT *
                            FROM san_pham as sp, danh_muc_thuong_hieu as dmth 
                            WHERE sp.id_thuong_hieu = dmth.id_thuong_hieu and sp.id_mat_hang = '$IDMH'
                                    and ten_san_pham LIKE N'%$txtSearch%'
                            ORDER BY id_san_pham DESC LIMIT " . $item_per_page . " OFFSET " . $offset;
    } else {
        $select_Product = " SELECT *
                            FROM san_pham as sp, danh_muc_thuong_hieu as dmth
                            WHERE sp.id_thuong_hieu = dmth.id_thuong_hieu and dmth.id_thuong_hieu = '$IDTH' 
                                    and ten_san_pham LIKE N'%$txtSearch%'  and sp.id_mat_hang = '$IDMH'";

        $page_Product = "   SELECT *
                            FROM san_pham as sp, danh_muc_thuong_hieu as dmth
                            WHERE sp.id_thuong_hieu = dmth.id_thuong_hieu and dmth.id_thuong_hieu = '$IDTH' 
                                    and sp.id_mat_hang = '$IDMH' and ten_san_pham LIKE N'%$txtSearch%' 
                            ORDER BY id_san_pham DESC LIMIT " . $item_per_page . " OFFSET " . $offset;
    }

    $find_product = mysqli_query($conn, $select_Product);
    $find_product =  $find_product->num_rows;
    $totalPages = ceil($find_product / $item_per_page);
    $find_product = mysqli_query($conn, $page_Product);
    if ($find_product->num_rows > 0) { ?>
        <table class="table table-hover"">
        <caption class="pb-2 border-bottom mb-2 font-weight-bold">Danh sách <?= $IDMH == 'PHUKIEN' ? 'Phụ kiện' : $IDMH; ?></caption>
            <thead style="background: #008776; color:#FFF">
                <tr>
                    <th scope="col" style="width: 5%">#</th>
                    <th scope="col" colspan="2">Sản phẩm</th>
                    <th scope="col" style="width: 10%">Hãng</th>
                    <th scope="col" style="width: 10%">Giá bán</th>
                    <th scope="col" style="width: 10%">Giảm giá</th>
                    <th scope="col" style="width: 20%">Nội dung</th>
                    <th scope="col" style="width: 5%">Pay</th>
                    <th scope="col" style="width: 10%">Ngày cập nhật</th>
                    <th scope="col" style="width: 10%">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stt = 0;
                foreach ($find_product as $row) :
                    ++$stt;
                ?>
                    <tr>
                        <td><?= $stt ?></td>
                        <td class="product-img">
                            <img src="../<?= $row['hinh_anh'] ?>" alt="<?= $row['ten_san_pham'] ?>" title="<?= $row['ten_san_pham'] ?>" />
                        </td>
                        <td><?= $row['ten_san_pham'] ?></td>
                        <td><?= $row['ten_thuong_hieu'] ?></td>
                        <td><?= number_format($row['gia_ban'], 0, ',', '.') ?>đ</td>
                        <td><?= number_format($row['giam_gia'], 0, ',', '.') ?>đ</td>
                        <td><?= $row['noi_dung'] ?></td>
                        <td><?= $row['pay'] ?></td>
                        <td><?= date("d-m-Y h:i", strtotime($row['ngay_cap_nhat'])) ?></td>
                        <td>
                            <a class="btn btn-sm btn-success" href="./product_modify.php?id=<?= $row['id_san_pham'] ?>"><i class="far fa-edit"></i></a>
                            <a class="btn btn-sm btn-danger" href="./phone_listing.php?action=del&id=<?= $row['id_san_pham'] ?>" onclick="return confirm('Bạn muốn xoá sản phẩm này này?')">
                                <i class="far fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                <?php
                endforeach;
                ?>
            </tbody>
        </table>
        <?php
        include '../pagination/'.strtolower($IDMH).'_pagination.php';
        ?>
<?php  } else {
        echo "<p class='text-center'>Không tìm thấy sản phẩm!</p>";
    }
}
?>
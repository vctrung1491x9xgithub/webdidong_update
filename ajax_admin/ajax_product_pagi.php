<?php
include '../connect_db.php';
if (isset($_POST['per_page'])  && isset($_POST['page']) && isset($_POST['IDTH'])  && isset($_POST['txtSearch']) && isset($_POST['IDMH'])) {

    $item_per_page = (!empty($_POST['per_page'])) ? $_POST['per_page'] : 2;
    $current_page = (!empty($_POST['page'])) ? $_POST['page'] : 1;

    $IDTH = $_POST['IDTH'];
    $txtSearch = $_POST['txtSearch'];
    // 
    $IDMH = (!empty($_POST['IDMH'])) ? $_POST['IDMH'] : '';
    $offset = ($current_page - 1) * $item_per_page;
    
    // Function
    // CASE_1
    function totalRecords_case_1($IDMH)
    {
        return "SELECT * FROM san_pham WHERE id_mat_hang = '$IDMH'";
    }
    function products_case_1($IDMH, $item_per_page, $offset)
    {
        return "    SELECT *
                    FROM san_pham as sp, danh_muc_thuong_hieu as dmth
                    WHERE sp.id_thuong_hieu = dmth.id_thuong_hieu and sp.id_mat_hang = '$IDMH'  
                    ORDER BY id_san_pham DESC LIMIT " . $item_per_page . " OFFSET " . $offset;
    }
    // CASE_2
    function totalRecords_case_2($IDTH, $IDMH)
    {
        return "    SELECT *
                    FROM san_pham as sp, danh_muc_thuong_hieu as dmth
                    WHERE sp.id_thuong_hieu = dmth.id_thuong_hieu and dmth.id_thuong_hieu = '$IDTH'  and sp.id_mat_hang = '$IDMH'";
    }
    function products_case_2($IDTH, $IDMH, $item_per_page, $offset)
    {
        return "    SELECT *
                    FROM san_pham as sp, danh_muc_thuong_hieu as dmth
                    WHERE sp.id_thuong_hieu = dmth.id_thuong_hieu and dmth.id_thuong_hieu = '$IDTH'  and sp.id_mat_hang = '$IDMH'
                    ORDER BY id_san_pham DESC LIMIT " . $item_per_page . " OFFSET " . $offset;
    }
    // CASE_3
    function totalRecords_case_3($IDMH, $txtSearch)
    {
        return "    SELECT *
                    FROM san_pham as sp, danh_muc_thuong_hieu as dmth
                    WHERE sp.id_thuong_hieu = dmth.id_thuong_hieu and  ten_san_pham LIKE N'%$txtSearch%' and sp.id_mat_hang = '$IDMH'";
    }
    function products_case_3($IDMH, $txtSearch, $item_per_page, $offset)
    {
        return "    SELECT *
                    FROM san_pham as sp, danh_muc_thuong_hieu as dmth
                    WHERE sp.id_thuong_hieu = dmth.id_thuong_hieu and ten_san_pham LIKE N'%$txtSearch%' and sp.id_mat_hang = '$IDMH'
                    ORDER BY id_san_pham DESC LIMIT " . $item_per_page . " OFFSET " . $offset;
    }
    // CASE_4
    function totalRecords_case_4($IDTH, $IDMH, $txtSearch)
    {
        return "    SELECT *
                    FROM san_pham as sp, danh_muc_thuong_hieu as dmth
                    WHERE sp.id_thuong_hieu = dmth.id_thuong_hieu and dmth.id_thuong_hieu = '$IDTH' 
                            and ten_san_pham LIKE N'%$txtSearch%'  and sp.id_mat_hang = '$IDMH'";
    }
    function products_case_4($IDTH, $IDMH, $txtSearch, $item_per_page, $offset)
    {
        return  "   SELECT *
                    FROM san_pham as sp, danh_muc_thuong_hieu as dmth
                    WHERE sp.id_thuong_hieu = dmth.id_thuong_hieu and dmth.id_thuong_hieu = '$IDTH' and ten_san_pham LIKE N'%$txtSearch%'  and sp.id_mat_hang = '$IDMH'
                    ORDER BY id_san_pham DESC LIMIT " . $item_per_page . " OFFSET " . $offset;
    }

    // CASE_1
    if (empty($IDTH) && empty($txtSearch)) {
        // 
        $totalRecords = totalRecords_case_1($IDMH);
        $products =     products_case_1($IDMH, $item_per_page, $offset);
        // 
    }
    // CASE_2
    elseif (!empty($IDTH) && empty($txtSearch)) {
        // 
        $totalRecords = totalRecords_case_2($IDTH, $IDMH);
        $products = products_case_2($IDTH, $IDMH, $item_per_page, $offset);
        // 
    } elseif (empty($IDTH) && !empty($txtSearch)) {
        // 
        $totalRecords = totalRecords_case_3($IDMH, $txtSearch);
        $products = products_case_3($IDMH, $txtSearch, $item_per_page, $offset);
        // 
    } else {
        // 
        $totalRecords = totalRecords_case_4($IDTH, $IDMH, $txtSearch);
        $products =  products_case_4($IDTH, $IDMH, $txtSearch, $item_per_page, $offset);
        // 
    }

    $offset = ($current_page - 1) * $item_per_page;
    $totalRecords = mysqli_query($conn, $totalRecords);
    $totalRecords = $totalRecords->num_rows;
    $totalPages = ceil($totalRecords / $item_per_page);
    $products = mysqli_query($conn,  $products);

    if ($products->num_rows > 0) { ?>
        <table class="table table-hover"">
        <caption class="pb-2 border-bottom mb-2 font-weight-bold">Danh sách <?= $IDMH == 'PHUKIEN' ? 'Phụ kiện' : $IDMH; ?> </caption>
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
                foreach ($products as $row) :
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
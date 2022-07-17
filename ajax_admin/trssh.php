<?php
include '../connect_db.php';
if(isset($_POST['IDTH'])) {
    $IDTH = $_POST['IDTH'];
    if($IDTH =='') {
        $find_product = mysqli_query($conn, "   SELECT * FROM san_pham as sp 
                                                WHERE sp.id_mat_hang = 'PHONE'");
        $find_product =  $find_product->num_rows;
        $totalPages = ceil($find_product / $item_per_page);
        $find_product = mysqli_query($conn, "   SELECT * FROM san_pham as sp
                                                WHERE   sp.id_mat_hang = 'PHONE'
                                                ORDER BY id_san_pham DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
    }
}
?>
<table class="table table-hover"">
    <caption class=" mb-1 font-weight-bold">Danh sách điện thoại </caption>
    <thead style="background: #008776; color:#FFF">
        <tr>
            <th>#</th>
            <th scope="col" colspan="2">Sản phẩm</th>
            <th scope="col">Hãng</th>
            <th scope="col">Giá bán</th>
            <th scope="col">Giảm giá</th>
            <th scope="col">Nội dung</th>
            <th scope="col">Pay</th>
            <th scope="col" style="width: 10%">Ngày cập nhật</th>
            <th colspan="2">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <!-- PHP TÌM KIẾM -->
        <?php
        if (isset($_POST['btn-find'])) {
            $thuonghieu = $_POST['thuonghieu'];
            $findbyname = $_POST['findByName'];
            if (empty($thuonghieu) && empty($findbyname)) {
                echo   '<script>
                                            document.getElementById("modal-custom-title").innerHTML = "THÔNG BÁO LỖI!";
                                            document.getElementById("doc").innerHTML = "Bạn chưa nhập thông tin tìm kiếm!";
                                            var modal = document.getElementById("myModal");
                                            var span = document.getElementsByClassName("modal-custom-close")[0];
                                            modal.classList.add("mystyle");
                                            span.onclick = function() {
                                                window.location.href="./phone_listing.php";
                                            }
                                            window.onclick = function(event) {
                                                if (event.target == modal) {
                                                    modal.classList.remove("mystyle");
                                                }
                                            }
                                        </script>';
            } else
                    if (isset($thuonghieu) && isset($findbyname)) {

                $select_thuonghieu = mysqli_query($conn, "SELECT * FROM danh_muc_thuong_hieu WHERE id_thuong_hieu = '$thuonghieu'");
                $select_thuonghieu = mysqli_fetch_assoc($select_thuonghieu);
                $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 8;

                // TÌM KIẾM TẤT CẢ THEO THƯƠNG HIỆU
                if (!empty($thuonghieu) && empty($findbyname)) {
                    $select_Product = " SELECT * FROM san_pham as sp, danh_muc_mat_hang as dmmh, danh_muc_thuong_hieu as dmth 
                                                    WHERE   sp.id_mat_hang = dmmh.id_mat_hang and sp.id_thuong_hieu = dmth.id_thuong_hieu and 
                                                            sp.id_thuong_hieu = '$thuonghieu'";

                    $page_Product = "    SELECT * FROM san_pham as sp, danh_muc_mat_hang as dmmh, danh_muc_thuong_hieu as dmth 
                                                    WHERE   sp.id_mat_hang = dmmh.id_mat_hang and sp.id_thuong_hieu = dmth.id_thuong_hieu 
                                                            and sp.id_thuong_hieu = '$thuonghieu'
                                                            ORDER BY id_san_pham DESC LIMIT " . $item_per_page . " OFFSET " . $offset;

                    $thongbao = "Kết quả tìm kiếm cho sản phẩm có thương hiệu: " . "' " . $select_thuonghieu['ten_thuong_hieu'] . " '";
                }
                //  TIỀM KIẾM TẤT CẢ THEO TÊN
                else if (empty($thuonghieu) && !empty($findbyname)) {
                    $select_Product = " SELECT * FROM san_pham as sp, danh_muc_mat_hang as dmmh, danh_muc_thuong_hieu as dmth 
                                                    WHERE sp.id_mat_hang = dmmh.id_mat_hang and sp.id_thuong_hieu = dmth.id_thuong_hieu 
                                                    and ten_san_pham LIKE N'%$findbyname%'";

                    $page_Product = "   SELECT * FROM san_pham as sp, danh_muc_mat_hang as dmmh, danh_muc_thuong_hieu as dmth 
                                                    WHERE   sp.id_mat_hang = dmmh.id_mat_hang and sp.id_thuong_hieu = dmth.id_thuong_hieu 
                                                            and ten_san_pham LIKE N'%$findbyname%'
                                                            ORDER BY id_san_pham DESC LIMIT " . $item_per_page . " OFFSET " . $offset;

                    $thongbao = "Kết quả tìm kiếm cho từ khoá: " . "' " . $findbyname . " '";
                }

                // TÌM KIẾM TẤT CẢ THEO THƯƠNG HIỆU + TỪ KHOÁ
                else if (!empty($thuonghieu) && !empty($findbyname)) {
                    $select_Product = " SELECT * FROM san_pham as sp, danh_muc_mat_hang as dmmh, danh_muc_thuong_hieu as dmth 
                                                    WHERE sp.id_mat_hang = dmmh.id_mat_hang and sp.id_thuong_hieu = dmth.id_thuong_hieu 
                                                    and sp.id_thuong_hieu = '$thuonghieu' and ten_san_pham LIKE N'%$findbyname%'";

                    $page_Product = "   SELECT * FROM san_pham as sp, danh_muc_mat_hang as dmmh, danh_muc_thuong_hieu as dmth 
                                                    WHERE sp.id_mat_hang = dmmh.id_mat_hang and sp.id_thuong_hieu = dmth.id_thuong_hieu 
                                                    and sp.id_thuong_hieu = '$thuonghieu' and ten_san_pham LIKE N'%$findbyname%'
                                                    ORDER BY id_san_pham DESC LIMIT " . $item_per_page . " OFFSET " . $offset;

                    $thongbao = "Kết quả tìm kiếm sản phẩm: " . "' " . $select_thuonghieu['ten_thuong_hieu'] . " '" . "với từ khoá " . "' " . $findbyname . " '";
                }

                $find_product = mysqli_query($conn, $select_Product);
                $find_product =  $find_product->num_rows;
                $totalPages = ceil($find_product / $item_per_page);
                $find_product = mysqli_query($conn, $page_Product);


                // END TRUY VẤN TÌM KIẾM
                $numrow = mysqli_num_rows($find_product);
                if ($numrow > 0) {
                    $stt = 0;
                    echo "<p class='p-3'><b>$thongbao</b></p>";
                    while ($result_find = mysqli_fetch_array($find_product)) {
                        ++$stt;
        ?>
                        <tr>
                            <td class="align-middle text-center"><?= $stt ?></td>
                            <td class="product-img">
                                <img src="../<?= $result_find['hinh_anh'] ?>" alt="<?= $result_find['ten_san_pham'] ?>" title="<?= $result_find['ten_san_pham'] ?>" />
                            </td>
                            <td><?= $result_find['ten_san_pham'] ?></td>
                            <td><?= $result_find['ten_thuong_hieu'] ?></td>
                            <td><?= number_format($result_find['gia_ban'], 0, ',', '.') ?>đ</td>
                            <td><?= number_format($result_find['giam_gia'], 0, ',', '.') ?>đ</td>
                            <td><?= $result_find['noi_dung'] ?></td>
                            <td><?= $result_find['pay'] ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($result_find['ngay_cap_nhat'])) ?></td>
                            <td>
                                <a href="./product_modify.php?id=<?= $result_find['id_san_pham'] ?>"><img src="../images/editpd.png" alt=""></a>
                            </td>
                            <td class="product-button">
                                <a href="./product_listing.php?id=<?= $result_find['id_san_pham'] ?>" onclick="return confirm('Bạn muốn xoá sản phẩm này này?')"><img src="../images/bin2.png" alt=""></a>
                            </td>
                        </tr>
                <?php }
                } else {
                    echo '<script>
                                                document.getElementById("modal-custom-title").innerHTML = "THÔNG BÁO!";
                                                document.getElementById("doc").innerHTML = "Không tìm thấy sản phẩm!";
                                                var modal = document.getElementById("myModal");
                                                var span = document.getElementsByClassName("modal-custom-close")[0];
                                                modal.classList.add("mystyle");
                                                span.onclick = function() {
                                                    window.location.href="product_listing.php";
                                                }
                                                window.onclick = function(event) {
                                                    if (event.target == modal) {
                                                        modal.classList.remove("mystyle");
                                                    }
                                                }
                                            </script>';
                }
            }
        } else {
            $stt = 0;
            while ($row = mysqli_fetch_array($products)) {
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
                    </td>
                    <td class="product-button">
                        <a class="btn btn-sm btn-danger" href="./phone_listing.php?action=del&id=<?= $row['id_san_pham'] ?>" onclick="return confirm('Bạn muốn xoá sản phẩm này này?')">
                            <i class="far fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
        <?php }
        } ?>
    </tbody>
</table>
<?php
include '../pagination.php';
?>
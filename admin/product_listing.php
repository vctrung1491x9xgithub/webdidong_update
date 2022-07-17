<?php
include 'header.php';
include './adding.php';
if (!empty($_SESSION['current_admin'])) {
    $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 4;
    $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $offset = ($current_page - 1) * $item_per_page;
    $totalRecords = mysqli_query($conn, "SELECT * FROM san_pham ");
    $totalRecords = $totalRecords->num_rows;
    $totalPages = ceil($totalRecords / $item_per_page);
    $products = mysqli_query($conn, "SELECT * FROM san_pham as sp, danh_muc_thuong_hieu as dmth WHERE sp.id_thuong_hieu = dmth.id_thuong_hieu
                                         ORDER BY id_san_pham DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
?>
    <div class="framework ">
        <div class="breadcrumb bg-transparent p-2 m-0 mb-3 shadow-sm">
            <h1><i class="fas fa-home text-secondary"></i> &#10095; <a href=""> Quản lý sản phẩm</a> &#10095; <span class="font-weight-bold">Danh sách điện thoại</span></h1>
        </div>
        <!-- <div class="bread-cump">
            <p style="font-size:18px;font-weight:600">Danh sách điện thoại</p>
            <p><span><a href="user_listing.php">Home</a> / <b>Danh sách điện thoại</b></span></p> 
        </div> -->
        <!-- TIỀM KIẾM -->
        <div class="d-flex justify-content-between">
            <form action="product_listing.php" class="find d-inline-block px-3 mb-2" method="post">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="find-box d-flex flex-column mr-5 mb-2">
                        <label class="mb-2 font-weight-bold">Loại:</label>
                        <select id="product-type" name="product-type">
                            <option value="" selected>--Chọn sản phẩm--</option>
                            <?php
                            $mat_hang = mysqli_query($conn, "SELECT * FROM danh_muc_mat_hang");
                            while ($row = mysqli_fetch_array($mat_hang)) { ?>
                                <option value="<?= $row['id_mat_hang'] ?>"><?= $row['ten_mat_hang'] ?></option>
                            <?php }
                            ?>
                        </select>
                    </div>
                    <div class="find-box d-flex flex-column mr-5 mb-2">
                        <label class="mb-2 font-weight-bold">Thương hiệu:</label>
                        <select id="trademark" name="trademark">
                            <option value="" selected>--Chọn thương hiệu--</option>
                            <?php
                            $thuong_hieu = mysqli_query($conn, "SELECT * FROM danh_muc_thuong_hieu");
                            while ($row = mysqli_fetch_array($thuong_hieu)) { ?>
                                <option value="<?= $row['id_thuong_hieu'] ?>"><?= $row['ten_thuong_hieu'] ?></option>
                            <?php }
                            ?>
                        </select>
                    </div>
                    <div class="find-box d-flex flex-column mr-5 mb-2">
                        <label class="mb-2 font-weight-bold"> Tìm kiếm theo tên:</label>
                        <input type="text" name="findByName" placeholder="Nhập tên sản phẩm">
                    </div>
                    <div class="find-box d-flex flex-column ">
                        <button class="mt-3 btn btn-find" type="submit" name="btn-find"><i class="fas fa-search"></i> Tìm</button>
                    </div>
                </div>
            </form>
            <div class="d-flex align-items-center">
                <button class="btn btn-sm bg-white border-warning" data-toggle="modal" data-target="#ModalAddPhone">Thêm mới</button>
            </div>
        </div>
        <!-- END TIỀM KIẾM -->
        <div class="table-responsive-lg p-2 bg-white shadow-sm">
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
                        $loaisanpham = $_POST['product-type'];
                        $thuonghieu = $_POST['trademark'];
                        $findbyname = $_POST['findByName'];
                        if (empty($loaisanpham) && empty($thuonghieu) && empty($findbyname)) {
                            echo   '<script>
                                            document.getElementById("modal-custom-title").innerHTML = "THÔNG BÁO LỖI!";
                                            document.getElementById("doc").innerHTML = "Bạn chưa nhập thông tin tìm kiếm!";
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
                        } else
                            if (isset($loaisanpham) && isset($thuonghieu) && isset($findbyname)) {

                            $select_loaisp = mysqli_query($conn, "SELECT * FROM danh_muc_mat_hang WHERE id_mat_hang = '$loaisanpham'");
                            $select_loaisp = mysqli_fetch_assoc($select_loaisp);

                            $select_thuonghieu = mysqli_query($conn, "SELECT * FROM danh_muc_thuong_hieu WHERE id_thuong_hieu = '$thuonghieu'");
                            $select_thuonghieu = mysqli_fetch_assoc($select_thuonghieu);

                            $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 8;
                            // TÌM  KIẾM TẤT CẢ THEO LOẠI SẢN PHẨM
                            if (!empty($loaisanpham) && empty($thuonghieu) && empty($findbyname)) {
                                $find_product = mysqli_query($conn, "SELECT * FROM san_pham as sp, danh_muc_mat_hang as dmmh, danh_muc_thuong_hieu as dmth 
                                    WHERE sp.id_mat_hang = dmmh.id_mat_hang and sp.id_thuong_hieu = dmth.id_thuong_hieu and sp.id_mat_hang = '$loaisanpham'");

                                $find_product =  $find_product->num_rows;
                                $totalPages = ceil($find_product / $item_per_page);
                                $find_product = mysqli_query($conn, "SELECT * FROM san_pham as sp, danh_muc_mat_hang as dmmh, danh_muc_thuong_hieu as dmth 
                                    WHERE sp.id_mat_hang = dmmh.id_mat_hang and sp.id_thuong_hieu = dmth.id_thuong_hieu and sp.id_mat_hang = '$loaisanpham'
                                    ORDER BY id_san_pham DESC LIMIT " . $item_per_page . " OFFSET " . $offset);

                                $thongbao = "Kết quả tìm kiếm cho loại sản phẩm là: " . "' " . $select_loaisp['ten_mat_hang'] . " '";
                            }
                            // TÌM KIẾM TẤT CẢ THEO THƯƠNG HIỆU
                            else if (empty($loaisanpham) && !empty($thuonghieu) && empty($findbyname)) {
                                $find_product = mysqli_query($conn, "SELECT * FROM san_pham as sp, danh_muc_mat_hang as dmmh, danh_muc_thuong_hieu as dmth 
                                    WHERE sp.id_mat_hang = dmmh.id_mat_hang and sp.id_thuong_hieu = dmth.id_thuong_hieu and sp.id_thuong_hieu = '$thuonghieu'");

                                $find_product =  $find_product->num_rows;
                                $totalPages = ceil($find_product / $item_per_page);
                                $find_product = mysqli_query($conn, "SELECT * FROM san_pham as sp, danh_muc_mat_hang as dmmh, danh_muc_thuong_hieu as dmth 
                                    WHERE sp.id_mat_hang = dmmh.id_mat_hang and sp.id_thuong_hieu = dmth.id_thuong_hieu and sp.id_thuong_hieu = '$thuonghieu'
                                    ORDER BY id_san_pham DESC LIMIT " . $item_per_page . " OFFSET " . $offset);

                                $thongbao = "Kết quả tìm kiếm cho sản phẩm có thương hiệu: " . "' " . $select_thuonghieu['ten_thuong_hieu'] . " '";
                            }
                            //  TIỀM KIẾM TẤT CẢ THEO TÊN
                            else if (empty($loaisanpham) && empty($thuonghieu) && !empty($findbyname)) {
                                $find_product = mysqli_query($conn, "SELECT * FROM san_pham as sp, danh_muc_mat_hang as dmmh, danh_muc_thuong_hieu as dmth 
                                    WHERE sp.id_mat_hang = dmmh.id_mat_hang and sp.id_thuong_hieu = dmth.id_thuong_hieu and ten_san_pham LIKE N'%$findbyname%'");

                                $find_product =  $find_product->num_rows;
                                $totalPages = ceil($find_product / $item_per_page);
                                $find_product = mysqli_query($conn, "SELECT * FROM san_pham as sp, danh_muc_mat_hang as dmmh, danh_muc_thuong_hieu as dmth 
                                    WHERE sp.id_mat_hang = dmmh.id_mat_hang and sp.id_thuong_hieu = dmth.id_thuong_hieu and ten_san_pham LIKE N'%$findbyname%'
                                    ORDER BY id_san_pham DESC LIMIT " . $item_per_page . " OFFSET " . $offset);

                                $thongbao = "Kết quả tìm kiếm cho từ khoá: " . "' " . $findbyname . " '";
                            }

                            // TÌM KIẾM TẤT CẢ THEO LOẠI SẢN PHẨM + THƯƠNG HIỆU
                            else if (!empty($loaisanpham) && !empty($thuonghieu) && empty($findbyname)) {
                                $find_product = mysqli_query($conn, "SELECT * FROM san_pham as sp, danh_muc_mat_hang as dmmh, danh_muc_thuong_hieu as dmth 
                                    WHERE sp.id_mat_hang = dmmh.id_mat_hang and sp.id_thuong_hieu = dmth.id_thuong_hieu 
                                    and sp.id_mat_hang = '$loaisanpham' and sp.id_thuong_hieu = '$thuonghieu'");

                                $find_product =  $find_product->num_rows;
                                $totalPages = ceil($find_product / $item_per_page);

                                $find_product = mysqli_query($conn, "SELECT * FROM san_pham as sp, danh_muc_mat_hang as dmmh, danh_muc_thuong_hieu as dmth 
                                    WHERE sp.id_mat_hang = dmmh.id_mat_hang and sp.id_thuong_hieu = dmth.id_thuong_hieu and sp.id_mat_hang = '$loaisanpham' and sp.id_thuong_hieu = '$thuonghieu'
                                    ORDER BY id_san_pham DESC LIMIT " . $item_per_page . " OFFSET " . $offset);

                                $thongbao = "Kết quả tìm kiếm sản phẩm: " . "' " . $select_loaisp['ten_mat_hang'] . " '" . " của " . "' " . $select_thuonghieu['ten_thuong_hieu'] . " '";
                            }

                            // TÌM KIẾM TẤT CẢ THEO LOẠI SẢN PHẨM + TỪ KHOÁ
                            else if (!empty($loaisanpham) && empty($thuonghieu) && !empty($findbyname)) {
                                $find_product = mysqli_query($conn, "SELECT * FROM san_pham as sp, danh_muc_mat_hang as dmmh, danh_muc_thuong_hieu as dmth 
                                    WHERE sp.id_mat_hang = dmmh.id_mat_hang and sp.id_thuong_hieu = dmth.id_thuong_hieu 
                                    and sp.id_mat_hang = '$loaisanpham' and ten_san_pham LIKE N'%$findbyname%'");

                                $find_product =  $find_product->num_rows;
                                $totalPages = ceil($find_product / $item_per_page);

                                $find_product = mysqli_query($conn, "SELECT * FROM san_pham as sp, danh_muc_mat_hang as dmmh, danh_muc_thuong_hieu as dmth 
                                    WHERE sp.id_mat_hang = dmmh.id_mat_hang and sp.id_thuong_hieu = dmth.id_thuong_hieu 
                                    and sp.id_mat_hang = '$loaisanpham' and ten_san_pham LIKE N'%$findbyname%'
                                    ORDER BY id_san_pham DESC LIMIT " . $item_per_page . " OFFSET " . $offset);

                                $thongbao = "Kết quả tìm kiếm sản phẩm: " . "' " . $select_loaisp['ten_mat_hang'] . " '" . "với từ khoá " . "' " . $findbyname . " '";
                            }
                            // TÌM KIẾM TẤT CẢ THEO THƯƠNG HIỆU + TỪ KHOÁ
                            else if (empty($loaisanpham) && !empty($thuonghieu) && !empty($findbyname)) {
                                $find_product = mysqli_query($conn, "SELECT * FROM san_pham as sp, danh_muc_mat_hang as dmmh, danh_muc_thuong_hieu as dmth 
                                    WHERE sp.id_mat_hang = dmmh.id_mat_hang and sp.id_thuong_hieu = dmth.id_thuong_hieu 
                                    and sp.id_thuong_hieu = '$thuonghieu' and ten_san_pham LIKE N'%$findbyname%'");

                                $find_product =  $find_product->num_rows;
                                $totalPages = ceil($find_product / $item_per_page);

                                $find_product = mysqli_query($conn, "SELECT * FROM san_pham as sp, danh_muc_mat_hang as dmmh, danh_muc_thuong_hieu as dmth 
                                    WHERE sp.id_mat_hang = dmmh.id_mat_hang and sp.id_thuong_hieu = dmth.id_thuong_hieu 
                                    and sp.id_thuong_hieu = '$thuonghieu' and ten_san_pham LIKE N'%$findbyname%'
                                    ORDER BY id_san_pham DESC LIMIT " . $item_per_page . " OFFSET " . $offset);

                                $thongbao = "Kết quả tìm kiếm sản phẩm: " . "' " . $select_thuonghieu['ten_thuong_hieu'] . " '" . "với từ khoá " . "' " . $findbyname . " '";
                            }
                            // TÌM KIẾM TẤT CẢ THEO LOẠI SẢN PHẨM + THƯƠNG HIỆU + TỪ KHOÁ
                            else if (!empty($loaisanpham) && !empty($thuonghieu) && !empty($findbyname)) {
                                $find_product = mysqli_query($conn, "SELECT * FROM san_pham as sp, danh_muc_mat_hang as dmmh, danh_muc_thuong_hieu as dmth 
                                    WHERE sp.id_mat_hang = dmmh.id_mat_hang and sp.id_thuong_hieu = dmth.id_thuong_hieu and sp.id_mat_hang = '$loaisanpham' 
                                    and sp.id_thuong_hieu = '$thuonghieu' and ten_san_pham LIKE N'%$findbyname%'");

                                $find_product =  $find_product->num_rows;
                                $totalPages = ceil($find_product / $item_per_page);
                                $find_product = mysqli_query($conn, "SELECT * FROM san_pham as sp, danh_muc_mat_hang as dmmh, danh_muc_thuong_hieu as dmth 
                                    WHERE sp.id_mat_hang = dmmh.id_mat_hang and sp.id_thuong_hieu = dmth.id_thuong_hieu and sp.id_mat_hang = '$loaisanpham' 
                                    and sp.id_thuong_hieu = '$thuonghieu' and ten_san_pham LIKE N'%$findbyname%'
                                    ORDER BY id_san_pham DESC LIMIT " . $item_per_page . " OFFSET " . $offset);

                                $thongbao = "Kết quả tìm kiếm sản phẩm: " . "' " . $select_loaisp['ten_mat_hang'] . " '" . " của " . "' " . $select_thuonghieu['ten_thuong_hieu'] . " '" . " với từ khoá " . "' " . $findbyname . " '";
                            }
                            // END TRUY VẤN TÌM KIẾM
                            $numrow = mysqli_num_rows($find_product);
                            if ($numrow > 0) {
                                $stt = 0;
                                echo "<p style='margin:0px 5px 15px;font-size:20px'><b>$thongbao</b></p>";
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
        </div>

        <!-- CODE XOÁ SẢM PHẨM -->
    <?php

    $error = false;
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        include '../connect_db.php';
        $result = mysqli_query($conn, "DELETE FROM san_pham WHERE id_san_pham = " . $_GET['id']);
        if (!$result) {
            $error = "Không thể xóa sản phẩm.";
        }
        mysqli_close($conn);
        if ($error) {
            echo '<script>
                            document.getElementById("modal-custom-title").innerHTML = "THÔNG BÁO LỖI!";
                            document.getElementById("doc").innerHTML = "Xoá Sản phẩm KHÔNG thành công!";
                            var modal = document.getElementById("myModal");
                            var span = document.getElementsByClassName("modal-custom-close")[0];
                            modal.classList.add("mystyle");
                            span.onclick = function() {
                                window.location.href="phone_listing.php";
                            }
                            window.onclick = function(event) {
                                if (event.target == modal) {
                                    modal.classList.remove("mystyle");
                                }
                            }
                        </script>';
        } else {
            echo '<script>
                        document.getElementById("modal-custom-title").innerHTML = "THÔNG BÁO!";
                        document.getElementById("doc").innerHTML = "Xoá Sản phẩm thành công!";
                        var modal = document.getElementById("myModal");
                        var span = document.getElementsByClassName("modal-custom-close")[0];
                        modal.classList.add("mystyle");
                        span.onclick = function() {
                            window.location.href="phone_listing.php";
                        }
                        window.onclick = function(event) {
                            if (event.target == modal) {
                                modal.classList.remove("mystyle");
                            }
                        }
                    </script>';
        }
    }
}
include 'footer.php';
    ?>
    <!-- CODE XOÁ SẢM PHẨM -->
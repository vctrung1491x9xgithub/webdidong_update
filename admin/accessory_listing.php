<?php
include 'header.php';
if (!empty($_SESSION['current_admin'])) {
    include './adding.php';
?>
    <div class="framework ">
        <div class="breadcrumb bg-white p-2 m-0 mb-3 shadow-sm">
            <h1><i class="ti-home text-secondary"></i><span class="mx-2">&#10095;</span><a href=""> Quản lý sản phẩm</a><span class="mx-2">&#10095;</span><span class="font-weight-bold">Danh sách phụ kiện</span></h1>
        </div>
        <div class="d-flex justify-content-between">
            <form action="phone_listing.php" class="find d-inline-block mb-2" method="post">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="find-box d-flex flex-column mr-5 mb-2">
                        <label class="mb-2 font-weight-bold">Thương hiệu:</label>
                        <select id="thuonghieu" name="thuonghieu">
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
                        <input type="text" id="txtSearch" name="txtSearch" placeholder="Nhập tên sản phẩm">
                    </div>
                    <div class="find-box d-flex flex-column ">
                        <button class="mt-3 btn btn-find " type="submit" name="btn-find"><i class="fas fa-search"></i> Tìm</button>
                    </div>
                </div>
            </form>
            <div class="d-flex align-items-center">
                <button class="btn btn-sm bg-white shadow-sm font-weight-bold" data-toggle="modal" data-target="#ModalAddPhone">Thêm mới</button>
            </div>
        </div>
        <!-- END TIỀM KIẾM -->
        <div class="table-responsive-lg p-2 bg-white shadow-sm border border-success" id="tbl-phone-listing">
            <?php

            $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 6;
            $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
            $offset = ($current_page - 1) * $item_per_page;

            $IDMH = "PHUKIEN";

            $totalRecords = mysqli_query($conn, "SELECT * FROM san_pham WHERE id_mat_hang = '$IDMH'");
            $totalRecords = $totalRecords->num_rows;
            $totalPages = ceil($totalRecords / $item_per_page);
            $products = mysqli_query($conn, "   SELECT *
                                                 FROM san_pham as sp, danh_muc_thuong_hieu as dmth
                                                 WHERE sp.id_thuong_hieu = dmth.id_thuong_hieu and sp.id_mat_hang = '$IDMH'  
                                                         ORDER BY id_san_pham DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
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
                                    <a class="btn btn-sm btn-danger" href="./phukien_listing.php?action=del&id=<?= $row['id_san_pham'] ?>" onclick="return confirm('Bạn muốn xoá sản phẩm này này?')">
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
                include '../pagination/' . strtolower($IDMH) . '_pagination.php';
                ?>
            <?php  } else {
                echo "<p class='text-center'>Không tìm thấy sản phẩm!</p>";
            }

            ?>
        </div>
        <?php include 'footer.php'; ?>
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
                                window.location.href="phukien_listing.php";
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
                            window.location.href="phukien_listing.php";
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
?>
<!-- CODE XOÁ SẢM PHẨM -->
<script>
    $(document).on('change', '#thuonghieu', function() {
        var IDTH = $(this).val();
        var txtSearch = $("#txtSearch").val();
        var IDMH = "<?= $IDMH; ?>";
        $.ajax({
            url: "../ajax_admin/ajax_product_cbb_filter.php",
            data: {
                "IDTH": IDTH,
                "txtSearch": txtSearch,
                "IDMH": IDMH
            },
            dataType: "html",
            type: "post",
            success: function(data) {
                $('#tbl-phone-listing').html(data);

            }
        });
    });
    $(document).on('keyup', '#txtSearch', function() {
        var IDTH = $("#thuonghieu").val();
        var txtSearch = $(this).val();
        var IDMH = "<?= $IDMH; ?>";
        $.ajax({
            url: "../ajax_admin/ajax_product_input_filter.php",
            data: {
                "IDTH": IDTH,
                "txtSearch": txtSearch,
                "IDMH": IDMH
            },
            dataType: "html",
            type: "post",
            success: function(data) {
                $('#tbl-phone-listing').html(data);

            }
        });
    });
    // Phân trang
    // $('#pagination').on('click', '.page-item-click', function(e) {
    //     var per_page = $(this).data('perpage');
    //     var page = $(this).data('page');
    //     var IDTH = $("#thuonghieu").val();
    //     var txtSearch = $("#txtSearch").val();
    //     $.ajax({
    //         url: "../ajax_admin/ajax_product_pagi.php",
    //         data: {
    //             "per_page": per_page,
    //             "page": page,
    //             "IDTH": IDTH,
    //             "txtSearch": txtSearch
    //         },
    //         dataType: "html",
    //         type: "post",
    //         success: function(data) {
    //             $('#tbl-phone-listing').html(data);

    //         }
    //     });
    //     e.preventDefault();
    // });
</script>
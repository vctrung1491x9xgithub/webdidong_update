<?php
include './header.php';
if (!empty($_SESSION['current_admin'])) {
?>
    <div class="framework">
        <div class="breadcrumb bg-white p-2 m-0 mb-3 shadow-sm">
            <h1><i class="fas fa-home text-secondary"></i><span class="mx-2">&#10095;</span><a href=""> Quản lý bình luận</a><span class="mx-2">&#10095;</span><span class="font-weight-bold">Danh sách bình luận</span></h1>
        </div>
        <form action="#" class="find mb-2" method="post">
            <div class="d-flex flex-wrap align-items-center">
                <!-- <div class="find-box d-flex flex-column mr-5 mb-2">
                    <label class="mb-2 font-weight-bold">Phân loại: </label>
                    <select id="sortType" name="sort-type">
                        <option value="" selected>--Chọn hình thức--</option>
                        <option value="new">Đơn hàng mới</option>
                        <option value="old">Đơn hàng đã xác nhận</option>
                    </select>
                </div> -->
                <div class="find-box d-flex flex-column mr-5 mb-2">
                    <label class="mb-2 font-weight-bold">Tìm kiếm theo:</label>
                    <input type="text" name="txtSearch" id="txtSearch" placeholder="Tên người dùng, tên sản phẩm">
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
            if (isset($_POST['btn-find'])) {
                $tukhoa = $_POST['txtSearch'];
                $totalRecords = mysqli_query($conn, "   SELECT * 
                                                    FROM binh_luan_san_pham as b, khach_hang as kh, san_pham as s
                                                    WHERE b.ma_kh = kh.ma_kh and b.id_san_pham = s.id_san_pham 
                                                        and ( ten_san_pham LIKE N'%$tukhoa%' or ho_lot LIKE N'%$tukhoa%' OR ten_kh LIKE N'%$tukhoa%')");

                $totalRecords = $totalRecords->num_rows;
                $totalPages = ceil($totalRecords / $item_per_page);
                $comments = mysqli_query($conn, "  SELECT * 
                                                    FROM binh_luan_san_pham as b, khach_hang as kh, san_pham as s
                                                    WHERE b.ma_kh = kh.ma_kh and b.id_san_pham = s.id_san_pham 
                                                        and ( ten_san_pham LIKE N'%$tukhoa%' or ho_lot LIKE N'%$tukhoa%' OR ten_kh LIKE N'%$tukhoa%')
                                    ORDER BY id_binh_luan DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
            } else {
                $totalRecords = mysqli_query($conn, "   SELECT * 
                                            FROM binh_luan_san_pham as b, khach_hang as kh, san_pham as s
                                            WHERE b.ma_kh = kh.ma_kh and b.id_san_pham = s.id_san_pham ");
                $totalRecords = $totalRecords->num_rows;
                $totalPages = ceil($totalRecords / $item_per_page);
                $comments = mysqli_query($conn, "   SELECT * 
                                            FROM binh_luan_san_pham as b, khach_hang as kh, san_pham as s
                                            WHERE b.ma_kh = kh.ma_kh and b.id_san_pham = s.id_san_pham 
                                            ORDER BY id_binh_luan DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
            }


            if ($comments->num_rows > 0) { ?>
                <table class="table table-hover"">
                    <caption class=" border-bottom pb-2 mb-2 font-weight-bold"><span>Danh sách bình luận</span></caption>
                    <thead style="background: #008776; color:#FFF">
                        <tr class="product-item-content">
                            <td style="width: 5%">#</td>
                            <td colspan="2">Nội dung bình luận</td>
                            <td style="width: 20%">Sản phẩm bình luận</td>
                            <td style="width: 10%">Người dùng</td>
                            <td style="width: 10%">Thời gian</td>
                            <td style="width: 15%">Thao tác</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($comments as $key => $row) :
                        ?>
                            <tr>
                                <td class=""><?= $key + 1 ?></td>
                                <td class="" colspan="2"><?= $row['noi_dung_binh_luan'] ?></td>
                                <td class="">
                                    <img width="50px" class="mr-2" src="../<?= $row['hinh_anh'] ?>" alt=""><?= $row['ten_san_pham'] ?>
                                </td>
                                <td class=""><?= $row['ho_lot'] . $row['ten_kh'] ?> </td>
                                <td class=""><?= date('d/m/Y H:i', strtotime($row['thoi_gian_binh_luan'])) ?></td>
                                <td>
                                    <a class="btn btn-sm shadow-sm btn-danger" onclick="return confirm('Bạn có chắc xoá bình luận này?')" href="?action=del&id=<?= $row['id_binh_luan'] ?>">Xoá</a>

                                </td>

                            </tr>
                        <?php
                        endforeach;
                        ?>
                    </tbody>
                </table>
                <?php
                include './pagination.php';
                ?>
            <?php  } else {
                echo "<p class='text-center'>Không tìm thấy bình luận nàog!</p>";
            }
            ?>
        </div>
    <?php
}
include './footer.php';
    ?>
    </div>
    <?php
    if (isset($_GET['action']) && $_GET['action'] == 'del' && isset($_GET['id'])) {
        $id = $_GET['id'];
        $del = $conn->query("DELETE FROM binh_luan_san_pham WHERE id_binh_luan = '$id'");
        if ($del) {
            echo "<script>window.location.href='comments_listing.php'</script>";
        }
    }
    ?>
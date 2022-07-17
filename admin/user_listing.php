<?php
include './header.php';
if (!empty($_SESSION['current_admin'])) {

?>
    <div class="framework">
        <div class="breadcrumb bg-white p-2 m-0 mb-3 shadow-sm">
            <h1><i class="fas fa-home text-secondary"></i><span class="mx-2">&#10095;</span><a href=""> Quản lý khách hàng</a><span class="mx-2">&#10095;</span><span class="font-weight-bold">Danh sách khách hàng</span></h1>
        </div>
        <form action="user_listing.php" class="find mb-2" method="post">
            <div class="d-flex flex-wrap align-items-center">
                <div class="find-box d-flex flex-column mr-5 mb-2">
                    <label class="mb-2 font-weight-bold">Sắp xếp: </label>
                    <select id="userPoint" name="userPoint">
                        <option value="" selected>--Chọn hình thức--</option>
                        <option value="max">Điểm cao nhất</option>
                        <option value="min">Điểm nhỏ nhất</option>
                    </select>
                </div>
                <div class="find-box d-flex flex-column mr-5 mb-2">
                    <label class="mb-2 font-weight-bold">Tìm kiếm theo:</label>
                    <input type="text" id="txtSearch" name="txtSearch" placeholder="Tên, thành phố">
                </div>
                <div class="find-box d-flex flex-column ">
                    <button class="mt-3 btn btn-find" type="submit" name="btn-find"><i class="fas fa-search"></i> Tìm</button>
                </div>

            </div>
        </form>
        <div class="table-responsive-lg p-2 bg-white shadow-sm border border-success" id="tbl-user-listing">
            <?php
            $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 2;
            $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
            $offset = ($current_page - 1) * $item_per_page;

            $totalRecords = mysqli_query($conn, " SELECT * FROM khach_hang");
            $totalRecords = $totalRecords->num_rows;
            $totalPages = ceil($totalRecords / $item_per_page);
            $users = mysqli_query($conn, " SELECT * FROM khach_hang 
                                                ORDER BY ma_kh DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
            if ($users->num_rows > 0) {
                $stt = 0;
            ?>
                <table class="table table-hover"">
                <caption class=" pb-2 border-bottom mb-2 font-weight-bold">Danh sách khách hàng</caption>
                    <thead style="background: #008776; color:#FFF">
                        <tr class="product-item-content">
                            <td>#</td>
                            <td class="prop">Mã KH</td>
                            <td class="prop">Tên khách hàng</td>
                            <td class="prop">Tên khách hàng</td>
                            <td class="prop">SĐT</td>
                            <td class="prop">Email</td>
                            <td class="prop">Địa chỉ</td>
                            <td class="prop">Điểm</td>
                            <td class="prop">Thao tác</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $row) :
                            ++$stt;
                        ?>
                            <tr>
                                <td><?= $stt; ?></td>
                                <td class=""><?= $row['ma_kh'] ?></td>
                                <td class=""><?= $row['ho_lot'] ?></td>
                                <td class=""><?= $row['ten_kh'] ?></td>
                                <td class=""><?= $row['sdt_kh'] ?></td>
                                <td class=""><?= $row['email_kh'] ?></td>
                                <td class=""><?= $row['dia_chi_kh'] ?></td>
                                <td class=""><?= $row['diem_kh'] ?> </td>
                                <td class="btn-edit">
                                    <a class="btn btn-sm btn-info" href="user_info.php?id=<?= $row['ma_kh'] ?>"><i class="ti-info-alt"></i></a>
                                    <a class="btn btn-sm btn-danger" href="user_delete.php?id=<?= $row['ma_kh'] ?>" onclick="return confirm('Bạn muốn xoá khách hàng này?')"><i class="ti-close"></i></a>
                                </td>
                            </tr>
                        <?php
                        endforeach;
                        ?>
                    </tbody>
                </table>
                <?php
                include '../pagination/user_pagination.php';

                ?>
        </div>
        <?php
                include 'footer.php';
        ?>
    </div>
<?php
            }
        }
?>
<script>
    $(document).on('change', '#userPoint', function() {
        var userPoint = $(this).val();
        var txtSearch = $("#txtSearch").val();
        $.ajax({
            url: "../ajax_admin/ajax_user_cbb_filter.php",
            data: {
                "userPoint": userPoint,
                "txtSearch": txtSearch,
            },
            dataType: "html",
            type: "post",
            success: function(data) {
                $('#tbl-user-listing').html(data);

            }
        });
    });
    $(document).on('keyup', '#txtSearch', function() {
        var userPoint = $("#userPoint").val();
        var txtSearch = $(this).val();
        $.ajax({
            url: "../ajax_admin/ajax_user_input_filter.php",
            data: {
                "userPoint": userPoint,
                "txtSearch": txtSearch,
            },
            dataType: "html",
            type: "post",
            success: function(data) {
                $('#tbl-user-listing').html(data);
            }
        });
    });
</script>
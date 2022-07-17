<?php
include '../connect_db.php';
if (isset($_POST['userPoint']) && isset($_POST['txtSearch'])) {
    $userPoint = $_POST['userPoint'];
    $txtSearch = $_POST['txtSearch'];

    $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 2;
    $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $offset = ($current_page - 1) * $item_per_page;

    if (empty($txtSearch) && empty($userPoint)) {
        $users_select =   " SELECT * FROM khach_hang";

        $page_user = "      SELECT * FROM khach_hang  
                            ORDER BY ma_kh DESC LIMIT " . $item_per_page . " OFFSET " . $offset;
    } else 
    if (!empty($txtSearch) && empty($userPoint)) {
        $users_select =   " SELECT * FROM khach_hang 
                            WHERE (ten_kh LIKE N'%$txtSearch%' or ho_lot LIKE N'%$txtSearch%' or dia_chi_kh LIKE N'%$txtSearch%')";

        $page_user = "      SELECT * FROM khach_hang 
                            WHERE (ten_kh LIKE N'%$txtSearch%' or ho_lot LIKE N'%$txtSearch%' or dia_chi_kh LIKE N'%$txtSearch%')
                            ORDER BY ma_kh DESC LIMIT " . $item_per_page . " OFFSET " . $offset;

        $thongbao = "Kết quả tìm kiếm: " . "' $txtSearch '";
    } else // SẮP XẾP TĂNG DẦN THEO ĐIỂM TÍCH LUỸ
        if (!empty($userPoint)) {
            if ($userPoint == 'min' && empty($txtSearch)) {

                $users_select = "SELECT * FROM khach_hang ORDER BY diem_kh";

                $page_user = "  SELECT * FROM khach_hang ORDER BY diem_kh , ma_kh DESC LIMIT " . $item_per_page . " OFFSET " . $offset;

                $thongbao = "Kết quả sắp xếp TĂNG DẦN.";
            } else  // SẮP XẾP GIẢM DẦN THEO ĐIỂM TÍCH LUỸ
                if ($userPoint == 'max' && empty($txtSearch)) {

                    $users_select =   "SELECT * FROM khach_hang ORDER BY diem_kh DESC";

                    $page_user = "  SELECT * FROM khach_hang ORDER BY diem_kh DESC, ma_kh DESC LIMIT " . $item_per_page . " OFFSET " . $offset;
                    $thongbao = "Kết quả sắp xếp GIẢM DẦN.";
                } else   // SẮP XẾP TĂNG DẦN THEO ĐIỂM TÍCH LUỸ CỦA KHÁCH HÀNG Ở THÀNH PHỐ
                    if ($userPoint == 'min' && !empty($txtSearch)) {
                        $users_select =  "  SELECT * FROM khach_hang
                                            WHERE (ten_kh LIKE N'%$txtSearch%' or dia_chi_kh LIKE N'%$txtSearch%') ORDER BY diem_kh";

                        $page_user = "  SELECT * FROM khach_hang
                                        WHERE (ten_kh LIKE N'%$txtSearch%' or dia_chi_kh LIKE N'%$txtSearch%') 
                                        ORDER BY diem_kh, ma_kh DESC LIMIT " . $item_per_page . " OFFSET " . $offset;

                        $thongbao = "Kết quả tìm kiếm khách hàng: " . "' $txtSearch '" . " có điểm tích luỹ tăng dần";
                    } else // SẮP XẾP GIẢM DẦN THEO ĐIỂM TÍCH LUỸ CỦA KHÁCH HÀNG Ở THÀNH PHỐ
                        if ($userPoint == 'max' && !empty($txtSearch)) {

                            $users_select =  "  SELECT * FROM khach_hang 
                                                WHERE (ten_kh LIKE N'%$txtSearch%' or dia_chi_kh LIKE N'%$txtSearch%') ORDER BY diem_kh DESC";

                            $page_user = "  SELECT * FROM khach_hang 
                                            WHERE (ten_kh LIKE N'%$txtSearch%' or dia_chi_kh LIKE N'%$txtSearch%') 
                                            ORDER BY diem_kh DESC, ma_kh DESC LIMIT " . $item_per_page . " OFFSET " . $offset;
                            $thongbao = "Kết quả tìm kiếm khách hàng: " . "' $txtSearch '" . " có điểm tích luỹ giảm dần";
                        }
        }

    $find_users = mysqli_query($conn, $users_select);
    $find_users =  $find_users->num_rows;
    $totalPages = ceil($find_users / $item_per_page);
    $find_users = mysqli_query($conn, $page_user);
    if ($find_users->num_rows > 0) {
        $stt = 0; ?>
        <table class="table table-hover"">
        <caption class="pb-2 border-bottom mb-2 font-weight-bold">Danh sách khách hàng</caption>
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
                <?php foreach ($find_users as $row) :
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
                            <a class="btn btn-sm shadow" href="user_info.php?id=<?= $row['ma_kh'] ?>"><i class="ti-info-alt text-info"></i></a>
                            <a class="btn btn-sm shadow" href="user_delete.php?id=<?= $row['ma_kh'] ?>" onclick="return confirm('Bạn muốn xoá khách hàng này?')"><i class="ti-close text-danger"></i></a>
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
<?php  } else {
        echo "<p class='text-center'>Không tìm thấy khách hàng!</p>";
    }
}
?>
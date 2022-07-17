<?php
include './header.php';
if (!empty($_SESSION['current_admin'])) {
    $result = mysqli_query($conn, "SELECT * FROM khach_hang as kh, tai_khoan as tk WHERE kh.ma_kh = '" . $_GET['id'] . "'
                                        and tk.ma_kh = '" . $_GET['id'] . "'") or die("loi");
?>
    <div class="framework">
        <div class="breadcrumb bg-white p-2 m-0 mb-3 shadow-sm">
            <h1><i class="fas fa-home text-secondary"></i><span class="mx-2">&#10095;</span><a href=""> Quản lý người dùng</a><span class="mx-2">&#10095;</span><span class="font-weight-bold">Thông tin người dùng</span></h1>
        </div>
        <?php
        $row = mysqli_fetch_assoc($result);
        ?>
        <div class="table-responsive-lg p-2 bg-white shadow-sm border border-warning">
            <table class="table table-hover table-bordered table-user">
                <thead>
                    <th class="text-center h4" colspan="2"><span class="badge badge-success">Thông tin người dùng</span></th>
                </thead>
                <tbody>
                    <tr>
                        <th class="">Mã KH</th>
                        <td class=""><?= $row['ma_kh'] ?></td>
                    </tr>
                    <tr>
                        <th class="">Họ tên:</th>
                        <td class=""><?= $row['ho_lot'] ?> <?= $row['ten_kh'] ?></td>
                    </tr>
                    <tr>
                        <th>Số điện thoại</th>
                        <td class=""><?= $row['sdt_kh'] ?></td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td class=""><?= $row['email_kh'] ?></td>
                    </tr>
                    <tr>
                        <th>Địa chỉ:</th>
                        <td class=""><?= $row['dia_chi_kh'] ?></td>
                    </tr>
                    <tr>
                        <th>Điểm:</th>
                        <td class=""><?= $row['diem_kh'] ?> </td>
                    </tr>
                    <tr>
                        <td class="text-center h4" colspan="2"><span class="badge badge-danger">Thông tin tài khoản</span></td>
                    </tr>
                    <tr>
                        <th class="">Mã tài khoản:</th>
                        <td class=""><?= $row['ma_tk'] ?></td>
                    </tr>
                    <tr>
                        <th class="">Tài khoản: </th>
                        <td class=""><?= $row['tk_nguoi_dung'] ?></td>
                    </tr>
                    <tr>
                        <th>Mật khẩu:</th>
                        <td class=""><?= $row['mk_nguoi_dung'] ?></td>
                    </tr>
                    <tr>
                        <th>Ngày tạo:</th>
                        <td class=""><?= date('d/m/Y H:i', strtotime($row['ngay_tao'])) ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            <a class="btn btn-danger btn-sm" href="user_delete.php?id=<?= $row['ma_kh'] ?>" onclick="return confirm('Bạn muốn xoá khách hàng này?');">Xoá khách hàng</a>
        </div>
    </div>
<?php }
include './footer.php';
?>
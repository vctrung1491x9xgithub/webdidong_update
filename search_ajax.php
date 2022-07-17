<?php
include './connect_db.php';

if (isset($_POST['search'])) {
    $content_search = $_POST['search'];
    $sql = mysqli_query($conn, "SELECT * FROM san_pham WHERE ten_san_pham LIKE '%$content_search%'");

?>
<table class="table_search">
    <?php
        // in kết quả
        if (mysqli_num_rows($sql) > 0) {
            while ($result_find = MySQLi_fetch_array($sql)) { ?>
    <tr>
        <td class="product-img">
            <a href="product_info.php?id=<?= $result_find['id_san_pham'] ?>"><img width="100%"
                    src="./<?= $result_find['hinh_anh'] ?>"></a>
        </td>
        <td class="product-name"> <a
                href="product_info.php?id=<?= $result_find['id_san_pham'] ?>"><?= $result_find['ten_san_pham'] ?></a>
        </td>
        <td class="product-price"><?= number_format($result_find['gia_ban'], 0, ',', '.') ?>đ</td>
        <td class="product-content"><?= $result_find['noi_dung'] ?></td>
    </tr>
    <?php }
        } else {
            echo "
           <tr>
                <td style='width: 540px; text-align:center'>Không tìm thấy sản phẩm</td>
            </tr>
           ";
        }
    }
    ?>
</table>
<style>
.table_search a {
    display: block;
}

.table_search {
    background: white;
    max-height: 400px;
    font-size: 13px;
    border: 2px solid #24DC83;
    border-radius: 5px;
}

.product-img {
    width: 100px;
}

.table_search td {
    padding: 10px 20px;
    vertical-align: middle;
}

.table_search tr:not(:last-child) {
    border-bottom: 1px solid #ccc;
}

.table_search th {
    text-align: center;
    padding: 10px;
}

.table_search tr:nth-child(even) {
    background: #FAF8F8;
}

.table_search tr:hover {
    background: #eee;
}
</style>
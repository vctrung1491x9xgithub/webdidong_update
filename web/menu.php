<div class="menu-container">
    <ul class="menu">
        <?php
        $selectDanhMucSP = mysqli_query($conn, "SELECT * FROM `danh_muc_mat_hang` ORDER BY `danh_muc_mat_hang`.`STT` ASC");
        while ($rowDanhMuc = $selectDanhMucSP->fetch_array()) {
        ?>
        <li>
            <a class="menu-item" href="<?= $rowDanhMuc['link_danh_muc'] ?>">
                <span class="material-icons"><?= $rowDanhMuc['icon'] ?></span>
                <p><?= $rowDanhMuc['ten_mat_hang'] ?></p>
                <div class="box-list-menu">
                </div>
            </a>
        </li>
        <?php } ?>
        <?php
        if (!isset($current_user)) {
        ?>
        <li>
            <a class="menu-item" href="don_hang_cua_toi.php">
                <span class="material-icons">wysiwyg</span>
                <p>TRA CỨU ĐƠN HÀNG</p>
            </a>
        </li>
        <?php }
        ?>
    </ul>
</div>
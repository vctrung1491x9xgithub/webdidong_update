<?php
include './web/header.php';
?>
<!-- ===================================================================================-->
<!-- MAIN-CONTAINT -->
<div id="containt">


    <!-- ALL-PHONE-CONTAINER-->
    <?php
    include './web/menu.php';

    if (isset($_GET['all_phone'])) { ?>

    <div class="menu-phone">
        <ul class="list-phone list-view">
            <li><a href=""><img src="https://cdn.tgdd.vn/Brand/1/iPhone-(Apple)42-b_16.jpg" alt=""></a></li>
            <li><a href=""><img src="https://cdn.tgdd.vn/Brand/1/Samsung42-b_25.jpg" alt=""></a></li>
            <li><a href=""><img src="https://cdn.tgdd.vn/Brand/1/OPPO42-b_9.png" alt=""></a></li>
            <li><a href=""><img src="https://cdn.tgdd.vn/Brand/1/Xiaomi42-b_45.jpg" alt=""></a></li>
            <li><a href=""><img src="https://cdn.tgdd.vn/Brand/1/Vivo42-b_50.jpg" alt=""></a></li>
            <li><a href=""><img src="https://cdn.tgdd.vn/Brand/1/Realme42-b_37.png" alt=""></a></li>
            <li><a href=""><img src="https://cdn.tgdd.vn/Brand/1/Vsmart42-b_40.png" alt=""></a></li>
            <li><a href=""><img src="https://cdn.tgdd.vn/Brand/1/Nokia42-b_21.jpg" alt=""></a></li>
            <li><a href=""><img src="https://cdn.tgdd.vn/Brand/1/Huawei42-b_30.jpg" alt=""></a></li>
            <li><a href=""><img src="https://cdn.tgdd.vn/Brand/1/Mobell42-b_19.jpg" alt=""></a></li>
            <li><a href=""><img src="https://cdn.tgdd.vn/Brand/1/Itel42-b_54.jpg" alt=""></a></li>
            <li><a href=""><img src="https://cdn.tgdd.vn/Brand/1/Masstel42-b_0.png" alt=""></a></li>
            <li><a href=""><img src="https://cdn.tgdd.vn/Brand/1/BlackBerry42-b_38.png" alt=""></a></li>
        </ul>
    </div>
    <div class="list-price">
        <div class="item-1"><span class="material-icons">smartphone</span> <span class="item-label">Tất cả điện
                thoại</span></div>
        <a class="item-2" href="">Dưới 3 triệu</a>
        <a class="item-2" href="">Từ 3 đến 10 triệu</a>
        <a class="item-2" href="">Trên 10 triệu</a>
        <a class="item-2" href="">Tự chọn giá</a>
    </div>
    <div id="phone-container" style="margin-top:0px">
        <div class="homeproduct">
            <ul class="list">
                <?php
                    $products = mysqli_query($conn, "SELECT * FROM san_pham WHERE id_mat_hang = 'PHONE' ORDER BY id_san_pham ");
                    while ($row = mysqli_fetch_array($products)) {
                    ?>
                <li class="main-product" style="padding-top: 10px;">
                    <a href="product_info.php?id=<?= $row['id_san_pham'] ?>">
                        <div class="product">
                            <div class="img">
                                <img src="./<?= $row['hinh_anh'] ?>" title="<?= $row['ten_san_pham'] ?>" />
                                <label class="discount product-label">GIẢM
                                    <?= number_format($row['giam_gia'], 0, ",", ".") ?>₫</label>
                            </div>

                            <div class="promo">
                                <div class="name-sp"><?= $row['ten_san_pham'] ?></div>
                                <div class="price">
                                    <strong><?= number_format($row['gia_ban'], 0, ",", ".") ?> đ</strong>
                                    <span><?= number_format($row['gia_ban'] + $row['giam_gia'], 0, ",", ".") ?> đ</span>
                                </div>
                                <div class="endow">
                                    <p><?= $row['noi_dung'] ?></p>
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <?php } //<!--================END-PHONE PRODUCT===============-->   
    elseif (isset($_GET['all_laptop'])) { ?>
    <div class="menu-laptop">
        <ul class="list-laptop list-view">
            <li><a href=""><img src="https://cdn.tgdd.vn/Brand/1/Macbook44-b_41.png" alt=""></a></li>
            <li><a href=""><img src="https://cdn.tgdd.vn/Brand/1/Asus44-b_35.jpg" alt=""></a></li>
            <li><a href=""><img src="https://cdn.tgdd.vn/Brand/1/HP-Compaq44-b_36.jpg" alt=""></a></li>
            <li><a href=""><img src="https://cdn.tgdd.vn/Brand/1/Lenovo44-b_36.jpg" alt=""></a></li>
            <li><a href=""><img src="https://cdn.tgdd.vn/Brand/1/Acer44-b_37.jpg" alt=""></a></li>
            <li><a href=""><img src="https://cdn.tgdd.vn/Brand/1/Dell44-b_34.jpg" alt=""></a></li>
            <li><a href=""><img src="https://cdn.tgdd.vn/Brand/1/Huawei44-b_7.jpg" alt=""></a></li>
        </ul>
    </div>
    <div class="list-price">
        <div class="item-1"><span class="material-icons">laptop</span class="item-label"> Tất cả laptop</div>
        <a class="item-2" href="">Dưới 3 triệu</a>
        <a class="item-2" href="">Từ 3 đến 10 triệu</a>
        <a class="item-2" href="">Trên 10 triệu</a>
        <a class="item-2" href="">Tự chọn giá</a>
    </div>
    <div id="laptop-container" style="margin-top:0px">
        <div class="homeproduct">
            <ul class="list">
                <?php
                    $products = mysqli_query($conn, "SELECT * FROM san_pham WHERE id_mat_hang = 'LAPTOP' ORDER BY id_san_pham ");
                    while ($row = mysqli_fetch_array($products)) {
                    ?>
                <li class="main-product" style="padding-top: 10px;">
                    <a href="product_info.php?id=<?= $row['id_san_pham'] ?>">
                        <div class="product">
                            <div class="img">
                                <img src="./<?= $row['hinh_anh'] ?>" title="<?= $row['ten_san_pham'] ?>" />
                                <label class="discount product-label">GIẢM
                                    <?= number_format($row['giam_gia'], 0, ",", ".") ?>₫</label>
                            </div>

                            <div class="promo">
                                <div class="name-sp"><?= $row['ten_san_pham'] ?></div>
                                <div class="price">
                                    <strong><?= number_format($row['gia_ban'], 0, ",", ".") ?> đ</strong>
                                    <span><?= number_format($row['gia_ban'] + $row['giam_gia'], 0, ",", ".") ?> đ</span>
                                </div>
                                <div class="endow">
                                    <p><?= $row['noi_dung'] ?></p>
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <?php } //<!--================END-PHONE PRODUCT===============-->   
    elseif (isset($_GET['all_tablet'])) { ?>
    <div class="menu-tablet">
        <ul class="list-tablet list-view">
            <li><a href=""><img src="https://cdn.tgdd.vn/Brand/1/iPad-(Apple)522-b_28.jpg"></a></li>
            <li><a href=""><img src="https://cdn.tgdd.vn/Brand/1/Samsung522-b_30.jpg"></a></li>
            <li><a href=""><img src="https://cdn.tgdd.vn/Brand/1/Huawei522-b_4.jpg"></a></li>
            <li><a href=""><img src="https://cdn.tgdd.vn/Brand/1/Lenovo522-b_29.jpg"></a></li>
            <li><a href=""><img src="https://cdn.tgdd.vn/Brand/1/Masstel522-b_35.png"></a></li>
            <li><a href=""><img src="https://cdn.tgdd.vn/Brand/1/Mobell522-b_30.jpg"></a></li>
        </ul>
    </div>
    <div class="list-price">
        <div class="item-1"><span class="material-icons">tablet</span> <span class="item-label">Tất cả tablet</span>
        </div>
        <a class="item-2" href="">Dưới 3 triệu</a>
        <a class="item-2" href="">Từ 3 đến 10 triệu</a>
        <a class="item-2" href="">Trên 10 triệu</a>
        <a class="item-2" href="">Tự chọn giá</a>
    </div>
    <div id="tablet-container" style="margin-top:0px">
        <div class="homeproduct">
            <ul class="list">
                <?php
                    $products = mysqli_query($conn, "SELECT * FROM san_pham WHERE id_mat_hang = 'TABLET' ORDER BY id_san_pham ");
                    while ($row = mysqli_fetch_array($products)) {
                    ?>
                <li class="main-product" style="padding: 10px 0;">
                    <a href="product_info.php?id=<?= $row['id_san_pham'] ?>">
                        <div class="product">
                            <div class="img">
                                <img src="./<?= $row['hinh_anh'] ?>" title="<?= $row['ten_san_pham'] ?>" />
                                <label class="discount product-label">GIẢM
                                    <?= number_format($row['giam_gia'], 0, ",", ".") ?>₫</label>
                            </div>

                            <div class="promo">
                                <div class="name-sp"><?= $row['ten_san_pham'] ?></div>
                                <div class="price">
                                    <strong><?= number_format($row['gia_ban'], 0, ",", ".") ?> đ</strong>
                                    <span><?= number_format($row['gia_ban'] + $row['giam_gia'], 0, ",", ".") ?> đ</span>
                                </div>
                                <div class="endow">
                                    <p><?= $row['noi_dung'] ?></p>
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <?php }  //<!--================END-PHONE PRODUCT===============-->   
    elseif (isset($_GET['all_accessory'])) { ?>
    <div class="menu-laptop">
        <ul class="list-laptop list-view">
            <li><a href=""><img src="https://cdn.tgdd.vn/Brand/1/Macbook44-b_41.png" alt=""></a></li>
            <li><a href=""><img src="https://cdn.tgdd.vn/Brand/1/Asus44-b_35.jpg" alt=""></a></li>
            <li><a href=""><img src="https://cdn.tgdd.vn/Brand/1/HP-Compaq44-b_36.jpg" alt=""></a></li>
            <li><a href=""><img src="https://cdn.tgdd.vn/Brand/1/Lenovo44-b_36.jpg" alt=""></a></li>
            <li><a href=""><img src="https://cdn.tgdd.vn/Brand/1/Acer44-b_37.jpg" alt=""></a></li>
            <li><a href=""><img src="https://cdn.tgdd.vn/Brand/1/Dell44-b_34.jpg" alt=""></a></li>
            <li><a href=""><img src="https://cdn.tgdd.vn/Brand/1/Huawei44-b_7.jpg" alt=""></a></li>
        </ul>
    </div>
    <div class="list-price">
        <div class="item-1"><span class="material-icons">headset</span class="item-label"> Tất cả phụ kiện</div>
        <a class="item-2" href="">USB</a>
        <a class="item-2" href="">Tai nghe</a>
        <a class="item-2" href="">Ốp lưng</a>
        <a class="item-2" href="">Thẻ nhớ</a>
        <a class="item-2" href="">Cáp sạc</a>
        <a class="item-2" href="">Chuột</a>
        <a class="item-2" href="">Bàn phím</a>
    </div>
    <div id="tablet-container" style="margin-top:0px">
        <div class="homeproduct">
            <ul class="list">
                <?php
                    $products = mysqli_query($conn, "SELECT * FROM san_pham WHERE id_mat_hang = 'PHUKIEN' ORDER BY id_san_pham ");
                    while ($row = mysqli_fetch_array($products)) {
                    ?>
                <li class="main-product" style="padding-top: 10px;">
                    <a href="product_info.php?id=<?= $row['id_san_pham'] ?>">
                        <div class="product">
                            <div class="img">
                                <img src="./<?= $row['hinh_anh'] ?>" title="<?= $row['ten_san_pham'] ?>" />
                                <label class="discount product-label">GIẢM
                                    <?= number_format($row['giam_gia'], 0, ",", ".") ?>₫</label>
                            </div>

                            <div class="promo">
                                <div class="name-sp"><?= $row['ten_san_pham'] ?></div>
                                <div class="price">
                                    <strong><?= number_format($row['gia_ban'], 0, ",", ".") ?> đ</strong>
                                    <span><?= number_format($row['gia_ban'] + $row['giam_gia'], 0, ",", ".") ?> đ</span>
                                </div>
                                <div class="endow">
                                    <p><?= $row['noi_dung'] ?></p>
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <?php } elseif (isset($_GET['all_pc'])) { ?>
    <div class="menu-laptop">
        <ul class="list-laptop list-view">
            <li><a href=""><img src="https://cdn.tgdd.vn/Brand/1/Macbook44-b_41.png" alt=""></a></li>
            <li><a href=""><img src="https://cdn.tgdd.vn/Brand/1/Asus44-b_35.jpg" alt=""></a></li>
            <li><a href=""><img src="https://cdn.tgdd.vn/Brand/1/HP-Compaq44-b_36.jpg" alt=""></a></li>
            <li><a href=""><img src="https://cdn.tgdd.vn/Brand/1/Lenovo44-b_36.jpg" alt=""></a></li>
            <li><a href=""><img src="https://cdn.tgdd.vn/Brand/1/Acer44-b_37.jpg" alt=""></a></li>
            <li><a href=""><img src="https://cdn.tgdd.vn/Brand/1/Dell44-b_34.jpg" alt=""></a></li>
            <li><a href=""><img src="https://cdn.tgdd.vn/Brand/1/Huawei44-b_7.jpg" alt=""></a></li>
        </ul>
    </div>
    <div class="list-price">
        <div class="item-1"><span class="material-icons">desktop_windows</span class="item-label"> Tất cả pc</div>
        <a class="item-2" href="">Dưới 10 triệu</a>
        <a class="item-2" href="">Dưới 20 triệu</a>
        <a class="item-2" href="">Dưới 50 triệu</a>
        <a class="item-2" href="">Trên 50 triệu</a>
    </div>
    <div id="tablet-container" style="margin-top:0px">
        <div class="homeproduct">
            <ul class="list">
                <?php
                    $products = mysqli_query($conn, "SELECT * FROM san_pham WHERE id_mat_hang = 'PC' ORDER BY id_san_pham ");
                    while ($row = mysqli_fetch_array($products)) {
                    ?>
                <li class="main-product" style="padding-top: 10px;">
                    <a href="product_info.php?id=<?= $row['id_san_pham'] ?>">
                        <div class="product">
                            <div class="img">
                                <img src="./<?= $row['hinh_anh'] ?>" title="<?= $row['ten_san_pham'] ?>" />
                                <label class="discount product-label">GIẢM
                                    <?= number_format($row['giam_gia'], 0, ",", ".") ?>₫</label>
                            </div>

                            <div class="promo">
                                <div class="name-sp"><?= $row['ten_san_pham'] ?></div>
                                <div class="price">
                                    <strong><?= number_format($row['gia_ban'], 0, ",", ".") ?> đ</strong>
                                    <span><?= number_format($row['gia_ban'] + $row['giam_gia'], 0, ",", ".") ?> đ</span>
                                </div>
                                <div class="endow">
                                    <p><?= $row['noi_dung'] ?></p>
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <?php } elseif (isset($_GET['all_sound'])) { ?>
    <div class="menu-laptop">
        <ul class="list-laptop list-view">
            <li><a href=""><img src="https://cdn.tgdd.vn/Brand/1/Macbook44-b_41.png" alt=""></a></li>
            <li><a href=""><img src="https://cdn.tgdd.vn/Brand/1/Asus44-b_35.jpg" alt=""></a></li>
            <li><a href=""><img src="https://cdn.tgdd.vn/Brand/1/HP-Compaq44-b_36.jpg" alt=""></a></li>
            <li><a href=""><img src="https://cdn.tgdd.vn/Brand/1/Lenovo44-b_36.jpg" alt=""></a></li>
            <li><a href=""><img src="https://cdn.tgdd.vn/Brand/1/Acer44-b_37.jpg" alt=""></a></li>
            <li><a href=""><img src="https://cdn.tgdd.vn/Brand/1/Dell44-b_34.jpg" alt=""></a></li>
            <li><a href=""><img src="https://cdn.tgdd.vn/Brand/1/Huawei44-b_7.jpg" alt=""></a></li>
        </ul>
    </div>
    <div class="list-price">
        <div class="item-1"><span class="material-icons">speaker_group</span class="item-label"> Tất cả âm thanh</div>
        <a class="item-2" href="">Dưới 1 triệu</a>
        <a class="item-2" href="">Dưới 5 triệu</a>
        <a class="item-2" href="">Dưới 10 triệu</a>
        <a class="item-2" href="">Trên 10 triệu</a>
    </div>
    <div id="tablet-container" style="margin-top:0px">
        <div class="homeproduct">
            <ul class="list">
                <?php
                    $products = mysqli_query($conn, "SELECT * FROM san_pham WHERE id_mat_hang = 'SOUND' ORDER BY id_san_pham ");
                    while ($row = mysqli_fetch_array($products)) {
                    ?>
                <li class="main-product" style="padding-top: 10px;">
                    <a href="product_info.php?id=<?= $row['id_san_pham'] ?>">
                        <div class="product">
                            <div class="img">
                                <img src="./<?= $row['hinh_anh'] ?>" title="<?= $row['ten_san_pham'] ?>" />
                                <label class="discount product-label">GIẢM
                                    <?= number_format($row['giam_gia'], 0, ",", ".") ?>₫</label>
                            </div>

                            <div class="promo">
                                <div class="name-sp"><?= $row['ten_san_pham'] ?></div>
                                <div class="price">
                                    <strong><?= number_format($row['gia_ban'], 0, ",", ".") ?> đ</strong>
                                    <span><?= number_format($row['gia_ban'] + $row['giam_gia'], 0, ",", ".") ?> đ</span>
                                </div>
                                <div class="endow">
                                    <p><?= $row['noi_dung'] ?></p>
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <?php } elseif (isset($_GET['all_watch'])) { ?>
    <div class="menu-laptop">
        <ul class="list-laptop list-view">
            <li><a href=""><img src="https://cdn.tgdd.vn/Brand/1/Macbook44-b_41.png" alt=""></a></li>
            <li><a href=""><img src="https://cdn.tgdd.vn/Brand/1/Asus44-b_35.jpg" alt=""></a></li>
            <li><a href=""><img src="https://cdn.tgdd.vn/Brand/1/HP-Compaq44-b_36.jpg" alt=""></a></li>
            <li><a href=""><img src="https://cdn.tgdd.vn/Brand/1/Lenovo44-b_36.jpg" alt=""></a></li>
            <li><a href=""><img src="https://cdn.tgdd.vn/Brand/1/Acer44-b_37.jpg" alt=""></a></li>
            <li><a href=""><img src="https://cdn.tgdd.vn/Brand/1/Dell44-b_34.jpg" alt=""></a></li>
            <li><a href=""><img src="https://cdn.tgdd.vn/Brand/1/Huawei44-b_7.jpg" alt=""></a></li>
        </ul>
    </div>
    <div class="list-price">
        <div class="item-1"><span class="material-icons">watch</span class="item-label"> Tất cả đồng hồ</div>
        <a class="item-2" href="">Dưới 1 triệu</a>
        <a class="item-2" href="">Dưới 5 triệu</a>
        <a class="item-2" href="">Dưới 10 triệu</a>
        <a class="item-2" href="">Dưới 100 triệu</a>
        <a class="item-2" href="">Trên 1 tỷ</a>
    </div>
    <div id="tablet-container" style="margin-top:0px">
        <div class="homeproduct">
            <ul class="list">
                <?php
                    $products = mysqli_query($conn, "SELECT * FROM san_pham WHERE id_mat_hang = 'WATCH' ORDER BY id_san_pham ");
                    while ($row = mysqli_fetch_array($products)) {
                    ?>
                <li class="main-product" style="padding-top: 10px;">
                    <a href="product_info.php?id=<?= $row['id_san_pham'] ?>">
                        <div class="product">
                            <div class="img">
                                <img src="./<?= $row['hinh_anh'] ?>" title="<?= $row['ten_san_pham'] ?>" />
                                <label class="discount product-label">GIẢM
                                    <?= number_format($row['giam_gia'], 0, ",", ".") ?>₫</label>
                            </div>

                            <div class="promo">
                                <div class="name-sp"><?= $row['ten_san_pham'] ?></div>
                                <div class="price">
                                    <strong><?= number_format($row['gia_ban'], 0, ",", ".") ?> đ</strong>
                                    <span><?= number_format($row['gia_ban'] + $row['giam_gia'], 0, ",", ".") ?> đ</span>
                                </div>
                                <div class="endow">
                                    <p><?= $row['noi_dung'] ?></p>
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <?php } ?>

</div>
<a href="#" class="back-to-top" id="back-to-top"></a>
<!-- <div class="night-mod-button">
    <img class="logo-bt-nm" src="./images/lododarkmode-open-sun5.png" title="Change theme">
</div> -->

<!--END-MAIN-CONTAINT-->
<!--FOOTER-->
<?php
include("./web/footer.php")
?>
</div>
<!--CONTAINER-->
</body>

</html>
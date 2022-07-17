<?php
include './web/header.php';
?>
<!-- ===================================================================================-->
<!-- MAIN-CONTAINT -->
<div id="containt">
    <?php
	include './web/menu.php'
	?>
    <!-- FIRST-CONTAINT-->
    <div id="banner-container">
        <!-- FIRST-CONTAINT-LEFT-->
        <div id="banner-left">
            <div class="banner-left-top">
                <div class="owl-carousel owl-theme" id="mySlidesShow">
                    <div class="item" data-index="1">
                        <img src="https://cdn.tgdd.vn/2020/03/banner/800-300-800x300-11.png">
                    </div>
                    <div class="item" data-index="2">
                        <img src="https://cdn.tgdd.vn/2020/07/banner/800-300-800x300.png">
                    </div>
                    <div class="item" data-index="3">
                        <img src="https://cdn.tgdd.vn/2020/03/banner/800-300-800x300-13.png">
                    </div>
                    <div class="item" data-index="4">
                        <img src="https://cdn.tgdd.vn/2020/06/banner/800-300-800x300-35.png">
                    </div>
                    <div class="item" data-index="5">
                        <img src="https://cdn.tgdd.vn/2020/07/banner/A92-800-300-800x300.png">
                    </div>
                </div>
            </div>
            <div class="banner-left-bottom">
                <div class="nav-left-bottom">
                    <div class="list-item active" data-index="1">
                        <a href="">Galaxy S20 Series Giảm ngay 2 triệu</a>
                    </div>
                    <div class="list-item" data-index="2">
                        <a href="">Galaxy S20 Series Giảm ngay 2 triệu</a>
                    </div>
                    <div class="list-item" data-index="3">
                        <a href="">Galaxy S20 Series Giảm ngay 2 triệu</a>
                    </div>
                    <div class="list-item" data-index="4">
                        <a href="">Galaxy S20 Series Giảm ngay 2 triệu</a>
                    </div>
                    <div class="list-item" data-index="5">
                        <a href="">Galaxy S20 Series Giảm ngay 2 triệu</a>
                    </div>

                </div>
            </div>
        </div>
        <!-- FIRST-CONTAINT-LEFT-END-->
        <!-- ===================================================================================-->
        <!-- FIRST-CONTAINT-RIGHT-->
        <div id="banner-right">
            <!--banner-right-top-->
            <div class="banner-right-top">
                <div class="banner-news">
                    <a class="label-news" href="/tin-tuc" style="color: #fff;">Tin tức</a>
                    <div class="text">
                        <div class="dots">
                            <div class="dot"><span class="ping"></span></div>
                        </div>
                        <a href="#">Thẻ cào online. Thẻ gì cũng có hết, mua ngay thôi!!!!!!!!!!!!</a>
                    </div>
                </div>
                <div class="news">
                    <ul>
                        <li class="news-items">
                            <a href="">
                                <img src="./images/cry.gif">
                                <h2>Thanh niên bắt được gấu khi đi mua hàng tại linktomobile, vui mừng trong khóc lóc
                                    tại sao mình không đi đến đây sớm hơn.</h2>
                            </a>
                        </li>
                        <li class="news-items">
                            <a href="">
                                <img src="./images/chodilui.gif">
                                <h2>Đây là cách sở hữu Samsung Galaxy Note 10 Lite khi chưa đủ kinh phí, vừa tiện lợi
                                    vừa tiết kiệm</h2>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!--banner-right-bottom-->
            <div class="banner-right-bottom">
                <iframe
                    src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Ffacebook&width=410&height=170&small_header=true&adapt_container_width=true&hide_cover=false&show_facepile=true&appId"
                    width="100%" height="100%" style="border:none;" scrolling="no" frameborder="0"
                    allowTransparency="true" allow="encrypted-media"></iframe>
            </div>
        </div>
        <!-- FIRST-CONTAINT-RIGHT-END-->
    </div>
    <!-- <div class="qc" style="margin-top: 10px;">
		<img src="./images/Deal-dai-pc.gif" alt="">
	</div> -->
    <!-- FIRST-CONTAINT--END-->
    <div class="slideShow-responsive-mobile">
        <div class="owl-carousel owl-theme" id="mySlidesShow-rp-mb">
            <div class="item" data-index="1">
                <img src="https://cdn.tgdd.vn/2020/03/banner/800-300-800x300-11.png">
            </div>
            <div class="item" data-index="2">
                <img src="https://cdn.tgdd.vn/2020/03/banner/800-300-800x300-12.png">
            </div>
            <div class="item" data-index="3">
                <img src="https://cdn.tgdd.vn/2020/03/banner/800-300-800x300-13.png">
            </div>
            <div class="item" data-index="4">
                <img src="https://cdn.tgdd.vn/2020/03/banner/800-300-800x300-14.png">
            </div>
            <div class="item" data-index="5">
                <img src="https://cdn.tgdd.vn/2020/03/banner/800-300-800x300-15.png">
            </div>
        </div>
    </div>
    <!-- SECOND-CONTAINT-->
    <div id="panel-container">
        <div class="label-container">
            <div class="label-text">SẢN PHẨM HOT</div>
        </div>
        <!--SLIDESHOW-SP-->
        <div class="show-sp">
            <div class="product-container">
                <div class="owl-carousel owl-theme" id="myOwlCarousel">
                    <?php
					$slides = $conn->query("	SELECT 	* 
												FROM 	san_pham AS sp, slider AS l, chi_tiet_slider AS c
												WHERE 	sp.id_san_pham = c.id_san_pham 
														and l.id_slider = c.id_slider
														and l.trang_thai_slider = 'enable'");
					if ($slides->num_rows > 0) :
						foreach ($slides as $slide) :
					?>
                    <div class="item">
                        <a href="product_info.php?id=<?= $slide['id_san_pham'] ?>">
                            <div class="product">
                                <div class="img">
                                    <img src="./<?= $slide['hinh_anh'] ?>" title="<?= $slide['ten_san_pham'] ?>" />
                                    <?php
											if ($slide['giam_gia'] != 0) { ?>
                                    <label class="discount product-label">GIẢM
                                        <?= number_format($slide['giam_gia'], 0, ",", ".") ?>₫</label>
                                    <?php  }
											?>

                                </div>
                                <div class="promo">
                                    <div class="name-sp"><?= $slide['ten_san_pham'] ?></div>
                                    <div class="price">
                                        <strong><?= number_format($slide['gia_ban'], 0, ",", ".") ?> ₫</strong>
                                        <?php
												if ($slide['giam_gia'] != 0) { ?>
                                        <span><?= number_format($slide['gia_ban'] + $slide['giam_gia'], 0, ",", ".") ?>
                                            đ</span>
                                        <?php
												}
												?>
                                    </div>
                                    <div class="endow">
                                        <p><?= $slide['noi_dung'] ?></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php endforeach;
					endif; ?>
                    <!-- END-PRODUCT -->
                </div>
            </div>
            <!-- END-OWL-SLIDE -->
        </div>
    </div>
    <!--ID = SECOND-CONTAINT-END-->
    <!--ID = THIRD-CONTAINT-->
    <?php

	// $item_per_page = !empty($_GET['per_page'])?$_GET['per_page']:15;
	// $current_page = !empty($_GET['page'])?$_GET['page']:1; //Trang hiện tại
	// $offset = ($current_page - 1) * $item_per_page;
	$products = mysqli_query($conn, "SELECT COUNT(*) as soluong FROM san_pham WHERE id_mat_hang = 'PHONE'");
	// $totalRecords = mysqli_query($conn, "SELECT * FROM sanpham");
	// $totalRecords = $totalRecords->num_rows;
	// $totalPages = ceil($totalRecords / $item_per_page);
	$soluong = mysqli_fetch_array($products);
	?>
    <div id="phone-container">
        <div class="navigat">
            <span>ĐIỆN THOẠI NỔI BẬT</span>
            <ul>
                <li><a href="">Điện thoại Iphone</a></li>
                <li><a href="">Điện thoại Samsung</a></li>
                <li><a href="">Điện thoại OPPO</a></li>
                <li><a href="">Điện thoại Huawei</a></li>
                <li><a href="view_all_product.php?all_phone">Xem tất cả <?= $soluong['soluong'] ?> điện thoại</a></li>
            </ul>
        </div>
        <div class="homeproduct">
            <ul class="list">
                <!-- <li class="feature pd-1">
					<a href="#">
						<img src="https://cdn.tgdd.vn/Products/Images/42/194251/Feature/s10-lite-spec-ft-480x222-1.jpg">
						<div class="feature-promo">
							<div class="feature-promo-left">
								<h2 class="name-sp">Samsung Galaxy S10 Lite</h2>
								<div class="price">
									<strong>14.990.000₫</strong>
								</div>
							</div>
							<div class="feature-label">Trả góp 0%</div>
						</div>
					</a>
				</li> -->
                <?php
				$products = mysqli_query($conn, "SELECT * FROM san_pham WHERE id_mat_hang = 'PHONE'");
				while ($row = mysqli_fetch_array($products)) {
				?>
                <li class="main-product">
                    <a href="product_info.php?id=<?= $row['id_san_pham'] ?>">
                        <div class="product">
                            <div class="img">
                                <img src="./<?= $row['hinh_anh'] ?>" title="<?= $row['ten_san_pham'] ?>" />
                                <?php
									if ($row['giam_gia'] != 0) { ?>
                                <label class="discount product-label">GIẢM
                                    <?= number_format($row['giam_gia'], 0, ",", ".") ?>₫</label>
                                <?php  }
									?>
                            </div>

                            <div class="promo">
                                <div class="name-sp"><?= $row['ten_san_pham'] ?></div>
                                <div class="price">
                                    <strong><?= number_format($row['gia_ban'], 0, ",", ".") ?> đ</strong>
                                    <?php
										if ($row['giam_gia'] != 0) { ?>
                                    <span><?= number_format($row['gia_ban'] + $row['giam_gia'], 0, ",", ".") ?> đ</span>
                                    <?php
										}
										?>
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
    <!--THIRD-CONTAINT-->
    <!--FIVE-CONTAINT-->
    <?php
	$laptop = mysqli_query($conn, "SELECT  COUNT(*) as soluong FROM san_pham WHERE id_mat_hang = 'LAPTOP'");
	$laptop = mysqli_fetch_array($laptop);
	?>
    <div id="laptop-container" class="container-responsive">
        <div class="navigat">
            <span>LAPTOP NỔI BẬT</span>
            <ul>
                <li><a href="">Laptop DELL</a></li>
                <li><a href="">Laptop ASUS</a></li>
                <li><a href="">Laptop HP</a></li>
                <li><a href="">Laptop Lenovo</a></li>
                <li><a href="">Laptop MacBook</a></li>
                <li><a href="view_all_product.php?all_laptop">Xem tất cả <?= $laptop['soluong'] ?> Laptop</a></li>
            </ul>
        </div>
        <div class="homeproduct">
            <ul class="list">
                <!-- <li class="feature pd-1">
					<a href="">
						<img src="https://cdn.tgdd.vn/Products/Images/44/212657/Feature/asus-vivobook-a412fa-i5-8265u-8gb-32gb-512gb-win10-480x222.jpg">
						<div class="feature-promo">
							<div class="feature-promo-left">
								<h2 class="name-sp">Samsung Galaxy S10 Lite</h2>
								<div class="price">
									<strong>14.990.000₫</strong>
								</div>
							</div>
							<div class="feature-label">Trả góp 0%</div>
						</div>
					</a>
				</li> -->
                <?php
				$result = mysqli_query($conn, "SELECT * FROM san_pham WHERE id_mat_hang = 'LAPTOP'");
				while ($laptop = mysqli_fetch_array($result)) {
				?>
                <li class="main-product">
                    <a href="product_info.php?id=<?= $laptop['id_san_pham'] ?>">
                        <div class="product">
                            <div class="img">
                                <img src="./<?= $laptop['hinh_anh'] ?>" title="<?= $laptop['ten_san_pham'] ?>" />
                                <label class="discount product-label">GIẢM
                                    <?= number_format($laptop['giam_gia'], 0, ",", ".") ?>₫</label>
                            </div>

                            <div class="promo">
                                <div class="name-sp"><?= $laptop['ten_san_pham'] ?></div>
                                <div class="price">
                                    <strong><?= number_format($laptop['gia_ban'], 0, ",", ".") ?> đ</strong>
                                    <span><?= number_format($laptop['gia_ban'] + $laptop['giam_gia'], 0, ",", ".") ?>
                                        đ</span>
                                </div>
                                <div class="endow">
                                    <p><?= $laptop['noi_dung'] ?></p>
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <!--FIVE-CONTAINT-->
    <!--SIX-CONTAINT-->
    <?php
	$tablet = mysqli_query($conn, "SELECT  COUNT(*) as soluong FROM san_pham WHERE id_mat_hang = 'TABLET'");
	$tablet = mysqli_fetch_array($tablet);
	?>
    <div id="tablet-container" class="container-responsive">
        <div class="navigat">
            <span>TAPLET NỔI BẬT</span>
            <ul>
                <li><a href="">Tablet IPad</a></li>
                <li><a href="">Tablet Samsung</a></li>
                <li><a href="">Tablet Huawei</a></li>
                <li><a href="">Tablet Lenovo</a></li>
                <li><a href="">Tablet mobell</a></li>
                <li><a href="view_all_product.php?all_tablet">Xem tất cả <?= $tablet['soluong'] ?> Tablet</a></li>
            </ul>
        </div>
        <div class="homeproduct">
            <ul class="list">
                <!-- <li class="feature pd-1">
					<a href="">
						<img src="https://cdn.tgdd.vn/Products/Images/522/208870/Feature/samsung-galaxy-tab-s6-ft-480x222-10.jpg">
						<div class="feature-promo">
							<div class="feature-promo-left">
								<h2 class="name-sp">Samsung Galaxy Tab S6</h2>
								<div class="price">
									<strong>18.490.000₫</strong>
								</div>
							</div>
							<div class="feature-label">Trả góp 0%</div>
						</div>
					</a>
				</li> -->
                <?php
				$result = mysqli_query($conn, "SELECT * FROM san_pham WHERE id_mat_hang = 'TABLET'");
				while ($tablet = mysqli_fetch_array($result)) {
				?>

                <li class="main-product">
                    <a href="product_info.php?id=<?= $tablet['id_san_pham'] ?>">
                        <div class="product">
                            <div class="img">
                                <img src="./<?= $tablet['hinh_anh'] ?>" title="<?= $tablet['ten_san_pham'] ?>" />
                                <label class="discount product-label">GIẢM
                                    <?= number_format($tablet['giam_gia'], 0, ",", ".") ?>₫</label>
                            </div>
                            <div class="promo">
                                <div class="name-sp"><?= $tablet['ten_san_pham'] ?></div>
                                <div class="price">
                                    <strong><?= number_format($tablet['gia_ban'], 0, ",", ".") ?> đ</strong>
                                    <span>6.999.000₫</span>
                                </div>
                                <div class="endow">
                                    <p><?= $tablet['noi_dung'] ?></p>
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <!-- --- -->
    <?php
	// $pc = mysqli_query($conn, "SELECT  COUNT(*) as soluong FROM san_pham WHERE id_mat_hang = 'PC'");
	// $pc = mysqli_fetch_array($pc);
	?>
    <!-- <div id="tablet-container" class="container-responsive">
        <div class="navigat">
            <span>PC NỔI BẬT</span>
            <ul>
                <li><a href="">PC Gaming</a></li>
                <li><a href="">PC Văn phòng</a></li>
                <li><a href="view_all_product.php?all_pc">Xem tất cả <?= $pc['soluong'] ?> PC</a></li>
            </ul>
        </div>
        <div class="homeproduct">
            <ul class="list"> -->
    <!-- <li class="feature pd-1">
					<a href="">
						<img src="https://cdn.tgdd.vn/Products/Images/522/208870/Feature/samsung-galaxy-tab-s6-ft-480x222-10.jpg">
						<div class="feature-promo">
							<div class="feature-promo-left">
								<h2 class="name-sp">Samsung Galaxy Tab S6</h2>
								<div class="price">
									<strong>18.490.000₫</strong>
								</div>
							</div>
							<div class="feature-label">Trả góp 0%</div>
						</div>
					</a>
				</li> -->
    <?php
	// $result = mysqli_query($conn, "SELECT * FROM san_pham WHERE id_mat_hang = 'PC'");
	// while ($pc = mysqli_fetch_array($result)) {
	?>

    <!-- <li class="main-product">
        <a href="product_info.php?id=<?= $pc['id_san_pham'] ?>">
            <div class="product">
                <div class="img">
                    <img src="./<?= $pc['hinh_anh'] ?>" title="<?= $pc['ten_san_pham'] ?>" />
                    <label class="discount product-label">GIẢM
                        <?= number_format($pc['giam_gia'], 0, ",", ".") ?>₫</label>
                </div>
                <div class="promo">
                    <div class="name-sp"><?= $pc['ten_san_pham'] ?></div>
                    <div class="price">
                        <strong><?= number_format($pc['gia_ban'], 0, ",", ".") ?> đ</strong>
                        <span>6.999.000₫</span>
                    </div>
                    <div class="endow">
                        <p><?= $pc['noi_dung'] ?></p>
                    </div>
                </div>
            </div>
        </a>
    </li> -->
    <?php
	//  } 
	?>
    <!-- </ul> -->
    <!-- </div> -->
    <!-- </div> -->
    <!-- --- -->
    <?php
	// $sound = mysqli_query($conn, "SELECT  COUNT(*) as soluong FROM san_pham WHERE id_mat_hang = 'SOUND'");
	// $sound = mysqli_fetch_array($sound);
	?>
    <!-- <div id="tablet-container" class="container-responsive">
        <div class="navigat">
            <span>ÂM THANH NỔI BẬT</span>
            <ul>
                <li><a href="">Sony</a></li>
                <li><a href="">Samsung</a></li>
                <li><a href="">Panasonic</a></li>
                <li><a href="view_all_product.php?all_sound">Xem tất cả <?= $sound['soluong'] ?> Âm thanh</a></li>
            </ul>
        </div>
        <div class="homeproduct">
            <ul class="list"> -->
    <!-- <li class="feature pd-1">
					<a href="">
						<img src="https://cdn.tgdd.vn/Products/Images/522/208870/Feature/samsung-galaxy-tab-s6-ft-480x222-10.jpg">
						<div class="feature-promo">
							<div class="feature-promo-left">
								<h2 class="name-sp">Samsung Galaxy Tab S6</h2>
								<div class="price">
									<strong>18.490.000₫</strong>
								</div>
							</div>
							<div class="feature-label">Trả góp 0%</div>
						</div>
					</a>
				</li> -->
    <?php
	// $result = mysqli_query($conn, "SELECT * FROM san_pham WHERE id_mat_hang = 'SOUND'");
	// while ($tablet = mysqli_fetch_array($result)) {
	?>

    <!-- <li class="main-product">
        <a href="product_info.php?id=<?= $tablet['id_san_pham'] ?>">
            <div class="product">
                <div class="img">
                    <img src="./<?= $tablet['hinh_anh'] ?>" title="<?= $tablet['ten_san_pham'] ?>" />
                    <label class="discount product-label">GIẢM
                        <?= number_format($tablet['giam_gia'], 0, ",", ".") ?>₫</label>
                </div>
                <div class="promo">
                    <div class="name-sp"><?= $tablet['ten_san_pham'] ?></div>
                    <div class="price">
                        <strong><?= number_format($tablet['gia_ban'], 0, ",", ".") ?> đ</strong>
                        <span>6.999.000₫</span>
                    </div>
                    <div class="endow">
                        <p><?= $tablet['noi_dung'] ?></p>
                    </div>
                </div>
            </div>
        </a>
    </li> -->
    <?php
	// } 
	?>
    <!-- </ul> -->
    <!-- </div> -->
    <!-- </div> -->
    <!--SIX-CONTAINT-->
    <!--SEVEN_CONTAINT-->
    <?php
	$phukien = mysqli_query($conn, "SELECT  COUNT(*) as soluong FROM san_pham WHERE id_mat_hang = 'PHUKIEN'");
	$phukien = mysqli_fetch_array($phukien);
	?>
    <div id="seven-containt">
        <div class="navigat">
            <span>PHỤ KIỆN NỔI BẬT</span>
            <ul>
                <li><a href="">Ốp lưng điện thoại</a></li>
                <li><a href="">Thẻ nhớ</a></li>
                <li><a href="">Tai nghe</a></li>
                <li><a href="">Pin sạc dự phòng</a></li>
                <li><a href="">Loa</a></li>
                <li><a href="">Cáp sạc</a></li>

                <li><a href="view_all_product.php?all_accessory">Xem tất cả <?= $phukien['soluong'] ?> Phụ kiện</a></li>
            </ul>
        </div>
        <div class="container-slide-sp seven-container-slide-sp">
            <div class="owl-carousel owl-theme" id="myOwlCarousel-2">
                <?php
				$products_Phone = mysqli_query($conn, "SELECT * FROM san_pham WHERE id_mat_hang = 'PHUKIEN'");
				while ($row = mysqli_fetch_array($products_Phone)) { ?>
                <div class="item">
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
                                    <strong><?= number_format($row['gia_ban'], 0, ",", ".") ?> ₫</strong>
                                    <span><?= number_format($row['gia_ban'] + $row['giam_gia'], 0, ",", ".") ?> đ</span>
                                </div>
                                <div class="endow">
                                    <p><?= $row['noi_dung'] ?></p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <?php } ?>
            </div>
            <!--================SLIDE-2-END===============-->
        </div>
    </div>
    <!-- DONG HO -->
    <!--SEVEN_CONTAINT-->
    <?php
	// $watch = mysqli_query($conn, "SELECT  COUNT(*) as soluong FROM san_pham WHERE id_mat_hang = 'WATCH'");
	// $watch = mysqli_fetch_array($watch);
	?>
    <!-- <div id="seven-containt">
        <div class="navigat">
            <span>ĐỒNG HỒ NỔI BẬT</span>
            <ul>
                <li><a href="">Rolex</a></li>
                <li><a href="">Casio</a></li>
                <li><a href="">Rado</a></li>
                <li><a href="">Omega</a></li>

                <li><a href="view_all_product.php?all_watch">Xem tất cả <?= $watch['soluong'] ?> Đồng hồ</a></li>
            </ul>
        </div>
        <div class="container-slide-sp seven-container-slide-sp">
            <div class="owl-carousel owl-theme" id="myOwlCarousel-watch"> -->
    <?php
	// $products_watch = mysqli_query($conn, "SELECT * FROM san_pham WHERE id_mat_hang = 'WATCH'");
	// while ($row = mysqli_fetch_array($products_watch)) { 
	?>
    <!-- <div class="item">
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
                        <strong><?= number_format($row['gia_ban'], 0, ",", ".") ?> ₫</strong>
                        <span><?= number_format($row['gia_ban'] + $row['giam_gia'], 0, ",", ".") ?> đ</span>
                    </div>
                    <div class="endow">
                        <p><?= $row['noi_dung'] ?></p>
                    </div>
                </div>
            </div>
        </a>
    </div> -->
    <?php
	// }
	?>
    <!-- </div> -->
    <!--================SLIDE-2-END===============-->
    <!-- </div> -->
    <!-- </div> -->
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
<?php
include './connect_db.php';
// HEADER
include './web/header.php';
//Get ID sản phẩm hiện tại
?>
<!-- ===================================================================================-->
<!--MAIN-CONTAINT -->
<div id="main-containt">
	<?php
	$id = $_GET['id'];
	$queryProduct = $conn->query("SELECT ten_san_pham FROM san_pham WHERE id_san_pham = '$id'");
	if ($queryProduct->num_rows == 0) {
		echo '<div id="containt" class="justify-content-center d-flex align-items-center" style="min-height: calc(100vh - 360px)">
				<p class="font-weight-bold">Không tìm thấy sản phẩm</p>
			</div>';
	} else {

		$sql = "SELECT * FROM san_pham WHERE id_san_pham = '$id'";
		$result = $conn->query($sql);
		$current_product = $result->fetch_array();
	?>
		<div id="containt">
			<div class="rowtop mt-3">
				<div class="bread-crumb">
					<span>
						<a href="index2.php">Trang chủ </a>/
						<a class="text-danger font-weight-bold" href="#"> Thông tin sản phẩm </a>
					</span>
				</div>
			</div>
			<div class="product-info-arena">
				<div class="row w-100 m-0 ">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 d-flex justify-content-center">
						<div class="picture">
							<div class="pc-tab">
								<input id="tab1" type="radio" name="pct" checked />
								<input id="tab2" type="radio" name="pct">
								<input id="tab3" type="radio" name="pct">
								<input id="tab4" type="radio" name="pct">
								<section>
									<div class="tab1">
										<img src="./<?= $current_product['hinh_anh']; ?>" alt="">
									</div>
									<?php
									$sql_img = "SELECT * FROM hinh_anh_san_pham WHERE id_san_pham = '$id'";
									$result_imgs = $conn->query($sql_img);
									$stt = 1;
									foreach ($result_imgs as $result_img) {
										++$stt;
									?>
										<div class="<?= 'tab' . $stt ?>">
											<img src=".<?= $result_img['link_anh_mo_ta'] ?>" alt="">
										</div>
									<?php } ?>
								</section>
								<div class="dots-items">
									<div class="tab tab1">
										<label for="tab1">
											<img src="./<?= $current_product['hinh_anh']; ?>" alt="">
											<!-- <span>Xanh</span> -->
										</label>
									</div>
									<?php
									$stt = 1;
									foreach ($result_imgs as $result_img) {
										++$stt;
									?>
										<div class="tab <?= 'tab' . $stt ?>">
											<label for="<?= 'tab' . $stt ?>">
												<img src=".<?= $result_img['link_anh_mo_ta'] ?>" alt="">
												<!-- <span>Xanh</span> -->
											</label>
										</div>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 d-flex justify-content-center">
						<div class="price-sale">
							<div class="product-name">
								<h1><?= $current_product['ten_san_pham']; ?></h1>
								<!-- <span>Đánh giá: </span>
								<div class="stars">
									<label class="rate">
										<input type="radio" name="radio1" id="star1" value="star1">
										<div class="face"></div>
										<i class="far fa-star star one-star"></i>
									</label>
									<label class="rate">
										<input type="radio" name="radio1" id="star2" value="star2">
										<div class="face"></div>
										<i class="far fa-star star two-star"></i>
									</label>
									<label class="rate">
										<input type="radio" name="radio1" id="star3" value="star3">
										<div class="face"></div>
										<i class="far fa-star star three-star"></i>
									</label>
									<label class="rate">
										<input type="radio" name="radio1" id="star4" value="star4">
										<div class="face"></div>
										<i class="far fa-star star four-star"></i>
									</label>
									<label class="rate">
										<input type="radio" name="radio1" id="star5" value="star5">
										<div class="face"></div>
										<i class="far fa-star star five-star"></i>
									</label>
								</div> -->
							</div>
							<div>
								<h1 class="h5"><span class="badge badge-success my-2">Giá bán</span></h1>
							</div>
							<div class="price">
								<strong><?= number_format($current_product['gia_ban'], 0, ',', '.') ?>đ</strong>
								<span><?= number_format($current_product['gia_ban'] + $current_product['giam_gia'], 0, ',', '.') ?></span>
								<label for="">&nbsp; -<?= number_format($current_product['giam_gia'], 0, ',', '.') ?>đ</label>
							</div>
							<!-- <div class="memory">
								<span>Bạn đang xem phiên bản: <strong>64GB</strong></span>
								<div class="version">
									<div class="ver-product">
										<input type="radio" checked> 64GB
										<strong>21.690.000đ</strong>
									</div>
									<div class="ver-product">
										<input type="radio"> 64GB
										<strong>21.690.000đ</strong>
									</div>
								</div>
							</div> -->
							<div class="area_promotion">
								<p><?= $current_product['noi_dung']; ?></p>
							</div>
							<div class="service">
								<h1>Chọn dịch vụ bạn cần:</h1>
								<p><input type="checkbox" checked> Giao hàng tận nhà</p>
							</div>
							<div>
								<h1 class="h5"><span class="badge badge-success my-3">Số lượng</span></h1>
							</div>
							<div class="buy-product">
								<?php
								if (empty($current_user)) { ?>
									<form action="shopping_cart.php?action=add" method="POST">
										<div class="button-added">
											<input style="font-size:20px" class="minus is-form" type="button" value="-">
											<input style="font-size:20px" class="input-amount" type="number" value="1" min="1" max="10" name="quantity[<?= $current_product['id_san_pham'] ?>]" aria-quality="quantity" readonly>
											<input style="font-size:20px" class="plus is-form" type="button" value="+">
										</div>
										<div class="buy my-4">
											<input id="muasanpham" type="submit" value="Mua sản phẩm">
										</div>
									</form>
								<?php } else { ?>
									<form action="shopping_cart.php?action=add&&id=<?= $current_product['id_san_pham'] ?>" method="POST">
										<div class="button-added">
											<input style="font-size:20px" class="minus is-form" type="button" value="-">
											<input style="font-size:20px" class="input-amount" type="number" value="1" min="1" max="10" name="soluong" readonly>
											<input style="font-size:20px" class="plus is-form" type="button" value="+">
										</div>
										<div class="buy my-4">
											<input id="muasanpham" type="submit" value="Mua sản phẩm">
										</div>
									</form>
								<?php }	?>
							</div>
						</div>
					</div>

					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 d-flex justify-content-center">
						<div class="tableparameter">
							<h1>Thông số kỹ thuật</h1>
							<table>
								<?php
								$sql_thongso = "SELECT * FROM thong_so_san_pham WHERE id_san_pham = '$id'";
								$result_thongso = $conn->query($sql_thongso);
								$stt = 1;
								foreach ($result_thongso as $thongso) {
									++$stt;
								?>
									<tr>
										<td><?= $thongso['ten_thong_so']; ?>:</td>
										<td><?= $thongso['mo_ta_thong_so']; ?></td>
									</tr>
								<?php } ?>

							</table>
						</div>
					</div>
				</div>
				<hr>
				<div class="row m-0">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 mb-2">
						Bình luận sản phẩm <b class="text-danger"><?= $current_product['ten_san_pham']?></b>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
						<?php 
						if(!empty($current_user)) {
							if(isset($_POST['gui_binh_luan'])) { 
								$id = $_GET['id'];
								$ma_kh = $current_user['ma_kh'];
								$binhluancuatoi = $_POST['binhluancuatoi'];
								$insert_binh_luan = $conn
									->query("INSERT INTO `binh_luan_san_pham` (`id_binh_luan`, `id_san_pham`, `ma_kh`, `noi_dung_binh_luan`, `thoi_gian_binh_luan`) 
												VALUES (NULL, '$id', '$ma_kh', '$binhluancuatoi', current_timestamp());");
								// var_dump($id,$ma_kh, $binhluancuatoi);exit;
							} else { 
								?>
								<div>
									<form action="" method="post">
										<label>Bình luận của bạn:</label><br>
										<textarea name="binhluancuatoi" class="w-100 my-2 p-2" style="outline: none"></textarea>
										<input type="submit" name="gui_binh_luan" class="btn btn-sm btn-info" value="gửi">
									</form>
								</div>	
							<?php }
							}
							?>
							<div>
								<hr>
								<p>Tất cả bình luận</p>
							</div>
							<div class="border p-2 mt-2">
								<?php 
								$today = date("d/m/Y");
								$select_binh_luan = $conn
								->query("	SELECT * FROM binh_luan_san_pham as b, khach_hang as k
											WHERE id_san_pham = '$id' and b.ma_kh = k.ma_kh ORDER BY thoi_gian_binh_luan DESC");
								if($select_binh_luan->num_rows == 0) {
									echo "<p>Sản phẩm chưa có bình luận</p>";
								} else { 
									foreach($select_binh_luan as $binh_luan):
										$new_date = explode(' ',$binh_luan['thoi_gian_binh_luan']);
										$today = date("Y/m/d");
										$first_date = strtotime($today);
										$second_date = strtotime($new_date[0]);
										$datediff = abs($first_date - $second_date);
									?>
									<label>
										<b class=""> <?= $binh_luan['ho_lot'] ." ". $binh_luan['ten_kh'] ?></b> -
										<?php
											if(!empty($current_user)) {?>
												<b class="badge <?= $binh_luan['ma_kh'] == $current_user['ma_kh'] ? 'badge-danger' : 'badge-info'  ?>"> <?= $binh_luan['ma_kh'] == $current_user['ma_kh'] ? 'Tôi' : 'Người dùng' ?> </b>
											<?php } else { ?>
										<b class="badge badge-info"> người dùng </b>
												<?php } ?> 
									</label>
									<p class="mt-2">&emsp; - <?= $binh_luan['noi_dung_binh_luan']?> 
										<span class="ml-2" style="color:#999"> • <?= floor($datediff / (60*60*24)) == 0 ? "Hôm nay" : floor($datediff / (60*60*24)) . " ngày trước" ?> </span>
									</p>
									<hr>
								<?php	
									endforeach;
									} 
								?> 
							</div>		
					</div>
				</div>
			</div>
		</div>
		<a href="#" class="back-to-top" id="back-to-top"></a>
		<!-- <div class="night-mod-button">
			<img class="logo-bt-nm" src="./images/lododarkmode-open-sun5.png" title="Change theme">
		</div> -->
		<!--END-MAIN-CONTAINT-->
		<!--FOOTER-->
	<?php
	}
	
	include './web/footer.php';
	?>
</div>
<!--END-FOOTER-->
</div>

<link id="dark-mode" rel="stylesheet" type="text/css" href="">
<script src="./js/slide.js"></script>
<script type="text/javascript" src="./js/index.js"></script>
<script>
	$('input.input-amount').each(function() {
		var $this = $(this),
			amount = $this.parent().find('.is-form'),
			min = Number($this.attr('min')),
			max = Number($this.attr('max'))
		if (min == 0) {
			var d = 0
		} else
			d = min
		$(amount).on('click', function() {
			if ($(this).hasClass('minus')) {
				if (d > min) d += -1
			} else if ($(this).hasClass('plus')) {
				var x = Number($this.val()) + 1
				if (x <= max) d += 1
			}
			$this.attr('value', d).val(d);
		});
	});
</script>
</body>

</html>














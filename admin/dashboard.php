<?php 
     include 'header.php';
    if (!empty($_SESSION['current_admin'])) {
        $all_product = mysqli_query($conn, "SELECT COUNT(*) as all_product FROM san_pham");
        $all_product= mysqli_fetch_assoc($all_product);
        // 
        $all_user = mysqli_query($conn, "SELECT COUNT(*) as all_user FROM khach_hang");
        $all_user= mysqli_fetch_assoc($all_user);
        // 
        $all_order = mysqli_query($conn, "SELECT COUNT(*) as all_order FROM don_hang");
        $all_order= mysqli_fetch_assoc($all_order);
        // 
        $all_money = mysqli_query($conn, "SELECT SUM(tong_tien) as all_money FROM don_hang");
        $all_money = mysqli_fetch_assoc($all_money);
?>
    <div class="framework dashboard" >
        <div class="bread-cump">
            <p style="font-size:18px;font-weight:600"><img src="../images/logo-db.png">Dashboard</p>
            <p><a href="user_listing.php">Home</a> / <b>Dashboard</b></p>
        </div>
        <div class="container_ctn" style="min-height:80vh;display:block;">
            <div class="db-top">
               <a href="product_listing.php">
                    <div class="db-top-box">
                        <div class="box-product">
                            <div class="db-img">
                                <img src="../images/product-db.png" alt="">
                            </div>
                            <div class="general">
                                <h1 id="amount-product"><?= $all_product['all_product']; ?></h1>
                                <p>Sản phẩm </p>
                            </div>
                        </div>
                        <div class="doc"><b>View</b>➤</div>
                    </div>
               </a>
               <a href="">
                    <div class="db-top-box">
                        <div class=" box-user">
                            <div class="db-img">
                                <img src="../images/user-db.png" alt="">
                            </div>
                            <div class="general">
                                <h1 id="amount-user"><?= $all_user['all_user']; ?></h1>
                                <p>Khách hàng</p>
                            </div>
                        </div>
                        <div class="doc"><b>View</b>➤</div>
                    </div>
               </a>
                <a href="">
                    <div class="db-top-box">
                        <div class="box-order">
                            <div class="db-img">
                                <img src="../images/order-db.png" alt="">
                            </div>
                            <div class="general">
                                <h1 id="amount-order"><?= $all_order['all_order']; ?></h1>
                                <p>Tổng đơn hàng </p>
                            </div>
                        </div>
                        <div class="doc"><b>View</b>➤</div>
                    </div>
                </a>
                <a href="">
                    <div class="db-top-box">
                        <div class="box-revenue">
                            <div class="db-img">
                                <img src="../images/money-db.png" alt="">
                            </div>
                            <div class="general">
                                <h2 style="font-size: 18px;"><span id="amount-money"><b><?= number_format($all_money['all_money'],0,",",".") ?></b></span><span>đ</span></h2>
                                <p>Doanh thu </p>
                            </div>
                        </div>
                        <div class="doc"><b>View</b>➤</div>
                    </div>
                </a>
            </div>
            <!-- DB-CENTER -->
            <?php 
                $dienthoai = mysqli_query($conn, "SELECT COUNT(*) as dienthoai FROM san_pham WHERE id_mat_hang = 'PHONE'");
                $dienthoai = mysqli_fetch_array($dienthoai);
                // 
                $laptop = mysqli_query($conn, "SELECT COUNT(*) as laptop FROM san_pham WHERE id_mat_hang = 'LAPTOP'");
                $laptop = mysqli_fetch_array($laptop);
                // 
                $tablet = mysqli_query($conn, "SELECT COUNT(*) as tablet FROM san_pham WHERE id_mat_hang = 'TABLET'");
                $tablet = mysqli_fetch_array($tablet);
                // 
                $phukien = mysqli_query($conn, "SELECT COUNT(*) as phukien FROM san_pham WHERE id_mat_hang = 'PHUKIEN'");
                $phukien = mysqli_fetch_array($phukien);
                 // 
                 $pc = mysqli_query($conn, "SELECT COUNT(*) as pc FROM san_pham WHERE id_mat_hang = 'PC'");
                 $pc = mysqli_fetch_array($pc);
                  // 
                $watch = mysqli_query($conn, "SELECT COUNT(*) as watch FROM san_pham WHERE id_mat_hang = 'WATCH'");
                $watch = mysqli_fetch_array($watch);
                 // 
                 $sound = mysqli_query($conn, "SELECT COUNT(*) as sound FROM san_pham WHERE id_mat_hang = 'SOUND'");
                 $sound = mysqli_fetch_array($sound);
            ?>
            <div class="db-center">
                    <div class="db-center-left">
                        <div class="view-line">
                            <h3>Điện thoại: <span><?=$dienthoai['dienthoai']?></span> sản phẩm</h3>
                            <div class="view-line">
                                <!-- <span class="bar bar-product">
                                    <span class="new-product">
                                        <span class="status-header"><span id="new-product-percent">67 </span><span> %</span></span>
                                    </span> 
                                </span> -->
                            </div>
                        </div>
                        <div class="view-line">
                            <h3>Laptop: <span><?=$laptop['laptop']?></span> sản phẩm</h3>
                            <div class="view-line">
                                <!-- <span class="bar bar-user">
                                    <span class="new-user">
                                        <span class="status-header"><span id="new-user-percent">20 </span><span> %</span></span>
                                    </span> 
                                </span> -->
                            </div>
                        </div>
                        <div class="view-line">
                            <h3>Máy tính bản: <span><?=$tablet['tablet']?></span> sản phẩm</h3>
                            <div class="view-line">
                                <!-- <span class="bar bar-oder">
                                    <span class="new-order">
                                        <span class="status-header"><span id="new-order-percent">50 </span><span> %</span></span>
                                    </span> 
                                </span> -->
                            </div>
                        </div>
                        <div class="view-line">
                            <h3>Phụ kiện: <span><?=$phukien['phukien']?></span> sản phẩm</h3>
                            <div class="view-line">
                                <!-- <span class="bar bar-money">
                                    <span class="new-money">
                                        <span class="status-header"><span id="new-money-percent">85 </span><span> %</span></span>
                                    </span> 
                                </span> -->
                            </div>
                        </div>
                        <div class="view-line">
                            <h3>Máy tính: <span><?=$pc['pc']?></span> sản phẩm</h3>
                            <div class="view-line">
                                <!-- <span class="bar bar-money">
                                    <span class="new-money">
                                        <span class="status-header"><span id="new-money-percent">85 </span><span> %</span></span>
                                    </span> 
                                </span> -->
                            </div>
                        </div>
                        <div class="view-line">
                            <h3>Đồng hồ: <span><?=$watch['watch']?></span> sản phẩm</h3>
                            <div class="view-line">
                                <!-- <span class="bar bar-money">
                                    <span class="new-money">
                                        <span class="status-header"><span id="new-money-percent">85 </span><span> %</span></span>
                                    </span> 
                                </span> -->
                            </div>
                        </div>
                        <div class="view-line">
                            <h3>Âm thanh: <span><?=$sound['sound']?></span> sản phẩm</h3>
                            <div class="view-line">
                                <!-- <span class="bar bar-money">
                                    <span class="new-money">
                                        <span class="status-header"><span id="new-money-percent">85 </span><span> %</span></span>
                                    </span> 
                                </span> -->
                            </div>
                        </div>
                    </div>
                    <?php 
                        $donhang_trongtuan = mysqli_query($conn,"SELECT COUNT(*) as donhangin7ngay FROM don_hang WHERE DAY(thoi_gian_dat) > DAY(CURRENT_DATE)-7");
                        $donhang_trongtuan = mysqli_fetch_array($donhang_trongtuan);
                        // 
                        $khachhang_trongtuan = mysqli_query($conn,"SELECT COUNT(*) as khachhangin7ngay FROM khach_hang WHERE DAY(ngay_cap_nhat) > DAY(CURRENT_DATE)-7");
                        $khachhang_trongtuan = mysqli_fetch_array($khachhang_trongtuan);
                         // 
                         $sanpham_trongtuan = mysqli_query($conn,"SELECT SUM(so_luong) as SP_Sell_In_7D FROM chi_tiet_don_hang WHERE DAY(thoi_gian_dat) > DAY(CURRENT_DATE)-7");
                         $sanpham_trongtuan = mysqli_fetch_array($sanpham_trongtuan);
                    ?>
                    <div class="db-center-center">
                        <div class="view-circle">
                            <div class="circlechart" data-percentage="6">Đơn hàng</div>
                            <div class="">
                                <h3>Có <span><?= $donhang_trongtuan['donhangin7ngay']?></span> Đơn hàng mới trong 7 ngày gần đây</h3>
                            </div>
                        </div>
                        <div class="view-circle">
                            <div class="circlechart" data-percentage="5">Khách hàng</div>
                            <div class="">
                                <h3>Có <span><?= $khachhang_trongtuan['khachhangin7ngay']?></span> Khách hàng mới trong 7 ngày gần đây</h3>
                            </div>
                        </div>
                        <div class="view-circle">
                            <div class="circlechart" data-percentage="30">Danh thu</div>
                            <div class="">
                                <h3>Có <span><?= $sanpham_trongtuan['SP_Sell_In_7D']?></span> sản phẩm đã bán trong 7 ngày gần đây</h3>
                            </div>
                        </div>
                    </div>
                    <!-- db_CENTER- RIGHT -->
                    <!-- <div class="db-center-right">
                        <div class="view-line-visited">
                            <span class=" bar-visited">
                                <span class="visited">
                                    <span class="status-header"><span id="amount-visited">125000</span><span> truy cập</span></span>
                                </span>
                            </span>
                        </div>
                        <h3>Lượng truy cập</h3> -->
                    </div>
            </div>
        </div>
    </div>
    <script>
        function easeOutExpo(x) {
            return x === 1 ? 1 : 1 - Math.pow(2, -10 * x);
            }
            function animateNumber(finalNumber, duration = 5000, startNumber = 0, callback) {
            const startTime = performance.now()
            function updateNumber(currentTime) {
                const elapsedTime = currentTime - startTime
                if (elapsedTime > duration) {
                callback(finalNumber)
                } else {
                const timeRate = (1.0 * elapsedTime) / duration
                const numberRate = easeOutExpo(timeRate)
                const currentNumber = Math.round(numberRate * finalNumber)
                callback(currentNumber)
                requestAnimationFrame(updateNumber)
                }
            }
            requestAnimationFrame(updateNumber)
            }
            document.addEventListener('DOMContentLoaded', function () {
                let money = document.getElementById("amount-money").innerHTML;
                let user = document.getElementById("amount-user").innerHTML;
                let product = document.getElementById("amount-product").innerHTML;

                let new_money = document.getElementById("new-money-percent").innerHTML;
                let new_user = document.getElementById("new-user-percent").innerHTML;
                let new_product = document.getElementById("new-product-percent").innerHTML;
                let new_order = document.getElementById("new-order-percent").innerHTML;
                let amount_visited = document.getElementById("amount-visited").innerHTML;

            animateNumber(<?= $all_money['all_money'] ?>, 3000, 0, function (number) {
                const formattedNumber = number.toLocaleString()
                document.getElementById('amount-money').innerText = formattedNumber
            })
            animateNumber(user, 3000, 0, function (number) {
                const formattedNumber = number.toLocaleString()
                document.getElementById('amount-user').innerText = formattedNumber
            })
            animateNumber(product, 3000, 0, function (number) {
                const formattedNumber = number.toLocaleString()
                document.getElementById('amount-product').innerText = formattedNumber
            })

            animateNumber(new_money, 3000, 0, function (number) {
                const formattedNumber = number.toLocaleString()
                document.getElementById('new-money-percent').innerText = formattedNumber
            })
            animateNumber(new_user, 3000, 0, function (number) {
                const formattedNumber = number.toLocaleString()
                document.getElementById('new-user-percent').innerText = formattedNumber
            })
            animateNumber(new_product, 3000, 0, function (number) {
                const formattedNumber = number.toLocaleString()
                document.getElementById('new-product-percent').innerText = formattedNumber
            })
            animateNumber(new_order, 3000, 0, function (number) {
                const formattedNumber = number.toLocaleString()
                document.getElementById('new-order-percent').innerText = formattedNumber
            })
            animateNumber(125000, 3000, 0, function (number) {
                const formattedNumber = number.toLocaleString()
                document.getElementById('amount-visited').innerText = formattedNumber
            })

            })
    </script>
        <script>
            $(function(){
                $('.circlechart').circlechart();
            });
        </script>
    	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" ></script>
	    <script src="https://www.jqueryscript.net/demo/jQuery-Plugin-SVG-Progress-Circle/progresscircle.js"></script>
<?php } 
    include 'footer.php';
?>

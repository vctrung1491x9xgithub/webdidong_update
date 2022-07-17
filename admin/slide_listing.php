<?php
include 'header.php';
include './adding.php';
if (!empty($_SESSION['current_admin'])) {

?>
    <div class="framework">
        <div class="breadcrumb bg-white p-2 m-0 mb-3 shadow-sm">
            <h1><i class="fas fa-home text-secondary"></i> <span class="mx-2">&#10095;</span><span class="font-weight-bold">Danh sách slide</span></h1>
        </div>
        <div class="d-flex justify-content-between bg-white rounded border border-success">
            <form action="product_listing.php" class="d-inline-block px-3 mb-2 py-2 w-100 " method="post">
                <!-- card -->
                <p class="pb-2 border-bottom mb-4 font-weight-bold">Danh sách slide</p>
                <div class="card-desk d-flex flex-wrap align-items-center" id="">
                    <div class="d-flex flex-wrap align-items-center" id="ajaxSliderHtml"></div>
                    <div class="d-flex align-items-center h-100 shadow p-3 rounded bg-light" data-toggle="modal" data-target="#ModalAddSlider">
                        <i class="fas fa-plus text-secondary"></i>
                    </div>
                </div>
            </form>
        </div>
        <?php include 'footer.php'; ?>
    </div>
    <!-- END WRAMEWORK -->
    <?php
    if (isset($_GET['action']) && $_GET['action'] == 'addSlider') {
        if (isset($_POST['ten_slider']) && !empty($_POST['ten_slider']) && isset($_POST['id_san_pham']) && !empty($_POST['id_san_pham'])) {
            $ten_slider = $_POST['ten_slider'];
            $id_san_pham = $_POST['id_san_pham'];

            $resultInsertSlider = $conn->query("INSERT INTO `slider` (`id_slider`, `ten_slider`, `ngay_them_slider`) 
                                                VALUES (NULL, '$ten_slider', now());");
            if (!$resultInsertSlider) {
                $error = "Thêm slider không thành công";
            } else {
                $id_slider = $conn->insert_id;
                foreach ($id_san_pham as $id) {
                    $select = $conn->query("SELECT ten_san_pham FROM san_pham WHERE id_san_pham = '$id'");
                    if ($select->num_rows > 0) {
                        $resultInsertSliderDetail = $conn->query("  INSERT INTO `chi_tiet_slider` (`id_chi_tiet_slider`, `id_slider`, `id_san_pham`)
                                                                    VALUES (NULL, '$id_slider', '$id');");
                    }
                }
            }
        } else {
            $error = "<h1>Bạn chưa nhập thông tin slider.</h1><br>";
        } ?>
        <div class="notify-content">
            <div class="error">
                <?= isset($error) ? $error : '<script>window.location.href = "./slide_listing.php"</script>' ?>
            </div>
            <a href="slide_listing.php">Quay lại danh sách sản phẩm</a>
        </div>
    <?php } else { ?>
        <div id="ModalAddSlider" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header py-2 bg-white">
                        <p class="modal-title h5">Thêm mới Slider</p>
                        <button type="button" class="btn btn-sm" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form id="product-form" method="POST" action="?action=addSlider" enctype="multipart/form-data">
                            <div class="mb-2 wrap-field">
                                <label class="m-0 font-weight-bold">Tên slider</label>
                                <input type="text" name="ten_slider" placeholder="Nhập tên slide">
                            </div>
                            <table id="example" class="table table-hover bg-white p-2 rounded">
                                <thead style="background: #008776; color:#FFF">
                                    <tr>
                                        <th scope="col">Chọn</th>
                                        <th scope="col">#</th>
                                        <th scope="col">Ảnh</th>
                                        <th scope="col">Tên</th>
                                        <th scope="col">Hãng</th>
                                        <th scope="col">Giá bán</th>
                                        <th scope="col">Giảm giá</th>
                                        <th scope="col">Pay</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $stt = 0;
                                    $select = "SELECT * FROM san_pham as sp, danh_muc_thuong_hieu as dmth
                                                        WHERE sp.id_thuong_hieu = dmth.id_thuong_hieu  
                                                        ORDER BY id_san_pham  ";
                                    $query = $conn->query($select);
                                    foreach ($query as $product) :
                                        ++$stt;
                                    ?>
                                        <tr>
                                            <td class="text-center">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="id_san_pham[]" value="<?= $product['id_san_pham']; ?>">
                                                    </label>
                                                </div>
                                            </td>
                                            <td class="text-center"><?= $stt; ?></td>
                                            <td class="product-img">
                                                <img style="width: 50px !important" src="../<?= $product['hinh_anh']; ?>" alt="<?= $product['ten_san_pham']; ?>" title="<?= $product['ten_san_pham']; ?>" />
                                            </td>
                                            <td><?= $product['ten_san_pham']; ?></td>
                                            <td><?= $product['ten_thuong_hieu']; ?></td>
                                            <td><?= number_format($product['gia_ban'], 0, ',', '.'); ?>đ</td>
                                            <td><?= number_format($product['giam_gia'], 0, ',', '.'); ?>đ</td>
                                            <td><?= $product['pay']; ?></td>
                                        </tr>
                                    <?php
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                    </div>
                    <div class="modal-footer py-2 bg-white">
                        <button type="" id="btnAddSlide" class="btn btn-sm shadow font-weight-bold text-success">Thêm</button>
                        <button type="button" class="btn btn-sm shadow font-weight-bold text-danger" data-dismiss="modal">Huỷ</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
<?php }
}
?>
<script>
    // ajax load data
    $(document).ready(function() {
        LoadData();
    });

    function LoadData() {
        $.ajax({
            url: '../ajax_admin/ajax_slider_loading.php',
            type: "GET",
            success: function(data) {
                $('#ajaxSliderHtml').html(data);
            }
        });
    }
    // end ajax load data 
    // Thêm slide
    $("#btnAddSlide").click(function() {
        var IDSlide = $(this).data('id');
        $.ajax({
            type: "POST",
            url: "../ajax_admin/ajax_slider_delete.php",
            data: {
                IDSlide: IDSlide
            },
            success: function(data) {
                LoadData();
            }
        });
    });

    $('#example').DataTable({
        order: [
            [0, 'asc']
        ],
        "scrollCollapse": true,
        pagingType: 'full_numbers',

        "lengthMenu": [
            [6, -1],
            [6, "All"]
        ],
        "iDisplayLength": 6,
        "language": {
            "lengthMenu": "Danh sách _MENU_ sản phẩm",
            "zeroRecords": "Không tìm thấy dữ liệu tìm kiếm",
            "info": "Trang _PAGE_ trong số tất cả _PAGES_ trang",
            "infoEmpty": "No records available",
            "infoFiltered": "( Được lọc từ _MAX_ dữ liệu trong hệ thống)",
            "search": "Tìm kiếm",
            "oPaginate": {
                "sFirst": "Đầu",
                "sLast": "Cuối",
                "sNext": "Tiếp",
                "sPrevious": "Trước"
            },
        },
    });
</script>
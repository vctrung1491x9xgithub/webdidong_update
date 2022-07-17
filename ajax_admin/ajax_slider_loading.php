<style>
    .card {
        width: 300px;
        height: 200px;
        position: relative;
    }

    .btn-del-slide {
        position: absolute;
        top: -10px;
        right: -10px;
        padding: 5px 7px;
        border-radius: 50%;
    }
    
</style>
<?php
include '../connect_db.php';
$slides = $conn->query("SELECT * FROM slider");
foreach ($slides as $slide) : ?>
    <div class="card shadow mr-5 mb-4 border-0">
        <div class="overflow-auto p-1 h-75 d-flex">
            <?php
            $slides_img = $conn->query("    SELECT hinh_anh 
                                            FROM san_pham as s,  chi_tiet_slider as c
                                            WHERE s.id_san_pham = c.id_san_pham and c.id_slider = " . $slide['id_slider']);
            foreach ($slides_img as $slide_img) :
            ?>
                <img class="w-25" src="../<?= $slide_img['hinh_anh'] ?>" alt="Card image">
            <?php endforeach; ?>
        </div>
        <div class="card-body border-top">
            <p class="card-text h6 font-weight-bold"><?= $slide['ten_slider']; ?></p>
        </div>
        <div class="card-footer border-success">
            <small><?= date("d-m-Y h:i", strtotime($slide['ngay_them_slider'])); ?></small>
        </div>
        <button type="button" data-id="<?= $slide['id_slider']; ?>" class="btn btn-sm btn-danger btn-del-slide"><i class="fas fa-times"></i></button>
        <button type="button" 
                data-slider='{"id":<?= $slide['id_slider']; ?>,"status":"<?= $slide['trang_thai_slider']; ?>"}' 
                class="btn btn-sm <?= $slide['trang_thai_slider'] == "disable" ? "btn-secondary" : "btn-danger" ?> btn-active-slide">
                <?= $slide['trang_thai_slider'] == "disable" ? "Kích hoạt" : "Đang kích hoạt" ?>
        </button>
    </div>
<?php endforeach; ?>

<script>
    $(".btn-del-slide").click(function() {
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
    // ACtive slider
    $(".btn-active-slide").click(function() {
        var IDSlide = $(this).data('slider').id;
        var status = $(this).data('slider').status;
        $.ajax({
            type: "POST",
            url: "../ajax_admin/ajax_slider_active.php",
            data: {
                IDSlide: IDSlide,
                status: status
            },
            success: function(data) {
                LoadData();
            }
        }); 
    });
    // Load Slide listing
    function LoadData() {
        $.ajax({
            url: '../ajax_admin/ajax_slider_loading.php',
            type: "GET",
            success: function(data) {
                $('#ajaxSliderHtml').html(data);
            }
        });
    }
</script>
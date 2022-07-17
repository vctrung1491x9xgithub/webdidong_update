<style>
    .modal-content {
        width: 1000px;
        margin: auto !important;
        height: 80vh;
        background: #F7F8F8;
    }

    .modal-body {
        line-height: 2;
    }

    #ModalAddPhone ::-webkit-scrollbar {
        width: 5px !important;
    }

    @media (min-width: 576px) {
        .modal-dialog {
            max-width: 800px;
            margin: 1.75rem auto;
        }
    }
</style>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
<div id="ModalAddPhone" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header py-2 bg-white">
                <p class="modal-title h5">Thêm mới sản phẩm</p>
                <button type="button" class="btn btn-sm" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body mt-1">
                <?php
                if (isset($_GET['action']) && $_GET['action'] == 'add') {

                    if (isset($_POST['tensanpham']) && !empty($_POST['tensanpham']) && isset($_POST['giaban']) && !empty($_POST['giaban'])) {
                        if (isset($_FILES['image']) && !empty($_FILES['image']['name'][0])) {
                            $uploadedFiles = $_FILES['image'];
                            $result_img = uploadFiles($uploadedFiles);
                            if (!empty($result_img['errors'])) {
                                $error = $result_img['errors'];
                            } else {
                                $image = $result_img['path'];
                            }
                        }
                        if (empty($image)) {
                            $error = "<h1>Lỗi: Bạn chưa chọn ảnh đại diện sản phẩm!</h1><br>";
                        }
                        if (!isset($error)) {
                            $tensanpham = $_POST['tensanpham'];
                            $giaban = $_POST['giaban'];
                            $giamgia = $_POST['giamgia'];
                            $noidung = $_POST['noidung'];

                            $maloaisp = $_POST['mamathang'];
                            $math = $_POST['mathuonghieu'];
                            $resultInsertSanPham = mysqli_query($conn, "INSERT INTO san_pham (id_san_pham, ten_san_pham,  gia_ban, giam_gia, hinh_anh, noi_dung, ngay_cap_nhat, id_mat_hang, id_thuong_hieu) 
                                                                                     VALUES (NULL, '$tensanpham', '$giaban', '$giamgia',  '$image', '$noidung', now(), '$maloaisp','$math');");

                            if (!$resultInsertSanPham) {
                                $error = "Có lỗi xảy ra trong quá trình thực hiện.";
                            } else {
                                $idsp = mysqli_insert_id($conn);
                                // Thêm thông số diện thoại
                                if (isset($_POST['tenthongso']) && !empty($_POST['tenthongso']) && isset($_POST['motathongso']) && !empty($_POST['motathongso'])) {
                                    $tenthongso = $_POST['tenthongso'];
                                    $motathongso = $_POST['motathongso'];
                                    for ($i = 0; $i < count($tenthongso); $i++) {
                                        $resultInsertThongSo = mysqli_query($conn, "INSERT INTO `thong_so_san_pham` (`id_thong_so`, `ten_thong_so`, `mo_ta_thong_so`, `id_san_pham`) 
                                                                                VALUES (NULL, '$tenthongso[$i]', '$motathongso[$i]', '$idsp');");
                                    }
                                }
                                // Thêm ảnh mô tả điện thoại
                                if (isset($_FILES['imageMota']) && !empty($_FILES['imageMota']['name'][0])) {
                                    $uploadedFilesMoTa = $_FILES['imageMota'];
                                    $result_imgMoTa = uploadFiles($uploadedFilesMoTa);
                                    if (!empty($result_imgMoTa['errors'])) {
                                        $error = $result_imgMoTa['errors'];
                                    } else {
                                        for ($i = 0; $i < count($result_imgMoTa['uploaded_files']); $i++) {
                                            $ImageMoTa = $result_imgMoTa['uploaded_files'][$i];
                                            $resultInsertImgMoTa = mysqli_query($conn, "INSERT INTO `hinh_anh_san_pham` (`id_anh_mo_ta`, `link_anh_mo_ta`, `id_san_pham`)
                                                                                     VALUES (NULL, '$ImageMoTa', '$idsp');");
                                        }
                                        echo '<script>window.location.reload()</script>';
                                    }
                                }
                            }
                        }
                    } else {
                        $error = "<h1>Bạn chưa nhập thông tin sản phẩm.</h1><br>";
                    }
                ?>
                <?php }  ?>
                <form id="product-form" method="POST" action="?action=add" enctype="multipart/form-data">
                    <div class="d-flex justify-content-between">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#home">Thông tin sản phẩm</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#menu1">Thông số sản phẩm</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#menu2">Hình ảnh sản phẩm</a>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <input type="submit" class="shadow" title="Lưu sản phẩm" value="Lưu thay đổi" />
                    </div>
                    <div class="tab-content shadow-sm">
                        <div class="tab-pane m-0 container active" id="home">
                            <div class="left-wrap">
                                <div class="wrap-field">
                                    <label>Tên sản phẩm: </label>
                                    <input type="text" name="tensanpham" />
                                </div>
                                <div class="wrap-field">
                                    <label>Giá sản phẩm: </label>
                                    <input type="text" name="giaban" />
                                </div>
                                <div class="wrap-field">
                                    <label>Giảm giá: </label>
                                    <input type="text" name="giamgia" />
                                </div>
                                <div class="wrap-field">
                                    <label>Sản phẩm:</label>
                                    <select class="w-100" name="mamathang">
                                        <option value="null" selected>-- Chọn loại sản phẩm --</option>
                                        <?php
                                        $thuong_hieu = mysqli_query($conn, "SELECT * FROM danh_muc_mat_hang");
                                        while ($row = mysqli_fetch_array($thuong_hieu)) { ?>
                                            <option value="<?= $row['id_mat_hang'] ?>"><?= $row['ten_mat_hang'] ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                                <div class="wrap-field">
                                    <label>Thương hiệu:</label>
                                    <select class="w-100" name="mathuonghieu">
                                        <option value="null" selected>-- Chọn thương hiệu --</option>
                                        <?php
                                        $thuong_hieu = mysqli_query($conn, "SELECT * FROM danh_muc_thuong_hieu");
                                        while ($row = mysqli_fetch_array($thuong_hieu)) { ?>
                                            <option value="<?= $row['id_thuong_hieu'] ?>"><?= $row['ten_thuong_hieu'] ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="wrap-field">
                                <label>Mô tả: </label>
                                <textarea name="noidung" id="noidung"></textarea>
                            </div>
                        </div>
                        <div class="tab-pane container fade m-0" id="menu1">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 70px">#</th>
                                        <th scope="col" style="width: 300px">Tên thông số</th>
                                        <th scope="col">Mô tả thông số</th>
                                        <th scope="col">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody id="thongSo">
                                    <tr>
                                        <td>Ví dụ:</td>
                                        <td><input class="border py-1 px-2" disabled value="HĐH" type="text"></td>
                                        <td><input class="border py-1 px-2 w-100" disabled value="Android 10" type="text"></td>
                                    </tr>
                                </tbody>
                            </table>
                            <button type="button" id="btn-add-thongSo" class="btn btn-sm btn-success shadow-none"><i class="fas fa-plus"></i></button>
                        </div>
                        <div class="tab-pane container w-100 fade m-0" id="menu2">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                                    <div class="wrap-field">
                                        <label>Ảnh đại diện: </label>
                                        <input type="file" id="smallImg" name="image" onchange="viewSmaillImg()" />
                                        <div id="showSmallImg" class="mt-3"></div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
                                    <div class="wrap-field">
                                        <label>Ảnh mô tả: </label>
                                        <input type="file" id="ImgMota" name="imageMota[]" onchange="viewImgMota()" multiple="multiple" />
                                        <div id="showImgMoTa"></div>
                                    </div>
                                </div>
                            </div>
                            <style>
                                .imgMoTa {
                                    width: 100px;
                                }
                            </style>
                        </div>
                    </div>
                </form>
                <!-- Bảng hiển thị đánh văn bản -->
                <script>
                    var stt = 0;
                    $(document).on('click', '#btn-add-thongSo', function() {
                        ++stt;
                        var trThongSo = '<tr>' +
                            '<td>' + stt + '</td>' +
                            '<td class="wrap-field"><input name="tenthongso[]" type="text"></td>' +
                            '<td class="wrap-field"><input w-100" name="motathongso[]" type="text"></td>' +
                            '<td><button type="button" id="btn-del-thongSo" class="btn btn-sm btn-danger shadow-none"><i class="fas fa-times"></i></button></td>' +
                            '</tr>';
                        $('#thongSo').append(trThongSo);
                    });
                    //  Xoá thông số
                    $(document).on('click', '#btn-del-thongSo', function() {
                        $(this).closest("tr").remove();
                        stt--;
                    })
                    // 
                    // Show ảnh chính
                    function viewSmaillImg() {
                        var fileInput = document.getElementById('smallImg');
                        var filePath = fileInput.value; //lấy giá trị input theo id
                        if (fileInput.files && fileInput.files[0]) {
                            var reader = new FileReader();
                            reader.onload = function(e) {
                                document.getElementById('showSmallImg').innerHTML = '<img style="width:150px;" src="' + e.target.result + '"/>';
                            };
                            reader.readAsDataURL(fileInput.files[0]);
                        }
                    }
                    // Show ảnh Mô tả
                    function viewImgMota() {
                        var fileInput = document.getElementById('ImgMota').files;
                        if (fileInput.length > 0) {
                            for (var i = 0; i < fileInput.length; i++) {
                                var fileToLoad = fileInput[i];
                                var fileReader = new FileReader();
                                fileReader.onload = function(e) {
                                    var scrData = e.target.result;
                                    var newImg = document.createElement('img');
                                    newImg.src = scrData;
                                    newImg.className = "imgMoTa shadow my-3 mr-5";
                                    document.getElementById('showImgMoTa').innerHTML += newImg.outerHTML;
                                }
                                fileReader.readAsDataURL(fileToLoad);
                            }
                        }
                    }
                </script>
            </div>
            <div class="modal-footer py-2 bg-white">
                <button type="button" class="btn btn-sm p-0 btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
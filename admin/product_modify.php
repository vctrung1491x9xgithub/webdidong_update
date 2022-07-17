 <?php
    include 'header.php';
    if (!empty($_SESSION['current_admin'])) {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $id = $_GET['id'];
            $result = mysqli_query($conn, " SELECT * 
                                            FROM danh_muc_mat_hang as dmmh, danh_muc_thuong_hieu as dmth, san_pham as sp 
                                            WHERE sp.id_mat_hang = dmmh.id_mat_hang and sp.id_thuong_hieu = dmth.id_thuong_hieu 
                                                    and sp.id_san_pham = '$id'") or die("loi");
            if (mysqli_num_rows($result) == 0) {
                echo "lỗi";
            } else {
                $row_product = mysqli_fetch_array($result);
            }
        }
    ?>
     <div class="framework">
         <div class="breadcrumb bg-transparent p-2 m-0 mb-3 shadow-sm">
             <h1><a href="javascript:history.go(-1)"> Quản lý sản phẩm</a> </h1>
         </div>
         <div class="content-box">
             <?php
                if (isset($_POST['luu_cap_nhat'])) {

                    if (isset($_FILES['image']) && !empty($_FILES['image']['name'][0])) {
                        $uploadedFiles = $_FILES['image'];
                        $result = uploadFiles($uploadedFiles);
                        if (!empty($result['errors'])) {
                            $error = $result['errors'];
                        } else {
                            $image = $result['path'];
                        }
                    } else {
                        $image = null;
                    }
                    if (empty($image)) {
                        $image = $row_product['hinh_anh'];
                    }

                    $tensanpham = $_POST['tensanpham'];
                    $giaban = $_POST['giaban'];
                    $giamgia = $_POST['giamgia'];
                    $noidung = $_POST['noidung'];
                    // $mat_hang = $_POST['product-type']; 
                    // -- id_mat_hang = '$mat_hang', 
                    $thuong_hieu = $_POST['mathuonghieu'];

                    $resultUpdate = mysqli_query($conn, " UPDATE  san_pham
                                                        SET     ten_san_pham = '$tensanpham',
                                                                gia_ban = '$giaban', 
                                                                giam_gia = '$giamgia',
                                                                noi_dung = '$noidung', 
                                                                hinh_anh = '$image',
                                                                id_thuong_hieu = '$thuong_hieu' 
                                                        WHERE id_san_pham = '$id'");
                    if ($resultUpdate) {
                        if (isset($_POST['tenthongso']) && isset($_POST['motathongso']) && isset($_POST['idthongso'])) {
                            // Thông số điện thoại
                            $tenthongso = $_POST['tenthongso'];
                            $motathongso = $_POST['motathongso'];
                            $idthongso = $_POST['idthongso'];
                            for ($i = 0; $i < count($idthongso); $i++) {
                                if (empty($tenthongso[$i]) && empty($motathongso[$i])) {
                                    mysqli_query($conn, "DELETE FROM thong_so_san_pham WHERE id_thong_so = '$idthongso[$i]'");
                                } else {
                                    $updateThongSo = mysqli_query($conn, "  UPDATE thong_so_san_pham 
                                                                            SET ten_thong_so = '$tenthongso[$i]',
                                                                                mo_ta_thong_so = '$motathongso[$i]'
                                                                            WHERE id_thong_so = '$idthongso[$i]'");
                                    if (!$updateThongSo) {
                                        $error = "Đã có lỗi xãy ra trong quá trình cập nhật thông số";
                                    }
                                }
                            }
                        }
                        // Thêm thông số diện thoại
                        if (isset($_POST['tenthongsomoi']) && !empty($_POST['tenthongsomoi']) && isset($_POST['motathongsomoi']) && !empty($_POST['motathongsomoi'])) {
                            $tenthongsomoi = $_POST['tenthongsomoi'];
                            $motathongsomoi = $_POST['motathongsomoi'];
                            for ($i = 0; $i < count($tenthongsomoi); $i++) {
                                $resultInsertThongSo = mysqli_query($conn, "INSERT INTO `thong_so_san_pham` (`id_thong_so`, `ten_thong_so`, `mo_ta_thong_so`, `id_san_pham`) 
                                                                        VALUES (NULL, '$tenthongsomoi[$i]', '$motathongsomoi[$i]', '$id ');");
                                if (!$resultInsertThongSo) {
                                    $error = "Đã có lỗi xãy ra trong quá trình cập nhật thông số";
                                }
                            }
                        }
                        // Xoá ảnh mô tả điện thoại
                        if (isset($_POST['linkanhota']) && isset($_POST['idanhmota'])) {
                            $linkanhota = $_POST['linkanhota'];
                            $idanhmota = $_POST['idanhmota'];
                            for ($i = 0; $i < count($idanhmota); $i++) {
                                if (empty($linkanhota[$i])) {
                                    mysqli_query($conn, "DELETE FROM hinh_anh_san_pham WHERE id_anh_mo_ta = '$idanhmota[$i]'");
                                }
                            }
                        }
                        // Thêm ảnh mô tả điện thoại mới 
                        if (isset($_FILES['imageMota']) && !empty($_FILES['imageMota']['name'][0])) {
                            $uploadedFilesMoTa = $_FILES['imageMota'];
                            $result_imgMoTa = uploadFiles($uploadedFilesMoTa);
                            if (!empty($result_imgMoTa['errors'])) {
                                $error = $result_imgMoTa['errors'];
                            } else {
                                for ($i = 0; $i < count($result_imgMoTa['uploaded_files']); $i++) {
                                    $imageMoTa = $result_imgMoTa['uploaded_files'][$i];
                                    $resultInsertThongSo = mysqli_query($conn, "INSERT INTO `hinh_anh_san_pham` (`id_anh_mo_ta`, `link_anh_mo_ta`, `id_san_pham`)
                                                                             VALUES (NULL, '$imageMoTa', '$id');");
                                }
                            }
                        }
                    } else {
                        $error = "Đã có lỗi xãy ra";
                    }
                ?>
                 <div class="notify-content">
                     <div class="error my-3"><?= isset($error) ? $error : 'Cập nhật sản phẩm thành công' ?></div>
                     <a href="phone_listing.php">Quay lại danh sách sản phẩm</a>
                 </div>
             <?php } else { ?>
                 <form id="product-form" method="POST" action="?action=update&id=<?= $id ?>" enctype="multipart/form-data">
                     <div class="d-flex justify-content-between">
                         <!-- Nav tabs -->
                         <ul class="nav nav-tabs tabs-update">
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
                         <input type="submit" name="luu_cap_nhat" title="Lưu cập nhật" value="Lưu thay đổi" />
                     </div>
                     <div class="tab-content shadow-sm t">
                         <div class="tab-pane m-0 container active" id="home">
                             <div class="left-wrap">
                                 <div class="wrap-field">
                                     <label>Tên sản phẩm: </label>
                                     <input type="text" name="tensanpham" value="<?= $row_product['ten_san_pham'] ?>" />
                                 </div>
                                 <div class="wrap-field">
                                     <label>Giá sản phẩm: </label>
                                     <input type="text" name="giaban" value="<?= $row_product['gia_ban'] ?>" />
                                 </div>
                                 <div class="wrap-field">
                                     <label>Giảm giá: </label>
                                     <input type="text" name="giamgia" value="<?= $row_product['giam_gia'] ?>" />
                                 </div>
                                 <div class="wrap-field">
                                     <label>Thương hiệu:</label>
                                     <select class="w-100" name="mathuonghieu">
                                         <?php
                                            $thuong_hieu = mysqli_query($conn, "SELECT * FROM danh_muc_thuong_hieu");
                                            while ($row_thuong_hieu = mysqli_fetch_array($thuong_hieu)) {
                                                if ($row_product['id_thuong_hieu'] == $row_thuong_hieu['id_thuong_hieu']) { ?>
                                                 <option value="<?= $row_thuong_hieu['id_thuong_hieu'] ?>" selected>
                                                     <?= $row_thuong_hieu['ten_thuong_hieu'] ?>
                                                 </option>
                                             <?php  } else {
                                                ?>
                                                 <option value="<?= $row_thuong_hieu['id_thuong_hieu'] ?>"><?= $row_thuong_hieu['ten_thuong_hieu'] ?></option>
                                         <?php }
                                            }
                                            ?>
                                     </select>
                                 </div>
                             </div>
                             <div class="wrap-field">
                                 <label>Mô tả: </label>
                                 <textarea name="noidung" id="noidung"><?= $row_product['noi_dung'] ?></textarea>
                             </div>
                         </div>
                         <div class="tab-pane container fade m-0" id="menu1">
                             <table class="table table-borderless table-thongso">
                                 <thead>
                                     <tr>
                                         <th scope="col" style="width: 70px">#</th>
                                         <th scope="col" style="width: 150px">Tên thông số</th>
                                         <th scope="col" style="width: 300px">Mô tả thông số</th>
                                         <th scope="col" style="width: 30px">Thao tác</th>
                                     </tr>
                                 </thead>
                                 <tbody id="thongSo">
                                     <?php
                                        $result = mysqli_query($conn, " SELECT * 
                                                                    FROM   thong_so_san_pham 
                                                                    WHERE  id_san_pham = '$id'") or die("loi");
                                        if (mysqli_num_rows($result) == 0) {
                                            echo '<tr class="emptythongso">
                                                <td colspan="4">Sản phẩm chưa có thông số</td>  
                                                </tr>';
                                        } else {
                                            $stt = 0;
                                            while ($row_thong_so = mysqli_fetch_array($result)) {
                                                ++$stt; ?>
                                             <tr>
                                                 <td><span class="badge badge-success"><?= $stt ?></span></td>
                                                 <td class="wrap-field"><input class="py-1 px-2" name="tenthongso[]" value="<?= $row_thong_so['ten_thong_so'] ?>" type="text"></td>
                                                 <td class="wrap-field"><input class="py-1 px-2 w-100" name="motathongso[]" value="<?= $row_thong_so['mo_ta_thong_so'] ?>" type="text"></td>
                                                 <td style="width: 30px">
                                                     <button type="button" class="btn btn-sm btn-danger btn-xoa-thong-so">x</button>
                                                     <input class="py-1 px-2" name="idthongso[]" value="<?= $row_thong_so['id_thong_so'] ?>" readonly type="hidden">
                                                 </td>
                                             </tr>
                                     <?php }
                                        }
                                        ?>
                                 </tbody>
                             </table>
                             <button type="button" id="btn-add-thongSo" class="btn btn-sm btn-success shadow-none"><i class="fas fa-plus"></i></button>
                         </div>
                         <div class="tab-pane container w-100 fade m-0" id="menu2">
                             <div class="row">
                                 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                                     <div class="wrap-field">
                                         <label>Ảnh đại diện: </label>
                                         <div id="showSmallImg" class="my-3 shadow p-2 d-inline-block">
                                             <img width="150px" src="../<?= $row_product['hinh_anh'] ?>" alt="">
                                         </div>
                                         <label>Chọn ảnh đại diện mới: </label>
                                         <input type="file" id="smallImg" name="image" onchange="viewSmaillImg()" />
                                     </div>
                                 </div>
                                 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
                                     <div class="wrap-field">
                                         <label>Ảnh mô tả: </label>
                                         <div class="d-flex my-3 p-2">
                                             <?php
                                                $result = mysqli_query($conn, " SELECT * 
                                            FROM   hinh_anh_san_pham 
                                            WHERE  id_san_pham = '$id'") or die("loi");
                                                if (mysqli_num_rows($result) == 0) {
                                                    echo '<tr>
                                                        <td rowspan="2">Sản phẩm chưa có ảnh mô tả</td> 
                                                    </tr>';
                                                } else {
                                                    $stt = 0;
                                                    while ($row_hinh_anh = mysqli_fetch_array($result)) { ?>
                                                     <div class="d-flex flex-column mr-3 shadow p-2 anhmota" style="width:170px">
                                                         <img width="150px" src="../<?= $row_hinh_anh['link_anh_mo_ta'] ?>" alt="">
                                                         <div class="">
                                                             <input type="hidden" class="wrap-field w-25" name="linkanhota[]" value="<?= $row_hinh_anh['link_anh_mo_ta'] ?>">
                                                             <input type="hidden" class="wrap-field w-25" name="idanhmota[]" value="<?= $row_hinh_anh['id_anh_mo_ta'] ?>">
                                                         </div>
                                                         <button type="button" class="btn btn-sm btn-danger btn-xoa-anh-mo-ta shadow-none"><i class="fas fa-times"></i></button>
                                                     </div>
                                             <?php }
                                                }
                                                ?>
                                         </div>
                                         <label>Thêm ảnh mô tả: </label>
                                         <button type="button" id="btn-them-anhmota" class="btn btn-sm btn-success shadow-none mt-1"><i class="fas fa-plus"></i></button>
                                         <div id="anh-mo-ta-content"></div>
                                         <div id="showImgMoTa" class="d-flex my-3 p-2"></div>
                                     </div>
                                 </div>
                             </div>
                             <style>
                                 .imgMoTa {
                                     width: 170px;
                                     padding: 10px;
                                 }

                                 .anhmota {
                                     position: relative;
                                 }

                                 .btn-xoa-anh-mo-ta {
                                     position: absolute;
                                     right: -15px;
                                     top: -15px;
                                     border-radius: 50%;
                                 }
                             </style>
                         </div>
                     </div>
                 </form>
                 <script>
                     //  Xoá thông số củ
                     $(document).on('click', '.btn-xoa-thong-so', function() {
                         $(this).closest("tr").hide();
                         $(this).closest("tr").find("input[name='tenthongso[]'").val(null);
                         $(this).closest("tr").find("input[name='motathongso[]'").val(null);

                     })
                     //  ADD thông số mới
                     var stt = 0;
                     $(document).on('click', '#btn-add-thongSo', function() {
                        ++stt;
                        if($("#thongSo tr").hasClass('emptythongso')) {
                           $('.emptythongso').remove(); 
                        }
                         var trThongSo = '<tr>' +
                             '<td>' + stt + '</td>' +
                             '<td class="wrap-field" style="width:150px"><input name="tenthongsomoi[]" type="text"></td>' +
                             '<td class="wrap-field"><input w-100" name="motathongsomoi[]" type="text"></td>' +
                             '<td><button type="button" id="btn-del-thongSo" class="btn btn-sm btn-danger shadow-none"><i class="fas fa-times"></i></button></td>' +
                             '</tr>';

                         $('#thongSo').append(trThongSo);
                     });
                     //  Xoá thông số mới
                     $(document).on('click', '#btn-del-thongSo', function() {
                         $(this).closest("tr").remove();
                         stt--;
                     })
                     //  Xoá ảnh mô tả củ
                     $(document).on('click', '.btn-xoa-anh-mo-ta', function() {
                         $(this).closest("div").find("input[name='linkanhota[]'").val(null);
                         $(this).closest("div").attr("style", "display: none !important");
                         console.log("aa");
                     })
                     // Thêm input ảnh mô tả
                     $(document).on('click', '#btn-them-anhmota', function() {
                         var inputAnhMoTa = '<div class="d-flex">' +
                             '<input type="file" class="mt-1 mr-2" id="ImgMota" name="imageMota[]" onchange="viewImgMota()" multiple="multiple" />' +
                             '<button type="button" id="btn-del-inputAnhMoTa" class="btn btn-sm shadow-none"><i class="fas fa-times"></i></button>' +
                             '</div>';
                         $('#anh-mo-ta-content').append(inputAnhMoTa);
                         $(this).hide();
                     });
                     //  Xoá input thêm ảnh mô tả mới
                     $(document).on('click', '#btn-del-inputAnhMoTa', function() {
                         $(this).closest("div").remove();
                         $('#btn-them-anhmota').show();
                         $('#showImgMoTa img').remove();
                     })
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
                                     newImg.className = "imgMoTa shadow mr-3";
                                     document.getElementById('showImgMoTa').innerHTML += newImg.outerHTML;
                                 }
                                 fileReader.readAsDataURL(fileToLoad);
                             }
                         }
                     }
                 </script>

             <?php } ?>
         </div>
     </div>
 <?php }
    // include './footer.php'
    ?>
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
 <script src="../bootstrap/bootstrap_js/bootstrap.min.js"></script>
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

     .tab-content {
         overflow: auto;
         scroll-behavior: smooth;
         -webkit-scroll-behavior: smooth;
         background: #FFFFFF;
         height: 60vh;
         border-radius: 0 0 7px 7px;
     }

     ::-webkit-scrollbar {
         width: 8px !important;
     }

     .nav-link {
         padding: 2px 10px !important;
     }

     .nav-tabs .nav-link {
         background: #FFFFFF;
     }

     .nav-tabs .nav-item.show .nav-link,
     .nav-tabs .nav-link.active {
         color: #ffffff;
         background-color: rgb(65, 96, 102);
         border-color: #353c42 #dee2e6 #fff;
     }

     @media (min-width: 576px) {
         .modal-dialog {
             max-width: 800px;
             margin: 1.75rem auto;
         }
     }
 </style>
 <div id="my_modal" class="modal fade" role="dialog">
     <div class="modal-dialog">
         <!-- Modal content-->
         <div class="modal-content">
             <div class="modal-header py-2 bg-white">
                 <p class="modal-title h5">Cập nhật điện thoại</p>
                 <button type="button" class="btn btn-sm" data-dismiss="modal">&times;</button>
             </div>
             <div class="modal-body mt-1">
                 <?php
                    include '../connect_db.php';
                    include '../function.php';
                    if (isset($_POST['id']) && !empty($_POST['id'])) {

                        $id = $_POST['id'];
                        $SelectProduct = mysqli_query($conn, "  SELECT *
                                                            FROM san_pham AS s, thong_so_san_pham AS t, hinh_anh_san_pham AS h
                                                            WHERE s.id_san_pham = t.id_san_pham AND s.id_san_pham = h.id_san_pham
                                                                    AND s.id_san_pham = '$id'");
                        $rowProduct = mysqli_fetch_array($SelectProduct);
                    ?>
                     <form id="product-form" method="POST" action="?action=add" enctype="multipart/form-data">
                         <div class="d-flex justify-content-between">
                             <!-- Nav tabs -->
                             <ul class="nav nav-tabs">
                                 <li class="nav-item">
                                     <a class="nav-link active" data-toggle="tab" href="#thongTinDienThoai">Thông tin điện thoại</a>
                                 </li>
                                 <li class="nav-item">
                                     <a class="nav-link" data-toggle="tab" href="#thongSoDienThoai">Thông số điện thoại</a>
                                 </li>
                                 <li class="nav-item">
                                     <a class="nav-link" data-toggle="tab" href="#hinhAnhDienThoai">Hình ảnh điện thoại</a>
                                 </li>
                             </ul>
                             <!-- Tab panes -->
                             <input type="submit" title="Lưu sản phẩm" value="Lưu thay đổi" />
                         </div>
                         <div class="tab-content shadow-sm">
                             <div class="tab-pane m-0 container active" id="thongTinDienThoai">
                                 <div class="left-wrap">
                                     <div class="wrap-field">
                                         <label>Tên sản phẩm: </label>
                                         <input type="text" name="tensanpham" value="<?= $rowProduct['ten_san_pham'] ?>" />
                                     </div>
                                     <div class="wrap-field">
                                         <label>Giá sản phẩm: </label>
                                         <input type="text" name="giaban" value="<?= $rowProduct['gia_ban'] ?>" />
                                     </div>
                                     <div class="wrap-field">
                                         <label>Giảm giá: </label>
                                         <input type="text" name="giamgia" value="<?= $rowProduct['giam_gia'] ?>" />
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
                             <div class="tab-pane container fade m-0" id="thongSoDienThoai">
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
                             <div class="tab-pane container w-100 fade m-0" id="hinhAnhDienThoai">
                                 <div class="row">
                                     <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                                         <div class="wrap-field">
                                             <label>Ảnh đại diện: </label>
                                             <input type="file" id="smallImg" name="image" onchange="viewSmaillImg()" />
                                             <div id="showSmallImg"></div>
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
                                     document.getElementById('showSmallImg').innerHTML = '<img style="width:180px;" src="' + e.target.result + '"/>';
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
                                         newImg.className = "imgMoTa";
                                         document.getElementById('showImgMoTa').innerHTML += newImg.outerHTML;
                                     }
                                     fileReader.readAsDataURL(fileToLoad);
                                 }
                             }
                         }
                     </script>
                 <?php } ?>
             </div>
             <div class="modal-footer py-2 bg-white">
                 <button type="button" class="btn btn-sm p-0 btn-default" data-dismiss="modal">Close</button>
             </div>
         </div>
     </div>
 </div>
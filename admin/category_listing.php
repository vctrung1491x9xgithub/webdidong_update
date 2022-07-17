<?php
include 'header.php';
if (!empty($_SESSION['current_admin'])) {
    include './adding.php';
?>
    <div class="framework ">
        <div class="breadcrumb bg-white p-2 m-0 mb-3 shadow-sm">
            <h1><i class="ti-home text-secondary"></i><span class="mx-2">&#10095;</span><a href=""> Quản lý danh mục</a><span class="mx-2">&#10095;</span><span class="font-weight-bold">Danh sách danh mục</span></h1>
        </div>

        <!-- END TIỀM KIẾM -->
        <div class="row">
            <!-- Danh mục thương hiệu-->
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">

                <div class="table-responsive-lg p-2 bg-white shadow-sm border border-warning" id="tbl-phone-listing">
                    <div class="border-bottom pb-2 mb-2 d-flex justify-content-between align-items-center">
                        <b>Danh mục thương hiệu</b>
                        <button type="button" class="btn btn-sm p-0 shadow-none" data-toggle="modal" data-target="#themThuongHieu">
                            <span class="material-icons bg-warning text-light">
                                add
                            </span>
                        </button>
                    </div>
                    <table class="table table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Mã</th>
                                <th>Tên sản phẩm</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $select_dm_thuong_hieu = $conn->query("SELECT * FROM danh_muc_thuong_hieu ORDER BY ten_thuong_hieu DESC");
                            if ($select_dm_thuong_hieu->num_rows > 0) {
                                foreach ($select_dm_thuong_hieu as $key => $thuong_hieu) :
                            ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= $thuong_hieu['id_thuong_hieu'] ?></td>
                                        <td><?= $thuong_hieu['ten_thuong_hieu'] ?></td>
                                        <td>
                                            <!-- <button type="button" class="btn btn-sm d-inline">
                                                <span class="material-icons text-info">
                                                    mode_edit_outline
                                                </span>
                                            </button> -->
                                            <a href="category_listing.php?action=del&&id=<?= $thuong_hieu['id_thuong_hieu']?>"   class="btn btn-sm d-inline" >
                                                <span class="material-icons text-danger">
                                                    clear
                                                </span>
                                            </a>
                                        </td>

                                    </tr>
                            <?php endforeach;
                            }
                            ?>
                        </tbody>
                        <?php 
                        if(isset($_GET['action']) && $_GET['action'] == 'del' && isset($_GET['id'])) {
                            $idTH = ($_GET['id']);  
                            $result = mysqli_query($conn, "DELETE FROM danh_muc_thuong_hieu WHERE id_thuong_hieu = '$idTH'");
                            if (!$result) {
                                $error = "Không thể xóa thương hiệu.";
                            }
                            mysqli_close($conn);
                            if (isset($error)) {
                                echo '<script>
                                                document.getElementById("modal-custom-title").innerHTML = "THÔNG BÁO LỖI!";
                                                document.getElementById("doc").innerHTML = "Xoá thương hiệu KHÔNG thành công!";
                                                var modal = document.getElementById("myModal");
                                                var span = document.getElementsByClassName("modal-custom-close")[0];
                                                modal.classList.add("mystyle");
                                                span.onclick = function() {
                                                    window.location.href="category_listing.php";
                                                }
                                                window.onclick = function(event) {
                                                    if (event.target == modal) {
                                                        modal.classList.remove("mystyle");
                                                    }
                                                }
                                            </script>';
                            } else {
                                echo '<script>
                                            alert("Xóa thương hiệu thành công");
                                            window.location.href="category_listing.php";
                                        </script>';
                            }
                            
                        }
                        ?>
                    </table>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
                <div class="table-responsive-lg p-2 bg-white shadow-sm border border-warning" id="tbl-phone-listing">
                    <div class="border-bottom pb-2 mb-2 d-flex justify-content-between align-items-center">
                        <b>Danh mục mặt hàng</b>
                        <button type="button" data-toggle="modal" data-target="#themMatHang" class="btn btn-sm p-0 shadow-none">
                            <span class="material-icons bg-warning text-light">
                                add
                            </span>
                        </button>
                    </div>
                    <table class="table table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Mã</th>
                                <th>Tên sản phẩm</th>
                                <th>Icon</th>
                                <th>Đường dẫn</th>
                                <th>Thứ tự hiển thị</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $select_dm_san_pham = $conn->query("SELECT * FROM danh_muc_mat_hang ORDER BY ten_mat_hang DESC");
                            if ($select_dm_san_pham->num_rows > 0) {
                                foreach ($select_dm_san_pham as $key => $danh_muc) :
                            ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= $danh_muc['id_mat_hang'] ?></td>
                                        <td><?= $danh_muc['ten_mat_hang'] ?></td>
                                        <td><?= $danh_muc['icon'] ?></td>
                                        <td><?= $danh_muc['link_danh_muc'] ?></td>
                                        <td><?= $danh_muc['stt'] ?></td>
                                        <td class="d-flex">
                                            <!-- <button type="button" class="btn btn-sm d-inline">
                                                <span class="material-icons text-info">
                                                    mode_edit_outline
                                                </span>
                                            </button> -->
                                            <a href="category_listing.php?action=delmh&&id=<?= $danh_muc['id_mat_hang'] ?>"   class="btn btn-sm d-inline" >
                                                <span class="material-icons text-danger">
                                                    clear
                                                </span>
                                            </a>
                                        </td>

                                    </tr>
                            <?php endforeach;
                            }
                            ?>
                        </tbody>
                        <?php 
                        if(isset($_GET['action']) && $_GET['action'] == 'delmh' && isset($_GET['id'])) {
                            $idMH = ($_GET['id']);  
                            $result = mysqli_query($conn, "DELETE FROM danh_muc_mat_hang WHERE id_mat_hang = '$idMH'");
                            if (!$result) {
                                $error = "Không thể xóa mặt hàng";
                            }
                            mysqli_close($conn);
                            if (isset($error)) {
                                echo '<script>
                                                document.getElementById("modal-custom-title").innerHTML = "THÔNG BÁO LỖI!";
                                                document.getElementById("doc").innerHTML = "Xoá mặt hàng KHÔNG thành công!";
                                                var modal = document.getElementById("myModal");
                                                var span = document.getElementsByClassName("modal-custom-close")[0];
                                                modal.classList.add("mystyle");
                                                span.onclick = function() {
                                                    window.location.href="category_listing.php";
                                                }
                                                window.onclick = function(event) {
                                                    if (event.target == modal) {
                                                        modal.classList.remove("mystyle");
                                                    }
                                                }
                                            </script>';
                            } else {
                                echo '<script>
                                            document.getElementById("modal-custom-title").innerHTML = "THÔNG BÁO!";
                                            document.getElementById("doc").innerHTML = "Xoá mặt hàng thành công!";
                                            var modal = document.getElementById("myModal");
                                            var span = document.getElementsByClassName("modal-custom-close")[0];
                                            modal.classList.add("mystyle");
                                            span.onclick = function() {
                                                window.location.href="category_listing.php";
                                            }
                                            window.onclick = function(event) {
                                                if (event.target == modal) {
                                                    modal.classList.remove("mystyle");
                                                }
                                            }
                                        </script>';
                            }
                            
                        }
                        ?>
                    </table>
                </div>
            </div>


        </div>
        <?php include 'footer.php'; ?>
    </div>
    <!-- CODE XOÁ SẢM PHẨM -->
<?php
   
}
?>
<!-- CODE XOÁ SẢM PHẨM -->


<!-- Modal -->
<div id="themThuongHieu" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Thêm thương hiệu</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
      <form method="post">
        <div class="form-group">
            <label for="exampleInputEmail1">Mã thương hiệu</label>
            <input type="text" class="form-control" name="mathuonghieu" placeholder="Nhập mã thương hiệu">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Tên thương hiệu</label>
            <input type="text" class="form-control" name="tenthuonghieu" placeholder="Nhập tên thương hiệu">
        </div>
        <button type="submit" name="btnthemThuongHieu" class="btn btn-primary">Thêm</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<?php 
    if(isset($_POST['btnthemThuongHieu'])) {
        $maTH = $_POST['mathuonghieu'];
        $tenTH = $_POST['tenthuonghieu'];

        $selectTH = $conn->query("SELECT * FROM danh_muc_thuong_hieu WHERE id_thuong_hieu= '$maTH'");
        if(mysqli_num_rows($selectTH) > 0) {
            echo "<script>
                    alert('Mã thương hiệu trùng');
            </script>";
        } else {
            $insertTH = $conn->query("INSERT INTO `danh_muc_thuong_hieu` (`id_thuong_hieu`, `ten_thuong_hieu`) VALUES ('$maTH', '$tenTH');");
            if($insertTH) {
                echo "<script>
                        alert('Thêm thương hiệu thành công');
                </script>";
            }
        }
       
    }

?>


<!-- Modal MẶT HÀNG -->
<div id="themMatHang" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Thêm mặt hàng</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
      <form method="POST">
        <div class="form-group">
            <label for="exampleInputEmail1">Mã mặt hàng</label>
            <input type="text" class="form-control" name="maMH" placeholder="Nhập mã mặt hàng">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Tên mặt hàng</label>
            <input type="text" class="form-control" name="tenMH" placeholder="Nhập tên mặt hàng">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Icon</label>
            <input type="text" class="form-control" name="icon" placeholder="Nhập icon">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Đường dẫn</label>
            <input type="text" class="form-control" name="link" placeholder="Nhập đường dẫn">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Thứ tự hiển thị</label>
            <input type="number" class="form-control" name="stt" placeholder="Nhập thứ tự">
        </div>
        <button type="submit" name="btnthemMatHang" class="btn btn-primary">Thêm</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<?php 
    if(isset($_POST['btnthemMatHang'])) {
        $maMH = $_POST['maMH'];
        $tenMH = $_POST['tenMH'];
        $icon = $_POST['icon'];
        $link = $_POST['link'];
        $stt = $_POST['stt'];

        $selectMH = $conn->query("SELECT * FROM danh_muc_mat_hang WHERE id_mat_hang= '$maMH'");
        if(mysqli_num_rows($selectTH) > 0) {
            echo "<script>
                    alert('Mã mặt hàng trùng');
            </script>";
        } else {
            $insertTH = $conn->query("INSERT INTO `danh_muc_mat_hang` (`id_mat_hang`, `ten_mat_hang`, `icon`, `link_danh_muc`, `stt`) 
                                                    VALUES ('$maMH', '$tenMH', ' $icon', '$link', '$stt');");
            if($insertTH) {
                echo "<script>
                       window.location.reload();
                        
                </script>";
            }
        }
       
    }

?>
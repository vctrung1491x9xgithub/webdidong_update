<?php 
    include '../connect_db.php';
    $id = $_GET['id'];
    $accept_order = mysqli_query($conn,"UPDATE don_hang SET trang_thai = 'Xác nhận' WHERE don_hang.id_don_hang = $id;");
    if(!$accept_order) {
        echo "<script>alert('Lỗi')</script>";
    } else {
        echo "<script>window.location.href = 'order_listing.php';</script>";
    }
      
?>
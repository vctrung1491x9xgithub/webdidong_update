<?php
include '../connect_db.php';
if (isset($_POST['IDSlide']) && !empty($_POST['IDSlide']) && isset($_POST['status']) && !empty($_POST['status'])) {
    $id = $_POST['IDSlide'];
    $status = $_POST['status'];

    switch ($status) {
        case 'disable':
            $queryActive = "UPDATE slider SET trang_thai_slider = 'enable' WHERE id_slider = '$id'";
            $queryDeactive = "UPDATE slider SET trang_thai_slider = 'disable' WHERE id_slider != '$id'";
            break;
        default:
            $queryActive = "UPDATE slider SET trang_thai_slider = 'disable' WHERE id_slider = '$id'";
            $queryDeactive = "UPDATE slider SET trang_thai_slider = 'enable' WHERE id_slider != '$id'";
            break;
    }
    
            $conn->query($queryActive);
            $conn->query($queryDeactive);
        
    }


<?php
include '../connect_db.php';
if(isset($_POST['IDSlide'])) {
    $id = $_POST['IDSlide'];
   $conn->query("DELETE FROM slider WHERE id_slider = '$id'");
}

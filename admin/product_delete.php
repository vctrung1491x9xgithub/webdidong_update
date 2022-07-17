<?php
    include 'header.php';
    // include '../modal_index/modal.php'; 
    if (!empty($_SESSION['current_admin'])) 
    {
            $error = false;
            if (isset($_GET['id']) && !empty($_GET['id'])) {
                include '../connect_db.php';
                $result = mysqli_query($conn, "DELETE FROM san_pham WHERE id_san_pham = " . $_GET['id']);
                if (!$result) {
                    $error = "Không thể xóa sản phẩm.";
                }
                mysqli_close($conn);
                if ($error) {
                    echo '<script>
                        document.getElementById("doc").innerHTML = "Xoá Sản phẩm KHÔNG thành công!";
                        var modal = document.getElementById("myModal");
                        var span = document.getElementsByClassName("close")[0];
                        modal.classList.add("mystyle");
                        span.onclick = function() {
                            window.location.reload();
                        }
                        window.onclick = function(event) {
                            if (event.target == modal) {
                                modal.classList.remove("mystyle");
                            }
                        }
                    </script>';
             } else { 
                echo '<script>
                    document.getElementById("doc").innerHTML = "Xoá Sản phẩm thành công!";
                    var modal = document.getElementById("myModal");
                    var span = document.getElementsByClassName("close")[0];
                    modal.classList.add("mystyle");
                    span.onclick = function() {
                        window.location.reload();
                    }
                    window.onclick = function(event) {
                        if (event.target == modal) {
                            modal.classList.remove("mystyle");
                        }
                    }
                </script>';
            } 
        } 
    }
include './footer.php';

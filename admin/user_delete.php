<?php
    include 'header.php';
    if (!empty($_SESSION['current_admin'])) 
    {
        $error = false;
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $result = mysqli_query($conn, "DELETE FROM tai_khoan WHERE ma_kh = '". $_GET['id']."'");
            if (!$result) {
                $error = "Không thể xóa Tài khoản khách hàng.";
            }
            // Đầu tiên xoá tài khoản có liên kết với khách hàng bởi khoá phụ
            if ($error !== false) {
                echo '<script>
                        document.getElementById("modal_title").innerHTML = "THÔNG BÁO!";
                        document.getElementById("doc").innerHTML = "Xoá khách hàng KHÔNG thành công!";
                        var modal = document.getElementById("myModal");
                        var span = document.getElementsByClassName("close")[0];
                        modal.classList.add("mystyle");
                        span.onclick = function() {
                            window.location.href="user_listing.php";
                        }
                        window.onclick = function(event) {
                            if (event.target == modal) {
                                modal.classList.remove("mystyle");
                            }
                        }
                    </script>';
            } 
            else { 
                // Nếu đã xoá Tài khoản thành công thì sẽ đến bước xoá Khách hàng
                $error = false;
                $user_del = mysqli_query($conn, "DELETE FROM khach_hang WHERE ma_kh = '". $_GET['id']."'");
                if(!$user_del) {
                    $error = "Không thể xóa khách hàng.";
                }
                mysqli_close($conn);
                if($error) {
                    echo '<script>
                            document.getElementById("modal_title").innerHTML = "THÔNG BÁO!";
                            document.getElementById("doc").innerHTML = "Xoá khách hàng KHÔNG thành công!";
                            var modal = document.getElementById("myModal");
                            var span = document.getElementsByClassName("close")[0];
                            modal.classList.add("mystyle");
                            span.onclick = function() {
                                window.location.href="user_listing.php";
                            }
                            window.onclick = function(event) {
                                if (event.target == modal) {
                                    modal.classList.remove("mystyle");
                                }
                            }
                        </script>';
                    } 
                    else {
                        echo '<script>
                                document.getElementById("modal_title").innerHTML = "THÔNG BÁO!";
                                document.getElementById("doc").innerHTML = "Xoá khách hàng thành công!";
                                var modal = document.getElementById("myModal");
                                var span = document.getElementsByClassName("close")[0];
                                modal.classList.add("mystyle");
                                span.onclick = function() {
                                    window.location.href="user_listing.php";
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
    }
include './footer.php';
?>
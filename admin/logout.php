<!DOCTYPE html>
<html>
    <head>
        <title>Đăng xuất tài khoản</title>
        <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Varela+Round&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../Style_admin/style_notify_error.css">
        <style>
           a {
               text-decoration: none;
               color: #05A139;
           }
        </style>
    </head>
    <body>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <div><h1 style="color: red;" id="modal_title"></h1></div>
            </div>
            <div class="modal-body">
                <p id="doc"></p>
            </div>
            <div class="modal-footer">
                <span style="color: red;" class="close">&times;</span>
            </div>
        </div>
    </div>
        <?php
            session_start();
            include '../connect_db.php';
            include '../modal_index/modal.php';
            if (!empty($_SESSION['current_admin'])) {
                unset($_SESSION['current_admin']);
                echo '<script>
                        document.getElementById("modal_title").innerHTML = "THÔNG BÁO!";
                        document.getElementById("doc").innerHTML = "Đăng xuất thành công!";
                        var modal = document.getElementById("myModal");
                        var span = document.getElementsByClassName("close")[0];
                        modal.classList.add("mystyle");
                        span.onclick = function() {
                            modal.classList.remove("mystyle");
                            window.location.href = "login.php";
                        }
                        window.onclick = function(event) {
                            if (event.target == modal) {
                                modal.classList.remove("mystyle");
                                window.location.href = "login.php";
                            }
                        }
                    </script>';
                } else {
                    include 'error.php';
            } ?>
    </body>
</html>

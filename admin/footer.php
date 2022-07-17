<?php if (!empty($_SESSION['current_admin'])) { ?>
    <div id="admin-footer">
        <div class="footer-top d-flex justify-content-between align-items-center h-100 px-2">
            <div class="footer-left d-flex ">
                &nbsp; © Copyright 2021 - Designed by
                <span style="font-weight:600;text-shadow: 0 0 5px #78DFFD;color:#78DFFD">
                    <i></i></span>
            </div>
            <div class="footer-center">
                <a href="" class="text-white"><i class="ti-facebook text-white">acebook</i></a>
            </div>
            <div class="footer-right">
                <a target="_blank" class="text-white" href="../index2.php" title=""><i class="ti-hand-point-right"></i> webdidong.com</a>
                <a target="_blank" href="" title=""></a>
            </div>
        </div>
        <!-- <div class="footer-bottom"> 
        </div> -->
    </div>
<?php } else { ?>
    <?php
    include 'error.php';
    ?>
<?php } ?>
<style>
    .footer-right img {
        width: 180px;
    }

    #admin-footer {
        width: calc(100% - 30px);
        height: 60px;
       
        color: #FFF;
        margin-top: 5px;
    }

    .container-footer {
        width: 100%;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .footer-top {
        background: #31364A;
    }

    /* .footer-bottom {
        height: 40px;
        background: #848383;
    } */
</style>

</body>

</html>
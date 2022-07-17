<style>
    #pagination {
        text-align: center;
        padding: 6px;
        margin-top: 20px;
    }

    #pagination .page-item {
        padding: 5px 8px;
        margin: 3px;
        border-radius: 4px;
        color: #303030;
        font-weight: 400;
        box-shadow: 0px 1px 3px rgb(0 0 0 / 15%);
    }
    #pagination .page-item:hover {
        background: #303030;
        color: #ffffff;
    }
    #pagination .current-page {
        background: #0b2239;
        color: #fff;
    }
</style>
<div id="pagination">
    <?php
    if ($totalPages > 1) {
        if ($current_page > 3) {
            $first_page = 1;
    ?>
            <a class="page-item page-item-click" href="?per_page=<?= $item_per_page ?>&page=<?= $first_page ?>" data-perpage='<?= $item_per_page ?>' data-page='<?= $first_page ?>'>First
            </a>
        <?php
        }
        if ($current_page > 1) {
            $prev_page = $current_page - 1;
        ?>
            <a class="page-item page-item-click" href="?per_page=<?= $item_per_page ?>&page=<?= $prev_page ?>" data-perpage='<?= $item_per_page ?>' data-page='<?= $prev_page ?>'>
                <b>‹</b>
            </a>
        <?php }
        ?>
        <?php for ($num = 1; $num <= $totalPages; $num++) { ?>
            <?php if ($num != $current_page) { ?>
                <?php if ($num > $current_page - 3 && $num < $current_page + 3) { ?>
                    <a class="page-item page-item-click" href="?per_page=<?= $item_per_page ?>&page=<?= $num ?>" data-perpage='<?= $item_per_page ?>' data-page='<?= $num ?>'><?= $num ?></a>
                <?php } ?>
            <?php } else { ?>
                <strong class="current-page page-item"><?= $num ?></strong>
            <?php } ?>
        <?php } ?>
        <?php
        if ($current_page < $totalPages) {
            $next_page = $current_page + 1;
        ?>
            <a class="page-item page-item-click" href="?per_page=<?= $item_per_page ?>&page=<?= $next_page ?>" data-perpage='<?= $item_per_page ?>' data-page='<?= $next_page ?>'>
                <b>›</b></a>
        <?php
        }
        if ($current_page < $totalPages - 3) {
            $end_page = $totalPages;
        ?>
            <a class="page-item page-item-click" href="?per_page=<?= $item_per_page ?>&page=<?= $end_page ?>" data-perpage='<?= $item_per_page ?>' data-page='<?= $end_page ?>'>Last</a>
    <?php
        }
    }
    ?>
</div>
<script>
    // Phân trang
    $('#pagination').on('click', '.page-item-click', function(e) {
        var per_page = $(this).data('perpage');
        var page = $(this).data('page');
        var IDTH = $("#thuonghieu").val();
        var txtSearch = $("#txtSearch").val();
        var IDMH = 'PHONE';
        $.ajax({
            url: "../ajax_admin/ajax_product_pagi.php",
            data: {
                "per_page": per_page,
                "page": page,
                "IDTH": IDTH,
                "txtSearch": txtSearch,
                "IDMH": IDMH
            },
            dataType: "html",
            type: "post",
            success: function(data) {
                $('#tbl-phone-listing').html(data);
            }
        });
        e.preventDefault();
    });
</script>
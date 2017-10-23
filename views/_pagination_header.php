<?php
?>

<div class="pagination-buttons">
    <div class="btn item-count">
        (<input id="pagination-count" class="form-control" value="<?php echo $pagination['limit']; ?>" />
        / page)
    </div>

    <?php if($pagination['pageCount'] > 1): ?>
    <div class="btn btn-primary prev <?php echo ($pagination['page'] > 1) ? '' : 'disabled' ?>" onclick="pageMove('prev')">
        <i class="fa fa-step-backward" aria-hidden="true"></i>
    </div>
    <?php endif; ?>

    <?php
    for($i = 1; $i <= $pagination['pageCount']; $i++){
        $active = $i == $pagination['page'] ? 'active' : '';
        echo "<div class=\"btn btn-primary num $active \" data-page=\"".$i."\" onclick=\"loadPage($i)\">$i</div>";
    }
    ?>

    <?php if($pagination['pageCount'] > 1): ?>
        <div class="btn btn-primary next  <?php echo ($pagination['pageCount'] > $pagination['page']) ? '' : 'disabled' ?>" onclick="pageMove('next')">
            <i class="fa fa-step-forward" aria-hidden="true"></i>
        </div>
    <?php endif; ?>
</div>
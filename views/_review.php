<?php

?>

<div class="review-box" data-id="<?php echo $review->id; ?>">
    <div class="review-rating">
        <?php
        $star = "<i class=\"fa fa-star\" aria-hidden=\"true\"></i>";
        $starActive = "<i class=\"fa fa-star active\" aria-hidden=\"true\"></i>";

        echo str_repeat($starActive, $review->rating);
        echo str_repeat($star, Review::MAX_RATING - $review->rating);

        ?>
    </div>

    <div class="review-date">
        <?php echo (new DateTime($review->create_time))->format('Y-m-d h:i:s'); ?>
    </div>

    <div class="review-name">
        <?php echo $review->name; ?>
    </div>


    <div class="review-text">
        <i class="fa fa-quote-right" aria-hidden="true"></i>
        <?php echo $review->review; ?>
    </div>
</div>
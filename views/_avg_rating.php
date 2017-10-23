
<div id="avg-rating">
    <?php
    if( isset($avgRating) && $avgRating != null ){
        $percent = round($avgRating - floor($avgRating), 2) * 100;

        $star = "<i class=\"fa fa-star\" aria-hidden=\"true\"></i>";
        $starActive = "<i class=\"fa fa-star active\" aria-hidden=\"true\"></i>";
        $starActivePartial = "<i class=\"fa fa-star\" aria-hidden=\"true\">
        <i class=\"fa fa-star partial active\" aria-hidden=\"true\" style=\"width: ".$percent."%\"></i></i>";

        echo "(Avg.: ".number_format($avgRating, 1).") ";
        echo str_repeat($starActive, floor($avgRating));
        if( round($avgRating - floor($avgRating), 2) )
            echo $starActivePartial;
        echo str_repeat($star, Review::MAX_RATING - $avgRating);
    } else {
        echo "(Avg. not calculable)";
    }
    ?>
</div>
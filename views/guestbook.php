<?php
    $action->registerCssFile('/assets/css/guestbook.css');
    $action->registerScriptFile('/assets/js/guestbook.js');
?>

<script type="text/javascript">
    /*var onloadCallback = function() {
        grecaptcha.render('recaptcha_html_element', {
            'sitekey' : '6LcHWTUUAAAAAFu_n5UyizLSO9ER3M_u5mwk_Ys0'
        });
    };*/
</script>

<div id="page-guestbook" class="container">

    <div class="title island-box row">
        <div class="col-md-6">
            <h1>Imaginary <span>Guestbook</span> <!-- <small style="color: #aaa; display: inline-block;">(Test Proj.)</small>--></h1>
        </div>
        <div class="col-md-6" style="text-align: right;">
            <?php $action->renderPartial('_avg_rating', ['avgRating' => $avgRating]); ?>
        </div>

    </div>

    <div id="review-container" class="island-box">
        <div id="review-pagination" data-page="<?php echo $pagination['page']; ?>" data-pagecount="<?php echo $pagination['pageCount']; ?>">
            <?php $action->renderPartial('_pagination_header', ['pagination' => $pagination]); ?>
        </div>
        <div id="review-list">
        <?php
        if( isset($reviews) && is_array($reviews) ){
            foreach($reviews as $revw){
                $action->renderPartial('_review', ['review' => $revw]);
            }
        }
        ?>
        </div>
    </div>

    <div id="review-form-container" class="island-box stylized-form">
        <?php $action->renderPartial('_review_form', ['review' => $review]); ?>
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <!-- <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
                async defer>
        </script> -->
    </div>

</div>

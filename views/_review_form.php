<form id="review-form" method="post" action="/post-review">
    <div class="form-group name">
        <label for="reviewName">Your Name <span class="required">*</span></label>
        <input type="text" class="form-control" id="reviewName" name="Review[name]" aria-describedby="nameHelp" placeholder="Name" required />
        <small id="nameHelp" class="form-text text-muted">The displayed name for the review.</small>
    </div>

    <div modelattr="email" class="form-group email">
        <label for="reviewEmail1">Email Address <span class="required">*</span></label>
        <input type="email" class="form-control" id="reviewEmail" name="Review[email]" aria-describedby="emailHelp" placeholder="Enter Email Address" required>
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>

    <div modelattr="rating" class="form-group rating" style="position: relative">
        <label for="reviewStars">Rating <span class="required">*</span></label>
        <div id="reviewStars">
            <?php
            $star = "<i class=\"fa fa-star\" aria-hidden=\"true\"></i>";
            $starActive = "<i class=\"fa fa-star active\" aria-hidden=\"true\"></i>";

            echo str_repeat($starActive, 0); //$review->rating
            echo str_repeat($star, Review::MAX_RATING); // - $review->rating

            ?>
        </div>
        <input id="reviewRating" name="Review[rating]" type="text" required/>
    </div>

    <div modelattr="review" class="form-group review">
        <label for="reviewText">Review <span class="required">*</span></label>
        <textarea class="form-control" id="reviewText" name="Review[review]" aria-describedby="reviewHelp" placeholder="Please, share your experience with us" required></textarea>
        <small id="reviewHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>

    <div modelattr="recaptcha" class="form-group recaptcha">
        <label for="reviewText">No offense but are you real?</label>
        <div id="recaptcha_html_element" class="g-recaptcha" data-sitekey="6LcHWTUUAAAAAFu_n5UyizLSO9ER3M_u5mwk_Ys0"></div>
        <!-- <div id="recaptcha_html_element"></div> -->
    </div>

    <div class="form-group">
        <small id="requireHint" class="form-text text-muted">Fields with <span class="required">*</span> are required.</small>
    </div>

    <button type="submit" class="btn btn-primary">Send Review</button>

</form>
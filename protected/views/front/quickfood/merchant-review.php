
<div id="summary_review">
    <div id="general_rating">
        <?php echo $ratings['votes'] . " " . t("Reviews") ?>
        <div class="rating">
            <?php
                $this->renderPartial('/front/quickfood/ratings-star', array(
                    'rating' => $ratings['ratings']
                ));
            ?>
        </div>
    </div>
    <a href="javascript:;" class="btn_1 add_bottom_15 write-review-new green-button inline bottom10 upper">
        <?php echo t("write a review") ?>
    </a>
    <hr class="styled">
    <div class="review-input-wrap bottom10 row" style="display: none;">
        <form class="forms" id="frm-review" onsubmit="return false;">
            <?php echo CHtml::hiddenField('action', 'addReviews') ?>
            <?php echo CHtml::hiddenField('currentController', 'store') ?>
            <?php echo CHtml::hiddenField('merchant-id', $merchant_id) ?>
            <?php echo CHtml::hiddenField('initial_review_rating', '') ?>	        
            <div class="col-md-12 border">
                <div style="text-align: center; margin-bottom: 10px">
                    Please rate us: <div class="raty-stars" data-score="5"></div>   
                </div>
                <div>
                    <?php
                        echo CHtml::textArea('review_content', '', array(
                            'required' => true,
                            'class' => "grey-inputs form-control",
                            'style' => "height:100px; color: #85c99d; "
                            . "border: 1px solid #85c99d; background: transparent;"
                            . "margin-bottom: 10px",
                            'placeholder'=>"Write your review"
                        ))
                    ?>
                </div>
                <div class="top10">
                    <button class="orange-button inline btn_full_outline" type="submit"><?php echo t("PUBLISH REVIEW") ?></button>
                </div>
            </div> <!--col-->	        
        </form>
    </div> <!--review-input-wrap-->
    
</div><!-- End summary_review -->

<div class="box-grey rounded merchant-review-wrap" style="margin-top:0;"></div>
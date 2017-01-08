<!-- SubHeader =============================================== -->
<section class="parallax-window" data-parallax="scroll" data-image-src="<?php echo empty($background)?assetsURL()."/images/b-2.jpg":uploadURL()."/$background"; ?>" 
         data-parallax="scroll" data-position="top" data-bleed="10"
         data-natural-width="2014" data-natural-height="1342"
         style="background: rgba(0, 0, 0, 0.5);"
         >
    <div id="subheader">
	<div id="sub_content">
            <div id="thumb"><img src="<?php echo $merchant_logo;?>" alt=""></div>
            <div class="rating">
                        <?php for($i = 0; $i < $ratings['ratings']; $i++){
                            echo '<i class="icon_star voted"></i>';
                        } ?>
                        <?php for($i = 0; $i < 5-$ratings['ratings']; $i++){
                            echo '<i class="icon_star"></i>';
                        } ?>
                (<small><a href="detail_page_2.html">Read <?php echo $ratings['votes']." ".t("Reviews")?></a></small>)
                <?php echo FunctionsV3::merchantOpenTag($merchant_id)?>
            </div>
            <div><?php echo FunctionsV3::getFreeDeliveryTag2($merchant_id)?></div>
            <h1><?php echo clearString($restaurant_name)?></h1>
            <div><em><?php echo FunctionsV3::displayCuisine($cuisine);?></em></div>
            <div><i class="icon_pin"></i> <?php echo $merchant_address?></div>
        
        </div><!-- End sub_content -->
    </div><!-- End subheader -->
<?php 
        if(isset($step) && isset($show_bar)){
            $this->renderPartial('/front/quickfood/order-progress-bar',array(
               'step'=>$step,
               'show_bar'=>$show_bar
            ));
        }
        //echo CHtml::hiddenField('current_page_url',isset($current_page_url)?$current_page_url:'');
        
    ?>
</section><!-- End section -->
<!-- End SubHeader ============================================ -->

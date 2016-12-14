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
        </div>
        <h1><?php echo clearString($restaurant_name)?></h1>
        <div><em><?php echo FunctionsV3::displayCuisine($cuisine);?></em></div>
        <div><i class="icon_pin"></i> <?php echo $merchant_address?> - <strong>Delivery charge:</strong> $10, free over $15.</div>
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

<?php if(false):?>
<div class="mobile-banner-wrap relative">
 <div class="layer"></div>
 <img class="mobile-banner" src="<?php echo empty($background)?assetsURL()."/images/b-2-mobile.jpg":uploadURL()."/$background"; ?>">
</div>

<div id="parallax-wrap" class="parallax-search parallax-menu" 
data-parallax="scroll" data-position="top" data-bleed="10" 
data-image-src="<?php echo empty($background)?assetsURL()."/images/b-2.jpg":uploadURL()."/$background"; ?>">

<div class="search-wraps center menu-header">

      <img class="logo-medium bottom15" src="<?php echo $merchant_logo;?>">
      
	  <div class="mytable">
	     <div class="mycol">
	        <div class="rating-stars" data-score="<?php echo $ratings['ratings']?>"></div>   
	     </div>
	     <div class="mycol">
	        <p class="small">
	        <a href="javascript:;"class="goto-reviews-tab">
	        <?php echo $ratings['votes']." ".t("Reviews")?>
	        </a>
	        </p>
	     </div>	        
	     <div class="mycol">
	        <?php echo FunctionsV3::merchantOpenTag($merchant_id)?>             
	     </div>
	     <div class="mycol">
	        <p class="small"><?php echo t("Minimum Order").": ".FunctionsV3::prettyPrice($minimum_order)?></p>
	     </div>
	   </div> <!--mytable-->

	<h1><?php echo clearString($restaurant_name)?></h1>
	<p><i class="fa fa-map-marker"></i> <?php echo $merchant_address?></p>
	<p class="small"><?php echo FunctionsV3::displayCuisine($cuisine);?></p>
	<p><?php echo FunctionsV3::getFreeDeliveryTag($merchant_id)?></p>
	
	<?php if ( getOption($merchant_id,'merchant_show_time')=="yes"):?>
	<p class="small">
	<?php echo t("Merchant Current Date/Time").": ".
	Yii::app()->functions->translateDate(date('F d l')."@".timeFormat(date('c'),true));?>
	</p>
	<?php endif;?>
	
	<?php if (!empty($merchant_website)):?>
	<p class="small">
	<?php echo t("Website").": "?>
	<a target="_blank" href="<?php echo FunctionsV3::fixedLink($merchant_website)?>">
	  <?php echo $merchant_website;?>
	</a>
	</p>
	<?php endif;?>
			
</div> <!--search-wraps-->

</div> <!--parallax-container-->
<?php endif;?>
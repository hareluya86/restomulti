
<!--<div class="mobile-banner-wrap relative">
 <div class="layer"></div>
 <img class="mobile-banner" src="<?php echo assetsURL()."/images/banner-5-mobile.jpg"?>">
</div>-->

<!-- SubHeader =============================================== -->
<section class="parallax-window" id="short" data-parallax="scroll" 
         data-image-src="<?php echo assetsURL()."/images/banner-5.jpg"?>" 
         data-natural-width="1600" data-natural-height="988"
         >      
    <div id="subheader">
        <div id="sub_content">
            <h1><?php echo isset($h1)?$h1:''?></h1>
            <div><i class="icon_pin"></i> <?php echo isset($sub_text)?$sub_text:''?></div>
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
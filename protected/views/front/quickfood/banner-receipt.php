<!--<div class="mobile-banner-wrap relative">
 <div class="layer"></div>
 <img class="mobile-banner" src="<?php echo assetsURL()."/images/b-2-mobile.jpg"?>">
</div>-->

<!-- SubHeader =============================================== -->
<section class="parallax-window" id="short" data-parallax="scroll" 
         data-image-src="<?php echo assetsURL()."/images/b-2-mobile.jpg"?>" 
         >
    <div id="subheader">
        <div id="sub_content">
            <h1><?php echo isset($h1)?$h1:''?></h1>
            <div><i class="icon_pin"></i> <?php echo isset($sub_text)?$sub_text:''?></div>
        </div><!-- End sub_content -->
    </div><!-- End subheader -->
    <?php 
        $this->renderPartial('/front/quickfood/progress-merchantsignup',array(
       'step'=>$step,
       'show_bar'=>$show_bar
    ));?>
</section><!-- End section -->
<!-- End SubHeader ============================================ -->


<!--<div class="mobile-banner-wrap relative">
 <div class="layer"></div>
 <img class="mobile-banner" src="<?php echo assetsURL()."/images/banner-5-mobile.jpg"?>">
</div>-->


    <!-- SubHeader =============================================== -->
    <section class="parallax-window" id="short" data-parallax="scroll" 
             data-image-src="<?php echo assetsURL()."/images/b-2-mobile.jpg"?>" 
             >
        <div id="subheader">
            <div id="sub_content">
                <h1><?php echo isset($h1)?$h1:''?></h1>
                <?php if (!empty($sub_text)):?>
                    <div><i class="icon_pin"></i> <?php echo isset($sub_text)?$sub_text:''?></div>
                <?php endif;?>

                <?php if (!empty($contact_phone)):?>
                    <div><i class="icon_phone"></i><?php echo $contact_phone?></div>
                <?php endif;?>

                <?php if (!empty($contact_email)):?>
                    <div><i class="icon_mail"></i><?php echo $contact_email?></div>
                <?php endif;?>


            </div><!-- End sub_content -->
        </div><!-- End subheader -->
    </section>
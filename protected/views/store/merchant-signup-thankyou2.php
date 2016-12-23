<?php
$this->renderPartial('/front/quickfood/banner-receipt',array(
    'h1'=>t("Restaurant Signup"),
    'sub_text'=>t("signup process completed"),
    'step'=>4,
    'show_bar'=>false
));
?>

<div class="sections section-grey2 section-orangeform ">

    <div class="container margin_60_35">
        <?php if ($data):?>
            <div class="row">    
                <div class="col-md-6 col-md-offset-3">
                    <div class="box_style_2">
                        <h2 class="inner"><?php echo t("Congratulations")?>!</h2>
                        <div id="confirm">
                            <i class="icon_check_alt2"></i>
                            
                            <h3>           
                                <?php echo t("Congratulation for signing up. Please wait while our administrator validated your request.")?>
                            </h3>          
                            <p>
                                <?php echo t("You will receive email once your merchant has been approved. Thank You.")?>
                            </p>
                        </div>
	           </div>
	           <a href="<?php echo Yii::app()->createUrl('/store')?>" 
               class="top25 green-text block text-center"><i class="ion-ios-arrow-thin-left"></i> <?php echo t("back to homepage")?></a>
           </div> <!--box-->        
        </div> <!--inner-->
        <?php else :?>
            <?php 
                $this->renderPartial('/front/404-page');
            ?>
        <?php endif;?>
    </div> <!--container--> 
 
</div>
<?php
$this->renderPartial('/front/banner-receipt',array(
   'h1'=>t("Restaurant Signup"),
   'sub_text'=>t("step 3 of 4"),
    'step'=>4,
   'show_bar'=>true
));

/*PROGRESS ORDER BAR*/
/*$this->renderPartial('/front/progress-merchantsignup',array(
   'step'=>4,
   'show_bar'=>true
));
*/
?>

<div class="sections section-grey2 section-orangeform ">

    <div class="container margin_60_35">
        <div class="row">    
            <div class="col-md-8">       
                <?php if ($continue==TRUE):?>
                    <div class="box_style_2">
                       <h2 class="inner"><?php echo t("Almost Done..")?></h2>
                       <p><?php echo t("Your merchant registration is successfull. An email was sent to your email with activation code.")?></p>

                        <form class="forms" id="forms" onsubmit="return false;">
                            <?php echo CHtml::hiddenField('action','activationMerchant')?> 
                            <?php echo CHtml::hiddenField('currentController','store')?>
                            <?php echo CHtml::hiddenField('token',$_GET['token'])?> 

                            <?php echo t('Enter Activation Code');?>
                            <div class="form-group">				   
                                <?php echo CHtml::textField('activation_code',
                                        ''
                                        ,array(
                                        'class'=>'grey-fields form-control',
                                        'data-validation'=>"required",
                                        'maxlength'=>10,
                                        'placeholder'=>t("Enter Activation Code")
                                ))?> 
                                <input type="submit" value="<?php echo t("Submit")?>" 
                                   class="black-button inline medium">
                            </div>

                            <div class="form-group">
                                 <p class="text-small">
                                    <?php echo t("Did not receive activation code? click")?> 
                                    <a class="resend-activation-code" href="javascript:;">
                                        <?php echo t("here")?>
                                    </a> 
                                    <?php echo Yii::t("default","to resend again.")?>
                                 </p>
                            </div>

                        </form>	              

                    </div> <!--box-->
                <?php else :?>
                    <p><?php echo t("Sorry but we cannot find what you are looking for.")?></p>
                <?php endif;?>
           </div> <!--inner-->
        </div> <!--row-->   
    </div> <!--container-->
 
</div> <!--sections-->
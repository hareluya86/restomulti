<?php
$this->renderPartial('/front/quickfood/default-header', array(
    'h1' => t("Email Verification"),
    'sub_text' => t("Your registration is almost complete"),
    'step' => 4,
    'show_bar' => isset($_GET['checkout'])
));

/* Render top menu */
$this->renderPartial('/layouts/quickfood/front_top_menu', array(
    'action' => Yii::app()->controller->action->id,
    'theme_hide_logo' => getOptionA('theme_hide_logo')
));
?>

<?php
//if (isset($_GET['checkout'])){
//	$this->renderPartial('/front/order-progress-bar',array(
//	   'step'=>4,
//	   'show_bar'=>true
//	));
//}
?>

<div class="container margin_60_35">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="box_style_2 hidden-xs info">
                <h4 class="nomargin_top"><?php echo t("We have sent verification code to your email address")?> </h4>
                <form class="forms bottom20" id="forms" onsubmit="return false;">
                    <?php echo CHtml::hiddenField('action','verifyEmailCode')?>         
                    <?php echo CHtml::hiddenField('client_id',$data['client_id']) ?>
                    <?php echo CHtml::hiddenField('currentController','store')?>

                    <?php if (isset($_GET['checkout'])):?>
                        <?php echo CHtml::hiddenField('redirect', Yii::app()->createUrl('/store/paymentoption') )?>
                    <?php endif;?>
                    <p><?php echo t('Please enter you verification code');?></p>
                    <div class="form-group">
                        <?php 
                            echo CHtml::textField('code','',array(
                                'class'=>"grey-fields form-control",
                                'data-validation'=>"required",
                                'maxlength'=>14
                            ));
                        ?>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="<?php echo t("Submit")?>" class="green-button inline btn_1">
                    </div>
                    
                    <div class="form-group">
                        <?php echo t("Did not receive your verification code")?>? 
                        <a href="javascript:;" class="resend-email-code"><?php echo t("Click here to resend")?></a>
                    </div>
                </form>
            </div>
        </div>

    </div> <!--row-->
</div> <!--container-->

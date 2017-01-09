<?php
$this->renderPartial('/front/quickfood/default-header', array(
'h1' => t("Checkout"),
 'sub_text' => t("login to your account"),
 'step' => 4,
 'show_bar' => true
));

/* Render top menu */
$this->renderPartial('/layouts/quickfood/front_top_menu', array(
'action' => Yii::app()->controller->action->id,
 'theme_hide_logo' => getOptionA('theme_hide_logo')
));

//$this->renderPartial('/front/quickfood/order-progress-bar',array(
//   'step'=>4,
//   'show_bar'=>true
//));

echo CHtml::hiddenField('mobile_country_code', Yii::app()->functions->getAdminCountrySet(true));
?>

<!-- Content ================================================== -->
<div class="container margin_60_35">
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="box_style_2 info">
                        <h4 class="nomargin_top">Login to your account <i class="icon_lock_alt pull-right"></i></h4>
                        <form id="forms" class="forms" method="POST">
                            <?php echo CHtml::hiddenField('action', 'clientLogin') ?>
                            <?php echo CHtml::hiddenField('currentController', 'store') ?>
                            <?php echo CHtml::hiddenField('redirect', Yii::app()->createUrl('/store/paymentoption') ) ?>
                            <?php FunctionsV3::addCsrfToken(false); ?>

                            <?php if ($google_login_enabled==2 || $fb_flag==2 ) : ?>
                                <?php if ( $fb_flag==2): ?>
                                    <a href="javascript:fbcheckLogin();" class="fb-button orange-button medium rounded btn btn-primary">
                                        <i class="icon-facebook"></i>
                                        <?php echo t("login with Facebook")?>
                                    </a>
                                <?php endif; ?>

                                <?php if ($google_login_enabled==2): ?>
                                    <a href="<?php echo Yii::app()->createUrl('/store/googleLogin')?>" 
                                        class="google-button orange-button medium rounded btn btn-danger">
                                        <i class="ion-social-googleplus-outline" style="width: 19px"></i>
                                            <?php echo t("Sign in with Google")?>
                                    </a>
                                <?php endif; ?>
                                <div class="login-or">
                                    <h4><?php echo t("Or")?></h4>
                                </div>
                            <?php endif;?>
                            <div class="form-group">
                                <?php echo CHtml::textField('username','',
                                    array('class'=>'grey-fields form-control',
                                    'placeholder'=>t("Email"),
                                    'required'=>true
                                ))?>
                            </div>
                            <div class="form-group">
                                <?php echo CHtml::passwordField('password','',
                                    array('class'=>'grey-fields form-control',
                                    'placeholder'=>t("Password"),
                                    'required'=>true
                                ))?>
                            </div>
                            <?php if ($captcha_customer_login==2):?>
                                <div class="form-group">
                                    <div id="kapcha-1"></div>
                                </div>
                            <?php endif; ?>
                            <div class="form-group">
                                <a href="javascript:;" class="forgot-pass-link2 block orange-text text-center">
                                    <?php echo t("Forgot Password");?> <i class="ion-help"></i>
                                </a>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="<?php echo t("Login")?>" class="green-button medium full-width btn_full">
                            </div>
                        </form>
                    </div>
                </div>
                <form id="frm-modal-forgotpass" class="frm-modal-forgotpass" method="POST" onsubmit="return false;" >
                    <?php echo CHtml::hiddenField('action','forgotPassword')?>
                    <?php echo CHtml::hiddenField('do-action', isset($_GET['do-action'])?$_GET['do-action']:'' )?>     
                    <div class="section-forgotpass" style="display: none;">
                        <div class="col-md-12 ">
                            <div class="box_style_2 info">
                                <h4 class="nomargin_top"><?php echo t("Forgot Password")?> <i class="icon_lock-open_alt pull-right"></i></h4>
                                <div class="form-group">
                                    <?php echo CHtml::textField('username-email','',
                                        array('class'=>'grey-fields form-control',
                                        'placeholder'=>t("Email address"),
                                        'required'=>true
                                    ))?>
                                </div>
                                <div class="form-group">
                                    <a href="javascript:;" class="back-link block orange-text text-center">
                                        <?php echo t("Close");?>
                                    </a> 
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="<?php echo t("Retrieve Password")?>" class="green-button medium full-width btn_full_outline">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box_style_2" id="order_process">
                <h2 class="inner"><?php echo t("Sign up")?></h2>
                <form id="form-signup" class="form-signup uk-panel uk-panel-box uk-form" method="POST">
                    <?php echo CHtml::hiddenField('action','clientRegistration')?>
                    <?php echo CHtml::hiddenField('currentController','store')?>
                    <?php echo CHtml::hiddenField('redirect',Yii::app()->createUrl('/store/paymentoption'))?>
                    <?php FunctionsV3::addCsrfToken(false);?>
                    <?php 
                        $verification=Yii::app()->functions->getOptionAdmin("website_enabled_mobile_verification");	    
                        if ( $verification=="yes"){
                            echo CHtml::hiddenField('verification',$verification);
                        }
                        if (getOptionA('theme_enabled_email_verification')==2){
                        echo CHtml::hiddenField('theme_enabled_email_verification',2);
                        }
                    ?>
                    <?php if ( $disabled_guest_checkout!="yes"):?>
                        <div class="payment_select">
                            <label>
                                <?php echo t("Guest Checkout")?>
                            </label>
                            <p><?php echo t("Proceed to checkout, and you will have an option to create an account at the end.")?></p>
                            <p style="text-align: center">
                                <a href="<?php echo $this->createUrl('/store/guestcheckout');?>" 
	               class="text-center block orange-text bottom20"><?php echo t("Continue as guest")?></a>
                            </p>
                        </div>
                    <?php endif; ?> 
                    <div class="form-group">
                        <label><?php echo t("First Name");?></label>
                        <?php echo CHtml::textField('first_name','',
                            array('class'=>'grey-fields form-control',
                            'placeholder'=>t("First Name"),
                            'required'=>true               
                        ))?>
                    </div>
                    <div class="form-group">
                        <label><?php echo t("Last Name");?></label>
                        <?php echo CHtml::textField('last_name','',
                            array('class'=>'grey-fields form-control',
                            'placeholder'=>t("Last Name"),
                            'required'=>true               
                        ))?>
                    </div>
                    <div class="form-group">
                        <label><?php echo t("Mobile");?></label>
                        <?php echo CHtml::textField('contact_phone','',
                            array('class'=>'grey-fields form-control mobile_inputs',
                            'placeholder'=>t("Mobile"),
                            'required'=>true               
                        ))?>
                    </div>
                    <div class="form-group">
                        <label><?php echo t("Email address");?></label>
                        <?php echo CHtml::textField('email_address','',
                            array('class'=>'grey-fields form-control',
                            'placeholder'=>t("Email address"),
                            'required'=>true               
                        ))?>
                    </div>
                    <div class="form-group">
                        <label><?php echo t("Password");?></label>
                        <?php echo CHtml::passwordField('password','',
                            array('class'=>'grey-fields form-control',
                            'placeholder'=>t("Password"),
                            'required'=>true               
                        ))?>
                    </div>
                    <div class="form-group">
                        <label><?php echo t("Confirm Password");?></label>
                        <?php echo CHtml::passwordField('cpassword','',
                            array('class'=>'grey-fields form-control',
                            'placeholder'=>t("Confirm Password"),
                            'required'=>true               
                        ))?>
                    </div>
                    <?php 
                        $FunctionsK=new FunctionsK();
                        $FunctionsK->clientRegistrationCustomFields();
                    ?>  
                    <?php if ($captcha_customer_signup==2):?>
                        <div class="top10">
                            <div id="kapcha-2"></div>
                        </div>
                    <?php endif;?> 
                    <p class="text-muted">
                        <?php echo Yii::t("default","By creating an account, you agree to receive sms from vendor.")?>
                    </p>
                    <?php if ($terms_customer=="yes"): ?> 
                        <div class="form-group">
                            <?php 
                                echo CHtml::checkBox('terms_n_condition',false,array(
                                    'value'=>2,
                                    'class'=>"",
                                    'required'=>true
                                ));
                            ?>
                            <span>
                                <?php 
                                    echo " ". t("I Agree To")." <a href=\"$terms_customer_url\" target=\"_blank\">".t("The Terms & Conditions")."</a>";
                                ?>
                            </span>
                        </div>
                    <?php endif;?>
                    <div class="form-group">
                        <input type="submit" value="<?php echo t("Create Account")?>" class="orange-button medium block full-width btn_1">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php 

$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();

$cs->registerCss('intl-tel-input', 
        '.intl-tel-input {'
        . ' display: block !important'
        . '}');

?>
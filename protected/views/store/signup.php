<?php
$this->renderPartial('/front/quickfood/banner-receipt',array(
    'h1'=>t("Login & Signup"),
    'sub_text'=>t("sign up to start ordering"),
    'step'=>'',
    'show_bar'=>false
));

echo CHtml::hiddenField('mobile_country_code',Yii::app()->functions->getAdminCountrySet(true));
?>

<div class="sections section-grey2 section-checkout">
    <div class="container margin_60_35">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <!--LEFT CONTENT-->
                    <div class="col-md-12" >
                        <div class="box_style_2 hidden-xs info">
                            <h4 class="nomargin_top">
                                <?php echo t("Log in to your account")?>
                            </h4>
                            <form id="forms" class="forms" method="POST">
                                <?php echo CHtml::hiddenField('action','clientLogin')?>
                                <?php echo CHtml::hiddenField('currentController','store')?> 
                                <?php FunctionsV3::addCsrfToken(false);?>

                                <?php if ($google_login_enabled==2 || $fb_flag==2 ) :?>
                                    <?php if ( $fb_flag==2):?>
                                        <a href="javascript:fbcheckLogin();" class="fb-button orange-button medium rounded">
                                            <i class="ion-social-facebook"></i>
                                            <?php echo t("login with Facebook")?>
                                        </a>
                                    <?php endif; ?>
                                    <?php if ($google_login_enabled==2):?>
                                        <div class="top10"></div>
                                        <a href="<?php echo Yii::app()->createUrl('/store/googleLogin')?>" 
                                            class="google-button orange-button medium rounded">
                                            <i class="ion-social-googleplus-outline"></i><?php echo t("Sign in with Google")?>
                                        </a>
                                    <?php endif;?>
                                    <div class="login-or">
                                        <span><?php echo t("Or")?></span>
                                    </div>
                                <?php endif; ?>
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
                                    <div class="top10">
                                        <div id="kapcha-1"></div>
                                    </div>
                                <?php endif;?>
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
                                <div class="box_style_2 hidden-xs info">
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
                        <?php echo CHtml::hiddenField('action','clientRegistrationModal')?>
                        <?php echo CHtml::hiddenField('currentController','store')?>
                        <?php echo CHtml::hiddenField('single_page',2)?>    
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
</div>
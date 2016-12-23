<?php
$this->renderPartial('/front/quickfood/banner-receipt', array(
    'h1' => t("Restaurant Signup"),
    'sub_text' => t("Please select one of our package"),
    'step' => 1,
    'show_bar' => true
));

/* PROGRESS ORDER BAR */
/* $this->renderPartial('/front/quickfood/progress-merchantsignup',array(
  'step'=>1,
  'show_bar'=>true
  )); */
?>

<!--TOP MENU-->
<?php
$this->renderPartial('/layouts/quickfood/front_top_menu', array(
    'action' => Yii::app()->controller->action->id,
    'theme_hide_logo' => getOptionA('theme_hide_logo')
));
?>

<div class="white_bg">
    <div class="container margin_60_35">
        <div class="main_title margin_mobile">
            <h2 class="nomargin_top">Our Plans</h2>
            <p></p>
        </div>
        <?php if (is_array($list) && count($list)>=1):?>
            <div class="row text-center plans">
                <?php foreach ($list as $val):?>
                    <div class="plan col-md-4">
                        <h2 class="plan-title"><?php echo $val['title']?></h2>
                        <?php if ( $val['promo_price']>=1):?>
                            <p class="plan-price"><?php echo FunctionsV3::prettyPrice($val['promo_price'])?><span>/00</span></p>
                        <?php else :?>
                            <p class="plan-price"><?php echo FunctionsV3::prettyPrice($val['price'])?><span>/00</span></p>
                        <?php endif;?>
                        <ul class="plan-features">
                            <li><?php echo $val['description']?></li>
                            <?php if ( $val['expiration_type']=="year"):?>
                                <li>
                                    <?php echo t("Membership Limit")?> <?php echo $val['expiration']/365;?> <?php echo t($val['expiration_type'])?>
                                </li>
                            <?php else :?>
                                <li>
                                    <?php echo t("Membership Limit")?> <strong><?php echo $val['expiration']?> <?php echo t($val['expiration_type'])?></strong>
                                </li>
                            <?php endif;?>
                            <?php if ( $val['sell_limit'] <=0):?>
                                <li>
                                    <?php echo Yii::t("default","Sell limit")?> : <strong><?php echo Yii::t("default","Unlimited")?></strong>
                                </li>
                            <?php else :?>
                                <li>
                                    <?php echo Yii::t("default","Sell limit")?> : <strong><?php echo $val['sell_limit']?></strong>
                                </li>
                            <?php endif;?>
                            <li>
                                <?php echo Yii::t("default","Usage:")?> <strong><?php echo $limited_post[$val['unlimited_post']]?></strong>
                            </li>
                        </ul>
                        <a href="<?php echo Yii::app()->createUrl('/store/merchantsignup/',array(
                            'do'=>"step2",
                            'package_id'=>$val['package_id']
                                ))?>" class="btn_1">
                       <?php echo t("Sign up")?>
                      </a>
                    </div> <!-- End col-md-4 -->
                <?php endforeach;?>
            </div>
        <?php else:?>
            <div class="main_title margin_mobile">
                <h2 class="nomargin_top"><?php echo t("No package available")?></h2>
                <p><?php echo t("come back again later")?></p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php if (is_array($list) && count($list)>=1):?>
    <div class="container margin_60">
        <div class="main_title margin_mobile">
            <h2 class="nomargin_top">
                <?php echo t('Resume Sign Up?');?>
            </h2>
            <br>
            <form onsubmit="return false;" method="POST" class="frm-resume-signup uk-form has-validation-callback" id="frm-resume-signup">
                <input type="hidden" id="action" name="action" value="merchantResumeSignup">
                <input type="hidden" id="do-action" name="do-action" value="sigin">         
                <?php echo CHtml::hiddenField('currentController','store')?>
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-md-offset-4 col-sm-offset-4">
                        <div class="form-group">
                            <?php echo CHtml::textField('email_address','',array(
                                'data-validation'=>'required',		    
                                'class'=>'grey-fields full-width form-control',
                                'placeholder'=>t("Email")
                              ))?>
                        </div>
                        <input type="submit" class="btn_1 orange-button medium" value="<?php echo Yii::t("default","Submit")?>">
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php endif; ?>

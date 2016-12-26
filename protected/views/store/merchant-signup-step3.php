<?php
$this->renderPartial('/front/quickfood/banner-receipt',array(
    'h1'=>t("Restaurant Signup"),
    'sub_text'=>t("step 3 of 4"),
    'step'=>3,
    'show_bar'=>true
));

/*PROGRESS ORDER BAR*/
/*$this->renderPartial('/front/progress-merchantsignup',array(
   'step'=>3,
   'show_bar'=>true
));
*/
/* Render top menu */
$this->renderPartial('/layouts/quickfood/front_top_menu', array(
    'action' => Yii::app()->controller->action->id,
    'theme_hide_logo' => getOptionA('theme_hide_logo')
));

?>
<div class="sections section-grey2 section-orangeform section-merchant-payment">
    <div class="container margin_60_35">
        <div class="row">
            <div class="col-md-8">
                <div class="box_style_2">
                    <h2 class="inner"><?php echo t("Choose Payment option")?></h2>
                    <?php if ($merchant):?>
                    <?php 
                         $merchant_id=$merchant['merchant_id']; 
                         if ($renew==TRUE){
                                 $merchant['package_price']=1;
                         }               
                    ?>
                        <?php if ($merchant['package_price']>=1):?>
                            <form class="uk-form uk-form-horizontal forms" id="forms" onsubmit="return false;">
                                <?php echo CHtml::hiddenField('action','merchantPayment')?>
                                <?php echo CHtml::hiddenField('currentController','store')?>
                                <?php echo CHtml::hiddenField('token',$_GET['token'])?>  

                                <?php if ($renew==TRUE):?>
                                    <?php echo CHtml::hiddenField("renew",1);?>
                                    <?php echo CHtml::hiddenField("package_id",$package_id);?>
                                    <?php if (is_numeric($package_id)):?>
                                        <?php 
                                            $this->renderPartial('/front/quickfood/payment-list',array(
                                              'merchant_id'=>$merchant_id,
                                              'payment_list'=>FunctionsV3::getAdminPaymentList(),						   
                                            ));
                                        ?>
                                    <?php else :?>
                                        <p class="text-warning"><?php echo t("No Selecetd Membership package. Please go back.")?></p>
                                    <?php endif; ?>
                                <?php else :?>
                                    <?php 
                                        $this->renderPartial('/front/quickfood/payment-list',array(
                                          'merchant_id'=>$merchant_id,
                                          'payment_list'=>FunctionsV3::getAdminPaymentList(),						   
                                        ));
                                    ?>
                                <?php endif; ?>
                                <input type="submit" value="<?php echo t("Next")?>" class="green-button medium inline btn_full_outline">
                            </form>
                            <!--CREDIT CART-->
                            <?php 
                            $this->renderPartial('/front/quickfood/credit-cart-merchant',array(
                                  'merchant_id'=>$merchant_id	   
                                ));
                                ?>     
                            <!--END CREDIT CART-->
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

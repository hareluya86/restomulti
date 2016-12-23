
<div class="credit_card_wrap" style="display: none;">    
    <form id="frm-creditcard" class="frm-creditcard" method="POST" onsubmit="return false;">
        <h3><?php echo t('Credit Card information');?></h3>

        <a href="javascript:;" class="cc-add orange-text">
        [ <i class="ion-ios-compose-outline"></i> <?php echo t("Add new card")?>]
        </a>
        
        
        <h4><?php echo t('select credit card below');?></h4>
        
        <table class="table table-striped">
            <tbody class="uk-list-cc"> 
            </tbody>
        </table>
        
        <div class="cc-add-wrap">
            <h4><?php echo Yii::t("default","New Card")?></h4>
            <?php echo CHtml::hiddenField('action','addCreditCardMerchant')?>
            <?php echo CHtml::hiddenField('currentController','store')?>
            <?php echo CHtml::hiddenField('merchant_id',$merchant_id)?>
            
            <div class="form-group">
                <?php echo CHtml::textField('card_name','',array(
                    'class'=>'grey-fields full-width form-control',
                    'placeholder'=>Yii::t("default","Card name"),
                    'data-validation'=>"required"  
                ))?>
            </div>
            
            <div class="form-group">
                <?php echo CHtml::textField('credit_card_number','',array(
                   'class'=>'numeric_only grey-fields full-width form-control',
                   'placeholder'=>Yii::t("default","Credit Card Number"),
                   'data-validation'=>"required",
                   'maxlength'=>16
                  ))?>     
            </div>
            
            <div class="form-group">
                <?php echo CHtml::dropDownList('expiration_month','',
                    Yii::app()->functions->ccExpirationMonth()
                    ,array(
                     'class'=>'grey-fields full-width form-control',
                     'placeholder'=>Yii::t("default","Exp. month"),
                     'data-validation'=>"required"  
                ))?>     
            </div>
            <div class="form-group">
                <?php echo CHtml::dropDownList('expiration_yr','',
                    Yii::app()->functions->ccExpirationYear()
                    ,array(
                        'class'=>'grey-fields full-width form-control',
                        'placeholder'=>Yii::t("default","Exp. year") ,
                        'data-validation'=>"required"  
                ))?>     
            </div> 
            <div class="form-group">
                <?php echo CHtml::textField('cvv','',array(
                   'class'=>'grey-fields full-width form-control',
                   'placeholder'=>Yii::t("default","CVV"),
                   'data-validation'=>"required",
                   'maxlength'=>4
                  ))?>     
            </div>
            <div class="form-group">
                <?php echo CHtml::textField('billing_address','',array(
                   'class'=>'grey-fields full-width form-control',
                   'placeholder'=>Yii::t("default","Billing Address"),
                   'data-validation'=>"required"  
                  ))?> 
            </div>
            <div class="form-group">
                <input type="submit" value="<?php echo t("Add Credit Card")?>" class="green-button medium inline block">
            </div>
  
        </div> <!--cc-add-wrap-->
 
    </form>
</div> <!--credit_card_wrap-->
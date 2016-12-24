<?php
$this->renderPartial('/front/quickfood/default-header',array(
    'h1'=>t("Payment Option"),
    'sub_text'=>t("choose your payment"),
    'step'=>4,
    'show_bar'=>true));

/* Render top menu */
$this->renderPartial('/layouts/quickfood/front_top_menu', array(
    'action' => Yii::app()->controller->action->id,
    'theme_hide_logo' => getOptionA('theme_hide_logo')
));

//$this->renderPartial('/front/order-progress-bar',array(
//   'step'=>4,
//   'show_bar'=>true
//));

$s=$_SESSION;
$continue=false;

$merchant_address='';		
if ($merchant_info=Yii::app()->functions->getMerchant($s['kr_merchant_id'])){	
	$merchant_address=$merchant_info['street']." ".$merchant_info['city']." ".$merchant_info['state'];
	$merchant_address.=" "	. $merchant_info['post_code'];
}

$client_info='';

if (isset($is_guest_checkout)){
	$continue=true;	
} else {	
	$client_info = Yii::app()->functions->getClientInfo(Yii::app()->functions->getClientId());
	if (false && isset($s['kr_search_address'])){	
		$temp=explode(",",$s['kr_search_address']);		
		if (is_array($temp) && count($temp)>=2){
			$street=isset($temp[0])?$temp[0]:'';
			$city=isset($temp[1])?$temp[1]:'';
			$state=isset($temp[2])?$temp[2]:'';
		}
		if ( isset($client_info['street'])){
			if ( empty($client_info['street']) ){
				$client_info['street']=$street;
			}
		}
		if ( isset($client_info['city'])){
			if ( empty($client_info['city']) ){
				$client_info['city']=$city;
			}
		}
		if ( isset($client_info['state'])){
			if ( empty($client_info['state']) ){
				$client_info['state']=$state;
			}
		}
	}	
	
	if (isset($s['kr_merchant_id']) && Yii::app()->functions->isClientLogin() && is_array($merchant_info) ){
		$continue=true;
	}
}
echo CHtml::hiddenField('mobile_country_code',Yii::app()->functions->getAdminCountrySet(true));

echo CHtml::hiddenField('admin_currency_set',getCurrencyCode());

echo CHtml::hiddenField('admin_currency_position',
Yii::app()->functions->getOptionAdmin("admin_currency_position"));
?>
<div class="white_bg">
<div class="container margin_60_35">
    <?php if ( $continue==TRUE):?>
        <?php 
            $merchant_id=$s['kr_merchant_id'];
            echo CHtml::hiddenField('merchant_id',$merchant_id);
        ?>
        <div class="row">
            <div class="col-md-8">
                <div class="box_style_2">

                    <form id="frm-delivery" class="frm-delivery" method="POST" onsubmit="return false;">
                        <?php 
                            echo CHtml::hiddenField('action','placeOrder');
                            echo CHtml::hiddenField('country_code',$merchant_info['country_code']);
                            echo CHtml::hiddenField('currentController','store');
                            echo CHtml::hiddenField('delivery_type',$s['kr_delivery_options']['delivery_type']);
                            echo CHtml::hiddenField('cart_tip_percentage','');
                            echo CHtml::hiddenField('cart_tip_value','');
                            echo CHtml::hiddenField('client_order_sms_code');
                            echo CHtml::hiddenField('client_order_session');
                            if (isset($is_guest_checkout)){
                               echo CHtml::hiddenField('is_guest_checkout',2);
                            }     
                        ?>
                        <?php if ( $s['kr_delivery_options']['delivery_type']=="pickup"):?> 
                            <h2 class="inner"><?php echo Yii::t("default","Pickup information")?> </h2>
                            <p><?php echo $merchant_address;?></p>
                        <?php else : //DELIVERY?> 
                            <h2 class="inner"><?php echo Yii::t("default","Delivery information")?> </h2>
                            <div class="payment_select">
                                <label>
                                    <?php echo clearString(ucwords($merchant_info['restaurant_name']))?> <?php echo Yii::t("default","Restaurant")?> 
                                </label>
                                <i class="icon_house"></i>
                                <p>
                                    <?php echo t(ucwords($s['kr_delivery_options']['delivery_type']));?>
                                    <?php if ($s['kr_delivery_options']['delivery_asap']==1):?>
                                        <?php echo $s['kr_delivery_options']['delivery_date']." ".Yii::t("default","ASAP");?>
                                    <?php else: ?>
                                        <?php echo '<span class="bold">'.Yii::app()->functions->translateDate(date("M d Y",strtotime($s['kr_delivery_options']['delivery_date']))).
                                                " ".t("at"). " ". $s['kr_delivery_options']['delivery_time']."</span> ".t("to");?>
                                    <?php endif;?>
                                </p>
                            </div>
                        <?php endif; ?>
                        <?php if (isset($is_guest_checkout)):?>
                            <div class="form-group">
                                <?php echo CHtml::textField('first_name','',array(
                                    'class'=>'grey-fields full-width form-control',
                                    'placeholder'=>Yii::t("default","First Name"),
                                    'data-validation'=>"required"
                                ))?>
                            </div>
                            <div class="form-group">
                                <?php echo CHtml::textField('last_name','',array(
                                    'class'=>'grey-fields full-width form-control',
                                    'placeholder'=>Yii::t("default","Last Name"),
                                    'data-validation'=>"required"
                                ))?>
                            </div>
                        <?php endif; ?>
                        <?php if ( $website_enabled_map_address==2 ):?>
                            <div class="top10">
                                <?php Widgets::AddressByMap()?>
                            </div>
                        <?php endif;?>
                        <?php if ( $address_book):?>
                            <div class="address_book_wrap">
                                <div class="form-group">
                                    <div class="row top10">
                                        <div class="col-md-10">
                                            <?php 
                                                $address_list=Yii::app()->functions->addressBook(Yii::app()->functions->getClientId());
                                                echo CHtml::dropDownList('address_book_id',$address_book['id'],
                                                (array)$address_list,array(
                                                   'class'=>"grey-fields full-width form-control"
                                                ));
                                            ?>

                                        </div> 
                                        <div class="col-md-2">
                                            <a href="javascript:;" class="edit_address_book block top10 btn_full_outline">
                                                <i class="ion-compose"></i> <?php echo t("Edit")?>
                                            </a>
                                        </div>
                                    </div>  
                                </div>
                            </div>
                        <?php endif;?>
                        <div class="address-block">
                            <div class="form-group">
                                <?php echo CHtml::textField('street', isset($client_info['street'])?$client_info['street']:'' ,array(
                                    'class'=>'grey-fields full-width form-control',
                                    'placeholder'=>Yii::t("default","Street"),
                                    'data-validation'=>"required"
                                ))?>
                            </div>
                            <div class="form-group">
                                <?php echo CHtml::textField('city', isset($client_info['city'])?$client_info['city']:''
                                    ,array(
                                        'class'=>'grey-fields full-width form-control',
                                        'placeholder'=>Yii::t("default","City"),
                                        'data-validation'=>"required"
                                ))?>
                            </div>
                            <div class="form-group">
                                <?php echo CHtml::textField('state',
                                    isset($client_info['state'])?$client_info['state']:''
                                    ,array(
                                        'class'=>'grey-fields full-width form-control',
                                        'placeholder'=>Yii::t("default","State"),
                                        'data-validation'=>"required"
                                ))?>
                            </div>
                            <div class="form-group">
                                <?php echo CHtml::textField('zipcode',
                                    isset($client_info['zipcode'])?$client_info['zipcode']:''
                                    ,array(
                                         'class'=>'grey-fields full-width form-control',
                                         'placeholder'=>Yii::t("default","Zip code")
                                ))?>
                            </div>
                            <div class="form-group">
                                <?php echo CHtml::textField('location_name',
                                    isset($client_info['location_name'])?$client_info['location_name']:''
                                    ,array(
                                        'class'=>'grey-fields full-width form-control',
                                        'placeholder'=>Yii::t("default","Apartment suite, unit number, or company name")	               
                                ))?>
                            </div>
                            <div class="form-group">
                                <?php echo CHtml::textField('contact_phone',
                                isset($client_info['contact_phone'])?$client_info['contact_phone']:''
                                ,array(
                                      'class'=>'grey-fields mobile_inputs full-width form-control',
                                      'placeholder'=>Yii::t("default","Mobile Number"),
                                      'data-validation'=>"required"  
                                     ))?>
                            </div> 
                            <div class="form-group">
                                <?php echo CHtml::textField('delivery_instruction','',array(
                                     'class'=>'grey-fields full-width form-control',
                                     'placeholder'=>Yii::t("default","Delivery instructions")   
                                    ))?>
                            </div>
                            <div class="form-group">
                                <?php
                                    echo CHtml::checkBox('saved_address',false,array('class'=>"",'value'=>2));
                                    echo " ".t("Save to my address book");
                                    ?>
                            </div>
                        </div>
                        <?php if (isset($is_guest_checkout)):?>
                            <div class="form-group">
                                <?php echo CHtml::textField('email_address','',array(
                                    'class'=>'grey-fields full-width form-control',
                                    'placeholder'=>Yii::t("default","Email address"),              
                                ))?>
                            </div> 
                            <div class="form-group">
                                <label><?php echo t('Optional');?></label>
                                <?php echo CHtml::passwordField('password','',array(
                                    'class'=>'grey-fields full-width form-control',
                                    'placeholder'=>Yii::t("default","Password"),               
                                ))?>
                            </div>
                        <?php endif;?>
                        <?php 
                            $this->renderPartial('/front/quickfood/payment-list',array(
                                'merchant_id'=>$merchant_id,
                                'payment_list'=>FunctionsV3::getMerchantPaymentList($merchant_id)
                            ));?>
                        <?php if ( Yii::app()->functions->getOption("merchant_enabled_tip",$merchant_id)==2):?>
                            <?php 
                                $merchant_tip_default=Yii::app()->functions->getOption("merchant_tip_default",$merchant_id);
                                if ( !empty($merchant_tip_default)){
                                   echo CHtml::hiddenField('default_tip',$merchant_tip_default);
                                }        
                                $FunctionsK=new FunctionsK();
                                $tips=$FunctionsK->tipsList();        
                            ?>
                            <div class="form-group">
                                <label>
                                    <?php echo t("Tip Amount")?> (<span class="tip_percentage">0%</span>)
                                </label>
                                <?php foreach ($tips as $tip_key=>$tip_val):?>   
                                    <a class="tips" href="javascript:;" data-type="tip" data-tip="<?php echo $tip_key?>">
                                        <?php echo $tip_val?>
                                    </a>
                                <?php endforeach;?>
                                <a class="tips" href="javascript:;" data-type="cash" data-tip="0"><?php echo t("Tip cash")?></a>
                                <?php echo CHtml::textField('tip_value','',array(
                                    'class'=>"numeric_only grey-fields",
                                    'style'=>"width:70px;"
                                ));?></li>
                            </div>
                        <?php endif;?>
                    </form>
                    <div class="form-group">
                        <?php 
                            $this->renderPartial('/front/quickfood/credit-card',array(
                                'merchant_id'=>$merchant_id	   
                            ));
                        ?>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4" id="sidebar">
                <div class="theiaStickySidebar">
                    <div id="cart_box" >
                        <h3><?php echo t("Your Order")?> <i class="icon_cart_alt pull-right"></i></h3>
                        <div class="item-order-wrap"></div>
                        <hr>
                        <?php Widgets::applyVoucher($merchant_id);?>
                        
                        <?php 
                            if (FunctionsV3::hasModuleAddon("pointsprogram")){
                                /*POINTS PROGRAM*/
                                PointsProgram::redeemForm();
                            }
                        ?>
                        <?php 
                            $minimum_order=Yii::app()->functions->getOption('merchant_minimum_order',$merchant_id);
                            $maximum_order=getOption($merchant_id,'merchant_maximum_order');	         
                            if ( $s['kr_delivery_options']['delivery_type']=="pickup"){
                                     $minimum_order=Yii::app()->functions->getOption('merchant_minimum_order_pickup',$merchant_id);
                                     $maximum_order=getOption($merchant_id,'merchant_maximum_order_pickup');	         
                            }  
                        ?>
                        <?php 
                            if (!empty($minimum_order)){
                                echo CHtml::hiddenField('minimum_order',unPrettyPrice($minimum_order));
                                echo CHtml::hiddenField('minimum_order_pretty',baseCurrency().prettyFormat($minimum_order));
                        ?>
                            <p class="small center"><?php echo t("Subtotal must exceed")?> 
                                <?php echo baseCurrency().prettyFormat($minimum_order,$merchant_id)?>
                            </p>      
                        <?php
                            }
                            if($maximum_order>0){
                                   echo CHtml::hiddenField('maximum_order',unPrettyPrice($maximum_order));
                                   echo CHtml::hiddenField('maximum_order_pretty',baseCurrency().prettyFormat($maximum_order));
                            }
                        ?>
                        <?php if ( getOptionA('captcha_order')==2 || getOptionA('captcha_customer_signup')==2):?>             
                            <div class="top10 capcha-wrapper">
                                <?php //GoogleCaptcha::displayCaptcha()?>
                                <div id="kapcha-1"></div>
                            </div>
                        <?php endif;?>          
             
                        <!--SMS Order verification-->
                        <?php if ( getOptionA('mechant_sms_enabled')==""):?>
                            <?php if ( getOption($merchant_id,'order_verification')==2):?>
                                <?php $sms_balance=Yii::app()->functions->getMerchantSMSCredit($merchant_id);?>
                                <?php if ( $sms_balance>=1):?>
                                    <?php $sms_order_session=Yii::app()->functions->generateCode(50);?>
                                    <p class="top20 center">
                                        <?php echo t("This merchant has required SMS verification")?><br/>
                                        <?php echo t("before you can place your order")?>.<br/>
                                        <?php echo t("Click")?> <a href="javascript:;" class="send-order-sms-code" data-session="<?php echo $sms_order_session;?>">
                                        <?php echo t("here")?></a>
                                        <?php echo t("receive your order sms code")?>
                                    </p>
                                    <div class="top10 text-center">
                                        <?php 
                                            echo CHtml::textField('order_sms_code','',array(	            
                                              'placeholder'=>t("SMS Code"),
                                              'maxlength'=>8,
                                              'class'=>'grey-fields text-center'
                                            ));
                                        ?>
                                    </div>
                                <?php endif;?>
                            <?php endif;?>
                        <?php endif;?>
                        <!--END SMS Order verification-->
           
                        <div class="text-center top25">
                            <a href="javascript:;" class="btn_full place_order green-button medium inline block">
                                <?php echo t("Place Order")?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
<!--section-payment-option-->
</div>
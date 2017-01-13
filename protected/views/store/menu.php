<?php
/* POINTS PROGRAM */
if (FunctionsV3::hasModuleAddon("pointsprogram")) {
    unset($_SESSION['pts_redeem_amt']);
    unset($_SESSION['pts_redeem_points']);
}

$merchant_photo_bg = getOption($merchant_id, 'merchant_photo_bg');
if (!file_exists(FunctionsV3::uploadPath() . "/$merchant_photo_bg")) {
    $merchant_photo_bg = '';
}

/* Render top menu */
$this->renderPartial('/layouts/quickfood/front_top_menu', array(
    'action' => Yii::app()->controller->action->id,
    'theme_hide_logo' => getOptionA('theme_hide_logo')
));

/* RENDER MENU HEADER FILE */
$ratings = Yii::app()->functions->getRatings($merchant_id);
$merchant_info = array(
    'merchant_id' => $merchant_id,
    'minimum_order' => $data['minimum_order'],
    'ratings' => $ratings,
    'merchant_address' => $data['merchant_address'],
    'cuisine' => $data['cuisine'],
    'restaurant_name' => $data['restaurant_name'],
    'background' => $merchant_photo_bg,
    'merchant_website' => $merchant_website,
    'merchant_logo' => FunctionsV3::getMerchantLogo($merchant_id),
    'contact_phone' => $data['contact_phone'],
    'restaurant_phone' => $data['restaurant_phone'],
    'step' => 3,
    'show_bar' => true
);
$this->renderPartial('/front/quickfood/menu-header', $merchant_info);

/* ADD MERCHANT INFO AS JSON */
$cs = Yii::app()->getClientScript();
$cs->registerScript(
        'merchant_information', "var merchant_information =" . json_encode($merchant_info) . "", CClientScript::POS_HEAD
);

/* PROGRESS ORDER BAR
  $this->renderPartial('/front/order-progress-bar',array(
  'step'=>3,
  'show_bar'=>true
  )); */

$now = date('Y-m-d');
$now_time = date('H:i');//'';

$checkout = FunctionsV3::isMerchantcanCheckout($merchant_id);
$menu = Yii::app()->functions->getMerchantMenu($merchant_id);

echo CHtml::hiddenField('is_merchant_open', isset($checkout['code']) ? $checkout['code'] : '' );

/* hidden TEXT */
echo CHtml::hiddenField('restaurant_slug', $data['restaurant_slug']);
echo CHtml::hiddenField('merchant_id', $merchant_id);
echo CHtml::hiddenField('is_client_login', Yii::app()->functions->isClientLogin());

echo CHtml::hiddenField('website_disbaled_auto_cart', Yii::app()->functions->getOptionAdmin('website_disbaled_auto_cart'));

$hide_foodprice = Yii::app()->functions->getOptionAdmin('website_hide_foodprice');
echo CHtml::hiddenField('hide_foodprice', $hide_foodprice);

echo CHtml::hiddenField('accept_booking_sameday', getOption($merchant_id
                , 'accept_booking_sameday'));

echo CHtml::hiddenField('customer_ask_address', getOptionA('customer_ask_address'));

echo CHtml::hiddenField('merchant_required_delivery_time', Yii::app()->functions->getOption("merchant_required_delivery_time", $merchant_id));

/** add minimum order for pickup status */
$merchant_minimum_order_pickup = Yii::app()->functions->getOption('merchant_minimum_order_pickup', $merchant_id);
if (!empty($merchant_minimum_order_pickup)) {
    echo CHtml::hiddenField('merchant_minimum_order_pickup', $merchant_minimum_order_pickup);

    echo CHtml::hiddenField('merchant_minimum_order_pickup_pretty', displayPrice(baseCurrency(), prettyFormat($merchant_minimum_order_pickup)));
}

$merchant_maximum_order_pickup = Yii::app()->functions->getOption('merchant_maximum_order_pickup', $merchant_id);
if (!empty($merchant_maximum_order_pickup)) {
    echo CHtml::hiddenField('merchant_maximum_order_pickup', $merchant_maximum_order_pickup);

    echo CHtml::hiddenField('merchant_maximum_order_pickup_pretty', displayPrice(baseCurrency(), prettyFormat($merchant_maximum_order_pickup)));
}

/* add minimum and max for delivery */
$minimum_order = Yii::app()->functions->getOption('merchant_minimum_order', $merchant_id);
if (!empty($minimum_order)) {
    echo CHtml::hiddenField('minimum_order', unPrettyPrice($minimum_order));
    echo CHtml::hiddenField('minimum_order_pretty', displayPrice(baseCurrency(), prettyFormat($minimum_order))
    );
}
$merchant_maximum_order = Yii::app()->functions->getOption("merchant_maximum_order", $merchant_id);
if (is_numeric($merchant_maximum_order)) {
    echo CHtml::hiddenField('merchant_maximum_order', unPrettyPrice($merchant_maximum_order));
    echo CHtml::hiddenField('merchant_maximum_order_pretty', baseCurrency() . prettyFormat($merchant_maximum_order));
}

$is_ok_delivered = 1;
if (is_numeric($merchant_delivery_distance)) {
    if ($distance > $merchant_delivery_distance) {
        $is_ok_delivered = 2;
        /* check if distance type is feet and meters */
        if ($distance_type == "ft" || $distance_type == "mm" || $distance_type == "mt") {
            $is_ok_delivered = 1;
        }
    }
}

echo CHtml::hiddenField('is_ok_delivered', $is_ok_delivered);
echo CHtml::hiddenField('merchant_delivery_miles', $merchant_delivery_distance);
echo CHtml::hiddenField('unit_distance', $distance_type);
echo CHtml::hiddenField('from_address', FunctionsV3::getSessionAddress());

echo CHtml::hiddenField('merchant_close_store', getOption($merchant_id, 'merchant_close_store'));
/* $close_msg=getOption($merchant_id,'merchant_close_msg');
  if(empty($close_msg)){
  $close_msg=t("This restaurant is closed now. Please check the opening times.");
  } */
echo CHtml::hiddenField('merchant_close_msg', isset($checkout['msg']) ? $checkout['msg'] : t("Sorry merchant is closed."));

echo CHtml::hiddenField('disabled_website_ordering', getOptionA('disabled_website_ordering'));
echo CHtml::hiddenField('web_session_id', session_id());

echo CHtml::hiddenField('merchant_map_latitude', $data['latitude']);
echo CHtml::hiddenField('merchant_map_longtitude', $data['lontitude']);
echo CHtml::hiddenField('restaurant_name', $data['restaurant_name']);


/* add meta tag for image */
Yii::app()->clientScript->registerMetaTag(
        Yii::app()->getBaseUrl(true) . FunctionsV3::getMerchantLogo($merchant_id)
        , 'og:image');
/*if (isset($_SESSION['search_type'])){
    switch ($_SESSION['search_type']) {
        case "kr_search_foodname":			
            $search_key='foodname';
            $search_str= isset($_SESSION['kr_search_foodname'])?$_SESSION['kr_search_foodname']:'';
            break;

        case "kr_search_category":			
            $search_key='category';
            $search_str=isset($_SESSION['kr_search_category'])?$_SESSION['kr_search_category']:'';
            break;

        case "kr_search_restaurantname":
            $search_str=isset($_SESSION['kr_search_restaurantname'])?$_SESSION['kr_search_restaurantname']:'';
            $search_key='restaurant-name';
            break;	

        case "kr_search_streetname":
            $search_str=isset($_SESSION['kr_search_streetname'])?$_SESSION['kr_search_streetname']:'';
            $search_key='street-name';
            break;	

        case "kr_postcode":	
            $search_str=isset($_SESSION['kr_postcode'])?$_SESSION['kr_postcode']:'';
            $search_key='zipcode';
                break;	

        default:
            $search_str=isset($_SESSION['kr_search_address'])?$_SESSION['kr_search_address']:'';
            $search_key='s';
            break;
    }
} else {
    $search_key='s';
    $search_str='';
}*/
?>

<div id="position">
    <div class="container">
        <ul>
        </ul>
    </div>
</div>


<div class="container margin_60_35">
    <div id="order_menu">
        <div class="row">

            <div class="col-md-3">
                <p>
                    <a href="javascript:;" class="btn_map toggle_reviews view-merchant-map">
                        <?php echo t('See reviews'); ?>
                    </a>
                </p>

                <div class="box_style_1">
                        <?php
                            $this->renderPartial('/front/quickfood/menu-category', array(
                                'merchant_id' => $merchant_id,
                                'menu' => $menu
                            ));
                        ?>
                </div><!-- End box_style_1 -->

                <div class="box_style_2" id="help">
                    <i class="icon_lifesaver"></i>
                    <h4>Need <span>Help?</span></h4>
                    <a href="tel://<?php echo $data['restaurant_phone'];?>" class="phone"><?php echo $data['restaurant_phone'];?></a>

                    <?php
                        $this->renderPartial('/front/quickfood/merchant-hours',array(
                          'merchant_id'=>$merchant_id
                        )); ?>

                </div>
            </div><!-- End col-md-3 -->

            <div class="col-md-6">
                <div class="box_style_2" id="main_menu">
                    <h2 class="inner"><?php echo t("Menu")?></h2>
                    <?php 
                        $admin_activated_menu=getOptionA('admin_activated_menu');			 
                        $admin_menu_allowed_merchant=getOptionA('admin_menu_allowed_merchant');
                        if ($admin_menu_allowed_merchant==2){			 	 
                                $temp_activated_menu=getOption($merchant_id,'merchant_activated_menu');			 	 
                                if(!empty($temp_activated_menu)){
                                        $admin_activated_menu=$temp_activated_menu;
                                }
                        }			 
                        switch ($admin_activated_menu)
                        {
                               case 1:
                                       $this->renderPartial('/front/menu-merchant-2',array(
                                         'merchant_id'=>$merchant_id,
                                         'menu'=>$menu,
                                         'disabled_addcart'=>$disabled_addcart
                                       ));
                                       break;

                               case 2:
                                       $this->renderPartial('/front/menu-merchant-3',array(
                                         'merchant_id'=>$merchant_id,
                                         'menu'=>$menu,
                                         'disabled_addcart'=>$disabled_addcart
                                       ));
                                       break;

                               default:	
                                       $this->renderPartial('/front/quickfood/menu-merchant-1',array(
                                         'merchant_id'=>$merchant_id,
                                         'menu'=>$menu,
                                         'disabled_addcart'=>$disabled_addcart,
                                         'tc'=>$tc
                                       ));
                           break;
                        }			 
                    ?>
                </div><!-- End box_style_1 -->
            </div><!-- End col-md-6 -->

            <div class="col-md-3" id="sidebar">
                <div class="theiaStickySidebar">
                    <div id="cart_box" >
                        <h3><?php echo t("Your Order")?> <i class="icon_cart_alt pull-right"></i></h3>
                        <div class="item-order-wrap"></div>
                        <hr>

                        <div class="row" id="options_2">
                            <?php foreach(Yii::app()->functions->DeliveryOptions($merchant_id) as $delivery_option):?>
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
                                    <?php /*echo CHtml::radioButtonList('delivery_type',$now,
                                        (array)Yii::app()->functions->DeliveryOptions($merchant_id),
                                        array(
                                            'class'=>'icheck'
                                    ))*/?>
                                    <?php echo CHtml::radioButton('delivery_type',true,array(
                                        'class'=>'icheck',
                                        'id'=> strtolower($delivery_option),
                                        'value' => strtolower($delivery_option)
                                    ));?>
                                    <label for="<?php echo strtolower($delivery_option);?>"><?php echo $delivery_option;?></label>
                                </div>
                            <?php endforeach;?>
                            <?php echo CHtml::hiddenField('delivery_date',$now)?>
                            <?php echo CHtml::hiddenField('delivery_time',$now_time)?>
                        </div>
                        <hr>

                        <?php if ($data['service']==3):?>
                            <h4><?php echo t("Distance Information")?></h4>
                        <?php else :?>
                            <h4><?php echo t("Delivery Information")?></h4>
                        <?php endif;?>
                        <p class="delivery-fee-wrap">
                            <?php echo t("Delivery Est")?>: <?php echo FunctionsV3::getDeliveryEstimation($merchant_id)?></p>
                        </p>
                        <p class="delivery-fee-wrap">
                            <?php 
                                if (!empty($merchant_delivery_distance)){
                                        echo t("Delivery Distance Covered").": ".$merchant_delivery_distance." $distance_type_orig";
                                } else echo  t("Delivery Distance Covered").": ".t("not available");
                            ?>
                        </p>
                        <p class="delivery-fee-wrap">
                            <?php 
                                if ($delivery_fee){
                                     echo t("Delivery Fee").": ".FunctionsV3::prettyPrice($delivery_fee);
                                } else echo  t("Delivery Fee").": ".t("Free Delivery");
                            ?>
                        </p>
                        <a href="javascript:;" class="top10 green-color change-address block text-center">
                            [<?php echo t("Change Your Address here")?>]
                        </a>
                        <hr>

                        <?php if ( $checkout['code']==1):?>
                            <a href="javascript:;" class="btn_full medium checkout"><?php echo $checkout['button']?></a>
                        <?php else :?>
                            <?php if ( $checkout['holiday']==1):?>
                                <?php echo CHtml::hiddenField('is_holiday',$checkout['msg'],array('class'=>'is_holiday'));?>
                                <p class="text-danger"><?php echo $checkout['msg']?></p>
                            <?php else :?>
                                <p class="text-danger"><?php echo $checkout['msg']?></p>
                                <p class="small">
                                <?php echo Yii::app()->functions->translateDate(date('F d l')."@".timeFormat(date('c'),true));?></p>
                            <?php endif;?>
                        <?php endif;?>
                    </div><!-- End cart_box -->
                </div><!-- End theiaStickySidebar -->
            </div><!-- End col-md-3 -->

        </div><!-- End row -->
    </div>
<!-- End container -->
<!-- End Content =============================================== -->
    <div id="reviews">
        <div class="row">

            <div class="col-md-4">
                    <p>
                        <a onclick="javascript:;" class="btn_map toggle_reviews">
                            <?php echo t('Back to menu'); ?>
                        </a>
                    </p>
                    <div class="box_style_2">
                        <h4 class="nomargin_top">Opening time <i class="icon_clock_alt pull-right"></i></h4>
                        <?php
                        $this->renderPartial('/front/quickfood/merchant-hours',array(
                          'merchant_id'=>$merchant_id
                        )); ?>
                    </div>
                    <div class="box_style_2 hidden-xs" id="help">
                            <i class="icon_lifesaver"></i>
                            <h4>Need <span>Help?</span></h4>
                            <a href="tel://<?php echo $data['restaurant_phone'];?>" class="phone"><?php echo $data['restaurant_phone'];?></a>
                    </div>
            </div>

            <div class="col-md-8">
                <div class="box_style_2">
                        <h2 class="inner">Description</h2>
                        <!--MERCHANT MAP-->
                        <p>
                            <?php if ($theme_map_tab==""):?>	        	
                                <?php $this->renderPartial('/front/quickfood/merchant-map'); ?>
                            <?php endif;?>
                        </p>
                        <p>
                            <?php if ($photo_enabled):?>
                                <?php 
                                    $gallery=Yii::app()->functions->getOption("merchant_gallery",$merchant_id);
                                    $gallery=!empty($gallery)?json_decode($gallery):false;
                                    $this->renderPartial('/front/quickfood/merchant-photos',array(
                                      'merchant_id'=>$merchant_id,
                                      'gallery'=>$gallery
                                    )); 
                                ?>
                            <?php endif; ?>
                        </p>
                        <p>
                            <?php if ($theme_info_tab==""):?>
                                <h3>About us</h3>
                                <p>
                                    <?php echo getOption($merchant_id,'merchant_information')?>
                                </p>
                            <?php endif; ?>
                        </p>
                        <p>
                            <?php $this->renderPartial('/front/quickfood/merchant-review',array(
                                'merchant_id'=>$merchant_id,
                                'ratings'=>$ratings
                                )); ?> 
                        </p>
                </div><!-- End box_style_1 -->
            </div>
        </div><!-- End row -->
    </div>
    
</div><!-- End container -->
<!-- End Content =============================================== -->

<?php
//page-specific js and css files
$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();


//$cs->registerScriptFile("http://maps.googleapis.com/maps/api/js"
//        , CClientScript::POS_END);
$cs->registerScriptFile($baseUrl . "/assets/js/quickfood/map_single.js"
        , CClientScript::POS_END);
$cs->registerScriptFile($baseUrl . "/assets/js/quickfood/infobox.js"
        , CClientScript::POS_END);
$cs->registerScriptFile($baseUrl . "/assets/js/quickfood/jquery.sliderPro.js"
        , CClientScript::POS_END);

$cs->registerCssFile($baseUrl . '/assets/css/quickfood/skins/square/grey.css');
$cs->registerCssFile($baseUrl . '/assets/css/quickfood/slider-pro.min.css');

$cs->registerScript('slider-pro', "
        $( document ).ready(function( $ ) {
                
		$( '#Img_carousel' ).sliderPro({
			width: 960,
			height: 500,
			fade: true,
			arrows: true,
			buttons: false,
			fullScreen: false,
			smallSize: 500,
			startSlide: 0,
			mediumSize: 1000,
			largeSize: 3000,
			thumbnailArrows: true,
			autoplay: false
		});
                $('#reviews').hide();
	});"
        , CClientScript::POS_END);//The last line is for sliderPro to render the gallery at its normal size first before hiding it
?>
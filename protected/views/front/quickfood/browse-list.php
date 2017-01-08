<div class="infinite-container result-merchant">
    <?php if($tabs == 3): ?>
        <div class="row">
    <?php endif; ?>
    <?php foreach ($list['list'] as $val):?>
    <?php
    $merchant_id=$val['merchant_id'];
    $ratings=Yii::app()->functions->getRatings($merchant_id);   
    $merchant_delivery_distance=getOption($merchant_id,'merchant_delivery_miles');
    $distance_type='';

    /*fallback*/
    if ( empty($val['latitude'])){
            if ($lat_res=Yii::app()->functions->geodecodeAddress($val['merchant_address'])){        
                    $val['latitude']=$lat_res['lat'];
                    $val['lontitude']=$lat_res['long'];
            } 
    }
    ?>
        <?php if($tabs == 3): ?>
            <div class="col-md-6 col-sm-6 wow zoomIn infinite-item" data-wow-delay="0.<?php echo $pos++; ?>s">
                <a class="strip_list grid" href="<?php echo Yii::app()->createUrl("/menu-". trim($val['restaurant_slug']))?>">
                    <?php if ( $val['is_sponsored']==2):?>
                    <div class="ribbon_1">Popular</div>
                    <?php endif;?>
                    <div class="desc">
                        <div class="thumb_strip">
                            <img src="<?php echo FunctionsV3::getMerchantLogo($merchant_id);?>" alt="">
                        </div>
                        <div class="rating">
                            <?php for($i = 0; $i < $ratings['ratings']; $i++){
                                echo '<i class="icon_star voted"></i>';
                            } ?>
                            <?php for($i = 0; $i < 5-$ratings['ratings']; $i++){
                                echo '<i class="icon_star"></i>';
                            } ?>
                            (<small><?php echo $ratings['votes']." ".t("Reviews")?></small>)
                        </div>
                        <h3><?php echo clearString($val['restaurant_name'])?></h3>
                        <div class="type">
                            <?php echo FunctionsV3::displayCuisine($val['cuisine']);?>
                        </div>
                        <div class="location">
                            <?php echo $val['merchant_address']?> <br />
                            <?php echo FunctionsV3::merchantOpenTag($merchant_id)?>  
                            <?php echo t("Minimum Order").": ".FunctionsV3::prettyPrice($val['minimum_order'])?>
                        </div>
                        <ul>
                            <li>Take away<i class=" 
                                <?php echo (strpos(FunctionsV3::displayServicesList($val['service']), 'Pickup') !== false)?'icon_check_alt2 ok':'icon_close_alt2 no'?>"></i></li>
                            <li>Delivery<i class="icon_check_alt2 
                                <?php echo (strpos(FunctionsV3::displayServicesList($val['service']), 'Delivery') !== false)?'icon_check_alt2 ok':'icon_close_alt2 no'?>"></i></li>
                        </ul>
                    </div>
                </a><!-- End strip_list-->
            </div><!-- End col-md-6-->
        <?php else: ?>
            <div class="strip_list wow fadeIn infinite-item" data-wow-delay="0.2s">
                <?php if ( $val['is_sponsored']==2):?>
                    <div class="ribbon_1">
                        Popular
                    </div>
                <?php endif;?>

                <?php if ($offer=FunctionsV3::getOffersByMerchant($merchant_id)):?>
                   <div class="ribbon-offer"><span><?php echo $offer;?></span></div>
                <?php endif;?>

                <div class="row">
                    <div class="col-md-9 col-sm-9">
                        <div class="desc">
                            <div class="thumb_strip">
                                <a href="<?php echo Yii::app()->createUrl("/menu-". trim($val['restaurant_slug']))?>">
                                    <img src="<?php echo FunctionsV3::getMerchantLogo($merchant_id);?>">
                                </a>
                            </div>
                            <div class="rating">
                                <?php for($i = 0; $i < $ratings['ratings']; $i++){
                                    echo '<i class="icon_star voted"></i>';
                                } ?>
                                <?php for($i = 0; $i < 5-$ratings['ratings']; $i++){
                                    echo '<i class="icon_star"></i>';
                                } ?>
                                (<small><?php echo $ratings['votes']." ".t("Reviews")?></small>)
                            </div>
                            <h3><?php echo clearString($val['restaurant_name'])?></h3>
                            <div class="type">
                                <?php echo FunctionsV3::displayCuisine($val['cuisine']);?>
                            </div>
                            <div class="location">
                                <?php echo $val['merchant_address']?> <br />
                                <?php echo FunctionsV3::merchantOpenTag($merchant_id)?>  
                                <?php echo t("Minimum Order").": ".FunctionsV3::prettyPrice($val['minimum_order'])?>
                            </div>
                            <ul>
                                <li>Delivery<i class="icon_check_alt2 
                                    <?php echo (strpos(FunctionsV3::displayServicesList($val['service']), 'Delivery') !== false)?'icon_check_alt2 ok':'icon_close_alt2 no'?>"></i></li>
                                <li>Pickup<i class=" 
                                    <?php echo (strpos(FunctionsV3::displayServicesList($val['service']), 'Pickup') !== false)?'icon_check_alt2 ok':'icon_close_alt2 no'?>"></i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <div class="go_to">
                            <div>
                                <a href="<?php echo Yii::app()->createUrl("/menu-". trim($val['restaurant_slug']))?>" 
                                    class="btn_1">
                                    <?php echo t("View menu")?>
                                </a>
                                <?php if($tabs == 1):?>
                                <a onclick="onHtmlClick('<?php echo $val['merchant_id'] ?>', 0)" class="btn_listing">View on Map</a>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                </div><!-- End row-->
            </div><!-- End strip_list-->
            
        <?php endif;?>
    <?php endforeach;?>
    <?php if($tabs == 3): ?>
        </div>
    <?php endif; ?>
</div>

<div class="search-result-loader" style="display: none;">
    <i></i>
    <div class="load_more_bt wow fadeIn" data-wow-delay="0.2s"><?php echo t("Loading more restaurant...")?></div>
</div> <!--search-result-loader-->
 
 

<?php             
if (isset($cuisine_page)){
	//$page_link=Yii::app()->createUrl('store/cuisine/'.$category.'/?');
	$page_link=Yii::app()->createUrl('store/cuisine/?category='.urlencode($_GET['category']));
} else $page_link=Yii::app()->createUrl('store/browse/?tabs='.$tabs);

 //echo CHtml::hiddenField('current_page_url',$page_link);
 require_once('pagination.class.php'); 
 $attributes                 =   array();
 $attributes['wrapper']      =   array('id'=>'pagination','class'=>'pagination');			 
 $options                    =   array();
 $options['attributes']      =   $attributes;
 $options['items_per_page']  =   FunctionsV3::getPerPage();
 $options['maxpages']        =   1;
 $options['jumpers']=false;
 $options['link_url']=$page_link.'&page=##ID##';			
 $pagination =   new pagination( $list['total'] ,((isset($_GET['page'])) ? $_GET['page']:1),$options);		
 $data   =   $pagination->render();
 ?>

 <?php //build map objects
    $markersPhp = array();
    $pin_nr = 0;
    foreach ($list['list'] as $val) {
        $restObj = array();
        $restObj['name'] = $val['restaurant_name'];
        $restObj['location_latitude'] = $val['latitude'];
        $restObj['location_longitude'] = $val['lontitude'];
        $restObj['map_image_url'] = FunctionsV3::getMerchantLogo($val['merchant_id']);
        $restObj['name_point'] = $val['restaurant_name'];
        $restObj['type_point'] = FunctionsV3::displayCuisine($val['cuisine']);
        $restObj['description_point'] = $val['merchant_address'];
        $restObj['open_status'] = FunctionsV3::merchantOpenTag($val['merchant_id']);
        $restObj['url_point'] = Yii::app()->createUrl("/menu-". trim($val['restaurant_slug']));
        $restObj['pin_nr'] = (++$pin_nr)%7;
        
        $restObjCont = array();
        $restObjCont[0] = $restObj;
        
        $markersPhp[$val['merchant_id']] = $restObjCont;
    }
    $cs = Yii::app()->getClientScript();
    $cs->registerScript(
            'MarkersData'
            ,'MarkersData = '.CJSON::encode($markersPhp).';'
            ,CClientScript::POS_BEGIN);
 
 ?>
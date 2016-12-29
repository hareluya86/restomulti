<?php
    $this->renderPartial('/front/quickfood/default-header', array(
        'h1' => $h1,
        'sub_text' => $sub_text
    ));
?>

<!--<div id="position">
    <div class="container">
        <ul>
            <li><a href="#0">Home</a></li>
            <li><a href="#0">Category</a></li>
            <li>Page active</li>
        </ul>
    </div>
</div> Position -->

<div class="collapse" id="collapseMap">
    <div id="map" class="map"></div>
</div><!-- End Map -->

<div class="white_bg">
<!-- Content ================================================== -->
<div class="container margin_60_35">
    <div class="row">
<?php if(false):?>
        <div class="col-md-3">
            <p>
                <a class="btn_map" data-toggle="collapse" href="#collapseMap" aria-expanded="false" aria-controls="collapseMap">View on map</a>
            </p>
            <div id="filters_col">
                <a data-toggle="collapse" href="#collapseFilters" aria-expanded="false" aria-controls="collapseFilters" id="filters_col_bt">Filters <i class="icon-plus-1 pull-right"></i></a>
                <div class="collapse" id="collapseFilters">
                    <!--FILTER MERCHANT NAME-->       

                    <div class="filter_type">
                        
                    </div> <!--filter-box-->
                    <!--END FILTER MERCHANT NAME-->
                    <div class="filter_type">
                        <h6>Rating</h6>
                        <ul>
                            <li><label><input type="checkbox" class="icheck"><span class="rating">
                                        <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i>
                                    </span></label></li>
                            <li><label><input type="checkbox" class="icheck"><span class="rating">
                                        <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i>
                                    </span></label></li>
                            <li><label><input type="checkbox" class="icheck"><span class="rating">
                                        <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i><i class="icon_star"></i>
                                    </span></label></li>
                            <li><label><input type="checkbox" class="icheck"><span class="rating">
                                        <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i>
                                    </span></label></li>
                            <li><label><input type="checkbox" class="icheck"><span class="rating">
                                        <i class="icon_star voted"></i><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i>
                                    </span></label></li>
                        </ul>
                    </div>
                    <div class="filter_type">
                        <h6>Options</h6>
                        <ul class="nomargin">
                            <li><label><input type="checkbox" class="icheck">Delivery</label></li>
                            <li><label><input type="checkbox" class="icheck">Take Away</label></li>
                            <li><label><input type="checkbox" class="icheck">Distance 10Km</label></li>
                            <li><label><input type="checkbox" class="icheck">Distance 5Km</label></li>
                        </ul>
                    </div>
                </div><!--End collapse -->
            </div><!--End filters col-->
        </div><!--End col-md -->
<?php endif; ?>
        <div class="col-md-12">

            <div id="tools">
                <div class="row">
                    <?php if(isset($filter)):?>
                        <div class="col-md-3 col-sm-3 col-xs-6">
                            <div class="styled-select">
                                <select name="filter" id="filter" >
                                    <option value="1" <?php echo ($filter==1 || $filter=='')?'selected':'';?>><?php echo t("Restaurant List");?></option>
                                    <option value="2" <?php echo ($filter==2)?'selected':'';?>><?php echo t("Newest");?></option>
                                    <option value="3" <?php echo ($filter==3)?'selected':'';?>><?php echo t("Featured");?></option>
                                </select>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="col-md-<?php echo (isset($filter))?'9':'12'?> 
                                col-sm-<?php echo (isset($filter))?'6':'12'?>  
                                col-xs-<?php echo (isset($filter))?'6':'12'?> ">
                        <a href="<?php echo Yii::app()->createUrl($current_page_url.'?tabs=2'
                                .((isset($filter))?'&filter='.$filter:'')
                                .((isset($category))?'&category='.$category:'')) ?>" class="bt_filters"><i class="icon-list"></i></a>
                    </div>
                </div>
            </div><!--End tools -->
            <div class="row">
            <?php $pos = 1;//For counting the position of each listing?>
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
                <div class="col-md-6 col-sm-6 wow zoomIn" data-wow-delay="0.<?php echo $pos++; ?>s">
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
            <?php endforeach ?>
            </div>            
            <a href="#0" class="load_more_bt wow fadeIn" data-wow-delay="0.2s">Load more...</a>           
        </div><!-- End col-md-9-->

    </div><!-- End row -->
</div><!-- End container -->
<!-- End Content =============================================== -->
</div>
<?php
//page-specific js and css files
$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();

$cs->registerScriptFile("/assets/js/quickfood/cat_nav_mobile.js"
        , CClientScript::POS_END);
$cs->registerScript('$(\'#cat_nav\').mobileMenu();'
        , CClientScript::POS_END);

//$cs->registerScriptFile("http://maps.googleapis.com/maps/api/js"
//        , CClientScript::POS_END);
$cs->registerScriptFile($baseUrl . "/assets/js/quickfood/map.js"
        , CClientScript::POS_END);
$cs->registerScriptFile($baseUrl . "/assets/js/quickfood/infobox.js"
        , CClientScript::POS_END);
$cs->registerScriptFile($baseUrl . "/assets/js/quickfood/ion.rangeSlider.js"
        , CClientScript::POS_END);

$cs->registerCssFile($baseUrl . '/assets/css/quickfood/skins/square/grey.css');
$cs->registerCssFile($baseUrl . '/assets/css/quickfood/ion.rangeSlider.css');
$cs->registerCssFile($baseUrl . '/assets/css/quickfood/ion.rangeSlider.skinFlat.css');

$cs->registerScript('ion.rangeSlider', '$(function () {
                     \'use strict\';
            $("#range").ionRangeSlider({
                hide_min_max: true,
                keyboard: true,
                min: 0,
                max: 15,
                from: 0,
                to:5,
                type: \'double\',
                step: 1,
                prefix: "Km ",
                grid: true
            });
        });'
        , CClientScript::POS_END);
?>
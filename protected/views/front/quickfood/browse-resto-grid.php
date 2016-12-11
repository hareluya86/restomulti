<!-- SubHeader =============================================== -->
<section class="parallax-window" id="short" data-parallax="scroll" data-image-src="/assets/images/quickfood/img/sub_header_short.jpg" data-natural-width="1400" data-natural-height="350">
    <div id="subheader">
        <div id="sub_content">
            <h1>24 results in your zone</h1>
            <div><i class="icon_pin"></i> 135 Newtownards Road, Belfast, BT4 1AB</div>
        </div><!-- End sub_content -->
    </div><!-- End subheader -->
</section><!-- End section -->
<!-- End SubHeader ============================================ -->

<div id="position">
    <div class="container">
        <ul>
            <li><a href="#0">Home</a></li>
            <li><a href="#0">Category</a></li>
            <li>Page active</li>
        </ul>
    </div>
</div><!-- Position -->

<div class="collapse" id="collapseMap">
    <div id="map" class="map"></div>
</div><!-- End Map -->

<!-- Content ================================================== -->
<div class="container margin_60_35">
    <div class="row">

        <div class="col-md-3">
            <p>
                <a class="btn_map" data-toggle="collapse" href="#collapseMap" aria-expanded="false" aria-controls="collapseMap">View on map</a>
            </p>
            <div id="filters_col">
                <a data-toggle="collapse" href="#collapseFilters" aria-expanded="false" aria-controls="collapseFilters" id="filters_col_bt">Filters <i class="icon-plus-1 pull-right"></i></a>
                <div class="collapse" id="collapseFilters">
                    <div class="filter_type">
                        <h6>Distance</h6>
                        <input type="text" id="range" value="" name="range">
                        <h6>Type</h6>
                        <ul>
                            <li><label><input type="checkbox" checked class="icheck">All <small>(49)</small></label></li> 
                            <?php $cuisines = Yii::app()->functions->Cuisine(true); ?>
                            <?php if (is_array($cuisines) && count($cuisines)>=1): ?>
                                <?php foreach($cuisines as $cuisine): ?>
                                    <li><label><input type="checkbox" class="icheck"><?php echo $cuisine; ?> <small>(49)</small></label></li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
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

        <div class="col-md-9">

            <div id="tools">
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-6">
                        <div class="styled-select">
                            <select name="sort_rating" id="sort_rating">
                                <option value="" selected>Sort by ranking</option>
                                <option value="lower">Lowest ranking</option>
                                <option value="higher">Highest ranking</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-9 col-sm-6 hidden-xs">
                        <a href="<?php echo Yii::app()->createUrl('/store/browse?tab=2') ?>" class="bt_filters"><i class="icon-list"></i></a>
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
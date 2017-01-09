<?php
$search_address = isset($_GET['s']) ? $_GET['s'] : '';
if (isset($_GET['st'])) {
    $search_address = $_GET['st'];
}
//$this->renderPartial('/front/search-header',array(
//   'search_address'=>$search_address,
//   'total'=>$data['total']
//));
?>

<!--TOP MENU-->
<?php
$this->renderPartial('/layouts/quickfood/front_top_menu', array(
    'action' => Yii::app()->controller->action->id,
    'theme_hide_logo' => getOptionA('theme_hide_logo')
));
?>

<?php
//$this->renderPartial('/front/order-progress-bar',array(
//   'step'=>2,
//   'show_bar'=>true
//));

$this->renderPartial('/front/quickfood/default-header', array(
    'h1' => $data['total'] . ' ' . t("results"),
    'sub_text' => $search_address,
    'step' => 2,
    'show_bar' => true
));

echo CHtml::hiddenField('clien_lat', $data['client']['lat']);
echo CHtml::hiddenField('clien_long', $data['client']['long']);

echo CHtml::hiddenField('sort_filter', $sort_filter);
echo CHtml::hiddenField('display_type', $display_type);
?>


<!--quickfood start-->
<div class="collapse" id="collapseMap">
    <div id="map" class="map"></div>
</div><!-- End Map -->

<!-- Content ================================================== -->
<div class="container margin_60_35">
    <div class="row">

        <div class="col-md-3">
            <p>
                <a class="btn_map" data-toggle="collapse" aria-expanded="false" aria-controls="collapseMap" href="#collapseMap" >
                    View on map
                </a>
            </p>
            <div id="filters_col">
                <a data-toggle="collapse" href="#collapseFilters" aria-expanded="false" aria-controls="collapseFilters" id="filters_col_bt">Filters <i class="icon-plus-1 pull-right"></i></a>
                <div class="collapse" id="collapseFilters">

                    <!--FILTER MERCHANT NAME-->       

                    <div class="filter_type">
                        <h6>
                            <?php echo t("Search by name") ?>
                            <?php if (!empty($restaurant_name)): ?>                      
                                <a href="<?php echo FunctionsV3::clearSearchParams('restaurant_name') ?>">[<?php echo t("Clear") ?>]</a>
<?php endif; ?>  
                        </h6>
                        <form method="POST" onsubmit="return research_merchant();">
                            <div class="search-input-wraps rounded30">
                                <div class="form-group">
                                    <?php
                                    echo CHtml::textField('restaurant_name', $restaurant_name, array(
                                        'required' => true,
                                        'placeholder' => t("enter restaurant name")
                                    ))
                                    ?>
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>         

                                </div>
                            </div>
                        </form>
                    </div> <!--filter-box-->
                    <!--END FILTER MERCHANT NAME-->   

                    <!--FILTER DELIVERY -->

                            <?php if ($services = Yii::app()->functions->Services()): ?>
                        <div class="filter_type">
                            <h6>
                                <?php echo t("By Delivery") ?>
    <?php if (!empty($filter_delivery_type)): ?>                      
                                    <a href="<?php echo FunctionsV3::clearSearchParams('filter_delivery_type') ?>">[<?php echo t("Clear") ?>]</a>
                                <?php endif; ?>
                            </h6>
                            <ul class="<?php echo $fc == 2 ? "hide" : '' ?>">
                                        <?php foreach ($services as $key => $val): ?>
                                    <li>	        
                                        <label>
                                            <?php
                                            echo CHtml::radioButton('filter_delivery_type', $filter_delivery_type == $key ? true : false
                                                    , array(
                                                'value' => $key,
                                                'class' => "filter_by filter_delivery_type icheck"
                                            ));
                                            ?>
                                    <?php echo $val; ?>   
                                        </label>
                                    </li>
                        <?php endforeach; ?> 
                            </ul>
                        </div> <!--filter-box-->
<?php endif; ?>
                    <!--END FILTER DELIVERY -->

                    <!--FILTER CUISINE-->
                            <?php if ($cuisines = Yii::app()->functions->Cuisine(false)): ?>
                        <div class="filter_type">
                            <h6>
                                <?php echo t("By Cuisines") ?>
                                <?php if (!empty($filter_cuisine)): ?>                      
                                    <a href="<?php echo FunctionsV3::clearSearchParams('filter_cuisine') ?>">[<?php echo t("Clear") ?>]</a>
                                <?php endif; ?>
                            </h6>
                            <ul class="<?php echo $fc == 2 ? "hide" : '' ?>">
                                        <?php foreach ($cuisines as $cuisine): ?>
                                    <li>
                                        <label>
                                            <?php
                                            $cuisine_json['cuisine_name_trans'] = !empty($cuisine['cuisine_name_trans']) ?
                                                    json_decode($cuisine['cuisine_name_trans'], true) : '';

                                            echo CHtml::checkBox('filter_cuisine[]', in_array($cuisine['cuisine_id'], (array) $filter_cuisine) ? true : false
                                                    , array(
                                                'value' => $cuisine['cuisine_id'],
                                                'class' => "filter_by icheck filter_cuisine"
                                                    )
                                            );
                                            ?>
                                        </label>
                                    <?php echo qTranslate($cuisine['cuisine_name'], 'cuisine_name', $cuisine_json) ?>
                                    </li>
    <?php endforeach; ?> 
                            </ul>
                        </div> <!--filter-box-->
<?php endif; ?>
                    <!--END FILTER CUISINE-->



<?php if (false): ?>
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
                    <?php endif; ?>
<?php if (false): ?>
                        <div class="filter_type">
                            <h6>Options</h6>
                            <ul class="nomargin">
                                <li><label><input type="checkbox" class="icheck">Delivery</label></li>
                                <li><label><input type="checkbox" class="icheck">Take Away</label></li>
                                <li><label><input type="checkbox" class="icheck">Distance 10Km</label></li>
                                <li><label><input type="checkbox" class="icheck">Distance 5Km</label></li>
                            </ul>
                        </div>
<?php endif; ?>
                </div><!--End collapse -->
            </div><!--End filters col-->
        </div><!--End col-md -->

        <div class="col-md-9">

            <!--MERCHANT LIST -->
            <?php
            if ($display_type == "listview") {
                $this->renderPartial('/front/quickfood/search-list-list', array(
                    'data' => $data,
                    'current_page_url' => $current_page_url,
                    'current_page_link' => $current_page_link
                        //'val'=>$val,
                        //'merchant_id'=>$merchant_id,
                        //'ratings'=>$ratings,
                        //'distance_type'=>$distance_type,
                        //'distance_type_orig'=>$distance_type_orig,
                        //'distance'=>$distance,
                        //'merchant_delivery_distance'=>$merchant_delivery_distance,
                        //'delivery_fee'=>$delivery_fee
                ));
            } else { //This is the default!!!
                $this->renderPartial('/front/quickfood/search-list-grid', array(
                    'data' => $data,
                    'current_page_url' => $current_page_url,
                    'current_page_link' => $current_page_link
                        //'val'=>$val,
                        //'merchant_id'=>$merchant_id,
                        ///'ratings'=>$ratings,
                        //'distance_type'=>$distance_type,
                        //'distance_type_orig'=>$distance_type_orig,
                        //'distance'=>$distance,
                        //'merchant_delivery_distance'=>$merchant_delivery_distance,
                        //'delivery_fee'=>$delivery_fee
                ));
            }
            ?>               

        </div><!-- End col-md-9-->

    </div><!-- End row -->
</div><!-- End container -->
<!-- End Content =============================================== -->

<!--quickfood end-->


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

<?php
//build map objects
$markersPhp = array();
$pin_nr = 0;
foreach ($data['list'] as $val) {
    $restObj = array();
    $restObj['name'] = $val['restaurant_name'];
    $restObj['location_latitude'] = $val['latitude'];
    $restObj['location_longitude'] = $val['lontitude'];
    $restObj['map_image_url'] = FunctionsV3::getMerchantLogo($val['merchant_id']);
    $restObj['name_point'] = $val['restaurant_name'];
    $restObj['type_point'] = FunctionsV3::displayCuisine($val['cuisine']);
    $restObj['description_point'] = $val['merchant_address'];
    $restObj['open_status'] = FunctionsV3::merchantOpenTag($val['merchant_id']);
    $restObj['url_point'] = Yii::app()->createUrl("/menu-" . trim($val['restaurant_slug']));
    $restObj['pin_nr'] = ( ++$pin_nr) % 7;

    $restObjCont = array();
    $restObjCont[0] = $restObj;

    $markersPhp[$val['merchant_id']] = $restObjCont;
}
$cs = Yii::app()->getClientScript();
$cs->registerScript(
        'MarkersData'
        , 'MarkersData = ' . CJSON::encode($markersPhp) . ';'
        , CClientScript::POS_BEGIN);
?>
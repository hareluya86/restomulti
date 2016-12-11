<div class="container-fluid full-height">
    <div class="row row-height">
        <div class="col-lg-7 col-md-6 content-left">
            <div id="filters_map">
                <a data-toggle="collapse" href="#collapseFiltesmap" aria-expanded="false" aria-controls="collapseFiltesmap" class="btn_filter" id="open_filters"></a>
                <div class="pull-right">
                    <a href="<?php echo Yii::app()->createUrl('/store/browse?tab=3') ?>" class="btn_filter" id="grid"></a>
                    <a href="<?php echo Yii::app()->createUrl('/store/browse?tab=2') ?>" class="btn_filter" id="list"></a>
                </div>
                <div id="collapseFiltesmap" class="collapse">
                    <!--<div class="filter_type clearfix">
                        <h6>Distance</h6>
                        <div class="range_wp">
                            <input type="text" id="range" name="range" value="">
                        </div>
                    </div>-->
                   <div class="filter_type clearfix">
                        <h6>Cuisine</h6>
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
                    <div class="filter_type clearfix">
                        <h6>Filter</h6>
                        <ul>
                            <li><label><input type="checkbox" checked class="icheck">Newest <small>(49)</small></label></li>
                            <li><label><input type="checkbox" class="icheck">Featured <small>(12)</small></label>
                            
                        </ul>
                    </div>
                    <div class="filter_type clearfix">
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
                </div>
            </div>
            <?php
                if (is_array($list['list']) && count($list['list']) >= 1) {
                    $this->renderPartial('/front/quickfood/browse-list', array(
                        'list' => $list,
                        'tabs' => $tabs
                    ));
                } else
                    echo '<p class="text-danger">' . t("No restaurant found") . '</p>';
            ?>
            <a href="#0" class="load_more_bt_2">Load more...</a>  
        </div>
        <!-- End content-left-->

        <div class=" col-lg-5 col-md-6 map-right">
            <div id="map_listing"></div>
            <!-- map-->
        </div>
    </div>
    <!-- End row-->
</div>
<!-- End container-fluid -->

<?php
//page-specific js and css files
$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();
//$cs->registerScriptFile("http://maps.googleapis.com/maps/api/js"
//        , CClientScript::POS_END);
$cs->registerScriptFile($baseUrl . "/assets/js/quickfood/map_listing.js"
        , CClientScript::POS_END);
$cs->registerScriptFile($baseUrl . "/assets/js/quickfood/infobox.js"
        , CClientScript::POS_END);
$cs->registerScriptFile($baseUrl . "/assets/js/quickfood/ion.rangeSlider.js"
        , CClientScript::POS_END);

$cs->registerCssFile($baseUrl . '/assets/css/quickfood/skins/square/grey.css');
$cs->registerCssFile($baseUrl . '/assets/css/quickfood/ion.rangeSlider.css');
$cs->registerCssFile($baseUrl . '/assets/css/quickfood/ion.rangeSlider.skinFlat.css');

$cs->registerCss('googleMap','html,
        body {
            height: 100%;
        }');

$cs->registerScript('ion.rangeSlider',
        '$(function () {
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
        ,CClientScript::POS_END);

$cs->registerScript('setMenu', 
        '$(document).ready(function(){$(\'#header\').addClass(\'alwaysShow\');});'
        , CClientScript::POS_END);
?>


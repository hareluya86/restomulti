<?php
    $this->renderPartial('/front/quickfood/default-header', array(
        'h1' => $h1,
        'sub_text' => $sub_text
    ));
?>

<div class="collapse" id="collapseMap">
    <div id="map" class="map"></div>
</div><!-- End Map -->

<div class="white_bg">
<!-- Content ================================================== -->
<div class="container margin_60_35">
    <div class="row">

        <div class="col-md-12">

            <div id="tools" class="hidden-xs">
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
                    <div class="hidden-xs
                                col-md-<?php echo (isset($filter))?'9':'12'?> 
                                col-sm-<?php echo (isset($filter))?'6':'12'?>  
                                col-xs-<?php echo (isset($filter))?'6':'12'?> ">
                        <a href="<?php echo Yii::app()->createUrl($current_page_url.'?tabs=3'
                                .((isset($filter))?'&filter='.$filter:'')
                                .((isset($category))?'&category='.$category:'')) ?>" class="bt_filters"><i class="icon-th"></i></a>
                    </div>
                </div>
            </div><!--End tools -->
            <?php
            if (is_array($list['list']) && count($list['list']) >= 1) {
                $this->renderPartial('/front/quickfood/browse-list', array(
                    'list' => $list,
                    'tabs' => $tabs
                ));
            } else
                echo '<p class="text-danger">' . t("No restaurant found") . '</p>';
            ?>
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
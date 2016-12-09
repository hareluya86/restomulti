<?php
if (false) {
    $this->renderPartial('/front/default-header', array(
        'h1' => t("Browse Restaurant"),
        'sub_text' => t("choose from your favorite restaurant")
    ));
}
?>

<!--TOP MENU-->
<?php
$this->renderPartial('/layouts/quickfood/front_top_menu', array(
    'action' => Yii::app()->controller->action->id,
    'theme_hide_logo' => getOptionA('theme_hide_logo')
));
?>


<div class="container-fluid full-height">
    <div class="row row-height">
        <div class="col-lg-7 col-md-6 content-left">
            <div id="filters_map">
                <a data-toggle="collapse" href="#collapseFiltesmap" aria-expanded="false" aria-controls="collapseFiltesmap" class="btn_filter" id="open_filters"></a>
                <div class="pull-right">
                    <a href="grid_list.html" class="btn_filter" id="grid"></a>
                    <a href="list_page.html" class="btn_filter" id="list"></a>
                </div>
                <div id="collapseFiltesmap" class="collapse">
                    <div class="filter_type clearfix">
                        <h6>Distance</h6>
                        <div class="range_wp">
                            <input type="text" id="range" name="range" value="">
                        </div>
                    </div>
                    <div class="filter_type clearfix">
                        <h6>Type</h6>
                        <ul>
                            <li><label><input type="checkbox" checked class="icheck">All <small>(49)</small></label></li>
                            <li><label><input type="checkbox" class="icheck">American <small>(12)</small></label><i class="color_1"></i></li>
                            <li><label><input type="checkbox" class="icheck">Chinese <small>(5)</small></label><i class="color_2"></i></li>
                            <li><label><input type="checkbox" class="icheck">Hamburger <small>(7)</small></label><i class="color_3"></i></li>
                            <li><label><input type="checkbox" class="icheck">Fish <small>(1)</small></label><i class="color_4"></i></li>
                            <li><label><input type="checkbox" class="icheck">Mexican <small>(49)</small></label><i class="color_5"></i></li>
                            <li><label><input type="checkbox" class="icheck">Pizza <small>(22)</small></label><i class="color_6"></i></li>
                            <li><label><input type="checkbox" class="icheck">Sushi <small>(43)</small></label><i class="color_7"></i></li>
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
            if ($tabs == 1):
                if (is_array($list['list']) && count($list['list']) >= 1) {
                    $this->renderPartial('/front/quickfood/browse-list', array(
                        'list' => $list,
                        'tabs' => $tabs
                    ));
                } else
                    echo '<p class="text-danger">' . t("No restaurant found") . '</p>';
            endif;
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
<div class="container">

    <div class="tabs-wrapper">
        <ul id="tabs">
            <li class="<?php echo $tabs == 1 ? "active" : '' ?> noclick"  >
                <a href="<?php echo Yii::app()->createUrl('/store/browse') ?>">
                    <i class="ion-coffee"></i>
                    <span><?php echo t("Restaurant List") ?></span>
                </a>
            </li>
            <li class="<?php echo $tabs == 2 ? "active" : '' ?> noclick">
                <a href="<?php echo Yii::app()->createUrl('/store/browse/?tab=2') ?>">
                    <i class="ion-pizza"></i>
                    <span><?php echo t("Newest") ?></span>
                </a>
            </li>
            <li class="<?php echo $tabs == 3 ? "active" : '' ?> noclick" >
                <a href="<?php echo Yii::app()->createUrl('/store/browse/?tab=3') ?>">
                    <i class="ion-fork"></i>
                    <span><?php echo t("Featured") ?></span>
                </a>
            </li>
            <li class="full-maps nounderline">				  
                <a href="javascript:;" >
                    <i class="ion-android-globe"></i>    
                    <span><?php echo t("View Restaurant by map") ?></span>	    
            </li>
            </a>
        </ul>		    

        <ul id="tab">
            <li class="<?php echo $tabs == 1 ? "active" : '' ?>" >            
                <?php
                if ($tabs == 1):
                    if (is_array($list['list']) && count($list['list']) >= 1) {
                        $this->renderPartial('/front/browse-list', array(
                            'list' => $list,
                            'tabs' => $tabs
                        ));
                    } else
                        echo '<p class="text-danger">' . t("No restaurant found") . '</p>';
                endif;
                ?>
            </li>
            <li class="<?php echo $tabs == 2 ? "active" : '' ?>" >
                <?php
                if ($tabs == 2):
                    if (is_array($list['list']) && count($list['list']) >= 1) {
                        $this->renderPartial('/front/browse-list', array(
                            'list' => $list,
                            'tabs' => $tabs
                        ));
                    } else
                        echo '<p class="text-danger">' . t("No restaurant found") . '</p>';
                endif;
                ?>
            </li>
            <li class="<?php echo $tabs == 3 ? "active" : '' ?>" >

                <?php
                if ($tabs == 3):
                    if (is_array($list['list']) && count($list['list']) >= 1) {
                        $this->renderPartial('/front/browse-list', array(
                            'list' => $list,
                            'tabs' => $tabs
                        ));
                    } else
                        echo '<p class="text-danger">' . t("No restaurant found") . '</p>';
                endif;
                ?>

            </li>

            <li>
                <div class="full-map-wrapper" >
                    <div id="full-map"></div>
                    <a href="javascript:;" class="view-full-map green-button"><?php echo t("View in fullscreen") ?></a>
                </div> <!--full-map-->
            </li>          
        </ul>     

    </div> <!--tabs-wrapper-->

</div><!-- container-->


<?php
//page-specific js and css files
$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile("http://maps.googleapis.com/maps/api/js"
        , CClientScript::POS_END);
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
?>


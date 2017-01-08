<div id="tools">
    <div class="row">
        <div class="col-md-12 col-sm-12 hidden-xs">
            <a href="<?php echo FunctionsV3::clearSearchParams('display_type','display_type=listview')?>" class="bt_filters"><i class="icon-list"></i></a>
        </div>
    </div>
</div><!--End tools -->

<div class="row">
    <div class="infinite-container result-merchant">
        <?php if ($data && $data['total'] > 0): ?>
            <?php $pos = 1; //For counting the position of each listing?>
            <?php foreach ($data['list'] as $val): ?>
                <?php
                $merchant_id = $val['merchant_id'];
                $ratings = Yii::app()->functions->getRatings($merchant_id);
                $merchant_delivery_distance = getOption($merchant_id, 'merchant_delivery_miles');
                $distance_type = '';

                /* fallback */
                if (empty($val['latitude'])) {
                    if ($lat_res = Yii::app()->functions->geodecodeAddress($val['merchant_address'])) {
                        $val['latitude'] = $lat_res['lat'];
                        $val['lontitude'] = $lat_res['long'];
                    }
                }
                ?>
                <div class="col-md-6 col-sm-6 wow zoomIn infinite-item" data-wow-delay="0.<?php echo $pos++; ?>s">
                    <a class="strip_list grid" href="<?php echo Yii::app()->createUrl("/menu-" . trim($val['restaurant_slug'])) ?>">
                        <?php if ($val['is_sponsored'] == 2): ?>
                            <div class="ribbon_1">Popular</div>
                        <?php endif; ?>
                        <div class="desc">
                            <div class="thumb_strip">
                                <img src="<?php echo FunctionsV3::getMerchantLogo($merchant_id); ?>" alt="">
                            </div>
                            <div class="rating">
                                <?php
                                    for ($i = 0; $i < $ratings['ratings']; $i++) {
                                        echo '<i class="icon_star voted"></i>';
                                    }
                                ?>
                                <?php
                                    for ($i = 0; $i < 5 - $ratings['ratings']; $i++) {
                                        echo '<i class="icon_star"></i>';
                                    }
                                ?>
                                (<small><?php echo $ratings['votes'] . " " . t("Reviews") ?></small>)
                            </div>
                            <h3><?php echo clearString($val['restaurant_name']) ?></h3>
                            <div class="type">
                                <?php echo FunctionsV3::displayCuisine($val['cuisine']); ?>
                            </div>
                            <div class="location">
                                <?php echo $val['merchant_address'] ?> <br />
                                <?php echo FunctionsV3::merchantOpenTag($merchant_id) ?>  
                                <?php echo t("Minimum Order") . ": " . FunctionsV3::prettyPrice($val['minimum_order']) ?>
                            </div>
                            <ul>
                                <li><?php echo t('Delivery'); ?>
                                    <i class=" 
                                    <?php echo (strpos(FunctionsV3::displayServicesList($val['service']), t('Delivery')))?'icon_check_alt2 ok':'icon_close_alt2 no'?>"></i>
                                </li>
                                <li><?php echo t('Pickup'); ?>
                                    <i class=" 
                                    <?php echo (strpos(FunctionsV3::displayServicesList($val['service']), t('Pickup')))?'icon_check_alt2 ok':'icon_close_alt2 no'?>"></i>
                                </li>
                            </ul>
                        </div>
                    </a><!-- End strip_list-->
                </div><!-- End col-md-6-->
            <?php endforeach ?>
        <?php else : ?>     
            <p class="center top25 text-danger"><?php echo t("No results with your selected filters") ?></p>
        <?php endif; ?>
    </div>
</div>

<div class="search-result-loader" style="display: none;">
    <i></i>
    <div class="load_more_bt wow fadeIn" data-wow-delay="0.2s"><?php echo t("Loading more restaurant...")?></div>
</div> <!--search-result-loader-->

<?php
if (!isset($current_page_url)) {
    $current_page_url = '';
}
if (!isset($current_page_link)) {
    $current_page_link = '';
}
echo CHtml::hiddenField('current_page_url', $current_page_link);
echo CHtml::hiddenField('current_page_link', $current_page_link);
require_once('pagination.class.php');
$attributes = array();
$attributes['wrapper'] = array('id' => 'pagination', 'class' => 'pagination');
$options = array();
$options['attributes'] = $attributes;
$options['items_per_page'] = FunctionsV3::getPerPage();
$options['maxpages'] = 1;
$options['jumpers'] = false;
$options['link_url'] = $current_page_link . '&page=##ID##';
$pagination = new pagination($data['total'], ((isset($_GET['page'])) ? $_GET['page'] : 1), $options);
$data = $pagination->render();
?>
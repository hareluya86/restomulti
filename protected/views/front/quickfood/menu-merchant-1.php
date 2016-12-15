
<?php if (is_array($menu) && count($menu) >= 1): ?>
    <?php foreach ($menu as $val): ?>
        <h3 class="nomargin_top" id="<?php echo $val['category_id'] ?>">
            <?php echo qTranslate($val['category_name'], 'category_name', $val) ?>
        </h3>
        <?php if (!empty($val['category_description'])): ?>
            <p>
                <?php echo qTranslate($val['category_description'], 'category_description', $val) ?>
            </p>
        <?php endif; ?>
        <?php if (is_array($val['item']) && count($val['item']) >= 1): ?>
        <table class="table table-striped cart-list">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Price</th>
                    <th>Order</th>
                </tr>
            </thead>
            <tbody>
                <?php $x = 1 ?>
                <?php foreach ($val['item'] as $val_item): ?>
                <?php
                    $atts = '';
                    if ($val_item['single_item'] == 2) {
                        $atts.='data-price="' . $val_item['single_details']['price'] . '"';
                        $atts.=" ";
                        $atts.='data-size="' . $val_item['single_details']['size'] . '"';
                    }
                    ?>
                <tr>
                    <td>
                        <h5><?php echo qTranslate($val_item['item_name'], 'item_name', $val_item) ?></h5>
                        <p><?php echo $val_item['item_description'] ?></p>
                    </td>
                    <td>
                        <strong>
                            <?php //echo FunctionsV3::getItemFirstPrice($val_item['prices'], $val_item['discount']) ?>
                            <?php echo FunctionsV3::getPriceRange($val_item['prices'], $val_item['discount']); ?>
                        </strong>
                    </td>
                    <td class="options">
                        <?php if ($val_item['not_available'] == 2) :?>
                            Not available
                        <?php else:?>
                            <a class="menu-item" rel="<?php echo $val_item['item_id']?>"
                                data-single="<?php echo $val_item['single_item']?>" 
                                <?php echo $atts;?> href="javascript:;"
                                ><i class="icon_plus_alt2"></i>
                            </a>
                        <?php endif;?>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
        <hr>
        <?php else:?>
            <?php echo t("no item found on this category") ?>
        <?php endif;?>
    <?php endforeach; ?>

<?php else : ?>
    <p class="text-danger"><?php echo t("This restaurant has not published their menu yet.") ?></p>
<?php endif; ?>

<?php 
//page-specific js and css files
$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();

$cs->registerScriptFile("/assets/js/quickfood/cat_nav_mobile.js"
        , CClientScript::POS_END);
$cs->registerScript('$(\'#cat_nav\').mobileMenu();'
        , CClientScript::POS_END);
$cs->registerScriptFile("/assets/js/quickfood/cat_nav_mobile.js"
        , CClientScript::POS_END);
$cs->registerScript('sticky-sidebar',"
    jQuery('#sidebar').theiaStickySidebar({
      additionalMarginTop: 80
    });
    ",CClientScript::POS_END);
$cs->registerScript('point-to-cat',"
    $(function() {
	 'use strict';
	  $('a[href*=#]:not([href=#])').click(function() {
	    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
	      var target = $(this.hash);
	      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
	      if (target.length) {
	        $('html,body').animate({
	          scrollTop: target.offset().top - 70
	        }, 1000);
	        return false;
	      }
	    }
	  });
	});
    ", CClientScript::POS_END);

$cs->registerCssFile($baseUrl . "/assets/vendor/fancybox/source/jquery.fancybox.css?ver=1");

//For food-item popup
//$cs->registerScriptFile("http://maps.googleapis.com/maps/api/js"
//        , CClientScript::POS_END);
$cs->registerScriptFile($baseUrl . "/assets/js/quickfood/map_single.js"
        , CClientScript::POS_END);
$cs->registerScriptFile($baseUrl . "/assets/js/quickfood/infobox.js"
        , CClientScript::POS_END);
$cs->registerScriptFile($baseUrl . "/assets/js/quickfood/jquery.sliderPro.min.js"
        , CClientScript::POS_END);
$cs->registerCssFile($baseUrl . '/assets/css/quickfood/skins/square/grey.css');
$cs->registerCssFile($baseUrl . '/assets/css/quickfood/slider-pro.min.css');
/*$cs->registerScript('carousel', "
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
    });
        ",CClientScript::POS_END);*/
?>
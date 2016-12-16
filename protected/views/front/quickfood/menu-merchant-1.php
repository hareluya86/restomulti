
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
                    };
                    
                    $data=Yii::app()->functions->getItemById($val_item['item_id']);
                    if (is_array($data) && count($data) >= 1){
                        $data = $data[0];
                    }
                    ?>
                
                <tr>
                    <td>
                        <figure class="thumb_menu_list"><img src="<?php echo FunctionsV3::getFoodDefaultImage($val_item['photo']);?>" alt="thumb"></figure>
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
                        <div class="dropdown dropdown-options">
                        <?php if ($val_item['not_available'] == 2) :?>
                            Not available
                        <?php else:?>
                            <form class="frm-fooditem" id="frm-fooditem-<?php echo $data['item_id'];?>" method="POST" onsubmit="return false;">
                                <?php echo CHtml::hiddenField('action','addToCart')?>
                                <?php echo CHtml::hiddenField('item_id',$data['item_id'])?>
                                <?php echo CHtml::hiddenField('row',isset($row)?$row:"")?>
                                <?php echo CHtml::hiddenField('merchant_id',isset($merchant_id)?$merchant_id:'')?>
                                <?php echo CHtml::hiddenField('discount',isset($data['discount'])?$data['discount']:"" )?>
                                <?php echo CHtml::hiddenField('currentController','store')?>
                                
                                <!--<a class="menu-item" rel="<?php echo $val_item['item_id']?>"
                                    data-single="<?php echo $val_item['single_item']?>" 
                                    <?php echo $atts;?> href="javascript:;"
                                    ><i class="icon_plus_alt2"></i>
                                </a>-->
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                    <i class="icon_plus_alt2"></i>
                                </a>
                                <div class="dropdown-menu">

                                    <?php if (is_array($data['prices']) && count($data['prices'])>=1):?>  
                                    <h5>Select a size</h5>
                                    <?php foreach ($data['prices'] as $price):?>
                                    <label>
                                        <input type="radio" value="option1" name="options_1" checked>
                                        <?php echo qTranslate($price['size'],'size',$price)?>
                                        <span><?php echo FunctionsV3::prettyPrice($price['price'])?></span>
                                    </label>
                                    <?php endforeach; ?>
                                    <?php endif;?>
                                    
                                    <?php if (isset($data['addon_item'])):?>
                                    <?php if (is_array($data['addon_item']) && count($data['addon_item'])>=1):?>

                                    <?php foreach ($data['addon_item'] as $val): //dump($val);?>
                                    <?php echo CHtml::hiddenField('require_addon_'.$val['subcat_id'],$val['require_addons'],array(
                                        'class'=>"require_addon require_addon_".$val['subcat_id'],
                                        'data-id'=>$val['subcat_id'],
                                        'data-name'=>strtoupper($val['subcat_name'])
                                    ))?>
                                        <h5><?php echo qTranslate($val['subcat_name'],'subcat_name',$val)?></h5>
                                        <?php foreach ($val['sub_item'] as $val_addon):?>   
                                        
                                        <?php 
                                            $subcat_id=$val['subcat_id'];
                                            $sub_item_id=$val_addon['sub_item_id'];
                                            $multi_option_val=$val['multi_option'];

                                            /** fixed select only one addon*/
                                            if ( $val['multi_option']=="custom" || $val['multi_option']=="multiple"){
                                                $sub_item_name="sub_item[$subcat_id][$x]";
                                            } else $sub_item_name="sub_item[$subcat_id][]"; 

                                            $sub_addon_selected='';
                                            $sub_addon_selected_id='';

                                            $item_data['sub_item']=isset($item_data['sub_item'])?$item_data['sub_item']:'';
                                            if (array_key_exists($subcat_id,(array)$item_data['sub_item'])){
                                                $sub_addon_selected=$item_data['sub_item'][$subcat_id];
                                                if (is_array($sub_addon_selected) && count($sub_addon_selected)>=1){
                                                    foreach ($sub_addon_selected as $val_addon_selected) {
                                                        $val_addon_selected=Yii::app()->functions->explodeData($val_addon_selected);
                                                        if (is_array($val_addon_selected)){
                                                            $sub_addon_selected_id[]=$val_addon_selected[0];
                                                        }
                                                    }
                                                }
                                            }
                                            ?>	
                                        
                                            <label>
                                                <input type="checkbox" value="<?php echo $val_addon['sub_item_id']."|".$val_addon['price']."|".$val_addon['sub_item_name']."|".$val['two_flavor_position'] ?>">
                                                    <?php echo qTranslate($val_addon['sub_item_name'],'sub_item_name',$val_addon);?>
                                                <span>+ <?php echo FunctionsV3::prettyPrice($val_addon['price']);?></span>
                                            </label>
                                        <?php endforeach; ?>
                                    <?php endforeach; ?>
                                    <?php endif;?>
                                    <?php endif;?>
                                    <a onclick="document.fooditem_<?php echo $val_item['item_id'];?>.submit();" class="add_to_basket add_to_cart">Add to cart</a>
                                    <input type="submit" value="<?php echo empty($row)?Yii::t("default","add to cart"):Yii::t("default","update cart");?>" 
                                           
                                           class="add_to_cart orange-button upper-text">
                                </div>
                            </form>
                        <?php endif;?>
                        </div>
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
$('#cat_nav a[href^=\"#\"]').on('click', function (e) {
    e.preventDefault();
    var target = this.hash;
    var \$target = \$(target);
    $('html, body').stop().animate({
            'scrollTop': \$target.offset().top - 70
    }, 900, 'swing', function () {
            window.location.hash = target;
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

?>
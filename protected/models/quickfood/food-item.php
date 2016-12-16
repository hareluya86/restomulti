<?php
$row = '';
$item_data = '';
$price_select = '';
$size_select = '';
if (array_key_exists("row", (array) $this->data)) {
    $row = $this->data['row'];
    $item_data = $_SESSION['kr_item'][$row];
    //dump($item_data);
    $price = Yii::app()->functions->explodeData($item_data['price']);
    if (is_array($price) && count($price) >= 1) {
        $price_select = isset($price[0]) ? $price[0] : '';
        $size_select = isset($price[1]) ? $price[1] : '';
    }
    $row++;
}


$data = Yii::app()->functions->getItemById($this->data['item_id']);
//dump($data);
$disabled_website_ordering = Yii::app()->functions->getOptionAdmin('disabled_website_ordering');
$hide_foodprice = Yii::app()->functions->getOptionAdmin('website_hide_foodprice');
echo CHtml::hiddenField('hide_foodprice', $hide_foodprice);

$gallery_photo=!empty($data['gallery_photo'])?json_decode($data['gallery_photo']):false;
?>

<?php if (is_array($data) && count($data) >= 1): ?>
    <?php
    $data = $data[0];

//dump($data);
    ?>

    <form class="frm-fooditem" id="frm-fooditem" method="POST" onsubmit="return false;">
        <?php echo CHtml::hiddenField('action', 'addToCart') ?>
        <?php echo CHtml::hiddenField('item_id', $this->data['item_id']) ?>
        <?php echo CHtml::hiddenField('row', isset($row) ? $row : "") ?>
        <?php echo CHtml::hiddenField('merchant_id', isset($data['merchant_id']) ? $data['merchant_id'] : '') ?>


        <?php echo CHtml::hiddenField('discount', isset($data['discount']) ? $data['discount'] : "" ) ?>
        <?php echo CHtml::hiddenField('currentController', 'store') ?>

        <?php
//dump($data);
        /** two flavores */
        if ($data['two_flavors'] == 2) {
            $data['prices'][0] = array(
                'price' => 0,
                'size' => ''
            );
            echo CHtml::hiddenField('two_flavors', $data['two_flavors']);
        }
//dump($data);
        ?>
        <div id="cart_box">
            <h3><?php echo qTranslate($data['item_name'], 'item_name', $data) ?></h3>
            <div class="row">
                
                <?php if (getOption($data['merchant_id'],'disabled_food_gallery')!=2):?>  
                <?php if (is_array($gallery_photo) && count($gallery_photo)>=1):?>
                <div class="col-md-8">
                    <div id="Img_carousel" class="slider-pro">
                        <div class="sp-slides">
                            <?php foreach ($gallery_photo as $gal_val):?>
                            <div class="sp-slide">
                                <img alt="" class="sp-image" src="<?php echo assetsURL() ?>/css/quickfood/images/blank.gif" 
                                     data-src="<?php echo websiteUrl()."/upload/$gal_val"?>" 
                                     data-small="<?php echo websiteUrl()."/upload/$gal_val"?>"
                                     data-medium="<?php echo websiteUrl()."/upload/$gal_val"?>"
                                     data-large="<?php echo websiteUrl()."/upload/$gal_val"?>"
                                     data-retina="<?php echo websiteUrl()."/upload/$gal_val"?>"
                            </div>
                            <?php endforeach;?>
                        </div>
                        <div class="sp-thumbnails">
                            <?php foreach ($gallery_photo as $gal_val):?>
                                <img alt="<?php echo $data['item_name'] ?>" class="sp-thumbnail" src="<?php echo websiteUrl()."/upload/$gal_val"?>">
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
                <?php endif;?>
                <?php endif;?>
                
                <div class="col-md-<?php echo (is_array($gallery_photo) && count($gallery_photo)>=1) ? '4' : '12' ?>">
                    <p><?php echo qTranslate($data['item_description'], 'item_description', $data) ?></p>
                      <!--PRICE-->
  <div class="section-label">
    <a class="section-label-a">
      <span class="bold">
      <?php echo t("Price")?></span>
      <b></b>
    </a>     
    <div class="row">
    <?php if (is_array($data['prices']) && count($data['prices'])>=1):?>  
      <?php foreach ($data['prices'] as $price):?>
          <?php $price['price']=Yii::app()->functions->unPrettyPrice($price['price'])?>
          <div class="col-md-5 ">
             <?php if ( !empty($price['size'])):?>
                 <?php echo CHtml::radioButton('price',
		          $size_select==$price['size']?true:false
		          ,array(
		            'value'=>$price['price']."|".$price['size'],
		            'class'=>"price_cls item_price"
		          ))?>
		          <?php echo qTranslate($price['size'],'size',$price)?>
              <?php else :?>
                  <?php echo CHtml::radioButton('price',
		            count($price['price'])==1?true:false
		            ,array(
		            'value'=>$price['price'],
		            'class'=>"item_price"
		          ))?>
             <?php endif;?>
             
             <?php if (isset($price['price'])):?>  
                <?php if (is_numeric($data['discount'])):?>
                    <span class="line-tru"><?php echo FunctionsV3::prettyPrice($price['price'])?></span>
                    <span class="text-danger"><?php echo FunctionsV3::prettyPrice($price['price']-$data['discount'])?></span>
                <?php else :?>
                    <?php echo FunctionsV3::prettyPrice($price['price'])?>
                 <?php endif;?>
             <?php endif;?>
             
          </div> <!--col-->
      <?php endforeach;?>
    <?php endif;?>
    </div> <!--row-->
  </div>        
  <!--PRICE-->
                </div>
            </div>


        </div>
    </div>
    </form>
<?php else : ?>
    <p class="text-danger"><?php echo Yii::t("default", "Sorry but we cannot find what you are looking for.") ?></p>
<?php endif; ?>
<script type="text/javascript">
    jQuery(document).ready(function () {
        var hide_foodprice = $("#hide_foodprice").val();
        if (hide_foodprice == "yes") {
            $(".hide-food-price").hide();
            $("span.price").hide();
            $(".view-item-wrap").find(':input').each(function () {
                $(this).hide();
            });
        }


        var price_cls = $(".price_cls:checked").length;
        if (price_cls <= 0) {
            var x = 0
            $(".price_cls").each(function (index) {
                if (x == 0) {
                    dump('set check');
                    $(this).attr("checked", true);
                }
                x++;
            });
        }


        if ($(".food-gallery-wrap").exists()) {
            $('.food-gallery-wrap').magnificPopup({
                delegate: 'a',
                type: 'image',
                closeOnContentClick: false,
                closeBtnInside: false,
                mainClass: 'mfp-with-zoom mfp-img-mobile',
                image: {
                    verticalFit: true,
                    titleSrc: function (item) {
                        return '';
                    }
                },
                gallery: {
                    enabled: true
                },
                zoom: {
                    enabled: true,
                    duration: 300, // don't foget to change the duration also in CSS
                    opener: function (element) {
                        return element.find('img');
                    }
                }
            });
        }

    });	 /*END READY*/
    //For carousel
    $(document).ready(function ($) {
        $('#Img_carousel').sliderPro({
            width: 960,
            height: 500,
            fade: true,
            arrows: true,
            buttons: false,
            fullScreen: true,
            smallSize: 500,
            startSlide: 0,
            mediumSize: 1000,
            largeSize: 3000,
            thumbnailArrows: true,
            autoplay: false
        });
    });
</script>

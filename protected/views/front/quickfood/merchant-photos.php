<?php if (is_array($gallery) && count($gallery) >= 1): ?>
    <div id="Img_carousel" class="slider-pro">
        <div class="sp-slides">
            <?php foreach ($gallery as $val):?>
                <div class="sp-slide">
                    <img alt="" class="sp-image" src="assets/css/quickfood/images/blank.gif" 
                         data-src="<?php echo uploadURL()."/".$val?>" 
                         data-small="<?php echo uploadURL()."/".$val?>" 
                         data-medium="<?php echo uploadURL()."/".$val?>" 
                         data-large="<?php echo uploadURL()."/".$val?>" 
                         data-retina="<?php echo uploadURL()."/".$val?>">
                </div>
            <?php endforeach;?>
        </div>
        <div class="sp-thumbnails">
            <?php foreach ($gallery as $val):?>
                <img alt="" class="sp-thumbnail" src="<?php echo uploadURL()."/".$val?>">
            <?php endforeach;?>
        </div>
    </div>
<?php else :?>
    <div>
        <h4>
            <?php echo t("gallery not available")?>
        </h4>
    </div>
<?php endif; ?>
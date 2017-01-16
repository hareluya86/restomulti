<?php if ( $res=FunctionsV3::getMerchantOpeningHours($merchant_id)):?>
    <ul class="opening_list">
        <?php foreach ($res as $val):?>
            <li>
              <?php echo ucwords(t($val['day']))?>
              <span><?php echo $val['hours']?></span>
           </li>
        <?php endforeach;?>
    </ul>
<?php else :?>
    <p class="text-danger"><?php echo t("Not available.")?></p>
<?php endif;?>

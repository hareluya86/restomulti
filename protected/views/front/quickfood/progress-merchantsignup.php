<?php ?>

<?php if ($show_bar): ?>
    <div id="count" class="hidden-xs">
        <ul>
            <li>
                <a class="active" href="<?php echo Yii::app()->createUrl('/store/merchantsignup') ?>">
                    <?php echo t("Select Package") ?>
                </a>
            </li>
            <li>
                <a class="<?php echo $step >= 2 ? "active" : "inactive";
                                echo $step == 2 ? " current" : ""; ?>" 
                   href="javascript:;">
                       <?php echo t("Merchant information") ?>
                </a>
            </li>
            <li>
                <a class="<?php echo $step >= 3 ? "active" : "inactive";
                       echo $step == 3 ? " current" : ""; ?> "
                   href="javascript:;">
                       <?php echo t("Payment Information") ?>
                </a>
            </li>
            <li>
                <a class="<?php echo $step >= 4 ? "active" : "inactive";
                   echo $step == 4 ? " current" : ""; ?> "
                   href="javascript:;">
    <?php echo t("Activation") ?>
                </a>
            </li>
        </ul>
    </div>
    <div class="border progress-dot mytable">    
        <a href="<?php echo Yii::app()->createUrl('/store/merchantsignup') ?>" class="mycol selected" >
            <i class="ion-record"></i>
        </a>

        <a href="javascript:;" class="mycol 
    <?php echo $step >= 2 ? "selected" : ''; ?>" ><i class="ion-record"></i>
        </a>

        <a href="javascript:;" class="mycol <?php echo $step >= 3 ? "selected" : ''; ?>" >
            <i class="ion-record"></i>
        </a>

        <a href="javascript:;" class="mycol <?php echo $step >= 4 ? "selected" : ''; ?>">
            <i class="ion-record"></i>
        </a>

    </div> <!--end progress-dot-->
<?php endif; ?>
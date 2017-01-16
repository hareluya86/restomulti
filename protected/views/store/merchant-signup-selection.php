<?php
$this->renderPartial('/front/quickfood/banner-receipt',array(
   'h1'=>t("Restaurant Signup"),
   'sub_text'=>t("Please Choose A Package Below To Signup"),
    'step' => 1,
    'show_bar' => true
));

/* Render top menu */
$this->renderPartial('/layouts/quickfood/front_top_menu', array(
    'action' => Yii::app()->controller->action->id,
    'theme_hide_logo' => getOptionA('theme_hide_logo')
));

?>

<div class="white_bg">
    <div class="container margin_60_35">
    <div class="main_title margin_mobile">
            <h2 class="nomargin_top">Increase your customers</h2>
            <p>
                Cum doctus civibus efficiantur in imperdiet deterruisset.
            </p>
        </div>
	<div class="row">
		<div class="col-md-6 wow fadeIn" data-wow-delay="0.1s">
			<div class="feature">
				<i class="icon_datareport"></i>
				<h3><span>Increase</span> your sales</h3>
				<p>
					 Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset, doctus volumus explicari qui ex, appareat similique an usu.
				</p>
			</div>
		</div>
		<div class="col-md-6 wow fadeIn" data-wow-delay="0.2s">
			<div class="feature">
				<i class="icon_chat_alt"></i>
				<h3><span>H24</span> chat support</h3>
				<p>
					 Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset, doctus volumus explicari qui ex, appareat similique an usu.
				</p>
			</div>
		</div>
	</div><!-- End row -->
	<div class="row">
		<div class="col-md-6 wow fadeIn" data-wow-delay="0.3s">
			<div class="feature">
				<i class="icon_bag_alt"></i>
				<h3><span>Delivery</span> or Takeaway</h3>
				<p>
					 Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset, doctus volumus explicari qui ex, appareat similique an usu.
				</p>
			</div>
		</div>
		<div class="col-md-6 wow fadeIn" data-wow-delay="0.4s">
			<div class="feature">
				<i class="icon_mobile"></i>
				<h3><span>Mobile</span> support</h3>
				<p>
					 Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset, doctus volumus explicari qui ex, appareat similique an usu.
				</p>
			</div>
		</div>
	</div><!-- End row -->
	<div class="row">
		<div class="col-md-6 wow fadeIn" data-wow-delay="0.5s">
			<div class="feature">
				<i class="icon_wallet"></i>
				<h3><span>Cash</span> payment</h3>
				<p>
					 Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset, doctus volumus explicari qui ex, appareat similique an usu.
				</p>
			</div>
		</div>
		<div class="col-md-6 wow fadeIn" data-wow-delay="0.6s">
			<div class="feature">
				<i class="icon_creditcard"></i>
				<h3><span>Secure card</span> payment</h3>
				<p>
					 Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset, doctus volumus explicari qui ex, appareat similique an usu.
				</p>
			</div>
		</div>
	</div><!-- End row -->
</div><!-- End container -->
</div>


<div class="container margin_60">
    <div class="main_title margin_mobile">
        <h2 class="nomargin_top"><?php echo t('Our Plans');?></h2>
    </div>
   <div class="row text-center plans">
        <?php if ( $disabled_membership_signup!=1):?>
            <div class="col-md-4 col-md-offset-2 plan">       
                <a href="<?php echo Yii::app()->createUrl("/store/merchantsignup")?>"
                        class=" box_work">
                    <?php if ( FunctionsK::hasMembershipPackage()):?>
                        <img src="assets/images/quickfood/img/submit_restaurant.jpg" width="848" height="480" alt="" class="img-responsive">
                        <h3><?php echo t("Membership")?></span></h3>
                        <p>    
                            <?php echo t("You will be charged a monthly or yearly fee")?>
                        </p>
                        <div class="btn_1">
                            <?php echo t("click here")?>
                        </div>
                    <?php endif;?>
                </a> <!--box-grey-->
            </div><!-- inner-->       
        <?php endif;?>

        <div class="col-md-4">
            <a href="<?php echo Yii::app()->createUrl("/store/merchantsignupinfo")?>"
               class="box_work">
                <h3><?php echo t("Commission")?></h3>
                <p>
                    <?php 
                        if ( $commision_type=="fixed"){
                                echo displayPrice($currency,$percent)." ".t("commission per order");
                        } else echo standardPrettyFormat($percent)."% ".t("commission per order")
                    ?> 
                </p>
                <div class="btn_1">
                    <?php echo t("click here")?>
                </div>


            </a>
        </div> <!--col-->
   </div> <!--row-->

</div> <!--container-->


<?php
//page-specific js and css files
$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();

$cs->registerScriptFile("/assets/js/quickfood/morphext.min.js"
        , CClientScript::POS_END);

$cs->registerCssFile($baseUrl . '/assets/css/quickfood/morphext.css');

$cs->registerScript('morphext', 
        '$("#js-rotating").Morphext({
    animation: "fadeIn", // Overrides default "bounceIn"
    separator: ",", // Overrides default ","
    speed: 2300, // Overrides default 2000
    complete: function () {
        // Overrides default empty function
    }})'
        , CClientScript::POS_END);
?>
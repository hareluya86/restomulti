<?php 
$search_address=isset($_GET['s'])?$_GET['s']:'';
if (isset($_GET['st'])){
	$search_address=$_GET['st'];
}
//$this->renderPartial('/front/search-header',array(
//   'search_address'=>$search_address,
//   'total'=>0
//));?>
<!--TOP MENU-->
<?php
$this->renderPartial('/layouts/quickfood/front_top_menu', array(
    'action' => Yii::app()->controller->action->id,
    'theme_hide_logo' => getOptionA('theme_hide_logo')
));
?>



<!-- SubHeader =============================================== -->
<section class="parallax-window" id="short" data-parallax="scroll" data-image-src="/assets/images/quickfood/img/sub_header_short.jpg" data-natural-width="1400" data-natural-height="350">
    <div id="subheader">
        <div id="sub_content">
            <h1> results in your zone</h1>
            <div><i class="icon_pin"></i> 135 Newtownards Road, Belfast, BT4 1AB</div>
        </div><!-- End sub_content -->
    </div><!-- End subheader -->
    <?php 
        $this->renderPartial('/front/quickfood/order-progress-bar',array(
           'step'=>2,
           'show_bar'=>true
        ));
        echo CHtml::hiddenField('current_page_url',isset($current_page_url)?$current_page_url:'');
    ?>
</section><!-- End section -->
<!-- End SubHeader ============================================ -->

<div class="sections section-search-results">
  <div class="container center">
     <h3><?php echo Yii::t("default","Oops. We're having trouble finding that address.")?></h3>
     <p><?php echo Yii::t("default","Please enter your address in one of the following formats and try again. Please do NOT enter your apartment or floor number here.")?></p>
    <p class="bold">- <?php echo Yii::t("default","Street address, city, state")?></p>
    <p class="bold">- <?php echo Yii::t("default","Street address, city")?></p>
    <p class="bold">- <?php echo Yii::t("default","Street address, zip code")?></p>
  </div> <!--container--> 
</div> <!--section-search-results-->   
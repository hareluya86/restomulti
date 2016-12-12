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
$this->renderPartial('/front/quickfood/default-header', array(
    'h1' => count($data).' '.t("results"),
    'sub_text' => $search_address,
    'step' => 2,
    'show_bar' => true
));
?>

<div class="sections section-search-results">
  <div class="container center">
     <h3><?php echo Yii::t("default","Oops. We're having trouble finding that address.")?></h3>
     <p><?php echo Yii::t("default","Please enter your address in one of the following formats and try again. Please do NOT enter your apartment or floor number here.")?></p>
    <p class="bold">- <?php echo Yii::t("default","Street address, city, state")?></p>
    <p class="bold">- <?php echo Yii::t("default","Street address, city")?></p>
    <p class="bold">- <?php echo Yii::t("default","Street address, zip code")?></p>
  </div> <!--container--> 
</div> <!--section-search-results-->   
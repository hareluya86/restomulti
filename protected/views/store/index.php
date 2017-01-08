<?php
$kr_search_adrress = FunctionsV3::getSessionAddress();

$home_search_text=Yii::app()->functions->getOptionAdmin('home_search_text');
if (empty($home_search_text)){
	$home_search_text=Yii::t("default","Find restaurants near you");
}

$home_search_subtext=Yii::app()->functions->getOptionAdmin('home_search_subtext');
if (empty($home_search_subtext)){
	$home_search_subtext=Yii::t("default","Order Delivery Food Online From Local Restaurants");
}

$home_search_mode=Yii::app()->functions->getOptionAdmin('home_search_mode');
$placholder_search=Yii::t("default","Street Address,City,State");
if ( $home_search_mode=="postcode" ){
	$placholder_search=Yii::t("default","Enter your postcode");
}
$placholder_search=Yii::t("default",$placholder_search);

$this->renderPartial('/layouts/quickfood/front_top_menu',array(
  'action'=>Yii::app()->controller->action->id,
  'theme_hide_logo'=>getOptionA('theme_hide_logo')
));
?>

<!-- SubHeader =============================================== -->
<section class="header-video">
    <div id="hero_video">
        <div id="sub_content">
            <h1>Order Takeaway or Delivery Food</h1>
            <p>
                Ridiculus sociosqu cursus neque cursus curae ante scelerisque vehicula.
            </p>
            <form id="forms-search" class="forms-search" method="GET" action="/searcharea">
                <div id="custom-search-input">
                    <div class="input-group">
                        <input id="s" type="text" class="search-query" 
                               placeholder="Your Address or postal code"
                               required="required" name="s">
                        <span class="input-group-btn">
                            <input type="submit" class="btn_search" value="submit">
                        </span>
                    </div>
                </div>
            </form>
        </div><!-- End sub_content -->
    </div>
    <img src="assets/images/quickfood/img/video_fix.png" alt="" class="header-video--media" data-video-src="/assets/video/intro" data-teaser-source="/assets/video/intro" data-provider="Vimeo" data-video-width="1920" data-video-height="960">
    <div id="count" class="hidden-xs">
        <ul>
            <li><span class="number">2650</span> Restaurant</li>
            <li><span class="number">5350</span> People Served</li>
            <li><span class="number">12350</span> Registered Users</li>
        </ul>
    </div>
</section><!-- End Header video -->

<!--<img class="mobile-home-banner" src="<?php echo assetsURL()."/images/banner.jpg"?>">-->

<!--<div id="parallax-wrap" class="parallax-container parallax-home" 
data-parallax="scroll" data-position="top" data-bleed="10" 
data-image-src="<?php echo assetsURL()."/images/banner.jpg"?>">-->

<?php 
/*if ( $home_search_mode=="address" || $home_search_mode=="") { 
	if ( $enabled_advance_search=="yes"){
		$this->renderPartial('/front/advance_search',array(
		  'home_search_text'=>$home_search_text,
		  'kr_search_adrress'=>$kr_search_adrress,
		  'placholder_search'=>$placholder_search,
		  'home_search_subtext'=>$home_search_subtext,
		  'theme_search_merchant_name'=>getOptionA('theme_search_merchant_name'),
		  'theme_search_street_name'=>getOptionA('theme_search_street_name'),
		  'theme_search_cuisine'=>getOptionA('theme_search_cuisine'),
		  'theme_search_foodname'=>getOptionA('theme_search_foodname'),
		  'theme_search_merchant_address'=>getOptionA('theme_search_merchant_address'),
		));
	} else $this->renderPartial('/front/single_search',array(
	      'home_search_text'=>$home_search_text,
		  'kr_search_adrress'=>$kr_search_adrress,
		  'placholder_search'=>$placholder_search,
		  'home_search_subtext'=>$home_search_subtext
	));
} else {
	$this->renderPartial('/front/search_postcode',array(
	      'home_search_text'=>$home_search_text,
		  'placholder_search'=>$placholder_search,
		  'home_search_subtext'=>t("Enter your post code")
	));
}*/
?>

</div> <!--parallax-container-->

<!--HOW IT WORKS SECTIONS -->
<?php if ($theme_hide_how_works<>2):?>
    <!-- Content ================================================== -->
    <div class="container margin_60">
        
         <div class="main_title">
            <h2 class="nomargin_top" style="padding-top:0">How it works</h2>
            <p>
                Cum doctus civibus efficiantur in imperdiet deterruisset.
            </p>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="box_home" id="one">
                    <span>1</span>
                    <h3>Search by address</h3>
                    <p>
                        Find all restaurants available in your zone.
                    </p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="box_home" id="two">
                    <span>2</span>
                    <h3>Choose a restaurant</h3>
                    <p>
                        We have more than 1000s of menus online.
                    </p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="box_home" id="three">
                    <span>3</span>
                    <h3>Pay by card or cash</h3>
                    <p>
                        It's quick, easy and totally secure.
                    </p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="box_home" id="four">
                    <span>4</span>
                    <h3>Delivery or takeaway</h3>
                    <p>
                        Don't feel like leaving home? No problem!
                    </p>
                </div>
            </div>
        </div><!-- End row -->
        
        <div id="delivery_time" class="hidden-xs">
            <strong><span>2</span><span>5</span></strong>
            <h4>The minutes that usually takes to deliver!</h4>
        </div>
    </div><!-- End container -->
<?php endif;?>
<?php if (false):?>
<!--HOW IT WORKS SECTIONS (old) -->
<div class="sections section-how-it-works">
<div class="container">
 <h2><?php echo t("How it works")?></h2>
 <p class="center"><?php echo t("Get your favourite food in 4 simple steps")?></p>
 
 <div class="row">
   <div class="col-md-3 col-sm-3 center">
      <div class="steps step1-icon">
        <img src="<?php echo assetsURL()."/images/step1.png"?>">
      </div>
      <h3><?php echo t("Search")?></h3>
      <p><?php echo t("Find all restaurants available near you")?></p>
   </div>
   <div class="col-md-3 col-sm-3 center">
      <div class="steps step2-icon">
         <img src="<?php echo assetsURL()."/images/step2.png"?>">
      </div>
      <h3><?php echo t("Choose")?></h3>
      <p><?php echo t("Browse hundreds of menus to find the food you like")?></p>
   </div>
   <div class="col-md-3 col-sm-3  center">
      <div class="steps step2-icon">
        <img src="<?php echo assetsURL()."/images/step3.png"?>">
      </div>
      <h3><?php echo t("Pay")?></h3>
      <p><?php echo t("It's quick, secure and easy")?></p>
   </div>
   <div class="col-md-3 col-sm-3  center">
     <div class="steps step2-icon">
       <img src="<?php echo assetsURL()."/images/step4.png"?>">
     </div>
      <h3><?php echo t("Enjoy")?></h3>
      <p><?php echo t("Food is prepared & delivered to your door")?></p>
   </div>   
 </div>

 </div> <!--container-->
</div> <!--section-how-it-works-->
<?php endif;?>


<!--FEATURED RESTAURANT SECIONS-->
<?php if ($disabled_featured_merchant==""):?>
<?php if ( getOptionA('disabled_featured_merchant')!="yes"):?>
<?php if ($res=Yii::app()->functions->getFeatureMerchant2()):?>

<!--quickfood-->
<div class="white_bg">
    <div class="container margin_60">
        
        <div class="main_title">
            <h2 class="nomargin_top"><?php echo t("Featured Restaurants")?></h2>
            <p>
                Cum doctus civibus efficiantur in imperdiet deterruisset.
            </p>
        </div>
        
        <div class="row">
            <?php foreach ($res as $val): //dump($val);?>
            <?php $address= $val['street']." ".$val['city'];
                  $address.=" ".$val['state']." ".$val['post_code'];

                  $ratings=Yii::app()->functions->getRatings($val['merchant_id']);
            ?>
                <div class="col-md-6">
                    <a href="<?php echo Yii::app()->createUrl("/menu-". trim($val['restaurant_slug']))?>" class="strip_list">
                    <div class="ribbon_1">Popular</div>
                        <div class="desc">
                            <div class="thumb_strip">
                                <img src="/assets/images/quickfood/img/thumb_restaurant.jpg" alt="">
                            </div>
                            <div class="rating">
                                <?php for($i = 0; $i < $ratings['ratings']; $i++){
                                    echo '<i class="icon_star voted"></i>';
                                } ?>
                                <?php for($i = 0; $i < 5-$ratings['ratings']; $i++){
                                    echo '<i class="icon_star"></i>';
                                } ?>
                                <?php echo FunctionsV3::merchantOpenTag($val['merchant_id'])?>
                            </div>
                            
                            <h3><?php echo clearString($val['restaurant_name'])?></h3>
                            <div class="type">
                                <?php echo FunctionsV3::displayCuisine($val['cuisine']);?>
                            </div>
                            <div class="location">
                                <?php echo $address?>
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
                        </div><!-- End desc-->
                    </a><!-- End strip_list-->
                </div><!-- End col-md-6-->
            <?php endforeach; ?>
        </div><!-- End row -->   
        
    </div><!-- End container -->
</div><!-- End white_bg -->
<!--quickfood-->

<?php if(false): ?>
<div class="sections section-feature-resto">
<div class="container">


  <h2><?php echo t("Featured Restaurants")?></h2>
  
  <div class="row">
  <?php foreach ($res as $val): //dump($val);?>
  <?php $address= $val['street']." ".$val['city'];
        $address.=" ".$val['state']." ".$val['post_code'];
        
        $ratings=Yii::app()->functions->getRatings($val['merchant_id']);
  ?>   
  
    <!--<a href="<?php echo Yii::app()->createUrl('/store/menu/merchant/'. trim($val['restaurant_slug']) )?>">-->
    <a href="<?php echo Yii::app()->createUrl("/menu-". trim($val['restaurant_slug']))?>">
    <div class="col-md-5 border-light ">
    
        <div class="col-md-3 col-sm-3">
           <img class="logo-small" src="<?php echo FunctionsV3::getMerchantLogo($val['merchant_id']);?>">
        </div> <!--col-->
        
        <div class="col-md-9 col-sm-9">
        
          <div class="row">
              <div class="col-sm-5">
		          <div class="rating-stars" data-score="<?php echo $ratings['ratings']?>"></div>   
	          </div>
	          <div class="col-sm-2 merchantopentag">
	          <?php echo FunctionsV3::merchantOpenTag($val['merchant_id'])?>   
	          </div>
          </div>
          
          <h4 class="concat-text"><?php echo clearString($val['restaurant_name'])?></h4>
          
          <p class="concat-text">
          <?php //echo wordwrap(FunctionsV3::displayCuisine($val['cuisine']),50,"<br />\n");?>
          <?php echo FunctionsV3::displayCuisine($val['cuisine']);?>
          </p>
          <p class="concat-text"><?php echo $address?></p>                             
          <?php echo FunctionsV3::displayServicesList($val['service'])?>          
        </div> <!--col-->
        
    </div> <!--col-6-->
    </a>
    <div class="col-md-1"></div>
      
  <?php endforeach;?>
  </div> <!--end row-->

  
</div> <!--container-->
</div>
<?php endif;?>
<?php endif;?>
<?php endif;?>
<!--END FEATURED RESTAURANT SECIONS-->
<?php endif;?>

<!--CHOOSE FROM OVER X RESTAURANTS-->
<div class="high_light">
    <div class="container">
            <h3>Choose from over 2,000 Restaurants</h3>
        <p>Ridiculus sociosqu cursus neque cursus curae ante scelerisque vehicula.</p>
        <a href="/store/browse">View all Restaurants</a>
    </div><!-- End container -->
</div><!-- End hight_light -->
<!--CHOOSE FROM OVER X RESTAURANTS-->

<!--WE ALSO DELIVER TO YOUR OFFICE-->
<section class="parallax-window" data-parallax="scroll" data-image-src="/assets/images/quickfood/img/bg_office.jpg" data-natural-width="1200" data-natural-height="600">
    <div class="parallax-content">
        <div class="sub_content">
            <i class="icon_mug"></i>
            <h3>We also deliver to your office</h3>
            <p>
                Ridiculus sociosqu cursus neque cursus curae ante scelerisque vehicula.
            </p>
        </div><!-- End sub_content -->
    </div><!-- End subheader -->
</section><!-- End section -->


<?php if (false && $theme_hide_cuisine<>2):?>
<!--CUISINE SECTIONS-->
<?php if ( $list=FunctionsV3::getCuisine() ): ?>
<div class="sections section-cuisine">
<div class="container  nopad">

<div class="col-md-3 nopad">
<img src="<?php echo assetsURL()."/images/cuisine.png"?>" class="img-cuisine">
</div>

<div class="col-md-9  nopad">

  <h2><?php echo t("Browse by cuisine")?></h2>
  <p class="sub-text center"><?php echo t("choose from your favorite cuisine")?></p>
  
  <div class="row">
    <?php $x=1;?>
    <?php foreach ($list as $val): ?>
    <div class="col-md-4 col-sm-4 indent-5percent nopad">
      <a href="<?php echo Yii::app()->createUrl('/store/cuisine',array("category"=>$val['cuisine_id']))?>" 
     class="<?php echo ($x%2)?"even":'odd'?>">
      <?php 
      $cuisine_json['cuisine_name_trans']=!empty($val['cuisine_name_trans'])?json_decode($val['cuisine_name_trans'],true):'';	 
      echo qTranslate($val['cuisine_name'],'cuisine_name',$cuisine_json);
      if($val['total']>0){
      	echo "<span>(".$val['total'].")</span>";
      }
      ?>
      </a>
    </div>   
    <?php $x++;?>
    <?php endforeach;?>
  </div> 

</div>
  
</div> <!--container-->
</div> <!--section-cuisine-->
<?php endif;?>
<?php endif;?>


<?php if ($theme_show_app==2):?>
<!--MOBILE APP SECTION-->
<div id="mobile-app-sections" class="container">
<div class="container-medium">
  <div class="row">
     <div class="col-xs-5 into-row border app-image-wrap">
       <img class="app-phone" src="<?php echo assetsURL()."/images/getapp-2.jpg"?>">
     </div> <!--col-->
     <div class="col-xs-7 into-row border">
       <h2><?php echo getOptionA('website_title')." ".t("in your mobile")?>! </h2>
       <h3 class="green-text"><?php echo t("Get our app, it's the fastest way to order food on the go")?>.</h3>
       
       <div class="row border" id="getapp-wrap">
       <?php if(!empty($theme_app_ios) && $theme_app_ios!="http://"):?>
         <div class="col-xs-4 border">                      
           <a href="<?php echo $theme_app_ios?>" target="_blank">
           <img class="get-app" src="<?php echo assetsURL()."/images/get-app-store.png"?>">
           </a>           
         </div>
         <?php endif;?>
         
         <?php if(!empty($theme_app_android) && $theme_app_android!="http://"):?>
         <div class="col-xs-4 border">
           <a href="<?php echo $theme_app_android?>" target="_blank">
             <img class="get-app" src="<?php echo assetsURL()."/images/get-google-play.png"?>">
           </a>
         </div>
         <?php endif;?>
         
       </div> <!--row-->
       
     </div> <!--col-->
  </div> <!--row-->
  </div> <!--container-medium-->
  
  <div class="mytable border" id="getapp-wrap2">
     <div class="mycol border">
           <a href="<?php echo $theme_app_ios?>" target="_blank">
           <img class="get-app" src="<?php echo assetsURL()."/images/get-app-store.png"?>">
           </a>
     </div> <!--col-->
     <div class="mycol border">
          <a href="<?php echo $theme_app_android?>" target="_blank">
             <img class="get-app" src="<?php echo assetsURL()."/images/get-google-play.png"?>">
           </a>
     </div> <!--col-->
  </div> <!--mytable-->
  
  
</div> <!--container-->
<!--END MOBILE APP SECTION-->
<?php endif;?>


<?php //page-specific js and css files
$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl . "/assets/js/quickfood/modernizr.js"
                , CClientScript::POS_END);
$cs->registerScriptFile($baseUrl . "/assets/js/quickfood/video_header.js"
                , CClientScript::POS_END);
?>
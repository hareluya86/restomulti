<?php
$this->renderPartial('/front/quickfood/banner-receipt', array(
    'h1' => t("Restaurant Signup"),
    'sub_text' => t("step 2 of 4"),
    'step' => 2,
    'show_bar' => true
));

echo CHtml::hiddenField('mobile_country_code',Yii::app()->functions->getAdminCountrySet(true));
?>

<div class="white_bg">
    <div class="container margin_60_35">
        <div class="row">
            <div class="col-md-8">
                <div class="box_style_2">
                    <?php if (is_array($data) && count($data)>=1):?>
                        <form class="forms" id="forms" onsubmit="return false;">
                            <?php echo CHtml::hiddenField('action','merchantSignUp')?>
                            <?php echo CHtml::hiddenField('currentController','store')?>
                            <?php echo CHtml::hiddenField('package_id',$data['package_id'])?>
                            <?php FunctionsV3::addCsrfToken();?>
                            
                            <div class="form-group">
                                <label>
                                    <?php echo t("Restaurant name")?>
                                </label>
                                <?php echo CHtml::textField('restaurant_name',
                                    isset($data['restaurant_name'])?$data['restaurant_name']:""
                                    ,array(
                                    'class'=>'grey-fields full-width form-control',
                                    'data-validation'=>"required"
                                ))?>
                            </div>
                            <?php if ( getOptionA('merchant_reg_abn')=="yes"):?>
                                <div class="form-group">
                                    <label>
                                        <?php echo t("ABN")?>
                                    </label>
                                    <?php echo CHtml::textField('abn',
                                        isset($data['restaurant_name'])?$data['abn']:""
                                        ,array(
                                        'class'=>'grey-fields full-width form-control',
                                        'data-validation'=>"required"
                                    ))?>
                                </div>
                            <?php endif; ?>
                            <div class="form-group">
                                <label>
                                    <?php echo t("Restaurant phone")?>
                                </label>
                                <?php echo CHtml::textField('restaurant_phone',
                                    isset($data['restaurant_phone'])?$data['restaurant_phone']:""
                                    ,array(
                                    'class'=>'grey-fields full-width form-control',
                                ))?>
                            </div>
                            <div class="form-group">
                                <label>
                                    <?php echo t("Contact name")?>
                                </label>
                                <?php echo CHtml::textField('contact_name',
                                    isset($data['contact_name'])?$data['contact_name']:""
                                    ,array(
                                    'class'=>'grey-fields full-width form-control',
                                    'data-validation'=>"required"
                                ))?>
                            </div>
                            <div class="form-group">
                                <label>
                                    <?php echo t("Contact phone")?>
                                </label>
                                <?php echo CHtml::textField('contact_phone',
                                    isset($data['contact_phone'])?$data['contact_phone']:""
                                    ,array(
                                    'class'=>'grey-fields full-width mobile_inputs form-control',
                                    'data-validation'=>"required"
                                ))?>
                            </div>
                            <div class="form-group">
                                <label>
                                    <?php echo t("Contact email")?>
                                </label>
                                <?php echo CHtml::textField('contact_email',
                                    isset($data['contact_email'])?$data['contact_email']:""
                                    ,array(
                                    'class'=>'grey-fields full-width form-control',
                                    'data-validation'=>"email"
                                ))?>
                            <p class="text-muted text-small"><?php echo t("Important: Please enter your correct email. we will sent an activation code to your email")?></p>
                            </div>
                            <div class="form-group">
                                <label>
                                    <?php echo t("Street address")?>
                                </label>
                                <?php echo CHtml::textField('street',
                                    isset($data['street'])?$data['street']:""
                                    ,array(
                                    'class'=>'grey-fields full-width form-control',
                                    'data-validation'=>"required"
                                ))?>
                            </div>
                            <div class="form-group">
                                <label>
                                    <?php echo t("City")?>
                                </label>
                                <?php echo CHtml::textField('city',
                                    isset($data['city'])?$data['city']:""
                                    ,array(
                                    'class'=>'grey-fields full-width form-control',
                                    'data-validation'=>"required"
                                ))?>
                            </div>
                            <div class="form-group">
                                <label>
                                    <?php echo t("Post code/Zip code")?>
                                </label>
                                <?php echo CHtml::textField('post_code',
                                    isset($data['post_code'])?$data['post_code']:""
                                    ,array(
                                    'class'=>'grey-fields full-width form-control',
                                    'data-validation'=>"required"
                                ))?>
                            </div>
                            <div class="form-group">
                                <label>
                                    <?php echo t("Country")?>
                                </label>
                                <?php echo CHtml::dropDownList('country_code',
                                    getOptionA('merchant_default_country'),
                                    (array)Yii::app()->functions->CountryListMerchant(),          
                                    array(
                                    'class'=>'grey-fields full-width form-control',
                                    'data-validation'=>"required"
                                ))?> 
                            </div>
                            <div class="form-group">
                                <label>
                                    <?php echo t("State/Region")?>
                                </label>
                                <?php echo CHtml::textField('state',
                                    isset($data['state'])?$data['state']:""
                                    ,array(
                                    'class'=>'grey-fields full-width form-control',
                                    'data-validation'=>"required"
                                ))?>
                            </div>
                            <div class="form-group">
                                <label>
                                    <?php echo t("Cuisine")?>
                                </label>
                                <?php 
                                    $cuisine_list=Yii::app()->functions->Cuisine(true);
                                    $cuisine_1='';
                                    if ( Yii::app()->functions->multipleField()==2){
                                            foreach ($cuisine_list as $cuisine_id=>$val) {
                                                     $cuisine_info=Yii::app()->functions->GetCuisine($cuisine_id);
                                                     $cuisine_json['cuisine_name_trans']=!empty($cuisine_info['cuisine_name_trans'])?
                                             json_decode($cuisine_info['cuisine_name_trans'],true):'';
                                             $cuisine_1[$cuisine_id]=qTranslate($val,'cuisine_name',$cuisine_json);
                                            }
                                            $cuisine_list=$cuisine_1;
                                    }
                                    echo CHtml::dropDownList('cuisine[]',
                                    isset($data['cuisine'])?(array)json_decode($data['cuisine']):"",
                                    (array)$cuisine_list,          
                                    array(
                                    'class'=>'full-width chosen form-control',
                                    'multiple'=>true,
                                    'data-validation'=>"required"  
                                ))?>
                            </div>
                            <div class="form-group">
                                <label>
                                    <?php echo t("Services Pick Up or Delivery?")?>
                                </label>
                                <?php echo CHtml::dropDownList('service',
                                    isset($data['service'])?$data['service']:"",
                                    (array)Yii::app()->functions->Services(),          
                                    array(
                                    'class'=>'grey-fields full-width form-control',
                                    'data-validation'=>"required"
                                ))?>
                            </div>
                            <br>
                            <h4>
                                <?php echo t('Login Information');?>
                            </h4>
                            <div class="form-group">
                                <label>
                                    <?php echo t("Username")?>
                                </label>
                                <?php echo CHtml::textField('username',
                                    ''
                                    ,array(
                                    'class'=>'grey-fields full-width form-control',
                                    'data-validation'=>"required"
                                ))?>
                            </div>
                            <div class="form-group">
                                <label>
                                    <?php echo t("Password")?>
                                </label>
                                <?php echo CHtml::passwordField('password',
                                    ''
                                    ,array(
                                    'class'=>'grey-fields full-width form-control',
                                    'data-validation'=>"required"
                                ))?>
                            </div>
                            <div class="form-group">
                                <label>
                                    <?php echo t("Confirm Password")?>
                                </label>
                                <?php echo CHtml::passwordField('cpassword',
                                    ''
                                    ,array(
                                    'class'=>'grey-fields full-width form-control',
                                    'data-validation'=>"required"
                                ))?>
                            </div>
                            <?php if ($kapcha_enabled==2):?>      
                                <div class="top10 capcha-wrapper">        
                                    <div id="kapcha-1"></div>
                                </div>
                            <?php endif;?>
                            <?php if ( $terms_merchant=="yes"):?>
                                <?php $terms_link=Yii::app()->functions->prettyLink($terms_merchant_url);?>
                            <?php 
                                echo CHtml::checkBox('terms_n_condition',false,array(
                                 'value'=>2,
                                 'class'=>"icheck",
                                 'data-validation'=>"required"
                                ));
                                echo " ". t("I Agree To")." <a href=\"$terms_link\" target=\"_blank\">".t("The Terms & Conditions")."</a>";
                            ?>
                            <?php endif; ?>
                            <input type="submit" value="<?php echo t("Next")?>" class="orange-button inline medium btn_full_outline">
                        </form>

                    <?php else :?>
                        <p class="text-danger"><?php echo t("Sorry but we cannot find what you are looking for.")?></p>
                    <?php endif;?>
                </div>
            </div>
            <div class="col-md-4" id="sidebar">
            	<div class="theiaStickySidebar">
                    <div id="cart_box">
                        <h3>
                            <?php echo t("Selected Package")?>
                        </h3>
                        <?php 
                            $p_list='';
                            if (is_array($package_list) && count($package_list)>=1){
                                    foreach ($package_list as $val) {
                                            $p_list[$val['package_id']]=$val['title'];
                                    }
                            }    
                            echo CHtml::hiddenField('change_package_url',
                               Yii::app()->createUrl('/store/merchantsignup?do=step2&package_id=')
                            ) ;
                        ?>
                        <div class="payment_select">
                            <p>
                                <strong>
                                    <?php echo $data['title']?>
                                    <?php if ( $data['promo_price']>=1):?>
                                        <?php echo FunctionsV3::prettyPrice($data['price'])?>
                                        (<?php echo FunctionsV3::prettyPrice($data['promo_price'])?>)
                                    <?php else :?>
                                        <?php echo FunctionsV3::prettyPrice($data['price'])?>
                                    <?php endif;?>
                                </strong>
                                <?php //echo t('per month'); ?>
                            </p>
                            <p>
                                <?php echo t("Membership Limit")?>: 
                                <strong>
                                    <?php if ( $data['expiration_type']=="year"):?>
                                        <?php echo $data['expiration']/365?> <?php echo Yii::t("default",ucwords($data['expiration_type']))?>
                                    <?php else :?>
                                        <?php echo $data['expiration']?> <?php echo Yii::t("default",ucwords($data['expiration_type']))?>
                                    <?php endif;?>
                                </strong>
                            </p>
                            <p>
                                <?php echo t("Usage")?>:
                                <strong>
                                    <?php if ( $data['unlimited_post']==2):?>
                                        <?php echo $limit_post[$data['unlimited_post']]?>
                                    <?php else :?>
                                        <?php echo $limit_post[$data['unlimited_post']] . " (".$data['post_limit']." item )"?>
                                    <?php endif;?>
                                </strong>
                            </p>
                        </div>
                        <div class="form-group">
                            <label>
                                <?php echo ('Change Package'); ?>
                            </label>
                            <?php 
                                echo CHtml::dropDownList('change_package',
                                isset($_GET['package_id'])?$_GET['package_id']:''
                                ,(array)$p_list,array(
                                  'class'=>'grey-fields full-width form-control',
                                ));
                            ?>
                        </div>
                        <a href="<?php echo Yii::app()->createUrl('/store/merchantsignup')?>" class="black-button inline medium btn_full">
                            <i class="ion-ios-arrow-thin-left"></i> <?php echo t("Back")?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 

$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();

$cs->registerCss('intl-tel-input', 
        '.intl-tel-input {'
        . ' display: block !important'
        . '}');

?>
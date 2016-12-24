<?php
$this->renderPartial('/front/quickfood/banner-receipt',array(
    'h1'=>t("Restaurant Signup"),
    'sub_text'=>t("step 2 of 4"),
    'step'=>2,
    'show_bar'=>true
));

/*PROGRESS ORDER BAR*/
/*$this->renderPartial('/front/progress-merchantsignup',array(
   'step'=>2,
   'show_bar'=>true
));
*/
?>


<div class="white_bg">
    <div class="container margin_60_35">
        <div class="row">
            <div class="col-md-8">
                <div class="box_style_2">
                    <form class="forms" id="forms" onsubmit="return false;">
                        <?php echo CHtml::hiddenField('action','merchantSignUp2')?>
                        <?php echo CHtml::hiddenField('currentController','store')?>
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
                </div>
            </div>
        </div>
    </div>
</div>
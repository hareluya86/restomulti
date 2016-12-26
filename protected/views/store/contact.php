<?php
$this->renderPartial('/front/quickfood/banner-contact',array(
   'h1'=>t("Contact Us"),
   'sub_text'=>$address." ".$country,
   'contact_phone'=>$contact_phone,
   'contact_email'=>$contact_email
));

$this->renderPartial('/layouts/quickfood/front_top_menu',array(
  'action'=>Yii::app()->controller->action->id,
  'theme_hide_logo'=>getOptionA('theme_hide_logo')
));

$fields=yii::app()->functions->getOptionAdmin('contact_field');
if (!empty($fields)){
	$fields=json_decode($fields);
}
?>

<div class="container margin_60_35">
    <div class="main_title margin_mobile">
        <h2 class="nomargin_top"><?php echo t("Contact")." $website_title";?> </h2>
        <p>
            <?php echo t("We are always happy to hear from our clients and visitors, you may contact us anytime")?>
        </p>
        <p>
            <?php echo $contact_content?>
        </p>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3 wow fadeIn" data-wow-delay="0.1s">
            <div class="feature_2">
                <i class="icon_mail_alt"></i>
                <form class="uk-form uk-form-horizontal forms" id="forms" onsubmit="return false;">   
                    <?php echo CHtml::hiddenField('action','contacUsSubmit')?>
                    <?php echo CHtml::hiddenField('currentController','store')?>
                    <?php FunctionsV3::addCsrfToken();?>
                    <?php if (is_array($fields) && count($fields)>=1):?>
                        <?php foreach ($fields as $val):?>
                            <?php  
                                $placeholder='';
                                $validate_default="required";
                                switch ($val) {
                                      case "name":
                                              $placeholder="Name";
                                              break;
                                      case "email":  
                                          $placeholder="Email address";
                                          $validate_default="email";
                                              break;
                                      case "phone":  
                                          $placeholder="Phone";
                                              break;
                                      case "country":  
                                          $placeholder="Country";
                                              break;
                                      case "message":  
                                          $placeholder="Message";
                                              break;	  	
                                      default:
                                              break;
                                }
                            ?>
                            <?php if ( $val=="message"):?>
                                <div class="form-group">
                                    <?php echo CHtml::textArea($val,'',array(
                                        'placeholder'=>t($placeholder),
                                        'class'=>'grey-fields full-width form-control'
                                    ))?>
                                </div>
                            <?php else :?>
                                <div class="form-group">
                                    <?php echo CHtml::textField($val,'',array(
                                        'placeholder'=>t($placeholder),
                                        'class'=>'grey-fields full-width form-control',
                                        'data-validation'=>$validate_default
                                    ))?>
                                </div>
                            <?php endif;?>
                        <?php endforeach;?>
                        <div class="form-group">
                            <input type="submit" value="<?php echo t("Submit")?>" class="orange-button medium inline rounded btn_full">
                        </div>
                    <?php endif;?>
                </form>
            </div>
        </div>
    </div>
</div> <!--container-->
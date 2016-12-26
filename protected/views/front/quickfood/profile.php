
<div class="indent_title_in">
    <i class="icon_profile"></i>
    <h3><?php echo t("Profile")?></h3>
    <p>Partem diceret praesent mel et, vis facilis alienum antiopam ea, vim in sumo diam sonet. Illud ignota cum te, decore elaboraret nec ea. Quo ei graeci repudiare definitionem. Vim et malorum ornatus assentior, exerci elaboraret eum ut, diam meliore no mel.</p>
</div>


<form class="profile-forms forms" id="forms" onsubmit="return false;">
<?php echo CHtml::hiddenField('action','updateClientProfile')?>
<?php echo CHtml::hiddenField('currentController','store')?>
<?php 
$p = new CHtmlPurifier();
FunctionsV3::addCsrfToken();
?>

<?php //FunctionsV3::sectionHeader('Profile');?>

    <div class="wrapper_indent">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo t("First Name")?></label>
                    <?php 
                        echo CHtml::textField('first_name',$p->purify($data['first_name']),
                        array(
                          'class'=>'grey-fields full-width form-control',
                          'data-validation'=>"required"
                        ));
                    ?>     
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo t("Last Name")?></label>
                    <?php 
                        echo CHtml::textField('last_name', $p->purify($data['last_name']),
                        array(
                        'class'=>'grey-fields full-width form-control',
                        'data-validation'=>"required"
                        ));
                    ?>     
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo t("Email address")?></label>
                    <?php 
                        echo CHtml::textField('email', $p->purify($data['email_address']),
                        array(
                          'class'=>'grey-fields full-width form-control',
                          'data-validation'=>"required",
                          'disabled'=>true
                        ));
                    ?>      
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo t("Contact phone")?></label>
                    <?php 
                        echo CHtml::textField('contact_phone',$p->purify($data['contact_phone']),
                        array(
                          'class'=>'grey-fields full-width mobile_inputs form-control',
                          'data-validation'=>"required"
                        ));
                    ?>
                </div>
            </div>
        </div>
        <div class="row">

            <?php 
                $one=Yii::app()->functions->getOptionAdmin('client_custom_field_name1');
                $two=Yii::app()->functions->getOptionAdmin('client_custom_field_name2');
            ?>
            <?php if (!empty($one) || !empty($two)):?>
                <?php if (!empty($one)):?>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo t($one)?></label>
                            <?php 
                                echo CHtml::textField('custom_field1',$p->purify($data['custom_field1']),
                                array(
                                  'class'=>'grey-fields full-width form-control',
                                  'data-validation'=>"required"
                                ));
                            ?>
                        </div>
                    </div>   
                <?php endif;?>
                <?php if (!empty($two)):?>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo t($two)?></label>
                            <?php 
                                echo CHtml::textField('custom_field2',$p->purify($data['custom_field2']),
                                array(
                                  'class'=>'grey-fields full-width form-control',
                                  'data-validation'=>"required"
                                ));
                            ?>
                        </div>
                    </div>
                <?php endif;?>
            <?php endif;?>
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo t("Password")?></label>
                    <?php 
                        echo CHtml::passwordField('password','',
                        array(
                          'class'=>'grey-fields full-width form-control',
                        ));
                    ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo t("Confirm Password")?></label>
                    <?php 
                        echo CHtml::passwordField('cpassword','',
                        array(
                          'class'=>'grey-fields full-width form-control',
                        ));
                    ?>
                </div>
            </div>
            <div class="col-md-12">
                <input type="submit" value="<?php echo t("Save")?>" class="green-button medium btn_1">  
            </div>
        </div>
    </div>
</form>

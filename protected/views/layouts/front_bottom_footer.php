<!-- Footer ================================================== -->
<footer>
    <div class="container">
        <div class="row">
            <!--<div class="col-md-3 col-sm-3">
                <h3>&nbsp;</h3>
                <?php FunctionsV3::getFooterAddress(); ?>
            </div>-->
            
            <div class="col-md-4 col-sm-4">
                <!--CUISINE SECTIONS-->
                <h3><?php echo t("Browse by cuisine")?></h3>
                <?php if ($theme_hide_cuisine<>2):?>
                    <?php if ( $list=FunctionsV3::getCuisine() ): ?>
                        <ul>
                            <!--<img src="img/cards.png" alt="" class="img-responsive">-->
                            <?php $x=1;?>
                            <?php foreach ($list as $val): ?>
                            <li>
                                <?php if($val['total']>0): ?>
                                <a href="<?php echo Yii::app()->createUrl('/store/cuisine',array("category"=>$val['cuisine_id']))?>">
                                    <?php 
                                    $cuisine_json['cuisine_name_trans']=!empty($val['cuisine_name_trans'])?json_decode($val['cuisine_name_trans'],true):'';	 
                                    echo qTranslate($val['cuisine_name'],'cuisine_name',$cuisine_json);
                                    if($val['total']>0){
                                      echo "<span>(".$val['total'].")</span>";
                                    }
                                    ?>
                                </a>
                                <?php else: ?>
                                    <span>
                                        <?php echo qTranslate($val['cuisine_name'],'cuisine_name',$cuisine_json);?>
                                    </span>
                                <?php endif; ?>
                            </li>
                            <?php $x++;?>
                            <?php endforeach;?>
                        </ul>
                    <?php endif;?>
                <?php endif;?>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <?php if (true && $theme_hide_footer_section1!=2):?>
                            <?php if (is_array($menu) && count($menu)>=1):?>
                                <h3><?php echo t("Menu")?></h3>
                                <ul>
                                    <?php foreach ($menu as $val):?>
                                        <li>
                                            <a href="<?php echo FunctionsV3::customPageUrl($val)?>" 
                                                <?php FunctionsV3::openAsNewTab($val)?> >
                                               <?php echo $val['page_name']?>
                                            </a>
                                        </li>
                                    <?php endforeach;?>
                                </ul>
                            <?php endif;?>
                        <?php endif;?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <?php if (true && $theme_hide_footer_section1!=2):?>
                            <?php if (is_array($others_menu) && count($others_menu)>=1):?>
                                <h3><?php echo t("Others")?></h3>
                                <ul>
                                    <?php foreach ($others_menu as $val):?>
                                        <li>
                                            <a href="<?php echo FunctionsV3::customPageUrl($val)?>" 
                                                <?php FunctionsV3::openAsNewTab($val)?> >
                                                <?php echo $val['page_name']?>
                                            </a>
                                        </li>
                                    <?php endforeach;?>
                                </ul>
                            <?php endif;?>
                        <?php endif;?>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="row">
                    <?php if ( getOptionA('disabled_subscription') == ""):?>
                        <div class="col-md-12 col-sm-12" id="newsletter">
                            <p>
                                <?php echo t("Subscribe to our newsletter") ?>
                            </p>
                                <div id="message-newsletter_2">
                            </div>
                            <form method="POST" id="frm-subscribe" class="frm-subscribe" onsubmit="return false;">
                                <?php echo CHtml::hiddenField('action','subscribeNewsletter')?>
                                <div class="form-group">
                                    <!--<input name="email_newsletter_2" id="email_newsletter_2" type="email" value="" placeholder="Your mail" class="form-control">-->
                                    <?php echo CHtml::textField('subscriber_email','',array(
                                        'placeholder'=>t("Your mail"),
                                        'required'=>true,
                                        'class'=>"form-control"
                                    ))?>
                                </div>
                                <input type="submit" value="Subscribe" class="btn_1" id="submit-newsletter_2">
                            </form>
                        </div>
                    <?php endif;?>
                    <?php if ($show_language <> 1) :?>
                        <?php if ($theme_lang_pos == "bottom" || $theme_lang_pos == "") :?>
                            <div class="col-md-12 col-sm-12">
                                <h3><?php echo t("Language")?></h3>
                                <div class="styled-select">
                                    <?php echo CHtml::dropDownList('language-options', $_COOKIE['kr_lang_id'], (array) FunctionsV3::getLanguage()
                                            , array(
                                        'class' => "form-control",// language-options selectpicker",
                                        'title' => t("Select language")
                                    ));?>

                                </div>
                            </div>
                        <?php endif;?>
                    <?php endif;?>
                </div>
            </div>
        </div><!-- End row -->
        <div class="row">
            <div class="col-md-12">
                <div id="social_footer">
                    <ul>
                        <?php if (!empty($google_page)):?>
                            <li>
                                <a target="_blank" href="<?php echo FunctionsV3::prettyUrl($google_page)?>">
                                    <i class="icon-google"></i>
                                </a>
                            </li>
                        <?php endif;?>
                        <?php if (!empty($twitter_page)):?>
                            <li>
                                <a target="_blank" href="<?php echo FunctionsV3::prettyUrl($twitter_page)?>">
                                    <i class="icon-twitter"></i>
                                </a>
                            </li>
                        <?php endif;?>
                        <?php if (!empty($fb_page)):?>
                            <li>
                                <a target="_blank" href="<?php echo FunctionsV3::prettyUrl($fb_page)?>">
                                    <i class="icon-facebook"></i>
                                </a>
                            </li>
                        <?php endif;?>
                        <?php if (!empty($intagram_page)):?>
                            <li>
                                <a target="_blank" href="<?php echo FunctionsV3::prettyUrl($intagram_page)?>">
                                    <i class="icon-instagram"></i>
                                </a>
                            </li>
                        <?php endif;?>
                        <?php if (!empty($youtube_url)):?>
                            <li>
                                <a target="_blank" href="<?php echo FunctionsV3::prettyUrl($youtube_url)?>">
                                    <i class="icon-youtube-play"></i>
                                </a>
                            </li>
                        <?php endif;?>
                    </ul>
                    <p>
                        © Vincent Lee 2016
                    </p>
                </div>
            </div>
        </div><!-- End row -->
    </div><!-- End container -->
</footer>
<!-- End Footer =============================================== -->
<?php if(false): ?>
<?php if (getOptionA('disabled_subscription') == ""): ?>
    <form method="POST" id="frm-subscribe" class="frm-subscribe" onsubmit="return false;">
        <?php echo CHtml::hiddenField('action', 'subscribeNewsletter') ?>
        <div class="sections section-subcribe">
            <div class="container">
                <h2><?php echo t("Subscribe to our newsletter") ?></h2>
                <div class="subscribe-footer">
                    <div class="row border">
                        <div class="col-md-3 border col-md-offset-4 ">
                            <?php
                            echo CHtml::textField('subscriber_email', '', array(
                                'placeholder' => t("E-mail"),
                                'required' => true,
                                'class' => "email"
                            ))
                            ?>
                        </div>
                        <div class="col-md-2 border">
                            <button class="green-button rounded">
    <?php echo t("Subscribe") ?>
                            </button>               
                        </div>
                    </div>
                </div>
            </div>


            <img src="<?php echo assetsURL() . "/images/divider.png" ?>" class="footer-divider">

        </div> <!--section-browse-resto-->
    </form>
<?php endif; ?>


<div class="sections section-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4 ">
                <?php FunctionsV3::getFooterAddress(); ?>

                <?php
                if ($show_language <> 1) : ?>
                    <?php if ($theme_lang_pos == "bottom" || $theme_lang_pos == ""):?>
                        <h3><?php echo t("Language")?></h3>
                        <?php echo CHtml::dropDownList('language-options', '', (array) FunctionsV3::getLanguage()
                                , array(
                            'class' => "language-options selectpicker",
                            'title' => t("Select language")
                        )); ?>
                    <?php endif; ?>
                
                <?php endif; ?>

            </div> <!--col-->


            <div class="col-md-3 border">
<?php if ($theme_hide_footer_section1 != 2): ?>
                    <h3><?php echo t("Menu") ?></h3>

                    <?php if (is_array($menu) && count($menu) >= 1): ?>
        <?php foreach ($menu as $val): ?>
                            <li>
                                <a 
                                    href="<?php echo FunctionsV3::customPageUrl($val) ?>" <?php FunctionsV3::openAsNewTab($val) ?> >
                            <?php echo $val['page_name'] ?></a>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>

<?php endif; ?>
            </div> <!--col-->

            <div class="col-md-3 border">
<?php if ($theme_hide_footer_section2 != 2): ?>
                    <h3><?php echo t("Others") ?></h3>

                    <?php if (is_array($others_menu) && count($others_menu) >= 1): ?>
        <?php foreach ($others_menu as $val): ?>
                            <li>
                                <a 
                                    href="<?php echo FunctionsV3::customPageUrl($val) ?>" <?php FunctionsV3::openAsNewTab($val) ?> >
                            <?php echo $val['page_name'] ?></a>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>

<?php endif; ?>  
            </div> <!--col-->

<?php if ($social_flag <> 1): ?>
                <div class="col-md-2 border">
                    <h3><?php echo t("Connect with us") ?></h3>

                    <div class="mytable social-wrap">
    <?php if (!empty($google_page)): ?>
                            <div class="mycol border">
                                <a target="_blank" href="<?php echo FunctionsV3::prettyUrl($google_page) ?>"><i class="icon-google"></i></a>
                            </div> <!--col-->
                        <?php endif; ?>

    <?php if (!empty($twitter_page)): ?>
                            <div class="mycol border">
                                <a target="_blank" href="<?php echo FunctionsV3::prettyUrl($twitter_page) ?>"><i class="icon-twitter"></i></a>
                            </div> <!--col-->
                        <?php endif; ?>

    <?php if (!empty($fb_page)): ?>
                            <div class="mycol border">
                                <a target="_blank" href="<?php echo FunctionsV3::prettyUrl($fb_page) ?>"><i class="icon-facebook"></i></a>
                            </div> <!--col-->
    <?php endif; ?>


    <?php if (!empty($intagram_page)): ?>
                            <div class="mycol border">
                                <a target="_blank" href="<?php echo FunctionsV3::prettyUrl($intagram_page) ?>"><i class="icon-instagram"></i></a>
                            </div> <!--col-->
                        <?php endif; ?>

    <?php if (!empty($youtube_url)): ?>
                            <div class="mycol border">
                                <a target="_blank" href="<?php echo FunctionsV3::prettyUrl($youtube_url) ?>"><i class="icon-youtube-play"></i></a>
                            </div> <!--col-->
    <?php endif; ?>

                    </div> <!--social wrap-->

                </div> <!--col-->
<?php endif; ?>

        </div> <!--row-->
    </div> <!--container-->
</div> <!--section-footer-->
<?php endif; ?>
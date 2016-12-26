<?php
$this->renderPartial('/front/quickfood/banner-receipt',array(
    'h1'=>t("Profile"),
    'sub_text'=>t("Manage your profile,address book, credit card and more"),
    'step' => '',
    'show_bar' => false
));
echo CHtml::hiddenField('mobile_country_code',Yii::app()->functions->getAdminCountrySet(true));

$this->renderPartial('/layouts/quickfood/front_top_menu',array(
  'action'=>Yii::app()->controller->action->id,
  'theme_hide_logo'=>getOptionA('theme_hide_logo')
));

?>

<!-- Content ================================================== -->
<div class="container margin_60">
    <div id="tabs" class="tabs">
        <nav>
            <ul>
                <li>
                    <a href="#profile" class="<?php echo $tabs==""?"active":''?>">
                        <i class="icon_profile"></i>
                        <span><?php echo t("Profile")?></span>
                    </a>
                </li>
                <li>
                    <a href="#address" >
                        <i class="icon_house"></i>
                        <span><?php echo t("Address Book")?></span>
                    </a>
                </li>
                <li>
                    <a href="#order">
                        <i class="icon_book"></i>
                        <span><?php echo t("Order History")?></span>
                    </a>
                </li>
                <?php if ( $disabled_cc != "yes"):?>
                    <li>
                        <a href="#creditcard">
                            <i class="icon_creditcard"></i>
                            <span><?php echo t("Credit Cards")?></span>
                        </a>
                    </li>
                <?php endif;?>
            </ul>
        </nav>
        <div class="content">
            <section id="profile">
                <?php $this->renderPartial('/front/quickfood/profile',array(
                    'data'=>$info           
                ));?>
            </section>
            <section id="address">
                <?php $this->renderPartial('/front/quickfood/address-book',array(
                    'client_id'=>Yii::app()->functions->getClientId(),
                    'data'=>Yii::app()->functions->getAddressBookByID( isset($_GET['id'])?$_GET['id']:'' ),
                    'tabs'=>$tabs
                ));?>
            </section>
            <section id="order">
                <?php $this->renderPartial('/front/quickfood/order-history',array(           
                    'data'=>Yii::app()->functions->clientHistyOrder( Yii::app()->functions->getClientId() )
                ));?>
            </section>
            <?php if ( $disabled_cc != "yes"):?>
                <section id="creditcard">
                    <?php 
                        if (isset($_GET['do']) && $tabs == 4){
                                $this->renderPartial('/front/manage-credit-card-add',array(
                                  'data'=>Yii::app()->functions->getCreditCardInfo(isset($_GET['id'])?$_GET['id']:''),
                                  'tabs'=>$tabs
                                ));
                        } else {
                                    $this->renderPartial('/front/manage-credit-card',array(
                                      'tabs'=>$tabs
                                    ));
                        }
                    ?>
                </section>
            <?php endif;?>
        </div>
    </div>
</div>
<?php //page-specific js and css files
$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();

$cs->registerCssFile($baseUrl . '/assets/css/quickfood/skins/square/grey.css');
$cs->registerCssFile($baseUrl . '/assets/css/quickfood/admin.css');
$cs->registerCssFile($baseUrl . '/assets/css/quickfood/bootstrap3-wysihtml5.min.css');
$cs->registerCssFile($baseUrl . '/assets/css/quickfood/dropzone.css');

$cs->registerScriptFile($baseUrl . "/assets/js/quickfood/tabs.js"
                , CClientScript::POS_END);
$cs->registerScriptFile($baseUrl . "/assets/js/quickfood/bootstrap3-wysihtml5.min.js"
                , CClientScript::POS_END);
$cs->registerScript('tabs', 
        'new CBPFWTabs(document.getElementById(\'tabs\'));'
        , CClientScript::POS_END);
$cs->registerScript('wysihtml5', 
        '$(\'.wysihtml5\').wysihtml5({});'
        , CClientScript::POS_END);

$cs->registerScriptFile($baseUrl . "/assets/js/quickfood/dropzone.js"
                , CClientScript::POS_END);

$cs->registerScript('dropzone', 
        'if ($(\'.dropzone\').length > 0) {
                Dropzone.autoDiscover = false;
                $("#photos").dropzone({
                        url: "upload",
                        addRemoveLinks: true
                });

                $("#logo_picture").dropzone({
                        url: "upload",
                        maxFiles: 1,
                        addRemoveLinks: true
                });

                $(".menu-item-pic").dropzone({
                        url: "upload",
                        maxFiles: 1,
                        addRemoveLinks: true
                });
        }'
        , CClientScript::POS_END);

$cs->registerCss('intl-tel-input', 
        '.intl-tel-input {'
        . ' display: block !important'
        . '}');
?>
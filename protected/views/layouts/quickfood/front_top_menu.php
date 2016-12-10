<!--[if lte IE 8]>
        <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a>.</p>
    <![endif]-->

<div id="preloader">
    <div class="sk-spinner sk-spinner-wave" id="status">
        <div class="sk-rect1"></div>
        <div class="sk-rect2"></div>
        <div class="sk-rect3"></div>
        <div class="sk-rect4"></div>
        <div class="sk-rect5"></div>
    </div>
</div><!-- End Preload -->

<!-- Header ================================================== -->
<header id="header" >
    <div class="container-fluid">
        <div class="row">
            <div class="col--md-4 col-sm-4 col-xs-4">
                <?php if ($theme_hide_logo <> 2): ?>
                    <a href="<?php echo Yii::app()->createUrl('/store') ?>">
                        <img src="<?php echo FunctionsV3::getDesktopLogo(); ?>" width="190" height="23" alt="" data-retina="true" class="hidden-xs">
                        <img src="<?php echo FunctionsV3::getMobileLogo(); ?>" width="59" height="23" alt="" data-retina="true" class="hidden-lg hidden-md hidden-sm">
                    </a>
                <?php endif; ?>
            </div>
            <nav class="col--md-8 col-sm-8 col-xs-8">
                <a class="cmn-toggle-switch cmn-toggle-switch__htx open_close" href="javascript:void(0);"><span>Menu mobile</span></a>
                <div class="main-menu">
                    <div id="header_menu">
                        <img src="img/logo.png" width="190" height="23" alt="" data-retina="true">
                    </div>
                    <a href="#" class="open_close" id="close_in"><i class="icon_close"></i></a>
                    <?php $this->widget('zii.widgets.CMenu', FunctionsV3::getMenu()); ?> 
                    <!--<ul>
                        <li class="submenu">
                        <a href="javascript:void(0);" class="show-submenu">Home<i class="icon-down-open-mini"></i></a>
                        <ul>
                            <li><a href="index.html">Home Video background</a></li>
                            <li><a href="index_2.html">Home Static image</a></li>
                            <li><a href="index_3.html">Home Text rotator</a></li>
                            <li><a href="index_8.html">Home Layer slider</a></li>
                            <li><a href="index_4.html">Home Cookie bar</a></li>
                            <li><a href="index_5.html">Home Popup</a></li>
                            <li><a href="index_6.html">Home Mobile synthetic</a></li>
                            <li><a href="index_7.html">Top Menu version 2</a></li>
                        </ul>
                        </li>
                        <li class="submenu">
                        <a href="javascript:void(0);" class="show-submenu">Restaurants<i class="icon-down-open-mini"></i></a>
                        <ul>
                            <li><a href="list_page.html">Row listing</a></li>
                            <li><a href="grid_list.html">Grid listing</a></li>
                            <li><a href="map_listing.html">Map listing</a></li>
                        </ul>
                        </li>
                        <li><a href="about.html">About us</a></li>
                        <li><a href="faq.html">Faq</a></li>
                        <li class="submenu">
                        <a href="javascript:void(0);" class="show-submenu">Pages<i class="icon-down-open-mini"></i></a>
                        <ul>
                            <li><a href="detail_page.html">Restaurant Menu</a></li>
                            <li><a href="cart.html">Order step 1</a></li>
                            <li><a href="cart_2.html">Order step 2</a></li>
                            <li><a href="cart_3.html">Order step 3</a></li>
                            <li><a href="cart_datepicker.html">Order Date/Time picker</a></li>
                            <li><a href="detail_page_2.html">Restaurant detail page</a></li>
                            <li><a href="blog.html">Blog</a></li>
                            <li><a href="grid_list.html">Grid list</a></li>
                            <li><a href="contacts.html">Contacts</a></li>
                            <li><a href="coming_soon/index.html">Coming soon page</a></li>
                            <li><a href="shortcodes.html">Shortcodes</a></li>
                            <li><a href="icon_pack_1.html">Icon pack 1</a></li>
                            <li><a href="icon_pack_2.html">Icon pack 2</a></li>
                        </ul>
                        </li>
                        <li><a href="#0" data-toggle="modal" data-target="#login_2">Login</a></li>
                        <li><a href="#0">Purchase this template</a></li>
                    </ul>-->

                </div><!-- End main-menu -->
            </nav>
        </div><!-- End row -->
    </div><!-- End container -->
</header>
<!-- End Header =============================================== -->

<!-- End SubHeader ============================================ -->

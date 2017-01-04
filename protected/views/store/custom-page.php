<?php
$this->renderPartial('/front/quickfood/banner-receipt',array(
    'h1'=>$data['page_name'],
    'step'=>'',
    'show_bar'=>false
));

//$config = HTMLPurifier_Config::createDefault();
//$config->set('Attr.EnableID',true);
//  $def = $config->getHTMLDefinition(true);
//$def->info_global_attr['data-toggle'] = new HTMLPurifier_AttrDef_Text;
//$def->
//$p = new CHtmlPurifier();
//$p->setOptions($config);

/* Render top menu */
$this->renderPartial('/layouts/quickfood/front_top_menu', array(
    'action' => Yii::app()->controller->action->id,
    'theme_hide_logo' => getOptionA('theme_hide_logo')
));
?>

<div class="sections section-grey2 section-custom-page" id="section-custom-page">  
   <?php echo $data['content'];//$p->purify(stripslashes($data['content']))?>
</div> <!--sections-->

<?php 
    //Additional scripts for FAQ page only
$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();

$cs->registerScript('stick-sidebar',
      "jQuery('#sidebar').theiaStickySidebar({
        additionalMarginTop: 80
      });",CClientScript::POS_END);
$cs->registerScript('faq_box',
      "             $('#faq_box a[href^=\"#\"]').on('click', function (e) {
			e.preventDefault();
			var target = this.hash;
			var \$target = $(target);
			$('html, body').stop().animate({
				'scrollTop': \$target.offset().top - 120
			}, 900, 'swing', function () {
				window.location.hash = target;
			});
		});",CClientScript::POS_END);

?>
<?php 

if(!empty($cookie_msg_text)){
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    
    $cs->registerCssFile($baseUrl . '/assets/css/quickfood/jquery.cookiebar.css');
    $cs->registerScriptFile($baseUrl . '/assets/js/quickfood/jquery.cookiebar.js',CClientScript::POS_END);
    $cs->registerScript('cookiebar', 
            "$(document).ready(function(){
		'use strict';
		 $.cookieBar({
                    fixed: true,
                    acceptText: '".$cookie_accept_text."',
                    message: '".$cookie_msg_text."',
                    policyText: '".$cookie_info_text."',
                    policyURL: '".FunctionsV3::prettyUrl($cookie_info_link)."'
		});
            });");
}
?>

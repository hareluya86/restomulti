<?php
if (false) {
    $this->renderPartial('/front/default-header', array(
        'h1'=>t("Restaurant  by cuisine"),
        'sub_text'=>t("choose from your favorite restaurant")
    ));
}
?>

<!--TOP MENU-->
<?php
$this->renderPartial('/layouts/quickfood/front_top_menu', array(
    'action' => Yii::app()->controller->action->id,
    'theme_hide_logo' => getOptionA('theme_hide_logo')
));
?>

<!--MAIN CONTENT-->
<?php 
    if (is_array($list['list']) && count($list['list']) >= 1) {
        if($tabs == 1) {
            $this->renderPartial('/front/quickfood/browse-resto-map', array(
                'list' => $list,
                'tabs' => $tabs,
                'filter' => 1
            ));
        } else if($tabs == 2) {
            $this->renderPartial('/front/quickfood/browse-resto-list', array(
                'list' => $list,
                'tabs' => $tabs,
                'h1'=>t("Restaurant  by cuisine"),
                'sub_text'=>t("choose from your favorite restaurant"),
                'category'=> $category,
                'current_page_url' => $current_page_url,
                'cuisine_page' => 1
            ));
        } else if($tabs == 3) {
            $this->renderPartial('/front/quickfood/browse-resto-grid', array(
                'list' => $list,
                'tabs' => $tabs,
                'h1'=>t("Restaurant  by cuisine"),
                'sub_text'=>t("choose from your favorite restaurant"),
                'category'=> $category,
                'current_page_url' => $current_page_url,
                'cuisine_page' => 1
            ));
        } else { //default will be map
            $this->renderPartial('/front/quickfood/browse-resto-map', array(
                'list' => $list,
                'tabs' => $tabs,
                'filter' => 1
            ));
        }
    } else
        echo '<p class="text-danger">' . t("No restaurant found") . '</p>';
    
    echo CHtml::hiddenField('current_page_url', $current_page_url);
    echo CHtml::hiddenField('category', $category);
    echo CHtml::hiddenField('tabs', $tabs);
?>

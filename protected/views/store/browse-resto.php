<?php
if (false) {
    $this->renderPartial('/front/default-header', array(
        'h1' => t("Browse Restaurant"),
        'sub_text' => t("choose from your favorite restaurant")
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
                'tabs' => $tabs
            ));
        } else if($tabs == 2) {
            $this->renderPartial('/front/quickfood/browse-resto-list', array(
                'list' => $list,
                'tabs' => $tabs,
                'h1' => t("Browse Restaurant"),
                'sub_text' => t("choose from your favorite restaurant")
            ));
        } else if($tabs == 3) {
            $this->renderPartial('/front/quickfood/browse-resto-grid', array(
                'list' => $list,
                'tabs' => $tabs,
                'h1' => t("Browse Restaurant"),
                'sub_text' => t("choose from your favorite restaurant")
            ));
        } else { //default will be map
            $this->renderPartial('/front/quickfood/browse-resto-map', array(
                'list' => $list,
                'tabs' => $tabs
            ));
        }
    } else
        echo '<p class="text-danger">' . t("No restaurant found") . '</p>';
?>

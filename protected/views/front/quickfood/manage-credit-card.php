
<div class="indent_title_in">
    <i class="icon_creditcard"></i>
    <h3><?php echo t("Credit Cards")?></h3>
</div>

<div class="bottom10 top10">
<a class="green-button inline rounded btn_1" href="<?php echo Yii::app()->createUrl('/store/profile/?tab=4&do=add')?>">
<?php echo t("Add New")?>
</a>
</div>

<form method="POST" id="frm-otable" class="frm-otable"> 
<?php echo CHtml::hiddenField('otable_action','ClientCCList')?> 
<?php echo CHtml::hiddenField('tbl','client_cc')?>
  
<table class="otable table table-striped">
 <thead>
  <tr>
   <th><?php echo Yii::t("default","Card name")?></th>
   <th><?php echo Yii::t("default","Card number")?></th>
   <th><?php echo Yii::t("default","Expiration")?></th>
  </tr>
 </thead>
</table>

</form>
<div class="clear"></div>

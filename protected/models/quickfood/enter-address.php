
<div class="container-fluid enter-address-wrap">
    <div class="row">
        <div class="col-md-12">
            <h4><?php echo t("Enter your address below")?></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form id="frm-modal-enter-address" class="frm-modal-enter-address" method="POST" onsubmit="return false;" >
                <?php echo CHtml::hiddenField('action','setAddress');?> 
                <?php echo CHtml::hiddenField('web_session_id',
                isset($this->data['web_session_id'])?$this->data['web_session_id']:''
                );?>

                <div class="form-group">
                    <?php echo CHtml::textField('client_address',
                         isset($_SESSION['kr_search_address'])?$_SESSION['kr_search_address']:''
                         ,array(
                         'class'=>"grey-inputs form-control",
                         'data-validation'=>"required"
                         ))?>
                </div> <!--row-->

                <div class="row food-item-actions top10">
                  <div class="col-md-5 "></div>
                  <div class="col-md-3 ">
                  <a href="javascript:$.fancybox.close();" class="orange-button inline center">Close</a>
                  </div>
                  <div class="col-md-3 ">
                     <input type="submit" class="green-button inline" value="<?php echo t("Submit")?>">
                  </div>
                </div>

                 </form>
        </div>
    </div>



</div> <!--container-->

<script type="text/javascript">
$.validate({ 	
	language : jsLanguageValidator,
	language : jsLanguageValidator,
    form : '#frm-modal-enter-address',    
    onError : function() {      
    },
    onSuccess : function() {     
      form_submit('frm-modal-enter-address');
      return false;
    }  
})

jQuery(document).ready(function() {
	var google_auto_address= $("#google_auto_address").val();	
	if ( google_auto_address =="yes") {		
	} else {
		$("#client_address").geocomplete({
		    country: $("#admin_country_set").val()
		});	
	}
});
</script>
<?php
die();
<?php
unset($_SESSION['pts_earn']);
unset($_SESSION['pts_redeem_amt']);

$this->renderPartial('/front/quickfood/banner-receipt', array(
    'h1' => t("Thank You"),
    'sub_text' => t("Your order has been placed.")
));

/* Render top menu */
$this->renderPartial('/layouts/quickfood/front_top_menu', array(
    'action' => Yii::app()->controller->action->id,
    'theme_hide_logo' => getOptionA('theme_hide_logo')
));

$data = '';
$ok = false;
if ($data = Yii::app()->functions->getOrder2($_GET['id'])) {
    $merchant_id = $data['merchant_id'];
    $json_details = !empty($data['json_details']) ? json_decode($data['json_details'], true) : false;
    if ($json_details != false) {
        Yii::app()->functions->displayOrderHTML(array(
            'merchant_id' => $data['merchant_id'],
            'delivery_type' => $data['trans_type'],
            'delivery_charge' => $data['delivery_charge'],
            'packaging' => $data['packaging'],
            'cart_tip_value' => $data['cart_tip_value'],
            'cart_tip_percentage' => $data['cart_tip_percentage'],
            'card_fee' => $data['card_fee'],
            'points_discount' => isset($data['points_discount']) ? $data['points_discount'] : '' /* POINTS PROGRAM */
                ), $json_details, true);
        if (Yii::app()->functions->code == 1) {
            $ok = true;
        }
    }
}
unset($_SESSION['kr_item']);
unset($_SESSION['kr_merchant_id']);
unset($_SESSION['voucher_code']);
unset($_SESSION['less_voucher']);
unset($_SESSION['shipping_fee']);

$print = '';

$order_ok = true;

$merchant_info = Yii::app()->functions->getMerchant(isset($merchant_id) ? $merchant_id : '');
$full_merchant_address = $merchant_info['street'] . " " . $merchant_info['city'] . " " . $merchant_info['state'] .
        " " . $merchant_info['post_code'];
?>

<div class="sections section-grey2 section-receipt">
    <div class="container margin_60_35">
        <?php if ($ok == TRUE): ?>
            <div class="row">
		<div class="col-md-offset-3 col-md-6">
                    <div class="box_style_2">
                        <h2 class="inner"><?php echo t("Order Details")?></h2>
                        <div id="confirm">
                            <i class="icon_check_alt2"></i>
                            <h3>Thank you!</h3>
                        </div>
                        <h4><?php echo t("Summary");?></h4>
                        <div class="receipt-wrap order-list-wrap">
                            <?php echo $item_details=Yii::app()->functions->details['html'];?>
                        </div>
                        <table class="table table-striped nomargin">
                            <tbody>
                                <tr>
                                    <td><?php echo Yii::t("default","Merchant Name")?></td>
                                    <td><strong class="pull-right"><?php echo clearString($data['merchant_name'])?></strong></td>
                                </tr>
                                <?php if (isset($_SESSION['kr_delivery_options']['delivery_date'])):?>
                                    <tr>
                                        <td><?php echo Yii::t("default","Pickup Date")?></td>
                                        <td>
                                            <strong class="pull-right">
                                                <?php echo $_SESSION['kr_delivery_options']['delivery_date']?>
                                            </strong>
                                        </td>
                                    </tr>
                                    <?php 	       
                                        $print[]=array(
                                          'label'=>Yii::t("default","Pickup Date"),
                                          'value'=>$_SESSION['kr_delivery_options']['delivery_date']
                                        );
                                    ?>
                                    <?php if (isset($_SESSION['kr_delivery_options']['delivery_time'])):?>
                                        <?php if ( !empty($_SESSION['kr_delivery_options']['delivery_time'])):?>
                                            <tr>
                                                <td><?php echo Yii::t("default","Pickup Time")?></td>
                                                <td>
                                                    <strong class="pull-right">
                                                        <?php echo Yii::app()->functions->timeFormat($_SESSION['kr_delivery_options']['delivery_time'],true)?>
                                                    </strong>
                                                </td>
                                            </tr>
                                            <?php 	       
                                                $print[]=array(
                                                    'label'=>Yii::t("default","Pickup Time"),
                                                    'value'=>Yii::app()->functions->timeFormat($_SESSION['kr_delivery_options']['delivery_time'],true)
                                                );?>
                                        <?php endif;?>
                                    <?php endif;?>
                                    <?php if ($data['order_change']>=0.1):?>
                                        <tr>
                                            <td><?php echo Yii::t("default","Change")?></td>
                                            <td>
                                                <strong class="pull-right">
                                                    <?php echo displayPrice( baseCurrency(), normalPrettyPrice($data['order_change']))?>
                                                </strong>
                                            </td>
                                        </tr>
                                        <?php 	       
                                            $print[]=array(
                                                'label'=>Yii::t("default","Change"),
                                                'value'=>$data['order_change']
                                            );
                                        ?>
                                    <?php endif;?>
                                <?php endif;?>
                            </tbody>
                        </table>
                </div>
            </div>

        <?php else : ?>
            <p class="text-warning"><?php echo t("Sorry but we cannot find what you are looking for.") ?></p>
    <?php $order_ok = false; ?>
<?php endif; ?>

    </div> <!--container-->
</div>  <!--section-receipt-->

<?php
$data_raw = Yii::app()->functions->details['raw'];
$receipt = EmailTPL::salesReceipt($print, Yii::app()->functions->details['raw']);
//dump($receipt);
$tpl = Yii::app()->functions->getOption("receipt_content", $merchant_id);
if (empty($tpl)) {
    $tpl = EmailTPL::receiptTPL();
}
$tpl = Yii::app()->functions->smarty('receipt', $receipt, $tpl);
$tpl = Yii::app()->functions->smarty('customer-name', $data['full_name'], $tpl);
$tpl = Yii::app()->functions->smarty('receipt-number', Yii::app()->functions->formatOrderNumber($data['order_id']), $tpl);

$receipt_sender = Yii::app()->functions->getOption("receipt_sender", $merchant_id);
$receipt_subject = Yii::app()->functions->getOption("receipt_subject", $merchant_id);
if (empty($receipt_subject)) {
    $receipt_subject = getOptionA('receipt_default_subject');
    if (empty($receipt_subject)) {
        $receipt_subject = "We have receive your order";
    }
}
if (empty($receipt_sender)) {
    $receipt_sender = 'no-reply@' . $_SERVER['HTTP_HOST'];
}
$to = isset($data['email_address']) ? $data['email_address'] : '';

if (!isset($_SESSION['kr_receipt'])) {
    $_SESSION['kr_receipt'] = '';
}

if (!in_array($data['order_id'], (array) $_SESSION['kr_receipt'])) {

    if ($order_ok == false) {
        return;
    }

    $send_email_customer = true;
    if (isset($_SESSION['kr_client']['is_guest'])) {
        if ($_SESSION['kr_client']['is_guest'] == 1) {
            $send_email_customer = false;
        }
    }

    if ($send_email_customer) {
        sendEmail($to, $receipt_sender, $receipt_subject, $tpl);
    }

    /* send email to merchant address */
    $merchant_notify_email = Yii::app()->functions->getOption("merchant_notify_email", $merchant_id);
    $enabled_alert_notification = Yii::app()->functions->getOption("enabled_alert_notification", $merchant_id);
    /* dump($merchant_notify_email);
      dump($enabled_alert_notification); */
    if ($enabled_alert_notification == "") {

        $merchant_receipt_subject = Yii::app()->functions->getOption("merchant_receipt_subject", $merchant_id);

        $merchant_receipt_subject = empty($merchant_receipt_subject) ? t("New Order From") .
                " " . $data['full_name'] : $merchant_receipt_subject;

        $merchant_receipt_content = Yii::app()->functions->getMerchantReceiptTemplate($merchant_id);

        $final_tpl = '';
        if (!empty($merchant_receipt_content)) {
            $merchant_token = Yii::app()->functions->getMerchantActivationToken($merchant_id);
            $confirmation_link = Yii::app()->getBaseUrl(true) . "/store/confirmorder/?id=" . $data['order_id'] . "&token=$merchant_token";
            $final_tpl = smarty('receipt-number', Yii::app()->functions->formatOrderNumber($data['order_id'])
                    , $merchant_receipt_content);
            $final_tpl = smarty('customer-name', $data['full_name'], $final_tpl);
            $final_tpl = smarty('receipt', $receipt, $final_tpl);
            $final_tpl = smarty('confirmation-link', $confirmation_link, $final_tpl);
        } else
            $final_tpl = $tpl;

        $global_admin_sender_email = Yii::app()->functions->getOptionAdmin('global_admin_sender_email');
        if (empty($global_admin_sender_email)) {
            $global_admin_sender_email = $receipt_sender;
        }

        // fixed if email is multiple
        $merchant_notify_email = explode(",", $merchant_notify_email);
        if (is_array($merchant_notify_email) && count($merchant_notify_email) >= 1) {
            foreach ($merchant_notify_email as $merchant_notify_email_val) {
                if (!empty($merchant_notify_email_val)) {
                    sendEmail(trim($merchant_notify_email_val), $global_admin_sender_email, $merchant_receipt_subject, $final_tpl);
                }
            }
        }
    }

    // send SMS    
    Yii::app()->functions->SMSnotificationMerchant($merchant_id, $data, $data_raw);

    // SEND FAX
    Yii::app()->functions->sendFax($merchant_id, $_GET['id']);
}
$_SESSION['kr_receipt'] = array($data['order_id']);

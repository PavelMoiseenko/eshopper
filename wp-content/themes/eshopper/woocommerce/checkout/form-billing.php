<?php
/**
 * Checkout billing information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-billing.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/** @global WC_Checkout $checkout */

?>

<!--<div class="woocommerce-billing-fields">-->
<?php do_action('woocommerce_before_checkout_billing_form', $checkout); ?>
<!--    <div class="woocommerce-billing-fields__field-wrapper">-->
<?php
$arr = $checkout->get_checkout_fields('billing');
$keys_first_column = ['billing_company', 'billing_email', 'billing_title','billing_first_name', 'billing_middle_name' ,'billing_last_name', 'billing_address_1', 'billing_address_2'];
$keys_second_column = ['billing_postcode', 'billing_country', 'billing_state', 'billing_phone',  'billing_mobile_phone', 'billing_fax'];

foreach ($keys_first_column as $key){
    $arr_first_column[$key] = $arr[$key];
}

foreach ($keys_second_column as $key){
    $arr_second_column[$key] = $arr[$key];
}?>
<div class="form-one">
    <?php foreach ($arr_first_column as $key => $field) : ?>
        <?php woocommerce_form_field($key, $field, $checkout->get_value($key)); ?>
    <?php endforeach; ?>
</div>
<div class="form-two">
    <?php foreach ($arr_second_column as $key => $field) : ?>
        <?php woocommerce_form_field($key, $field, $checkout->get_value($key)); ?>
    <?php endforeach; ?>
</div>
<!--    </div>-->
<?php do_action('woocommerce_after_checkout_billing_form', $checkout); ?>
<!--</div>-->

<?php if (!is_user_logged_in() && $checkout->is_registration_enabled()) : ?>
    <div class="woocommerce-account-fields">
        <?php if (!$checkout->is_registration_required()) : ?>

            <p class="form-row form-row-wide create-account">
                <label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
                    <input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox"
                           id="createaccount" <?php checked((true === $checkout->get_value('createaccount') || (true === apply_filters('woocommerce_create_account_default_checked', false))), true) ?>
                           type="checkbox" name="createaccount" value="1"/>
                    <span><?php _e('Create an account?', 'woocommerce'); ?></span>
                </label>
            </p>

        <?php endif; ?>

        <?php do_action('woocommerce_before_checkout_registration_form', $checkout); ?>

        <?php if ($checkout->get_checkout_fields('account')) : ?>

            <div class="create-account">
                <?php foreach ($checkout->get_checkout_fields('account') as $key => $field) : ?>
                    <?php woocommerce_form_field($key, $field, $checkout->get_value($key)); ?>
                <?php endforeach; ?>
                <div class="clear"></div>
            </div>

        <?php endif; ?>

        <?php do_action('woocommerce_after_checkout_registration_form', $checkout); ?>
    </div>
<?php endif; ?>

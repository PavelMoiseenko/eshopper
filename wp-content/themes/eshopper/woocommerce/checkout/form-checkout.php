<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     2.3.0
 */

if (!defined('ABSPATH')) {
    exit;
}

wc_print_notices();

do_action('woocommerce_before_checkout_form', $checkout);

// If checkout registration is disabled and not logged in, the user cannot checkout
if (!$checkout->is_registration_enabled() && $checkout->is_registration_required() && !is_user_logged_in()) {
    echo apply_filters('woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', 'woocommerce'));
    return;
}
?>
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Check out</li>
            </ol>
        </div><!--/breadcrumbs-->

        <div class="step-one">
            <h2 class="heading">Step1</h2>
        </div>
        <div class="checkout-options">
            <h3>New User</h3>
            <p>Checkout options</p>
            <ul class="nav">
                <li>
                    <label><input type="checkbox"> Register Account</label>
                </li>
                <li>
                    <label><input type="checkbox"> Guest Checkout</label>
                </li>
                <li>
                    <a href=""><i class="fa fa-times"></i>Cancel</a>
                </li>
            </ul>
        </div><!--/checkout-options-->

        <div class="register-req">
            <p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Guest</p>
        </div><!--/register-req-->
        <form name="checkout" method="post" class="checkout woocommerce-checkout"
              action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">
            <div class="shopper-informations">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="shopper-info">
                            <p>Shopper Information</p>
                            <?php dynamic_sidebar('checkout_login_panel');?>
                        </div>
                    </div>

                    <?php if ($checkout->get_checkout_fields()) : ?>

                        <?php do_action('woocommerce_checkout_before_customer_details'); ?>
                        <div class="col-sm-5 clearfix">
                            <div class="bill-to">
                                <p>Bill To</p>

                                    <?php do_action('woocommerce_checkout_billing'); ?>

                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="order-message">
                                <?php do_action('woocommerce_checkout_shipping'); ?>
                            </div>
                        </div>
                        <?php do_action('woocommerce_checkout_after_customer_details'); ?>

                    <?php endif; ?>
                </div>
            </div>

            <div class="review-payment">
                <h2><?php _e('Review & Payment', 'eshopper'); ?></h2>
            </div>
            <?php do_action('woocommerce_checkout_before_order_review'); ?>
            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php do_action('woocommerce_before_cart_contents'); ?>

                    <?php
                    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                        $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                        $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

                        if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
                            $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
                            ?>
                            <tr class="woocommerce-cart-form__cart-item <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">

                                <td class="cart_product">
                                    <?php
                                    $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);

                                    if (!$product_permalink) {
                                        echo $thumbnail;
                                    } else {
                                        printf('<a href="%s">%s</a>', esc_url($product_permalink), $thumbnail);
                                    }
                                    ?>
                                </td>

                                <td class="cart_description"
                                    data-title="<?php esc_attr_e('Product', 'woocommerce'); ?>">
                                    <?php
                                    if (!$product_permalink) {
                                        echo apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key) . '&nbsp;';
                                    } else {
                                        echo apply_filters('woocommerce_cart_item_name', sprintf('<h4><a href="%s">%s</a></h4>', esc_url($product_permalink), $_product->get_name()), $cart_item, $cart_item_key);
                                    }

                                    // Meta data
                                    echo WC()->cart->get_item_data($cart_item);

                                    // Backorder notification
                                    if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity'])) {
                                        echo '<p class="backorder_notification">' . esc_html__('Available on backorder', 'woocommerce') . '</p>';
                                    }
                                    ?>
                                </td>

                                <td class="cart-price" data-title="<?php esc_attr_e('Price', 'woocommerce'); ?>">
                                    <p>
                                        <?php
                                        echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key);
                                        ?>
                                    </p>
                                </td>

                                <td class="cart-quantity" data-title="<?php esc_attr_e('Quantity', 'woocommerce'); ?>">
                                    <?php
                                    if ($_product->is_sold_individually()) {
                                        $product_quantity = sprintf('1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key);
                                    } else {
                                        $product_quantity = woocommerce_quantity_input(array(
                                            'input_name' => "cart[{$cart_item_key}][qty]",
                                            'input_value' => $cart_item['quantity'],
                                            'max_value' => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
                                            'min_value' => '0',
                                        ), $_product, false);
                                    }

                                    echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item);
                                    ?>
                                </td>

                                <td class="cart_total" data-title="<?php esc_attr_e('Total', 'woocommerce'); ?>">
                                    <p class="cart_total_price">
                                        <?php
                                        echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key);
                                        ?>
                                    </p>
                                </td>

                                <td class="cart_delete">
                                    <?php
                                    echo apply_filters('woocommerce_cart_item_remove_link', sprintf(
                                        '<a href="%s" class="cart_quantity_delete" aria-label="%s" data-product_id="%s" data-product_sku="%s"><i class="fa fa-times"></i></a>',
                                        esc_url(WC()->cart->get_remove_url($cart_item_key)),
                                        __('Remove this item', 'woocommerce'),
                                        esc_attr($product_id),
                                        esc_attr($_product->get_sku())
                                    ), $cart_item_key);
                                    ?>
                                </td>
                            </tr>

                            <?php
                        }
                    }
                    ?>
                    <tr>
                        <td colspan="4">&nbsp;</td>
                        <td colspan="2">
                            <table class="table table-condensed total-result">
                                <tr>
                                    <td><?php _e('Cart Sub Total', 'eshopper');?></td>
                                    <td><?php wc_cart_totals_subtotal_html(); ?></td>
                                </tr>
                                <tr>
                                    <td><?php _e('Exo Tax', 'eshopper');?></td>
                                    <td><?php wc_cart_totals_taxes_total_html(); ?></td>
                                </tr>
                                <tr class="shipping-cost">
                                    <td><?php _e('Shipping Cost', 'eshopper');?></td>
                                    <td>Free</td>
                                </tr>
                                <tr>
                                    <td><?php _e('Total', 'eshopper');?></td>
                                    <td><span><?php wc_cart_totals_order_total_html(); ?></span></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
            </div>
            </table>
    </div>
    <div id="order_review" class="woocommerce-checkout-review-order">
        <?php do_action('woocommerce_checkout_order_review'); ?>
    </div>
    <?php do_action('woocommerce_checkout_after_order_review'); ?>
    <?php do_action('woocommerce_after_checkout_form', $checkout); ?>


    </form>

    </div>
</section> <!--/#cart_items-->

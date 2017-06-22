<?php
/**
 * Declare woocommerce_support
 */

add_action('after_setup_theme', 'woocommerce_support');
function woocommerce_support()
{
    add_theme_support('woocommerce');
}

/*
 Billing form of checkout page*/
add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );

function custom_override_checkout_fields( $fields ) {

    $fields['billing']['billing_company']['placeholder'] = 'Company Name';
    $fields['billing']['billing_company']['required'] = false;

    $fields['billing']['billing_email']['placeholder'] = 'Email*';
    $fields['billing']['billing_email']['required'] = true;

    $fields['billing']['billing_title'] = array(
        'label'     => 'Title',
        'placeholder'   => 'Title',
        'required'  => false
    );

    $fields['billing']['billing_first_name']['placeholder'] = 'First name*';
    $fields['billing']['billing_first_name']['required'] = true;

    $fields['billing']['billing_middle_name'] = array(
        'label'     => 'Middle Name',
        'placeholder'   => 'Middle Name',
        'required'  => false
    );

    $fields['billing']['billing_last_name']['placeholder'] = 'Last name*';
    $fields['billing']['billing_last_name']['required'] = true;

    $fields['billing']['billing_address_1']['placeholder'] = 'Address 1*';
    $fields['billing']['billing_address_1']['required'] = true;

    $fields['billing']['billing_address_2']['placeholder'] = 'Address 2';
    $fields['billing']['billing_address_2']['required'] = false;

    $fields['billing']['billing_postcode']['placeholder'] = 'ZIP / Postal Code*';
    $fields['billing']['billing_postcode']['required']  = true;

    $fields['billing']['billing_country'] = array(
        'type'      => 'select',
        'required'  => true,
        'options'   => array(
            'option_0' => '-- Country --',
            'BD' => 'Bangladesh',
            'GB' => 'UK',
            'IN' => 'India',
            'PK' => 'Pakistan',
            'UA' => 'Ukraine',
            'CA' => 'Canada',
            'DJ' => 'Dubai'
        )
    );


    $fields['billing']['billing_state']['required'] = true;
    $fields['billing']['billing_state']['type'] = 'select';
    $fields['billing']['billing_state']['options'] = array(
        'option_0' => '-- State/Province/Region --',
        'BD' => 'Bangladesh',
        'GB' => 'UK',
        'IN' => 'India',
        'PK' => 'Pakistan',
        'UA' => 'Ukraine',
        'CA' => 'Canada',
        'DJ' => 'Dubai'
    );

    $fields['billing']['billing_phone']['placeholder'] = 'Phone*';
    $fields['billing']['billing_phone']['required'] = true;

    $fields['billing']['billing_mobile_phone']['placeholder'] = 'Mobile phone';
    $fields['billing']['billing_mobile_phone']['required'] = false;

    $fields['billing']['billing_fax']['placeholder'] = 'Fax';
    $fields['billing']['billing_fax']['required'] = false;

    unset($fields['billing']['billing_city']);


    return $fields;
}

remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
remove_action('woocommerce_checkout_order_review', 'woocommerce_order_review', 10);
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar');
remove_filter('woocommerce_show_page_title', 'filter_woocommerce_show_page_title');
//remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash');
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title');
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price');
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
//remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
add_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_price', 5);


/*Pagination woocommerce*/
function woocommerce_pagination() {
    wp_pagenavi();
}
add_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10);

add_action('woocommerce_shop_loop_item_title', 's_render_title', 5);

function s_render_title()
{
    ?>
    <p><?php the_title(); ?></p>
    <?php
}

add_action('woocommerce_shop_loop_item_title', 's_open_price', 2);

function s_open_price()
{
    ?>
    <h2>
    <?php
}


add_action('woocommerce_shop_loop_item_title', 's_close_price', 6);

function s_close_price()
{
    ?>
    </h2>
    <?php
}


add_action('woocommerce_before_shop_loop_item', 's_open_product', 2);

function s_open_product()
{
    ?>
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
    <?php
}

add_action('woocommerce_after_shop_loop_item', 's_close_product', 15);

function s_close_product()
{
    global $product;
    ?>
    </div>
    <div class="product-overlay">
        <div class="overlay-content">
            <h2><?php echo $product->get_price_html(); ?></h2>
            <p><?php the_title(); ?></p>
            <?php get_template_part('/woocommerce/loop/add-to-cart'); ?>
        </div>
        <?php
        $condition = get_field('condition');
        if (!empty($condition)) :?>
            <img src="<?php echo TEMPLATE_DIRECTORY_URI;?>/images/home/new.png" class="new" alt="">
        <?php endif;?>
    </div>
    </div>
    <div class="choose">
        <ul class="nav nav-pills nav-justified">
            <li>
                <?php echo do_shortcode("[yith_wcwl_add_to_wishlist label='<i class=\"fa fa-plus-square\"></i>Add to wishlist']"); ?>
            </li>
            <li>
                <?php echo do_shortcode("[yith_compare_button]"); ?>
            </li>
        </ul>
    </div>
    </div>
    </div>
    <?php
}

add_action('woocommerce_before_shop_loop', 's_open_products', 5);

function s_open_products()
{
    ?>
    <div class="col-sm-9 padding-right">
        <div class="features_items"><!--features_items-->
            <h2 class="title text-center">Features Items</h2>
    <?php
}

add_action('woocommerce_after_shop_loop', 's_close_products', 15);

function s_close_products()
{
    ?>
    </div>
    </div>
    </section>
    <?php
}

//* Add stock status to archive pages
function stock_availability() {
    global $product;
    if ( $product->is_in_stock() ) {
        echo '<p class="stock" ><b>Availability: </b>' . $product->get_stock_quantity() . __( ' in stock', 'eshopper' ) . '</p>';
    } else {
        echo '<p class="out-of-stock" ><b>Availability: </b>' . __( 'out of stock', 'eshopper' ) . '</p>';
    }

    $terms = get_the_terms( $product->get_ID(), 'product_cat' );
    foreach ($terms as $term) {
        $product_cat_id = $term->name;}
    if ($product_cat_id){
        echo '<p class="brand" ><b>Brand: </b>' . __( $product_cat_id , 'eshopper' ) . '</p>';
    }
    $condition = get_field('condition');
    if(!empty($condition)) : ?>
        <p class="condition" ><b>Condition: </b>  <?php  _e( $condition , 'eshopper' )?> </p>
    <?php endif;
}

add_action( 'woocommerce_single_product_summary', 'stock_availability', 35 );

/*
 * Add sharing
 */

function sharing(){
    ?>
    <a href=""><img src="<?php echo TEMPLATE_DIRECTORY_URI;?>/images/product-details/share.png" class="share img-responsive"  alt="" /></a>
    <?php
}

add_action('woocommerce_single_product_summary', 'sharing', 35);


add_action('woocommerce_before_main_content', 'render_sidebar');

function render_sidebar()
{
    ?>
    <section>
    <div class="container">
    <div class="row">
    <?php
    get_sidebar('left'); ?>
    <?php
}

add_action('woocommerce_before_cart', 'add_breadcrumbs');

function add_breadcrumbs(){?>
    <div class="breadcrumbs">
    <ol class="breadcrumb">
        <?php
        $args = array(
            'delimiter' => '',
            'before' => '<li>',
            'after' => '</li>',
            'wrap_before' => '',
            'wrap_after' => ''
        );
        woocommerce_breadcrumb($args); ?>
    </div><?php
}

/**
 * Validate billing title field
 */
add_action('woocommerce_checkout_process', 'my_custom_checkout_field_process');

function my_custom_checkout_field_process() {
    // Check if set, if its not set add an error.
    if ( ! $_POST['billing_title'] )
        wc_add_notice( __( 'Please enter something into billing title field.' ), 'error' );
}


/**
 * Update the order meta with field value
 */
add_action( 'woocommerce_checkout_update_order_meta', 'my_custom_checkout_field_update_order_meta' );

function my_custom_checkout_field_update_order_meta( $order_id ) {
    if ( ! empty( $_POST['billing_title'] ) ) {
        update_post_meta( $order_id, '_billing_title', sanitize_text_field( $_POST['billing_title'] ) );
    }
}

/**
 * Display field value on the order edit page
 */
add_action( 'woocommerce_admin_order_data_after_billing_address', 'my_custom_checkout_field_display_admin_order_meta', 10, 1 );

function my_custom_checkout_field_display_admin_order_meta($order){
    echo "<h1>TEST</h1>";
    echo '<p><strong>'.__('My Field').':</strong> ' . get_post_meta( $order->id, '_billing_title', true ) . '</p>';
}

/*AJAX filter by brand & category*/

add_action('wp_ajax_my_action', 'callback_my_action');
add_action('wp_ajax_nopriv_my_action', 'callback_my_action');

function callback_my_action(){
    $brand_slug = $_POST['brand_slug'];
    $category_name = $_POST['category_name'];
    $ajax_query = new WP_Query(array(
        'pwb-brand' => $brand_slug,
        "product_cat" => $category_name
    ));

if ($ajax_query->have_posts()): ?>
    <div class="features_items">
        <h2 class="title text-center">Features Items</h2>
        <?php while ($ajax_query->have_posts()) : $ajax_query->the_post();
            global $product;?>
            <div class="col-sm-4">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <?php the_post_thumbnail(); ?>
                            <h2><?php echo $product->get_price_html(); ?></h2>
                            <p><?php the_title(); ?></p>
                            <a href="#" class="btn btn-default add-to-cart"><i
                                        class="fa fa-shopping-cart"></i>Add to cart</a>
                        </div>
                        <div class="product-overlay">
                            <div class="overlay-content">
                                <h2><?php get_template_part('/woocommerce/loop/price'); ?></h2>
                                <p><?php the_title(); ?></p>
                                <?php get_template_part('/woocommerce/loop/add-to-cart'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="choose">
                        <ul class="nav nav-pills nav-justified">
                            <li>
                                <?php
                                echo do_shortcode("[yith_wcwl_add_to_wishlist label='<i class=\"fa fa-plus-square\"></i>Add to wishlist']"); ?>
                            </li>
                            <li>
                                <?php echo do_shortcode("[yith_compare_button]"); ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php
        endwhile;
        wp_reset_postdata(); ?>
    </div>
<?php endif;
wp_die();
}
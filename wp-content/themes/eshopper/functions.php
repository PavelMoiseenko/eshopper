<?php
define('TEMPLATE_DIRECTORY', get_template_directory());
define('TEMPLATE_DIRECTORY_URI', get_template_directory_uri());
define('STYLESHEET_URI', get_stylesheet_uri());
//define('WOOCOMMERCE_USE_CSS', false);

require_once "woo-functions.php";

/**
 * Enqueue scripts and styles.
 */
if (!function_exists('base_scripts')) {
    function base_scripts()
    {
        wp_register_style('jquery-ui-css', TEMPLATE_DIRECTORY_URI . '/css/jquery-ui.min.css');
        wp_register_style('bootstrap', TEMPLATE_DIRECTORY_URI . '/css/bootstrap.min.css');
        wp_register_style('font-awesome', TEMPLATE_DIRECTORY_URI . '/css/font-awesome.min.css');
        wp_register_style('prettyphoto', TEMPLATE_DIRECTORY_URI . '/css/prettyPhoto.css');
        wp_register_style('price-range', TEMPLATE_DIRECTORY_URI . '/css/price-range.css');
        wp_register_style('animate', TEMPLATE_DIRECTORY_URI . '/css/animate.css');
        wp_register_style('main', TEMPLATE_DIRECTORY_URI . '/css/main.css');
        wp_register_style('responsive', TEMPLATE_DIRECTORY_URI . '/css/responsive.css');

        // Enqueue Styles
        wp_enqueue_style('jquery-ui-css');
        wp_enqueue_style('bootstrap');
        wp_enqueue_style('font-awesome');
        wp_enqueue_style('prettyphoto');
        wp_enqueue_style('price-range');
        wp_enqueue_style('animate');
        wp_enqueue_style('main');
        wp_enqueue_style('responsive');

        // Register Scripts
        wp_register_script('jquery-ui', TEMPLATE_DIRECTORY_URI . '/js/jquery-ui.min.js', array(), false, true);
        wp_register_script('bootstrapmin', TEMPLATE_DIRECTORY_URI . '/js/bootstrap.min.js', array(), false, true);
        wp_register_script('scrollup', TEMPLATE_DIRECTORY_URI . '/js/jquery.scrollUp.min.js', array(), false, true);
        wp_register_script('price-range', TEMPLATE_DIRECTORY_URI . '/js/price-range.js', array(), false, true);
        wp_register_script('prettyphoto', TEMPLATE_DIRECTORY_URI . '/js/jquery.prettyPhoto.js', array(), false, true);
        wp_register_script('main', TEMPLATE_DIRECTORY_URI . '/js/main.js', array(), false, true);
        wp_register_script('google-map', "https://maps.googleapis.com/maps/api/js?key=AIzaSyB5xU4-M1P9JImDM5I68ZAP57gSpI-983g", array(), false, true);
        wp_register_script('map', TEMPLATE_DIRECTORY_URI . '/js/map.js', array(), false, true);


        // Enqueue Scripts
        wp_enqueue_script('jquery');
        wp_enqueue_script('jquery-ui');
        wp_enqueue_script('bootstrapmin');
        wp_enqueue_script('scrollup');
        wp_enqueue_script('price-range');
        wp_enqueue_script('prettyphoto');
        wp_enqueue_script('main');
        wp_enqueue_script('google-map');
        wp_enqueue_script('map');


        wp_dequeue_style('woocommerce-general');

        /*Remove select2*/
        if ( class_exists( 'woocommerce' ) ) {
        wp_dequeue_style( 'select2' );
        wp_deregister_style( 'select2' );

        wp_dequeue_script( 'select2');
        wp_deregister_script('select2');

    }
    }

    add_action('wp_enqueue_scripts', 'base_scripts');

}

/*
 * Using SVGs*/
function svg_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}

add_filter('upload_mimes', 'svg_mime_types');


//theme options tab in appearance
if (function_exists('acf_add_options_sub_page')) {
    acf_add_options_sub_page(array(
        'title' => 'Theme Options',
        'parent' => 'themes.php',
    ));
}

/**
 * Declare woocommerce_support
 */

add_action('after_setup_theme', 'woocommerce_support');
function woocommerce_support()
{
    add_theme_support('woocommerce');
}


remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination', 10);

function woocommerce_pagination() {
    wp_pagenavi();
}
add_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10);

remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

/*add_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 15);
function woocommerce_breadcrumb(){
    ?><div class="breadcrumbs">
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
}*/
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar');

remove_filter('woocommerce_show_page_title', 'filter_woocommerce_show_page_title');

//тremove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash');
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title');
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price');
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);


add_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_price', 5);

add_action('woocommerce_shop_loop_item_title', 's_render_title', 5);

/**
 * Register menu
 */
add_action('after_setup_theme', function () {
    register_nav_menus(array(
        'header_menu' => 'Меню в хедере справа',
        'main_menu' => "Меню главное"
    ));
});

/**
 * Change image for wp-login.php
 */
function login_style()
{
    wp_register_style('login-style', TEMPLATE_DIRECTORY_URI . '/css/login-style.css');
    wp_enqueue_style('login-style');
}

add_action('login_enqueue_scripts', 'login_style');


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


function register_my_widgets(){
	register_sidebar( array(
		'name' => "Левая боковая панель сайта для фильтра цены",
		'id' => 'left-sidebar',
		'description' => 'Эти виджеты будут показаны левой колонке сайта'
	) );
}
add_action( 'widgets_init', 'register_my_widgets' );


remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
//remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);


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

remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);




remove_action('woocommerce_checkout_order_review', 'woocommerce_order_review', 10);

/*Skill up with custom post-types and taxonomies*/
//add_action('init', 'custom_post_type');
//function custom_post_type(){
//	register_post_type('custom_type', array(
//		'labels'             => array(
//			'name'               => 'Кастомный тип', // Основное название типа записи
//			'singular_name'      => 'Кастомный тип', // отдельное название записи типа Book
//			'add_new'            => 'Добавить новый',
//			'add_new_item'       => 'Добавить новый кастомный тип',
//			'edit_item'          => 'Редактировать кастомный тип',
//			'new_item'           => 'Новый кастомный тип',
//			'view_item'          => 'Посмотреть кастомный тип',
//			'search_items'       => 'Найти кастомный тип',
//			'not_found'          =>  'Кастомных типов не найдено',
//			'not_found_in_trash' => 'В корзине кастомных типов не найдено',
//			'parent_item_colon'  => '',
//			'menu_name'          => 'Кастомные типы'
//
//		  ),
//		'public'             => true,
//		'publicly_queryable' => true,
//		'show_ui'            => true,
//		'show_in_menu'       => true,
//		'query_var'          => true,
//		'rewrite'            => true,
//		'capability_type'    => 'post',
//		'has_archive'        => true,
//		'hierarchical'       => false,
//		'supports'           => array('title','editor', 'thumbnail'),
//		'menu_position'      => 7,
//		'menu_icon'          => 'dashicons-admin-users',
//		//'taxonomies'         => 'classification'
//
//	) );
//}
//
//add_action( 'init', 'create_custom_type_taxonomies', 0);
//
//
//function create_custom_type_taxonomies(){
//	$labels = array(
//		'name' => _x( 'Genres', 'taxonomy general name' ),
//		'singular_name' => _x( 'Genre', 'taxonomy singular name' ),
//		'search_items' =>  __( 'Search Genres' ),
//		'all_items' => __( 'All Genres' ),
//		'parent_item' => __( 'Parent Genre' ),
//		'parent_item_colon' => __( 'Parent Genre:' ),
//		'edit_item' => __( 'Edit Genre' ),
//		'update_item' => __( 'Update Genre' ),
//		'add_new_item' => __( 'Add New Genre' ),
//		'new_item_name' => __( 'New Genre Name' ),
//		'menu_name' => __( 'Genre' ),
//	);
//
//// Добавляем древовидную таксономию 'genre' (как категории)
//	register_taxonomy('genre', array('custom_type'), array(
//		'hierarchical' => true,
//		'labels' => $labels,
//		'show_ui' => true,
//		'query_var' => true,
//		'rewrite' => array( 'slug' => 'genre' ),
//	));
//
//	// определяем заголовки для 'writer'
//	$labels = array(
//		'name' => _x( 'Writers', 'taxonomy general name' ),
//		'singular_name' => _x( 'Writer', 'taxonomy singular name' ),
//		'search_items' =>  __( 'Search Writers' ),
//		'popular_items' => __( 'Popular Writers' ),
//		'all_items' => __( 'All Writers' ),
//		'parent_item' => null,
//		'parent_item_colon' => null,
//		'edit_item' => __( 'Edit Writer' ),
//		'update_item' => __( 'Update Writer' ),
//		'add_new_item' => __( 'Add New Writer' ),
//		'new_item_name' => __( 'New Writer Name' ),
//		'separate_items_with_commas' => __( 'Separate writers with commas' ),
//		'add_or_remove_items' => __( 'Add or remove writers' ),
//		'choose_from_most_used' => __( 'Choose from the most used writers' ),
//		'menu_name' => __( 'Writers' ),
//	);
//
//	// Добавляем НЕ древовидную таксономию 'writer' (как метки)
//	register_taxonomy('writer', 'custom_type',array(
//		'hierarchical' => false,
//		'labels' => $labels,
//		'show_ui' => true,
//		'query_var' => true,
//		'rewrite' => array( 'slug' => 'writer' ),
//	));
//}

function my_acf_init() {

	acf_update_setting('google_api_key', 'AIzaSyB5xU4-M1P9JImDM5I68ZAP57gSpI-983g');
}

add_action('acf/init', 'my_acf_init');

function register_newsletter_widget(){
	register_sidebar( array(
		'name' => "Panel for newsletter in footer",
		'id' => 'newsletter-panel',
		'description' => 'On this panel will be shown newsletter',
        'before_widget' => '',
        'after_widget' => ''
	) );
}
add_action( 'widgets_init', 'register_newsletter_widget' );

add_filter('widget_text','do_shortcode');

function footer_copyright_func(){
	$year = date('Y');
    return 'Copyright © ' . $year . ' E-SHOPPER Inc. All rights reserved.';
}
add_shortcode('footer_copyright', 'footer_copyright_func');


function footer_produced_by_func($atts){
    return "Designed by <span><a target='_blank' href='{$atts["sitelink"]}'>{$atts['sitename']}</a></span>";
}
add_shortcode('footer_produced_by', 'footer_produced_by_func');


function register_panel_login(){
    register_sidebar( array(
		'name' => "Panel for login and registration",
		'id' => 'login-panel',
		'description' => 'On this panel will be shown login and registration forms',
        'before_widget' => "<div class='col-sm-4 col-sm-offset-1'><div class='login-form'>",
        'after_widget' => "</div></div><div class='col-sm-1'><h2 class='or'>OR</h2></div>"
	) );

    register_sidebar( array(
		'name' => "Panel for login",
		'id' => 'checkout_login_panel',
		'description' => 'On this panel will be shown login form',
        'before_widget' => "",
        'after_widget' => ""
	));

}
add_action( 'widgets_init', 'register_panel_login' );


add_action( 'register_form', 'add_registration_field' );

function add_registration_field(){
    $user_extra = ( isset( $_POST['user_extra'] ) ) ? $_POST['user_extra'] : '';
    ?>
    <p>
        <input type="password" name="user_extra" id="user_extra" value="<?php echo esc_attr( stripslashes( $user_extra ) ); ?>" placeholder="Password" />
    </p>
    <?php
}

add_filter( 'registration_errors', 'password_registration_errors', 10, 3 );

function password_registration_errors( $errors, $sanitized_user_login, $user_email ) {

    if ( empty( $_POST['user_extra'] ) || ! empty( $_POST['user_extra'] ) && trim( $_POST['user_extra'] ) == '' ) {
        $errors->add( 'password_error', __( '<strong>ERROR</strong>: You must include a password', 'eshopper' ) );
    }
    return $errors;
}

add_action( 'user_register', 'password_user_register' );
function password_user_register( $user_id ) {
    if ( ! empty( $_POST['user_extra'] ) ) {
        update_user_meta( $user_id, 'password', trim( $_POST['user_extra'] ) );
    }
}


remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );


/*
 * Login/logout menu*/

add_filter('wp_nav_menu_items', 'add_login_logout_link', 10, 2);
function add_login_logout_link($items, $args) {
        ob_start();
        wp_loginout('index.php');
        $loginoutlink = ob_get_contents();
        ob_end_clean();
        $items .= '<li>'. $loginoutlink .'</li>';
    return $items;
}
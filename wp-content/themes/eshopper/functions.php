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

        $url = array(
            'url' => admin_url('admin-ajax.php')
        );
        wp_localize_script('jquery', 'myajax', $url);
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


function register_my_widgets(){
	register_sidebar( array(
		'name' => "Левая боковая панель сайта для фильтра цены",
		'id' => 'left-sidebar',
		'description' => 'Эти виджеты будут показаны левой колонке сайта'
	) );
}
add_action( 'widgets_init', 'register_my_widgets' );

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


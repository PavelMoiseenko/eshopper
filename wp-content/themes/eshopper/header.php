<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shopper</title>
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="<?php echo TEMPLATE_DIRECTORY_URI;?>/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
    <?php wp_head(); ?>
</head><!--/head-->
<body <?php body_class(); ?>>
<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <?php
                if (have_rows('header_contacts', 'option')): ?>
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <?php while (have_rows('header_contacts', 'option')) : the_row(); ?>
                                    <li><a href="#"><i
                                                    class="<?php the_sub_field('contact_image') ?>"></i><?php the_sub_field('contact_info'); ?>
                                        </a></li>
                                <?php endwhile; ?>
                            </ul>
                        </div>
                    </div>
                <?php endif; ?>
                <?php
                if (have_rows('header_social', 'option')): ?>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                <?php while (have_rows('header_social', 'option')) : the_row(); ?>
                                    <li><a href="<?php the_sub_field('social_link'); ?>"><i
                                                    class="<?php the_sub_field('social_image'); ?>"></i></a></li>
                                <?php endwhile; ?>
                            </ul>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div><!--/header_top-->

    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <?php
                    $header_logo = get_field('header_logo', 'option');
                    if (!empty($header_logo)) : ?>
                        <div class="logo pull-left">
                            <a href="<?php bloginfo('wpurl'); ?>"><img src="<?php echo $header_logo; ?>" alt=""/></a>
                        </div>
                    <?php endif; ?>
                    <div class="btn-group pull-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                USA
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#">Canada</a></li>
                                <li><a href="#">UK</a></li>
                            </ul>
                        </div>

                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                DOLLAR
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#">Canadian Dollar</a></li>
                                <li><a href="#">Pound</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <?php wp_nav_menu(array(
                            'theme_location' => 'header_menu',
                            'menu_class' => 'nav navbar-nav'
                        )); ?>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->

    <div class="header-bottom"><!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <?php
                    if (has_nav_menu('main_menu')) :?>
                        <div class="mainmenu pull-left">
                            <?php wp_nav_menu(array(
                                'theme_location' => 'main_menu',
                                'menu_class' => 'nav navbar-nav collapse navbar-collapse'
                            )); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <?php get_search_form();?>
            </div>
        </div>
    </div><!--/header-bottom-->
</header><!--/header-->
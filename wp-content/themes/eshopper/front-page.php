<?php get_header(); ?>
<?php get_template_part('/inc/slider'); ?>
    <section>
        <div class="container">
            <div class="row">
                <?php get_sidebar('left'); ?>
                <div class="col-sm-9 padding-right">
                    <?php
                    $query = new WP_Query(array(
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'product_visibility',
                                'field' => 'name',
                                'terms' => 'featured',
                                'operator' => 'IN'
                            ),
                        ),
                    ));
                    if ($query->have_posts()): ?>
                        <div class="features_items">
                            <h2 class="title text-center">Features Items</h2>
                            <?php while ($query->have_posts()) : $query->the_post(); ?>
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
                            endwhile;
                            wp_reset_postdata(); ?>
                        </div>
                    <?php endif; ?>
                    <div class="category-tab">
                        <div class="col-sm-12">
                            <ul class="nav nav-tabs">
                                <?php
                                $terms = get_terms('product_cat', array(
                                    'hide_empty' => true,
                                    'parent' => 0
                                ));
                                $i = 0;
                                foreach ($terms as $term) :?>
                                    <li <?php echo ($i == 0) ? "class='active'" : false; ?>><a
                                                href="<?php echo "#" . $term->name; ?>"
                                                data-toggle="tab"><?php echo $term->name; ?></a></li>
                                    ?>
                                    <?php
                                    $i++;
                                endforeach; ?>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <?php
                            $j = 0;
                            foreach ($terms as $term) :?>
                                <div <?php echo ($j == 0) ? "class='tab-pane fade active in'" : "class='tab-pane fade'"; ?>
                                        id="<?php echo $term->name; ?>">
                                    <?php $args = array(
                                        "post_type" => "product",
                                        "product_cat" => $term->name
                                    );
                                    $query = new WP_Query($args);
                                    if ($query->have_posts()): ?>
                                        <?php
                                        while ($query->have_posts()) : $query->the_post(); ?>
                                            <div class="col-sm-3">
                                                <div class="product-image-wrapper">
                                                    <div class="single-products">
                                                        <div class="productinfo text-center">
                                                            <?php the_post_thumbnail(); ?>
                                                            <h2><?php get_template_part('/woocommerce/loop/price'); ?></h2>
                                                            <p><?php the_title(); ?></p>
                                                            <a href="#" class="btn btn-default add-to-cart"><i
                                                                        class="fa fa-shopping-cart"></i>Add to cart</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <?php
                                        endwhile;
                                        wp_reset_postdata(); ?>
                                    <?php endif; ?>
                                    <?php
                                    $j++; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="recommended_items">
                        <h2 class="title text-center">recommended items</h2>
                        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <?php
                                $posts = get_field('recomended_items');
                                if ($posts): ?>
                                <?php
                                $i = 0;
                                foreach ($posts as $post): ?>
                                <?php setup_postdata($post);
                                if ($i == 0) : ?>
                                <div class="item active">
                                    <?php endif;
                                    if ($i == 3) : ?>
                                    <div class="item">
                                        <?php endif; ?>
                                        <div class="col-sm-4">
                                            <div class="product-image-wrapper">
                                                <div class="single-products">
                                                    <div class="productinfo text-center">
                                                        <?php the_post_thumbnail(); ?>
                                                        <h2><?php get_template_part('/woocommerce/loop/price'); ?></h2>
                                                        <p><?php the_title(); ?></p>
                                                        <?php get_template_part('/woocommerce/loop/add-to-cart'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        $i++;
                                        if ($i % 3 == 0): ?>
                                    </div>
                                <?php endif;
                                endforeach; ?>
                                    <?php wp_reset_postdata(); ?>
                                    <?php endif; ?>
                                </div>
                                <a class="left recommended-item-control" href="#recommended-item-carousel"
                                   data-slide="prev">
                                    <i class="fa fa-angle-left"></i>
                                </a>
                                <a class="right recommended-item-control" href="#recommended-item-carousel"
                                   data-slide="next">
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </div><!--recommended items-->
                    </div>
                </div>
            </div>
    </section>
<?php get_footer(); ?>
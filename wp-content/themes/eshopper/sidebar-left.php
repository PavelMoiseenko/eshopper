<div class="col-sm-3">
    <div class="left-sidebar">
        <h2>Category</h2>
        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
            <?php
            $prod_cat_terms = get_terms(array(
                'taxonomy' => 'product_cat',
                'parent' => 0,
                'hide_empty' => 0,
                'orderby' => 'count',
                'order' => 'DESC'));
            foreach ($prod_cat_terms as $prod_cat_term) :
                $brands = [];
                $args = array(
                        'post_type' => 'product',
                        'product_cat' => $prod_cat_term->name
                );
                $loop = new WP_Query( $args );
                while ( $loop->have_posts() ) : $loop->the_post();
                    global $product;
//                    echo '<br /><a href="'.get_permalink().'">' . ' '.get_the_title().'</a>';
                    //var_dump($product);
                    $brand = wp_get_post_terms( $post->ID, 'pwb-brand', array("fields" => "all") );
                    $brand_name = $brand[0]->name;
                    if(!in_array($brand_name, $brands)){
                        $brands[] = $brand_name;
                    }
                endwhile;
                wp_reset_query();
             ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a <?php echo "href=" . get_term_link($prod_cat_term); ?>>
                            <?php echo $prod_cat_term->name; ?>
                        </a>
                        <?php echo((empty($brands)) ? false : " <span data-toggle='collapse' data-target='#$prod_cat_term->name' class='badge pull-right'><i class='fa fa-plus'></i></span>"); ?>
                    </h4>
                </div>
            </div>
            <?php
            if (!empty($brands)) : ?>
            <div id="<?php echo $prod_cat_term->name; ?>" class="panel-collapse collapse">
                <div class="panel-body">
                    <ul>
                        <?php
                        foreach ($brands as $brand_name) : ?>
                            <li><a href="<?php echo get_term_link( $brand_name, 'pwb-brand' );?>"><?php echo $brand_name; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <?php endif;
            endforeach; ?><!--/category products-->
            <div class="brands_products"><!--brands_products-->
                <h2>Brands</h2>
                <div class="brands-name">
                    <ul class="nav nav-pills nav-stacked">
                        <?php $brands= get_terms(array(
                            'taxonomy' => 'pwb-brand',
                            'orderby' => 'count',
                            'order' => 'DESC'));
                        foreach ($brands as $brand):?>
                            <li>
                                <a href="<?php echo get_term_link($brand->term_id);?>">
                                    <span class="pull-right"><?php echo("($brand->count)");?></span><?php echo($brand->name); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div><!--/brands_products-->
            <div class="price-range"><!--price-range-->
                <h2>Price Range</h2>
                <div class="well text-center">
                    <ul class="price-filter">
                    <?php
                    dynamic_sidebar('left-sidebar');?>
                    </ul>
                </div>
            </div><!--/price-range-->
            <div class="shipping text-center"><!--shipping-->
                <img src="<?php echo TEMPLATE_DIRECTORY_URI;?>/images/home/shipping.jpg" alt=""/>
            </div><!--/shipping-->

        </div>
    </div>
</div>
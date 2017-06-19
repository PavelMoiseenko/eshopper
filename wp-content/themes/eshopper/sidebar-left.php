<div class="col-sm-3">
    <div class="left-sidebar">
        <h2>Category</h2>
        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
            <?php
            $brands = [];
            $prod_cat_terms = get_terms(array(
                'taxonomy' => 'product_cat',
                'parent' => 0,
                'hide_empty' => 0,
                'orderby' => 'count'));
            foreach ($prod_cat_terms as $prod_cat_term) :
            $child_categories = "";
            $child_categories = get_terms(array(
                'taxonomy' => 'product_cat',
                'parent' => $prod_cat_term->term_id
            )); ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a <?php echo((empty($child_categories)) ? "href='#'" : "data-toggle='collapse' data-parent='#accordian' href='#$prod_cat_term->name'"); ?>>
                            <?php echo((empty($child_categories)) ? false : " <span class='badge pull-right'><i class='fa fa-plus'></i></span>"); ?>
                            <?php echo $prod_cat_term->name; ?></a>
                    </h4>
                </div>
            </div>
            <?php
            if (!empty($child_categories)) : ?>
            <div id="<?php echo $prod_cat_term->name; ?>" class="panel-collapse collapse">
                <div class="panel-body">
                    <ul>
                        <?php
                        foreach ($child_categories as $child_category) : ?>
                            <li><a href="<?php echo get_term_link( $child_category->slug, 'product_cat' );?>"><?php echo $child_category->name; ?></a></li>
                            <?php
                            if(!array_key_exists($child_category->name, $brands)){
                                $brands[$child_category->name] = $child_category->count;
                            }
                            else{
                                $brands[$child_category->name] += $child_category->count;
                            }
                            ?>
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
                        <?php
                        arsort($brands);
                        foreach ($brands as $key => $value):?>
                            <li><a href="<?php echo get_term_link( $key, 'product_cat' );?>">
                                    <span class="pull-right"><?php echo('(' . $value . ')'); ?></span><?php echo $key; ?>
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
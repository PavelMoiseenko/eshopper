<?php get_header(); ?>
<section>
    <div class="container woocommerce">
        <div class="row">
            <?php if(!is_cart() && !is_checkout()){get_sidebar('left');}?>
            <div class="col-sm-9 padding-right">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <?php the_content(); ?>
                <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php get_footer();?>

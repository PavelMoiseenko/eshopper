<?php get_header(); ?>
<section>
    <div class="container woocommerce">
        <div class="row">
            <?php if(!is_cart() && !is_checkout()){get_sidebar('left');}?>
            <div class="col-sm-9 padding-right">
                <h1>This is my search page</h1>
                <p>Результаты поиска по запросу: " <?php the_search_query() ?> ".</p>
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
                        <?php the_title();?>
                        <?php the_content(); ?>
                <?php endwhile; ?>
                <?php else :?>
                    <h2>Nothing is found</h2>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php get_footer();?>

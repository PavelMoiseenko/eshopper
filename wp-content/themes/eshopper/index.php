<?php get_header(); ?>
<?php get_template_part('/inc/slider') ?>
<section>
    <div class="container">
        <div class="row">
            <?php get_sidebar('left');?>
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
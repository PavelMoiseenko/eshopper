<?php get_header(); ?>
<section>
    <div class="container woocommerce">
        <div class="row">
            <?php if (!is_cart() && !is_checkout()) {
                get_sidebar('left');
            } ?>
            <div class="col-sm-9 padding-right">
                <?php if (have_posts()) : ?>
                    <div class="blog-post-area">
                        <h2 class="title text-center">Latest From our Blog</h2>
                        <?php while (have_posts()) : the_post(); ?>
                            <div class="single-blog-post">
                                <h3><?php the_title(); ?></h3>
                                <div class="post-meta">
                                    <ul>
                                        <li><i class="fa fa-user"></i><?php the_author(); ?></li>
                                        <li><i class="fa fa-clock-o"></i> <?php the_time('g:s a'); ?></li>
                                        <li>
                                            <i class="fa fa-calendar"></i> <?php echo strtoupper(get_the_date('M j, Y ')); ?>
                                        </li>
                                    </ul>
                                    <span>
										<?php the_ratings(); ?>
								</span>
                                </div>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail(); ?>
                                </a>
                                <p><?php the_excerpt(); ?></p>
                                <a class="btn btn-primary" href="<?php the_permalink(); ?>">Read More</a>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>

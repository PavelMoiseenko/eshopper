<?php get_header(); ?>
<section>
    <div class="container woocommerce">
        <div class="row">
            <?php if(!is_cart() && !is_checkout()){get_sidebar('left');}?>
            <div class="col-sm-9 padding-right">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <div class="blog-post-area">
                        <h2 class="title text-center">Latest From our Blog</h2>
                        <div class="single-blog-post">
                            <h3><?php the_title();?></h3>
                            <div class="post-meta">
                                <ul>
                                    <li><i class="fa fa-user"></i><?php the_author(); ?></li>
                                    <li><i class="fa fa-clock-o"></i><?php the_time('g:s a'); ?></li>
                                    <li><i class="fa fa-calendar"></i><?php echo strtoupper(get_the_date('M j, Y ')); ?></li>
                                </ul>
                                <span>
									<?php the_ratings();?>
								</span>
                            </div>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail(); ?>
                            </a>
                            <p><?php the_content();?></p>
                            <div class="pager-area">
                                <ul class="pager pull-right">
                                    <li><a href="#">Pre</a></li>
                                    <li><a href="#">Next</a></li>
                                </ul>
                            </div>
                        </div>
                    </div><!--/blog-post-area-->

                    <div class="rating-area">
                        <ul class="ratings">
                            <li class="rate-this">Rate this item:</li>
                            <li>
                                <?php the_ratings();?>
                            </li>
                        </ul>
                        <ul class="tag">
                            <?php the_tags('<li>TAG: </li><li>', ' / </li><li>', '</li>');?>
                        </ul>
                    </div><!--/rating-area-->
                    <div class="socials-share">
                        <a href=""><img src="<?php echo TEMPLATE_DIRECTORY_URI;?>/images/blog/socials.png" alt=""></a>
                    </div><!--/socials-share-->
                <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php get_footer();?>

<footer id="footer"><!--Footer-->
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <?php
                $footer_title = get_field('footer_title', 'options');
                if (!empty($footer_title)) : ?>
                    <div class="col-sm-2">
                        <div class="companyinfo">
                            <h2><?php echo $footer_title; ?></h2>
                            <?php
                            $footer_description = get_field('footer_description', 'options');
                            if (!empty($footer_description)) :?>
                                <p><?php echo $footer_description; ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php
                if (have_rows('video_gallery', 'options')) :?>
                    <div class="col-sm-7">
                        <?php
                        while (have_rows('video_gallery', 'options')) : the_row();
                            $gallery_link = get_sub_field('gallery_link');
                            $gallery_image = get_sub_field('gallery_image');
                            $gallery_title = get_sub_field('gallery_title');
                            $gallery_date = get_sub_field('gallery_date');
                            if (!empty($gallery_link)) :?>
                                <div class="col-sm-3">
                                    <div class="video-gallery text-center">
                                        <a href="<?php echo $gallery_link; ?>">
                                            <?php
                                            if (!empty($gallery_link)) :?>
                                                <div class="iframe-img">
                                                    <img src="<?php echo $gallery_image; ?>" alt=""/>
                                                </div>
                                            <?php endif; ?>
                                            <div class="overlay-icon">
                                                <i class="fa fa-play-circle-o"></i>
                                            </div>
                                        </a>
                                        <?php
                                        if (!empty($gallery_title)):?>
                                            <p><?php echo $gallery_title; ?></p>
                                        <?php endif; ?>
                                        <?php if (!empty($gallery_date)): ?>
                                            <h2><?php echo $gallery_date; ?></h2>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php
                            endif;
                        endwhile; ?>
                    </div>
                    <?php
                endif;
                $footer_address = get_field('footer_address', 'options');
                $footer_address_image = get_field('footer_address_image', 'options');
                if (!empty($footer_address) || !empty($footer_address_image)):?>
                    <div class="col-sm-3">
                        <div class="address">
                            <img src="<?php echo $footer_address_image['url']; ?>" alt=""/>
                            <p><?php echo $footer_address; ?></p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="footer-widget">
        <div class="container">
            <div class="row">
                <?php
                if (have_rows('service_block_items', 'options')) :?>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <?php
                            $service_block_title = get_field('service_block_title', 'options');
                            if (!empty($service_block_title)):?>
                                <h2><?php echo $service_block_title; ?></h2>
                            <?php endif; ?>
                            <ul class="nav nav-pills nav-stacked">
                                <?php while (have_rows('service_block_items', 'options')) : the_row();
                                    $service_item_title = get_sub_field('service_item_title');
                                    $service_item_link = get_sub_field('service_item_link');
                                    if (!empty($service_item_link)) :?>
                                        <li>
                                            <a href="<?php echo $service_item_link; ?>"><?php echo $service_item_title; ?></a>
                                        </li>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            </ul>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if (have_rows('shop_block_items', 'options')): ?>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <?php
                            $shop_block_title = get_field('shop_block_title', 'options');
                            if (!empty($shop_block_title)):?>
                                <h2><?php echo $shop_block_title; ?></h2>
                            <?php endif; ?>
                            <ul class="nav nav-pills nav-stacked">
                                <?php while (have_rows('shop_block_items', 'options')) : the_row(); ?>
                                    <?php
                                    $shop_block_item = get_sub_field('shop_block_item');
                                    $shop_block_link = get_sub_field('shop_block_link'); ?>
                                    <li><a href="<?php echo $shop_block_link; ?>"><?php echo $shop_block_item; ?></a>
                                    </li>
                                <?php endwhile; ?>
                            </ul>
                        </div>
                    </div>
                <?php endif; ?>
                <?php
                if (have_rows('policy_block_items', 'options')):?>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <?php
                            $policy_block_title = get_field('policy_block_title', 'options');
                            if (!empty($policy_block_title)) :?>
                                <h2><?php echo $policy_block_title; ?></h2>
                            <?php endif; ?>
                            <ul class="nav nav-pills nav-stacked">
                                <?php while (have_rows('policy_block_items', 'options')): the_row();
                                    $policy_block_item = get_sub_field('policy_block_item');
                                    $policy_block_link = get_sub_field('policy_block_link'); ?>
                                    <li>
                                        <a href="<?php echo $policy_block_link; ?>"><?php echo $policy_block_item; ?></a>
                                    </li>
                                <?php endwhile; ?>
                            </ul>
                        </div>
                    </div>
                <?php endif; ?>
                <?php
                if (have_rows('about_block_items', 'options')):?>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <?php
                            $about_block_title = get_field('about_block_title', 'options');
                            if (!empty($about_block_title)):?>
                                <h2><?php echo $about_block_title; ?></h2>
                            <?php endif; ?>
                            <ul class="nav nav-pills nav-stacked">
                                <?php while (have_rows('about_block_items', 'options')):the_row();
                                    $about_block_item = get_sub_field('about_block_item');
                                    $about_block_link = get_sub_field('about_block_link'); ?>
                                    <li><a href="<?php echo $about_block_link; ?>"><?php echo $about_block_item; ?></a>
                                    </li>
                                <?php endwhile; ?>
                            </ul>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if (is_active_sidebar('newsletter-panel')) : ?>
                    <div class="col-sm-3 col-sm-offset-1">
                        <div class="single-widget">
                            <?php dynamic_sidebar('newsletter-panel'); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <p class="pull-left"><?php echo do_shortcode('[footer_copyright]'); ?></p>
                <p class="pull-right"><?php echo do_shortcode("[footer_produced_by sitename='Themeum' sitelink='http://www.themeum.com']"); ?></p>
            </div>
        </div>
    </div>
</footer><!--/Footer-->
<?php wp_footer(); ?>
</body>
</html>
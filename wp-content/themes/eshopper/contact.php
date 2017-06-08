<?php
/* Template Name: Contact us */
get_header(); ?>
<section>
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php the_content(); ?>
    <?php endwhile; ?>
    <?php endif; ?>
    <div class="container woocommerce">
        <?php
        $title_map = get_field('title_map');
        if (!empty($title_map)) :?>
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="title text-center"><?php echo $title_map; ?></h2>
                    <div id="gmap" class="contact-map">
                        <?php
                        $map = get_field('map');
                        if (!empty($map)):?>
                            <div class="acf-map map-canvas" id="map-canvas">
                                <div class="marker" data-lat="<?php echo $map['lat']; ?>"
                                     data-lng="<?php echo $map['lng']; ?>"></div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="row">
            <?php
            echo do_shortcode('[contact-form-7 id="177" title="Contact form 1"]'); ?>
            <div class="col-sm-4">
                <div class="contact-info">
                    <?php
                    $title_address_block = get_field('title_address_block');
                    $show_address_title = get_field('show_address_title');
                    if (!empty($show_address_title)) : ?>
                        <h2 class="title text-center"><?php echo $title_address_block; ?></h2>
                        <?php
                    endif;
                    if (have_rows('contacts')): ?>
                        <address>
                            <?php while (have_rows('contacts')) : the_row(); ?>
                                <p><?php the_sub_field('contact'); ?></p>
                            <?php endwhile; ?>
                        </address>
                    <?php endif; ?>
                    <?php
                    $title_social_block = get_field('title_social_block');
                    if (!empty($title_social_block)) :?>
                        <div class="social-networks">
                            <h2 class="title text-center"><?php echo $title_social_block; ?></h2>
                            <?php if (have_rows('social_links')) : ?>
                                <ul>
                                    <?php while (have_rows('social_links')) : the_row(); ?>
                                        <?php
                                        $social_link = get_sub_field('social_link');
                                        $social_picture = get_sub_field('social_picture');
                                        if (!empty($social_link)) : ?>
                                            <li>
                                                <a href="<?php echo $social_link; ?>"><i
                                                            class="<?php echo $social_picture; ?>"></i></a>
                                            </li>
                                            <?php
                                        endif;
                                    endwhile; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<?php get_footer(); ?>

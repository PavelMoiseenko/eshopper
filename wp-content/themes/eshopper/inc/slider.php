<?php
if (have_rows('gallery')): ?>
    <section id="slider"><!--slider-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#slider-carousel" data-slide-to="1"></li>
                            <li data-target="#slider-carousel" data-slide-to="2"></li>
                        </ol>

                        <div class="carousel-inner">
                            <?php
                            $i = 0;
                            while (have_rows('gallery')) : the_row();?>
                                <div class="<?php echo ($i === 0) ? 'item active' : 'item';?>">
                                    <div class="col-sm-6">
                                        <h1><?php the_sub_field('gallery_title');?></h1>
                                        <h2><?php the_sub_field('gallery_subtitle');?></h2>
                                        <p><?php the_sub_field('gallery_description');?></p>
                                        <button type="button" class="btn btn-default get"><?php the_sub_field('gallery_cta_text');?></button>
                                    </div>
                                    <div class="col-sm-6">
                                        <img src="<?php the_sub_field('gallery_slide');?>" class="girl img-responsive" alt="" />
                                        <img src="<?php the_sub_field('gallery_sticker');?>"  class="pricing" alt="" />
                                    </div>
                                </div>
                                <?php
                                $i++;
                            endwhile; ?>
                        </div>
                        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section><!--/slider-->
<?php endif;?>

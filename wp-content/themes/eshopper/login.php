<?php
/*Template name: login & registration page*/
get_header(); ?>
<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            <?php
            dynamic_sidebar('login-panel');?>
        </div>
    </div>
</section><!--/form-->
<?php get_footer();?>
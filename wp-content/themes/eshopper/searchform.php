<div class="col-sm-3">
    <div class="search_box pull-right">
        <form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ) ?>" >
            <input type="text" value="<?php echo get_search_query() ?>" name="s" id="s" placeholder="Search" />
            <input type="submit" id="searchsubmit" value=""/>
        </form>
    </div>
</div>
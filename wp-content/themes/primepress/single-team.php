<?php get_header(); ?><div class="motopress-wrapper content-holder clearfix">
    <div class="container">
        <div class="row" data-motopress-id="51e76ec4b9f75" data-motopress-file="single-team.php">
            <div class="span12" data-motopress-wrapper-file="single-team.php" data-motopress-wrapper-type="content" data-motopress-id="51e76ec4b9f75">
                <div class="row" data-motopress-id="51e76ec4b9f75" data-motopress-file="single-team.php">
                    <div class="span8 <?php echo of_get_option('blog_sidebar_pos'); ?>" id="content" data-motopress-type="loop" data-motopress-loop-file="loop/loop-single-team.php" data-motopress-id="51e76ec4b9f75" data-motopress-file="single-team.php">
                        <?php get_template_part("loop/loop-single-team"); ?></div>
                    <div class="span4 sidebar" id="sidebar" data-motopress-type="static-sidebar" data-motopress-sidebar-file="sidebar.php" data-motopress-id="51e76ec4b9f75" data-motopress-file="single-team.php">
						<?php get_sidebar(); ?></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
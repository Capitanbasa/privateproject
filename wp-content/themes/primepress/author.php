<?php get_header(); ?><div class="motopress-wrapper content-holder clearfix">
    <div class="container">
        <div class="row" data-motopress-id="51e76ec4a72a8" data-motopress-file="author.php">
            <div class="span12" data-motopress-wrapper-file="author.php" data-motopress-wrapper-type="content" data-motopress-id="51e76ec4a72a8">
                <div class="row" data-motopress-id="51e76ec4a72a8" data-motopress-file="author.php">
                    <div class="span8 <?php echo of_get_option('blog_sidebar_pos'); ?>" id="content" data-motopress-type="loop" data-motopress-loop-file="loop/loop-author.php" data-motopress-id="51e76ec4a72a8" data-motopress-file="author.php">
                        <?php get_template_part("loop/loop-author"); ?></div>
                    <div class="span4 sidebar" id="sidebar" data-motopress-type="static-sidebar" data-motopress-sidebar-file="sidebar.php" data-motopress-id="51e76ec4a72a8" data-motopress-file="author.php">
						<?php get_sidebar(); ?></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
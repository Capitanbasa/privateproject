<?php
/**
 * Template Name: Documentation Page
 */
?>
<?php get_header(); ?>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.scrollTo-min.js" type="text/javascript"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/google-code-prettify/prettify.js" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
         jQuery('#doc-nav a').on('click', function() {
            jQuery('#doc-nav a').removeClass('active');
            $(this).addClass('active');
            jQuery.scrollTo('#' + $(this).attr('href'), {
                duration: 1000
            });
        });
        prettyPrint();
    });
</script>
<div class="motopress-wrapper content-holder clearfix">
    <div class="container">
        <div class="row" data-motopress-id="510903d6c1e51" data-motopress-file="page-documentation.php">
            <div class="span12" data-motopress-wrapper-file="page-documentation.php" data-motopress-wrapper-type="content" data-motopress-id="510903d6c1cf7">
                <div class="row" data-motopress-id="510903d6c1e99" data-motopress-file="page-documentation.php">
                    <div class="span12" data-motopress-type="static" data-motopress-static-file="static/static-title.php" data-motopress-id="510903d6c1ee0" data-motopress-file="page-documentation.php"><?php get_template_part("static/static-title"); ?></div>
                </div>
                <div class="row" data-motopress-id="510903d6c1f27" data-motopress-file="page-documentation.php">
                    <div class="span12" id="content" data-motopress-type="loop" data-motopress-loop-file="loop/loop-page-documentation.php" data-motopress-id="510903d6c1f6e" data-motopress-file="page-documentation.php" style="">
                        <?php get_template_part("loop/loop-page"); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
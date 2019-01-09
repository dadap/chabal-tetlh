<?php
/**
 * @package firmasite
 */
global $firmasite_settings;
global $post;

get_header();
?>

<div id="primary" class="content-area clearfix <?php echo $firmasite_settings["layout_primary_class"]; ?>">

<?php do_action( 'open_content' ); ?>
<?php do_action( 'open_single' ); ?>

<div class="panel panel-default">
    <div class="panel-body">
        <header class="entry-header">
            <h1 class="page-header page-title entry-title unipIqaD">chabal tetlh</h1>
        </header>
        <div class="entry-content">
            <?php echo chabal_tISuq(); ?>
        </div>
    </div>
</div>

<?php do_action( 'close_single' ); ?>
<?php do_action( 'close_content' ); ?>

</div><!-- #primary .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>

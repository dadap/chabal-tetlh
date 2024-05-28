<?php /**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package BuddyBoss_Theme
 */
 
header("location:/chabal");
 

get_header();

?>
<link rel="stylesheet" href="https://www.kli.org/wp-content/plugins/elementor/assets/css/frontend.min.css">
<link rel="stylesheet" href="https://www.kli.org/wp-content/uploads/elementor/css/post-7070.css">
<style>
.elementor-8244 .elementor-element.elementor-element-73bf02be:not(.elementor-motion-effects-element-type-background), .elementor-8244 .elementor-element.elementor-element-73bf02be > .elementor-motion-effects-container > .elementor-motion-effects-layer{background-color:#FFFFFF;}.elementor-8244 .elementor-element.elementor-element-73bf02be, .elementor-8244 .elementor-element.elementor-element-73bf02be > .elementor-background-overlay{border-radius:20px 20px 20px 20px;}.elementor-8244 .elementor-element.elementor-element-73bf02be{transition:background 0.3s, border 0.3s, border-radius 0.3s, box-shadow 0.3s;}.elementor-8244 .elementor-element.elementor-element-73bf02be > .elementor-background-overlay{transition:background 0.3s, border-radius 0.3s, opacity 0.3s;}.elementor-8244 .elementor-element.elementor-element-e8c83c4 .elementor-spacer-inner{height:15px;}.elementor-8244 .elementor-element.elementor-element-17d46f4b{text-align:center;}.elementor-8244 .elementor-element.elementor-element-17d46f4b > .elementor-widget-container{margin:0px 0px 0px 0px;padding:0px 0px 0px 0px;}
</style>


<?php
    $share_box = buddyboss_theme_get_option( 'blog_share_box' );
    if ( !empty( $share_box ) && is_singular('post') ) :
        get_template_part( 'template-parts/share' );
    endif;
?>

<div id="primary" class="content-area"> <!-- bb-grid-cell" -->
<main id="main" class="site-main">

<div class="elementor elementor-8244 elementor-location-single post-6836 chabal type-chabal status-publish hentry muz_Segh-verb pmpro-has-access default-fi" data-elementor-settings="[]">
<div class="elementor-section-wrap">
<section class="elementor-section elementor-top-section elementor-element elementor-element-73bf02be elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="73bf02be"
data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
<div class="elementor-container elementor-column-gap-default">
<div class="elementor-row">
<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-3f99fa9d" data-id="3f99fa9d" data-element_type="column">
<div class="elementor-column-wrap elementor-element-populated">
<div class="elementor-widget-wrap">
<div class="elementor-element elementor-element-e8c83c4 elementor-widget elementor-widget-spacer" data-id="e8c83c4" data-element_type="widget" data-widget_type="spacer.default">

		<?php do_action( THEME_HOOK_PREFIX . '_template_parts_content_top' ); ?>
        		<h1 class="page-header page-title entry-title unipIqaD">chabal tetlh</h1>
            		<?php echo chabal_tISuq(); ?>

</div></div></div></div></div></div></section></div></div>

</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();

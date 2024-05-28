<?php
/**
 * @package firmasite
 */
//global $firmasite_settings;
global $post;

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


		<?php //do_action( 'open_content' ); ?>
		<?php //do_action( 'open_single' ); ?>

<?php if ( have_posts() ) : ?>
<?php    do_action( THEME_HOOK_PREFIX . '_template_parts_content_top' ); ?>
	<?php /* Start the Loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
 	    <div class="panel panel-default">
   		    <div class="panel-body">
				<header class="entry-header">
					<h1 class="page-header page-title entry-title unipIqaD">
    						<strong>Word:</strong> <?php the_title(); ?>
					</h1>
				<p><?php the_terms( 0, 'muz_Segh', "Category: ", ', ', '<br />'); ?></p>
				</header>
    			<div class="entry-content">
                    <?php if (chabal_lajQozluzpuz(get_the_ID())) { ?>
					<div class="row">
						<div class="col-sm-12">
							<h4><strong>This word has been blacklisted. No further votes can be made on it.</strong></h4>
						</div>
					</div>
                    <?php } ?>
   					<div class="row">
						<div class="col-sm-9 unipIqaD">
							<h5><strong>Description/Reason: </strong></h5><div class="unipIqaD"><?php the_content()?></div>
						</div>
						<div class="col-sm-3">
							<div class="wIv" id="chabal_tetlh_<?php the_ID(); ?>"></div>
							<script>
							    window.onload = function () {
    								chabal_tetlh_wpuser = <?php echo get_current_user_id(); ?>;
    								chabal_tetlh_chabal_yIvurmoH(<?php the_ID(); ?>);
							    };
							</script>
                            <?php /* TODO add lock/delete buttons
						        <div class="col-sm-2 pull-right">
							        <button class="btn btn-default pull-right" href="#"><img draggable="false" class="emoji" alt="🔓" src="https://s.w.org/images/core/emoji/11/svg/1f513.svg"></button>
							        <button class="btn btn-default pull-right" href="#">x</button>
						        </div>
                            */ ?>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-sm-3">
							<a class="button outline small" href="/chabal/" role="button">Back to listing</a>
                                <?php if (!chabal_lajQozluzpuz(get_the_ID())) {
							        edit_post_link('Edit Word', '', '', 0, 'post-edit-link button outline small' );
                                }
                                ?>
							    <?php if( is_user_logged_in() && is_author(get_current_user_id()) ) {
    							    edit_post_link('Edit Word', '', '', 0, 'post-edit-link button outline small' );
							    }
							    ?>
						</div>
					</div>

                    <?php if ( comments_open() || get_comments_number() ) : ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <p>Comment below with feedback and suggestions.</p>
                        </div>
                    </div>
                     <div class="row">
                        <div class="col-sm-12">
                            <?php comments_template(); ?>
                        </div>
                    </div>
                    <?php endif; ?>


    			</div>
   			</div>
 		</div>
	</article>
	<!-- #post-<?php the_ID(); ?> -->

	<?php endwhile; ?>

<?php else : ?>
	<?php get_template_part( 'templates/no-results', 'index' ); ?>
<?php endif; ?>
</div></div></div></div></div></div></section></div></div>
<?php //do_action( 'close_single' ); ?>
<?php //do_action( 'close_content' ); ?>

</div><!-- #primary .content-area -->
<?php //get_sidebar(); ?>
<?php get_footer(); ?>

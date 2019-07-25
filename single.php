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

<?php if ( have_posts() ) : ?>

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
								chabal_tetlh_wpuser = <?php echo get_current_user_id(); ?>;
								chabal_tetlh_chabal_yIvurmoH(<?php the_ID(); ?>);
							</script>
						</div>
					</div>
					<hr>
					   <div class="row">
						<div class="col-sm-3">
							<a class="btn btn-primary" href="/chabal/" role="button">Back to listing</a>
                                                        <?php if (!chabal_lajQozluzpuz(get_the_ID())) {
							          edit_post_link( __('Edit Word', 'firmasite'), '', '', 0, 'post-edit-link btn btn-default' );
                                                              }
                                                        ?>
						</div>
                                                <div class="col-sm-9">
							<p>Comment below with feedback and suggestions.</p>
						</div>
<?php /* TODO add lock/delete buttons
						<div class="col-sm-2 pull-right">
							<button class="btn btn-default pull-right" href="#"><img draggable="false" class="emoji" alt="🔓" src="https://s.w.org/images/core/emoji/11/svg/1f513.svg"></button>
							<button class="btn btn-default pull-right" href="#">x</button>
						</div>
*/ ?>
					   </div>
    					</div>
   				</div>
 			</div>
		</article>
	<!-- #post-<?php the_ID(); ?> -->

	<?php endwhile; ?>

<?php else : ?>
	<?php get_template_part( 'templates/no-results', 'index' ); ?>
<?php endif; ?>

<?php do_action( 'close_single' ); ?>
<?php do_action( 'close_content' ); ?>

</div><!-- #primary .content-area -->

<?php get_sidebar(); ?>
<?php get_footer("chabal"); ?>

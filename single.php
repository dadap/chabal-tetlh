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
        					<h1 class="page-header page-title entry-title">
            						<strong>Word: <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'firmasite' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></strong>
        					</h1>
    					</header>
    					<div class="entry-content">
					   <div class="row">
						<div class="col-xs-8">
							<h5><strong>Description/Reason: </strong><?php the_content()?></h5>
						</div>
						<div class="col-xs-4">
							Voting Data (doesn't work)
             <div class="wIv" id="chabal_tetlh_5507">
		<div class="leQmey">
                    <button class="nupmoH" onclick="chabal_tetlh_chabal_yIpatlh(this);">-</button>
                    <button class="ghurmoH wIvbogh" onclick="chabal_tetlh_chabal_yIpatlh(this);">+</button>
                </div>
                    <div class="mIz_toghbogh">1</div>
                    <div class="gherzID_naQ">
                        (+1 /
                         -0)
                    </div>
                </div>

						</div>
					   </div>
					<hr>
					   <div class="row">
						<div class="col-sm-3">
							<a class="btn btn-primary" href="/chabal-tetlh/" role="button">Back to listing</a>
							<?php edit_post_link( __('Edit Word', 'firmasite'), '', '', 0, 'post-edit-link btn btn-default' ); ?>
						</div>
                                                <div class="col-sm-7">
							<p>Comment below with feedback and suggestions.</p>
						</div>
						<div class="col-sm-2 pull-right">
							<button class="btn btn-default pull-right" href="#"><img draggable="false" class="emoji" alt="🔓" src="https://s.w.org/images/core/emoji/11/svg/1f513.svg"></button>
							<button class="btn btn-default pull-right" href="#">x</button>
						</div>
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
<?php get_footer(); ?>

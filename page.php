<?php get_header(); ?>

	<div class="row">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); //The Loop?>
		<article <?php post_class('col-xs-12')?>>
			<div class="white-box">
				<div class="postdate">
					<div class="postday"><?php echo get_the_date('jS'); ?></div>
					<div class="postmonth"><?php echo get_the_date('M'); ?></div>
					<div class="postyear"><?php echo get_the_date('\'y'); ?></div>
				</div>
				<header><h1><?php the_title()?></h1></header>
				<?php the_content()?>
				<footer>
					<?php the_date()?> <a href="<?php the_permalink(); ?>"><?php _e('Permalink');?></a> <?php wp_link_pages( array( 'before' => __('Pages'), 'after' =>'' ) ); ?>
				</footer>
			</div>
		</article>

		<div class="col-xs-12">
			<div class="white-box">
				<?php comments_template()?>
			</div>
		</div>
	<?php endwhile;endif;?>
	</div>

<?php get_footer(); ?>

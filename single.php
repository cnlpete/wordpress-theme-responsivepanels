<?php get_header(); ?>

<div class="row">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<article <?php post_class('col-xs-12')?>>
			<div class="postdate">
				<div class="postday"><?php echo get_the_date('jS'); ?></div>
				<div class="postmonth"><?php echo get_the_date('M'); ?></div>
				<div class="postyear"><?php echo get_the_date('\'y'); ?></div>
			</div>
			<header class="white-box">
				<h1><?php the_title()?></h1>
				<div class="text-right">
					<?php if ( comments_open() ) : ?>
						<span class="comments-link">
							<?php comments_popup_link(); ?>
						</span>
					<?php endif; ?>
				</div>
			</header>
			<article class="white-box">
				<?php the_content()?>
			</article>
			<footer class="white-box">
				<?php the_date()?> <a href="<?php the_permalink(); ?>"><?php _e('Permalink', 'responsivepanels');?></a> <?php wp_link_pages(array('before' => __('Pages', 'responsivepanels'), 'after' =>'')); ?><br/>
				<?php _e('Categories', 'responsivepanels'); ?>: <?php the_category(', '); ?>
				<?php if(has_tag()) {
					echo "<br />";
					the_tags( _e('Tags', 'responsivepanels') . ': ', ', ');
				}?>
			</footer>
		</article>

		<div class="col-xs-12">
			<div class="white-box">
				<?php comments_template('', true); ?>
			</div>
		</div>
	<?php endwhile;endif;?>
</div>

<div class="row">
	<div class="col-xs-6 col-sm-5 col-md-4 col-ld-3">
		<div class="white-box">
			<?php previous_post_link(); ?>
		</div>
	</div>
	<div class="col-xs-6 col-sm-5 col-sm-offset-2 col-md-4 col-md-offset-4 col-ld-3 col-ld-offset-6">
		<div class="white-box text-right">
			<?php next_post_link(); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>

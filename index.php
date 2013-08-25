<?php get_header(); ?>

<?php if (have_posts()) : ?>

<div class="row js-myposts">
	<?php while (have_posts()) : the_post(); ?>

		<div <?php post_class('col-sm-4 col-md-3 col-lg-2')?>>
			<div class="white-box">
				<div class="postdate">
					<div class="postday"><?php echo get_the_date('jS'); ?></div>
					<div class="postmonth"><?php echo get_the_date('M'); ?></div>
					<div class="postyear"><?php echo get_the_date('\'y'); ?></div>
				</div>
				<a href="<?php the_permalink()?>"
						title="<?php the_title_attribute(); ?>"
						rel="bookmark"
						class="thumbnail">
					<?php if(has_post_thumbnail()) : ?>
						<?php the_post_thumbnail('medium', array('class' => "img-responsive")); ?>
					<?php else: ?>
						<div class="text-title">
							<?php the_title_attribute(); ?>
						</div>
					<?php endif; ?>
				</a>
				<div class="row">
					<div class="col-xs-12 text-right">
						<a href="<?php the_permalink()?>#comments" title="<?php comments_number(); ?>">
							<?php printf(__('Comments: %s'), '<span class="badge">' . get_comments_number() . '</span>'); ?>
						</a>
					</div>
				</div>
			</div>
		</div>

	<?php endwhile; ?>
	<script type="text/javascript">
		var container = document.querySelector('.js-myposts');
		var msnry;
		// initialize Masonry after all images have loaded
		imagesLoaded( container, function() {
			msnry = new Masonry( container, { itemSelector: '.post' } );
		});
	</script>
</div>

<div class="row navigation">
	<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
		<?php if("" != get_next_posts_link('next')): ?>
			<div class="white-box text-left">
				<?php next_posts_link(__('&laquo; Previous Page')); ?>
			</div>
		<?php endif; ?>
	</div>
	<div class="col-xs-6 col-sm-4 col-sm-offset-4 col-md-3 col-md-offset-6 col-lg-2 col-sm-offset-8">
		<?php if("" != get_previous_posts_link('prev')): ?>
			<div class="white-box text-right">
				<?php previous_posts_link(__('Next Page &raquo;')); ?>
			</div>
		<?php endif; ?>
	</div>
</div>

<?php else : ?>
	<div class="row">
		<div id="col-xs-12">
			<h1><?php _e('No WordPress posts found','responsivepanels')?></h1>
			<p><?php _e('There are no WordPress posts to display here.','responsivepanels')?></p>
		</div>
	</div>
<?php endif; ?>

<?php get_footer(); ?>

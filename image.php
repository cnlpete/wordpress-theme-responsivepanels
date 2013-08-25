<?php get_header(); ?>

<?php if (have_posts()): ?>
	<?php while (have_posts()) : the_post(); ?>

	<div class="row">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="col-xs-12">
				<header class="white-box">
					<h1 class="post-title"><?php the_title(); ?></h1>
					<p class="col-xs-6">
						<a href="<?php echo get_permalink($post->post_parent); ?>" rel="gallery">
							&loquo; <?php echo get_the_title($post->post_parent); ?>
						</a>
					</p>
					<div class="col-xs-6 text-right">
						<?php if ( comments_open() ) : ?>
							<span class="comments-link">
								<?php comments_popup_link(); ?>
							</span>
						<?php endif; ?>
					</div>
					<div class="clearfix"></div>
					<?php edit_post_link(__('(Edit)', 'responsivepanels'), '<div class="col-xs-12 text-right">', '</div>'); ?>
				</header>
			</div>
			<div class="clearfix"></div>

			<div class="col-xs-12">
				<div class="white-box text-center imagebox">
					<a href="<?php echo wp_get_attachment_url($post->ID); ?>">
						<?php echo wp_get_attachment_image( $post->ID, 'large' ); ?>
					</a>
					<?php if(!empty($post->post_excerpt)) the_excerpt(); ?>
					<?php the_content(__('Read more &#8250;', 'responsive')); ?>
					<?php wp_link_pages(array('before' => '<div class="pagination">' . __('Pages:'), 'after' => '</div>')); ?>
				</div>
			</div>
			<div class="clearfix"></div>

			<div class="col-xs-12">
				<div class="white-box">
					<?php _e('Categories');?>: <?php the_category(', '); ?>
					<?php if(has_tag()) { echo "<br />"; the_tags( _e('Tags') . ': ', ', '); } ?> 
				</div>
			</div>
			<div class="clearfix"></div>

			<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
				<div class="white-box text-center">
					<?php previous_image_link('thumbnail'); ?>
				</div>
			</div>
			<div class="col-xs-6 col-sm-4 col-sm-offset-4 col-md-3 col-md-offset-6 col-lg-2 col-lg-offset-8">
				<div class="white-box text-center">
					<?php next_image_link('thumbnail'); ?>
				</div>
			</div>
			<div class="clearfix"></div>

		</article>

		<div class="col-xs-12">
			<div class="white-box">
				<?php comments_template( '', true ); ?>
			</div>
		</div>

	</div>
	<?php endwhile; ?>
<?php else: ?>
	<div class="row">
		<div id="col-xs-12">
			<h1><?php _e('No WordPress posts found','responsivepanels')?></h1>
			<p><?php _e('There are no WordPress posts to display here.','responsivepanels')?></p>
		</div>
	</div>
<?php endif; ?>

<?php get_footer(); ?>

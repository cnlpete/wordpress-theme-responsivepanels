	<div id="comments">
<?php if(post_password_required()): ?>
		<p class="nopassword">
			<?php _e('This post is password protected. Enter the password to view any comments.', 'responsivepanels'); ?>
		</p>
	</div><!-- #comments -->
<?php
	return;
endif;
?>

<?php if(have_comments()): ?>
	<h3 id="comments-title">
		<?php 
			printf(_n('One Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), 'responsivepanels'),
				number_format_i18n(get_comments_number()),
				'<em>' . get_the_title() . '</em>');
		?>
	</h3>

	<?php if(get_comment_pages_count() > 1 && get_option('page_comments')): ?>
		<ul class="pager">
			<li class="previous"><?php previous_comments_link(__('<span class="meta-nav">&larr;</span> Older Comments', 'responsivepanels')); ?></li>
			<li class="next"><?php next_comments_link(__('Newer Comments <span class="meta-nav">&rarr;</span>', 'responsivepanels')); ?></li>
		</ul>
	<?php endif; ?>

	<ol class="commentlist">
		<?php wp_list_comments('avatar_size=60'); ?>
	</ol>

	<?php if(get_comment_pages_count() > 1 && get_option('page_comments')): ?>
		<ul class="pager">
			<li class="previous"><?php previous_comments_link(__('<span class="meta-nav">&larr;</span> Older Comments', 'responsivepanels')); ?></li>
			<li class="next"><?php next_comments_link(__('Newer Comments <span class="meta-nav">&rarr;</span>', 'responsivepanels')); ?></li>
		</ul>
	<?php endif; ?>

<?php else: // we don't have comments
	if(!comments_open()): ?>
		<p class="nocomments">
			<?php _e('Comments are closed.', 'responsivepanels'); ?>
		</p>
	<?php endif; ?>

<?php endif; ?>

<?php comment_form(); ?>

</div>

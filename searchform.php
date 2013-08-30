<form method="get" id="searchform" action="<?php echo esc_url(home_url('/')); ?>">
	<div class="input-group">
		<input type="text" class="form-control" name="s" placeholder="<?php _e('Search', 'responsivepanels'); ?>" id="s" />
		<span class="input-group-btn">
			<button type="button" id="searchsubmit" class="btn btn-default"><?php _e('Search', 'responsivepanels'); ?></button>
		</span>
	</div>
</form>


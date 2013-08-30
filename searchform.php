<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="input-group">
		<input type="text" class="form-control" name="s" placeholder="<?php _e('Search'); ?>" id="s" />
		<span class="input-group-btn">
			<button type="button" id="searchsubmit" class="btn btn-default"><?php _e('Search'); ?></button>
		</span>
	</div>
</form>


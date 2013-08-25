	<div class="row">

		<div class="col-xs-12 col-sm-6">
			<?php wp_nav_menu( array(
				'theme_location' => 'left-footer-menu',
				'depth' => 0,
				'container' => 'div',
				'container_class' => 'white-box',
				'menu_class' => 'nav nav-pills nav-stacked',
				'fallback_cb' => 'wp_page_menu',
				//Process nav menu using our custom nav walker
				'walker' => new wp_bootstrap_navwalker())); ?>

			<?php dynamic_sidebar('footer-left'); ?>
		</div>

		<div class="col-xs-12 col-sm-6">
			<?php wp_nav_menu( array(
				'theme_location' => 'right-footer-menu',
				'depth' => 0,
				'container' => 'div',
				'container_class' => 'white-box',
				'menu_class' => 'nav nav-pills nav-stacked',
				'fallback_cb' => 'wp_page_menu',
				//Process nav menu using our custom nav walker
				'walker' => new wp_bootstrap_navwalker())); ?>

			<?php dynamic_sidebar('footer-right'); ?>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<p class="white-box text-right"><small>Copyright &copy; <a title="<?php bloginfo('title')?>" href="<?php echo site_url()?>"><?php bloginfo('title')?></a> - <?php printf(__('Powered by <a href="http://wordpress.org" title="%1$s">%2$s</a>, Theme by <a href="http://panels.cnlpete.de" title="%3$s">%4$s</a>', 'responsivepanels'), esc_attr('WordPress'), esc_attr('WordPress'), esc_attr('Hauke Schade'), esc_attr('Hauke Schade')); ?>.</small></p>
		</div>
	</div>
</div>
<?php wp_footer()?>
</body>
</html>

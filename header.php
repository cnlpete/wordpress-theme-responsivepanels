<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html <?php language_attributes('xhtml'); ?> xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="<?php bloginfo('html_type')?>;charset=<?php bloginfo('charset'); ?>"/>
	<title><?php wp_title( '|', true, 'left' ); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="profile" href=" http://gmpg.org/xfn/11" />
	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<?php wp_enqueue_style("bootstrap-flatly"); ?>
	<?php wp_enqueue_script("jquery"); ?>
	<?php wp_enqueue_script("imagesloaded"); ?>
	<?php wp_enqueue_script("masonry"); ?>
	<?php wp_enqueue_script("bootstrap-js"); ?>
	<?php wp_head()?>
</head>
<body <?php body_class()?>>

<div class="container">

	<header class="page-header hidden-xs">
		<div id="headerimage">
			<a href="<?php echo site_url()?>" title="<?php bloginfo('name')?>">
				<img src="<?php header_image(); ?>" alt="<?php bloginfo('name')?>" />
			</a>
		</div>
	</header>

	<nav class="navbar navbar-default" role="navigation">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				<span class="sr-only"><?php _e('Toggle navigation', 'responsivepanels');?></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?php echo site_url(); ?>">
				<?php bloginfo('name')?>
			</a>
		</div>
		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<?php
$args = array(
	'child_of' => 2,
	'title_li' => '',
	'depth' => 1);
			?>
			<ul class="nav navbar-nav">
				<?php wp_list_categories($args); ?>
			</ul>
		</div>
	</nav>


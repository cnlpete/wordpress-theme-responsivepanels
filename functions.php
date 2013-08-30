<?php

if (!is_admin())
	add_action('wp_enqueue_scripts', 'responsivepanels_js');

function responsivepanels_js() {
	wp_enqueue_style('responsivepanels-style', get_stylesheet_uri());
	if ( is_singular() && get_option('thread_comments') )
		wp_enqueue_script('comment-reply');
}

add_theme_support('post-thumbnails');
set_post_thumbnail_size(200, 200, true);

function responsivepanels_main_image() {
	$files = get_children('post_parent='.get_the_ID().'&post_type=attachment&post_mime_type=image&order=desc');
	if($files) :
		$keys = array_reverse(array_keys($files));
		$j=0;
		$num = $keys[$j];
		$image=wp_get_attachment_image($num, 'large', true);
		$imagepieces = explode('"', $image);
		$imagepath = $imagepieces[1];
		$main=wp_get_attachment_url($num);
		$template=get_template_directory();
		$the_title=the_title_attribute( 'echo=0');
		print "<img src='$main' alt='$the_title' />";
	endif;
}

function responsivepanels_menu() {
	register_nav_menus(
		array(
			'header-menu' => __('Header Menu', 'responsivepanels'),
			'left-footer-menu' => __('Left Footer Menu', 'responsivepanels'),
			'right-footer-menu' => __('Right Footer Menu', 'responsivepanels')
		)
	);
}
add_action('init', 'responsivepanels_menu');

$custom_header_support = array(
	'default-image' => get_template_directory_uri() . '/headers/001.jpg',
	'width' => apply_filters('responsivepanels_header_image_width', 938),
	'height' => apply_filters('responsivepanels_header_image_height', 180),
	'flex-height' => true,
	'flex-width' => true,
	'header-text' => false,
	'uploads' => true,
);
add_theme_support('custom-header', $custom_header_support);

add_theme_support('custom-background', array(
	'default-image' => get_stylesheet_directory_uri() . '/img/bg.jpg',
	'default-color' => 'FFFFFF'
));

function responsivepanels_title($title) {
	if ($title == '') {
		return __('Untitled Post', 'responsivepanels');
	} else {
		return $title;
	}
}
//add_filter('the_title', 'responsivepanels_title');

function responsivepanels_custom_excerpt_length($length) {
	return 40;
}
add_filter('excerpt_length', 'responsivepanels_custom_excerpt_length', 999);

function responsivepanels_widgets_init() {
	register_sidebar(array(
		'name' => __('Footer Left', 'responsivepanels'),
		'id' => 'footer-left',
		'description' => __('The left footer widget area.', 'responsivepanels'),
		'before_widget' => '<div class="white-box">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));

	register_sidebar(array(
		'name' => __('Footer Right', 'responsivepanels'),
		'id' => 'footer-right',
		'description' => __('The right footer widget area.', 'responsivepanels'),
		'before_widget' => '<div class="white-box">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));
}
add_action('widgets_init', 'responsivepanels_widgets_init');

// comment form defaults
function responsivepanels_comment_fields($fields) {
	$commenter = wp_get_current_commenter();
	$req = get_option('require_name_email');
	$aria_req = ($req ? " aria-required='true'" : '');
	$req_string = ($req ? ' <span class="required">*</span>' : '');

	$fields['author'] = '<div class="comment-form-author form-group">' .
		'<label for="author">' . __('Name', 'responsivepanels') . $req_string . '</label> ' .
		'<input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" class="form-control"' . $aria_req . ' /></div>';

	$fields['email'] = '<div class="comment-form-email form-group">' .
		'<label for="email">' . __('Email', 'responsivepanels') . $req_string . '</label> ' .
		'<input id="email" name="email" type="email" value="' . esc_attr($commenter['comment_author_email']) . '" class="form-control"' . $aria_req . ' />' .
		'<p class="comment-notes help-block">' . __( 'Your email address will not be published.', 'responsivepanels') . ($req ? $required_text : '') . '</p>' .
		'</div>';

	$fields['url'] = '<div class="comment-form-url form-group">' .
		'<label for="url">' . __('Website', 'responsivepanels') . '</label> ' .
		'<input id="url" name="url" type="url" type="text" value="' . esc_attr($commenter['comment_author_url']) . '" class="form-control" /></div>';

	return $fields;
function responsivepanels_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
			<div class="comment-author vcard">
				<?php echo get_avatar( $comment, 40 ); ?>
				<?php printf(__('%s <span class="says">says:</span>', 'responsivepanels'), sprintf('<cite class="fn">%s</cite>', get_comment_author_link())); ?>
			</div><!-- .comment-author .vcard -->
			<?php if($comment->comment_approved == '0') : ?>
				<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'responsivepanels'); ?></em>
				<br />
			<?php endif; ?>

			<div class="comment-meta commentmetadata">
				<a href="<?php echo esc_url(get_comment_link($comment->comment_ID )); ?>">
					<?php
						/* translators: 1: date, 2: time */
						printf(__( '%1$s at %2$s', 'responsivepanels' ), 
								get_comment_date(), 
								get_comment_time()); ?>
				</a>
				<?php edit_comment_link(__('(Edit)', 'responsivepanels'), ' '); ?>
			</div><!-- .comment-meta .commentmetadata -->

			<div class="comment-body"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
			</div><!-- .reply -->
		</div><!-- #comment-##  -->
	</li>
	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p>
			<?php _e('Pingback:', 'responsivepanels'); ?> 
			<?php comment_author_link(); ?>
			<?php edit_comment_link(__('(Edit)','responsivepanels'), ' '); ?>
		</p>
	</li>
	<?php
		break;
	endswitch;
}
add_filter('comment_form_default_fields', 'responsivepanels_comment_fields');

function responsivepanels_comment_form_defaults($defaults) {
	$user = wp_get_current_user();
	$user_identity = $user->exists() ? $user->display_name : '';

	$defaults['comment_field'] = '<div class="comment-form-comment form-group">' .
		'<label for="comment">' . _x('Comment', 'noun', 'responsivepanels') . '</label>' .
		'<textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" class="form-control"></textarea></div>';
	$defaults['must_log_in'] = '<div class="must-log-in">' . 
		sprintf(__('You must be <a href="%s">logged in</a> to post a comment.', 'responsivepanels'), 
			wp_login_url(apply_filters('the_permalink', get_permalink($post_id)))) .
		'</div>';
	$defaults['logged_in_as'] = '<div class="logged-in-as">' . 
		sprintf(__('Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>'),
			get_edit_user_link(),
			$user_identity,
			wp_logout_url(apply_filters('the_permalink', get_permalink($post_id)))) .
		'</div>';
	$defaults['comment_notes_before'] = sprintf(' ' . __('Required fields are marked %s', 'responsivepanels'), '<span class="required">*</span>');
	$defaults['comment_notes_after'] = '<p class="form-allowed-tags help-block">' . sprintf(__('You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', 'responsivepanels'), ' <pre class=".pre-scrollable">' . allowed_tags() . '</pre>') . '</p>';
	$defaults['format'] = 'html5';
	return $defaults;
}
add_filter('comment_form_defaults', 'responsivepanels_comment_form_defaults', 999);

//Required by WordPress
add_theme_support('automatic-feed-links');

//LOCALIZATION
//Enable localization
load_theme_textdomain('responsivepanels', get_template_directory() . '/languages');

// filter function for wp_title
function responsivepanels_filter_wp_title( $old_title, $sep, $sep_location ){
	// add padding to the sep
	$ssep = ' ' . $sep . ' ';

	// find the type of index page this is
	if( is_tag() ) 
		$insert = $ssep . __('Tag', 'responsivepanels');
	elseif( is_author() ) 
		$insert = $ssep . __('Author', 'responsivepanels');
	elseif( !is_category() && (is_year() || is_month() || is_day()) ) 
		$insert = $ssep . __('Archive', 'responsivepanels');
	else 
		$insert = NULL;

	// get the page number we're on (index)
	if(get_query_var('paged'))
		$num = sprintf($ssep . __('Page %s', 'responsivepanels'), get_query_var( 'paged' ));

	// get the page number we're on (multipage post)
	elseif(get_query_var('page'))
		$num = sprintf($ssep . __('Page %s', 'responsivepanels'), get_query_var( 'page' ));

	// else
	else
		$num = NULL;

	// concoct and return new title
	return get_bloginfo('name') . $insert . $old_title . $num;
}
add_filter('wp_title', 'responsivepanels_filter_wp_title', 10, 3);

// add some bootstrap styles
wp_register_style('bootstrap-amelia', '//netdna.bootstrapcdn.com/bootswatch/3.0.0/amelia/bootstrap.min.css');
wp_register_style('bootstrap-cerulean', '//netdna.bootstrapcdn.com/bootswatch/3.0.0/cerulean/bootstrap.min.css');
wp_register_style('bootstrap-cosmo', '//netdna.bootstrapcdn.com/bootswatch/3.0.0/cosmo/bootstrap.min.css');
wp_register_style('bootstrap-cyborg', '//netdna.bootstrapcdn.com/bootswatch/3.0.0/cyborg/bootstrap.min.css');
wp_register_style('bootstrap-flatly', '//netdna.bootstrapcdn.com/bootswatch/3.0.0/flatly/bootstrap.min.css');
wp_register_style('bootstrap-journal', '//netdna.bootstrapcdn.com/bootswatch/3.0.0/journal/bootstrap.min.css');
wp_register_style('bootstrap-readable', '//netdna.bootstrapcdn.com/bootswatch/3.0.0/readable/bootstrap.min.css');
wp_register_style('bootstrap-simplex', '//netdna.bootstrapcdn.com/bootswatch/3.0.0/simplex/bootstrap.min.css');
wp_register_style('bootstrap-slate', '//netdna.bootstrapcdn.com/bootswatch/3.0.0/slate/bootstrap.min.css');
wp_register_style('bootstrap-spacelab', '//netdna.bootstrapcdn.com/bootswatch/3.0.0/spacelab/bootstrap.min.css');
wp_register_style('bootstrap-united', '//netdna.bootstrapcdn.com/bootswatch/3.0.0/united/bootstrap.min.css');

// add the bootstrap js
wp_register_script('bootstrap-js', '//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js');
// add the masonry js
wp_register_script('masonry', get_template_directory_uri() . '/jquery.masonry.min.js');
// add the imagesLoaded js
wp_register_script('imagesloaded', get_template_directory_uri() . '/jquery.imagesloaded.min.js');

require ( get_template_directory() . '/wp_bootstrap_navwalker.php' );
?>

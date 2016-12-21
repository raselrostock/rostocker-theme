<?php 
/*
		@package rasel_rostocker
*/
if( post_password_required())
{
	return;
}
?>
<div id="comments" class="comments-area">
	<?php
		if(have_comments()):
			//We have comments

		?>
	<h2 class="comment-title">
		<?php 
			printf( 
				esc_html(_nx('One comment on &ldquo;%2s&rdquo;', '%1s comments on &ldquo;%2s&rdquo;', get_comments_number(), 'comments title','rostockertheme')),number_format_i18n(get_comments_number()),
				'<span>'.get_the_title().'</span>'
				);
		?>
	</h2>
	<?php rostocker_get_post_navigation();?>

	<ol class="comment-list">
		<?php
			$args=array(
					'walker' 			=>null,
					'max_depth' 		=> '',
					'style'				=>'ol',
					'callback'			=>null,
					'end-callback'		=>null,
					'type'				=>'all',
					'reply_text'	=>'Reply',
					'page'				=>'',
					'per_page'			=>'',
					'avatar_size'		=>32,
					'reverse_top_level'	=> null,
					'reverse_children'	=>'',
					'format'		=>'html5',
					'short_ping'		=>false,
					'echo'				=>true

				);
			wp_list_comments( $args );
		?>
	</ol>

	<?php rostocker_get_post_navigation();?>

	<?php
		if( !comments_open( ) && get_comments_number()):
	?>
	<p class="no-comments"><?php esc_html_e( 'Comments are closed','rostockertheme');?></p>
	<?php
			endif;

	?>
	<?php
		endif;
	?>
	<?php
	$fields =array(
		'author'		=>'<div class="form-group"><label for="author">'.__('Name','rostockertheme').'</label><span class="required">*</span><input id="author" name="author" type="text" class="form-control" value="'.esc_attr($commenter['comment_author'] ).'" required="required"/></div>',

		'email'		=>'<div class="form-group"><label for="email">'.__('Email','rostockertheme').'</label><span class="required">*</span><input id="email" name="email" type="text" class="form-control" value="'.esc_attr($commenter['comment_author_email'] ).'" required="required" /></div>',
		'url'		=>'<div class="form-group  last-field"><label for="url">'.__('Website','rostockertheme').'</label><input id="url" name="url" type="text" class="form-control" value="'.esc_attr($commenter['comment_author_url'] ).'"/></div>'

		);
	$args = array(
		'class_submit' 		=>'btn btn-block btn-lg btn-warning',
		'label_submit'		=>__('Submit Comment'),
		'comment_field'		=> '<div class="form-group"><label for="comment">'.__('Comment','rostockertheme').'</label><textarea id="comment" name="comment" class="form-control" rows=" 8" required="required"></textarea></div>',
		'fields'			=>apply_filters('comment_form_default_fields', $fields)
		);
	comment_form($args);
	?>

</div> 		<!--comments-->

<?php
/*
		@package rasel_rostocker
=======================================
		AJAX FUNCTION
========================================
*/
// For all user
add_action( 'wp_ajax_nopriv_rostocker_load_more', 'rostocker_load_more' );
//Only for the logged user
add_action( 'wp_ajax_rostocker_load_more', 'rostocker_load_more' );
// For all user
add_action( 'wp_ajax_nopriv_rostocker_save_user_contact_form', 'rostocker_save_contact' );
//Only for the logged user
add_action( 'wp_ajax_rostocker_save_user_contact_form', 'rostocker_save_contact' );

function rostocker_load_more(){
	$paged = $_POST["page"]+1;
	$prev = $_POST["prev"];
	$archive = $_POST["archive"];
	if( $prev== 1 && $_POST["page"] != 1)
	{
		$paged = $_POST["page"]-1;
	}
	$args =  array(
		'post_type' => 'post',
		'post_status' =>'publish',
		'paged' => $paged
		);

	if( $archive != '0' )
	{
		$archVal = explode( '/', $archive);
		$flipped = array_flip($archVal);

		switch( isset( $flipped )) 
		{
			case $flipped['category'] :
				$type = 'category_name';
				$key = 'category';
				break;
			case $flipped['tag'] :
				$type = 'tag';
				$key = $type;
				break;
			
			case $flipped['author'] :
				$type = 'author';
				$key = $type;
			    break;
		}
		$curKey = array_keys($archVal,$key);
		$nextKey= $curKey[0]+ 1;
		$value = $archVal[ $nextKey];
		$args[$type] = $value;

		// Check page trail and remove "page" value
		if( isset($flipped['page']))
		{
			$pageVal = explode('page', $archive);
			$page_trail=$pageVal[0];
		}
		else
		{

			$page_trail = $archive;
		}
		
	}
	else
	{
		$page_trail = '/';
	}
	$query = new WP_Query( $args );
	if ( $query->have_posts() ):
		echo '<div class="page-limit" data-page="'.$page_trail.'page/'.$paged.'/">';
		while( $query->have_posts() ): $query->the_post();
			get_template_part( 'template-parts/content', get_post_format() );
		endwhile;
		echo "</div>";
		else:
			echo 0;
	endif;
	wp_reset_postdata();
	die();
	
}

function rostocker_check_paged( $num = null ){
	$output = '';
	if( is_paged() )
	{
		$output = 'page/'. get_query_var( 'paged' );
	}
	if( $num == 1)
	{
		$paged = ( get_query_var( 'paged' ) == 0 ? 1 : get_query_var( 'paged' ));
		return $paged;
	}
	else
	{
		return $output;
	}

}

function rostocker_save_contact()
{
	$title = wp_strip_all_tags($_POST['name']);
	$email = wp_strip_all_tags($_POST['email']);
	$message = wp_strip_all_tags($_POST['message']);
	$args = array(
		'post_title'		=>$title,
		'post_content'		=>$message,
		'post_author'		=>1,
		'post_status'		=>'publish',
		'post_type'		=>'rostocker-contact',
		'meta_input'	=>array(
					'_contact_email_value_key'  =>$email
			),
	);
	$postID = wp_insert_post($args);
	if($postID !== 0)
	{
		$to = get_bloginfo('admin_email');
		$subject = 'Rostocker Contact Form - '.$title;
		$headers[] = 'From: '.get_bloginfo('name').'<'.$to.'>';
		$headers[] = 'Reply-To: '.$title.' <'.$email.'>';
		$headers[] = 'Content-Type: text/html: charset=UTF-8';
		wp_mail( $to, $subject, $message, $headers);
		echo $postID;	
	}
	else
	{
		echo 0;
	}
	die();
}
<?php
/*
		@package rasel_rostocker
=======================================
		SHORTCODE OPTIONS
========================================
*/
function rostocker_tooltip( $atts, $content = null )
{
	$atts = shortcode_atts(
				array(
					'placement' => 'top',
					'title' 	=> ''

					),
					$atts,
					'tooltip'
 	);
 	$title = ( $atts['title'] =='' ? $content : $atts['title']);
 	return ' <span class="rostocker-tooltip" data-toggle="tooltip" type="button" data-placement="'.$atts['placement'].'" title="Tooltip on top">'.$content.' </span>';
}
add_shortcode( 'tooltip', 'rostocker_tooltip' );

/*
=======================================
		[tooltip placement='top' title='the title'] content [/tooltip]
========================================
*/
function rostocker_popover( $atts, $content = null )
{
	/*
		[popover title='the title' placement="top" trigger="click" content="popover content"] content [/popover]
*/
	$atts = shortcode_atts(
				array(
					'placement' => 'bottom',
					'title' 	=> '',
					'trigger'	=>'click',
					'content'	=>'',

					),
					$atts,
					'popover'
 	);
	//retutn html
	/*
	<button type="button" class="btn btn-lg btn-danger" data-toggle="popover" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?">Click to toggle popover</button>
	*/
 	return '<span class="rostocker-popover" data-toggle="popover" data-placement="'.$atts['placement'].'" title="'.$atts['title'].'" data-trigger="'.$atts['trigger'].'" data-content="'.$atts['content'].'">'.$content.' </span>';

}
add_shortcode( 'popover', 'rostocker_popover' );
/*
=======================================
		CONTACT FORM SHORTCODE OPTIONS
========================================
*/
function rostocker_contact_form( $atts, $content = null )
{
	//[contact_form]
	
	//get the attributes
	$atts = shortcode_atts(
				array(),
					$atts,
					'contact_form'
 	);
 	//return HTML
	ob_start();
 	include 'templates/contact-form.php';
 	return ob_get_clean();
 	
}
add_shortcode( 'contact_form', 'rostocker_contact_form' );
<?php
/*
@package rostocker-theme

*/
if( ! is_active_sidebar('rostocker-sidebar'))
{
	return;
}
?>
<aside id="secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar('rostocker-sidebar');?>
	
</aside>
<?php
/**
 * Template part for displaying latest work section in front-page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package inpress
 */

$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;


$args = array(
	'paged' => $paged,
	'posts_per_page' => 9,
	'cat' => 2,
);
// echo 'here';

$query = new WP_Query( $args);
	if($query->have_posts() ):

		while($query->have_posts() ):
			$query->the_post();
			get_template_part( 'template-parts/content', 'archive');

		endwhile;
		// if (function_exists("pagination")) {
		// 	pagination($the_query->max_num_pages);
		// }
	else:
		echo 'No News Found';
		
	endif;
	

?> 
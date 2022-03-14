<?php
/**
 * Template part for displaying latest work section in front-page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package inpress
 */

$args = array(
	'posts_per_page' => 1,
	'cat' => 3,
);

$query = new WP_Query( $args);
	if($query->have_posts() ):
		echo '<h3>Latest Work</h3>';
		while($query->have_posts() ):
			$query->the_post();
			the_content();
		endwhile;
	else:
		/*echo 'No Latest Work Found';*/
		
	endif;
	

?> 
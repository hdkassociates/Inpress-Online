<?php
/**
 * Template part for displaying latest work section in front-page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package inpress
 */

	$image = get_the_post_thumbnail($post,'medium');
	$title = get_the_title();
	$date = get_the_date();
	$url = get_the_permalink();
	?>
	<div class="archive-item">
		<a href="<?php echo $url; ?>">
			<?php if($image){ 
				echo $image; 
			} 
			else{ ?>
				<div class="image-placeholder"></div>
			<?php
			}
			?>
			<h4><?php echo $title; ?></h4>
			<p class="meta"><?php echo $date; ?></p>
		</a>
	</div>
	<?php
	

?> 
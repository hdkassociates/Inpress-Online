<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package inpress
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<header class="entry-header">
		<?php the_post_thumbnail('hero-banner'); ?>
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	

	<div class="entry-content">
		<?php
		the_content();
		wp_reset_postdata();

		?>
	</div><!-- .entry-content -->
	
		<?php if( have_rows('custom_layouts') ): 
		echo '<div class="entry-layouts">';
			while( have_rows('custom_layouts') ): the_row(); 
				if( get_row_layout() == 'title_field' ): 
					echo '<h3>'.get_sub_field('title').'</h3>'; 
				elseif( get_row_layout() == 'image_links' ):
					$count = count(get_row()['field_5fd1c48a0e224']);
						if( have_rows('image_link_repeater') ):  
						echo '<div class="custom_image_link link_'.$count.'">';
						
						while( have_rows('image_link_repeater') ): the_row();
							echo '<a href="'.get_sub_field('image_link_url').'"><img src="'.get_sub_field('image_link_image').'"><h4>'.get_sub_field('image_link_title').'</h4></a>';
						endwhile;
					echo '</div>';
					endif;
				elseif( get_row_layout() == 'wysiwyg_text' ):
					echo '<div class="custom_text">'.get_sub_field('custom_text').'</div>';

				elseif( get_row_layout() == 'video_file' ):
					echo '<video class="video-tag" autoplay muted>';
					echo	'<source class="the-video" src="'.get_sub_field('file').'" type="video/mp4">';
					echo  '</video>';
				elseif( get_row_layout() == 'gallery' ):
					echo '<div class="custom_gallery">';
						$images = get_sub_field('custom_gallery');
						$size = 'medium';
						if($images):
							foreach($images as $image):
								// Get the link
								$image_info = get_post_meta( $image, 'media_link', true);
								// var_dump($image_info['url']) . "linkID";
								// print_r(strlen($image_info['url']));

								// var_dump($image);
								// If there's a link, change the html so that it's linked
								if(strlen($image_info['url']) > 0) { 
									echo '<a class="image-item" href="'.$image_info['url'].'">';
								};
								
								echo wp_get_attachment_image($image,$size, false, array('class' => 'image-item'));
								
								if(strlen($image_info['url']) > 0) { 
									echo '</a>'; 
								};
							endforeach;
						endif;
					echo '<img><img><img><img></div>';
				elseif( get_row_layout() == 'embed_video' ):
					echo '<div class="custom_embed">'.get_sub_field('video').'</div>';
				elseif( get_row_layout() == 'google_maps' ):
					$location = get_sub_field('google_map');
					
					if( $location ): ?>
						<div class="acf-map" data-zoom="16">
							<div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>"></div>
						</div>
					<?php
					endif; 
				endif; 
			endwhile; 

// 			if(is_front_page()) {

// 				$args = array( 
// 					'orderby' => 'date',
// 					'post_type' => 'post',
// 					'posts_per_page' => '3'
// 				);
	
// 				// The Query
// 				$the_query = new WP_Query( $args );
// 				// var_dump($the_query);
// 				// The Loop
// 				if ( $the_query->have_posts() ) {
// 					echo '<h3> Latest News </h3>';
// 					echo '<div class="archive-items">';
// 					while ( $the_query->have_posts() ) {
// 						$the_query->the_post();
// 						// echo the_title();
// 						// echo the_permalink();

// 						echo '<div class="archive-item">';
// 						echo '<a href="'.get_the_permalink().'">';
// 						echo get_the_post_thumbnail($post,'medium'); 
// 						echo '<h4>'.get_the_title().'</h4>';
// 						echo '<p class="meta">'.get_the_date().'</p>';
// 						echo '</a>';
// 						echo '</div>';
// 						// echo '<a href="'.get_the_permalink().'"><img src="'.get_the_post_thumbnail_url().'"><h4>'.the_title( '', '', false ).'</h4></a>';
// 						// echo '<a href="'.the_permalink().'"><img src="'.the_post_thumbnail_url().'"><h4>'.the_title().'</h4></a>';
	
// 						// echo '1';
// 						// echo '<a href="ssss'.the_permalink().'"><img src="'.get_the_post_thumbnail_url().'"><h4>'.the_title().'</h4></a>';
// 						// echo '<a href=facebook.com>yes<a>';
// 					}
// 					echo '</div>';
// 				} else {
// 					// no posts found
// 				}
// 				/* Restore original Post Data */
// 				wp_reset_postdata();
	
// 			}

			echo '</div>';
		endif; 
		?>

		<!-- <?php  ?> -->
	
	

</article><!-- #post-<?php the_ID(); ?> -->

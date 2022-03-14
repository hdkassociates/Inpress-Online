<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package inpress
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : 
				$term = get_queried_object();
				?>
			<header class="page-header">
				<?php
				if(get_field('category_hero',$term)){
					echo wp_get_attachment_image(get_field('category_hero',$term),'hero-banner');
				}
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				
				?>
			</header><!-- .page-header -->
			<div class="entry-content">
				<?php if(get_field('category_intro_text',$term)){
					echo '<div class="category_intro">'.get_field('category_intro_text',$term).'</div>';
				}
				?>
			</div>
			<div class="archive-items">
			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'archive');
				// echo 'here';
			endwhile;
			?></div><?php


			// the_posts_navigation();
			numeric_posts_nav();
			// if (function_exists("pagination")) {
			// 	pagination($the_query->max_num_pages);
			// };

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php

get_footer();

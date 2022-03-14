<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package inpress
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->
	<div class="content_after archive-items">
			<?php
			get_template_part('template-parts/content','news');
			?>
		<a class="cat_link" href="/category/media-tech-news"><h3>See All News</h3></a>
	</div>
<?php
get_footer();

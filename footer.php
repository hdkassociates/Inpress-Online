<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package inpress
 */

?>

	<footer id="colophon" class="site-footer">
		<?php
		if( have_rows('site_links','option') ):
			?><div class="site-links"><?php
			while( have_rows('site_links','option') ) : the_row();

				$link = get_sub_field('link');
				?>
				<p><a href="<?php echo $link['url']; ?>" target="_blank"><?php echo $link['title']; ?></a></p>
				<?php
			endwhile;
		?></div><?php	
		endif;
		$site_info=get_field('site_info','option');
		if($site_info){
		?>
		<div class="site-info">
		<?php the_field('site_info','option'); ?>
		</div>
		<?php } 
		if( have_rows('site_social','option') ):
			?><div class="site-social"><?php
			while( have_rows('site_social','option') ) : the_row();

				$link = get_sub_field('social_media_link');
				$icon = get_sub_field('social_media_icon_url');
				?>
				<a href="<?php echo $link; ?>" target="_blank"><img src="<?php echo $icon; ?>"></a>
				<?php
			endwhile;
		?></div><?php	
		endif;
		?>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

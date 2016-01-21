<?php
/**
 * The Template for displaying home page (fall-back) if nothing specified.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @author radii
 */

get_header(); ?>

<?php get_template_part( 'super-banner' );?>

<div id="main-content" class="container">

	<div class="row">
	
		<div id="content-primary" class="col-md-9">
		<?php
			if ( have_posts() ) :
				// Start the Loop.
				while ( have_posts() ) : the_post();

					/*
					 * Include the post format-specific template for the content. If you want to
					 * use this in a child theme, then include a file called called content-___.php
					 * (where ___ is the post format) and that will be used instead.
					 */
					//get_template_part( 'content', get_post_format() );
					get_template_part( 'content' );

				endwhile;
				// Previous/next post navigation.
				PostsHelper::theme_paging_nav('array');

			else :
				// If no content, include the "No posts found" template.
				get_template_part( 'content', 'none' );

			endif;
		?>
		</div><!-- #content-primary -->
	
		<div id="content-sidebar" class="col-md-3">
		
			<?php get_sidebar(); ?>
			
		</div><!-- #content-sidebar -->
	
	</div><!-- .row -->
	
</div><!-- #main-content -->

<?php
get_footer();
?>
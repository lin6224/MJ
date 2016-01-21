<?php
/**
 * The Template for displaying home page.
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
				
					get_template_part( 'content' );//get_template_part( 'content', get_post_format() );
					
				endwhile;
				
				// blog listing pagination
				//$post_helper = new PostsHelper();
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
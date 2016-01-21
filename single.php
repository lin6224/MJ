<?php
/**
 * The Template for displaying all single posts
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @author radii
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

<div id="super-banner-wrapper">

	<div id="super-banner" class="container">
		
		<h1><?php the_title(); ?></h1>
	
	</div>
	
</div>

<div id="main-content" class="container">

	<div class="row">
	
		<div id="content-primary" class="col-md-9">
		<?php
			// Start the Loop.

			get_template_part( 'content', get_post_format() );

			// Previous/next post navigation.
			PostsHelper::theme_post_nav();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
			
		?>
		</div><!-- #content-primary -->
	
		<div id="content-sidebar" class="col-md-3">
		
			<?php get_sidebar(); ?>
		
		</div><!-- #content-sidebar -->
	
	</div><!-- .row -->
	
</div><!-- #main-content -->

<?php endwhile; ?>

<?php
get_footer();
?>
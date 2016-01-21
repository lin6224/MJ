<?php
/**
 * The Template for displaying wp page.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @author radii
 */
 
get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

<?php get_template_part( 'super-banner' );?>

<div id="main-content" class="container">

	<div class="row">
	
		<div id="content-primary" class="col-md-9">
			
			<h1><?php the_title(); ?></h1>
			
			<div class="content-body"><?php the_content(); ?></div>

			<?php comments_template( '', true ); ?>
		
		</div><!-- content-primary -->
	
		<div id="content-sidebar" class="col-md-3">
		
			<?php get_sidebar(); ?>
			
		</div><!-- #content-sidebar -->

	</div><!-- .row -->
	
</div><!-- .container -->

<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>
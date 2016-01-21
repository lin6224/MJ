<?php
/**
 * The Template for displaying wp page.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @author radii
 */
 
get_header(); ?>



<div id="main-content" class="container">

	<div class="row">

		<p>this is contact us age template (pate-contact-us.php) </p>
	
		<div id="content-primary" class="col-md-9">
			
			<h1><?php the_title(); ?></h1>
			
			<div class="content-body"><?php the_content(); ?></div>

			<?php comments_template( '', true ); ?>
		
		</div><!-- content-primary -->
	
		<div id="content-sidebar" class="col-md-3">
		
			
		</div><!-- #content-sidebar -->

	</div><!-- .row -->
	
</div><!-- .container -->


<?php get_footer(); ?>
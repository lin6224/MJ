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
	<?php 
		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post();
				the_content();
		//
			} // end while
		} // end if
	?>
	</div><!-- .row -->
	
</div><!-- .container -->


<?php get_footer(); ?>
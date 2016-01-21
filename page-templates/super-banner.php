<?php
/**
 * Template Name: example with super banner
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @author radii
 */

get_header(); ?>

<div id="super-banner-wrapper">
	<div id="super-banner" class="container-12">
		<h1>Super Banner</h1>
	</div>
</div>

<div id="main-content" class="container-12">

	<div class="row">

		<div id="content-primary" class="grid-12">
			<?php
				// Start the Loop.
				while ( have_posts() ) : the_post();

					// Include the page content template.
					get_template_part( 'content', get_post_format() );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				endwhile;
			?>
		</div><!-- #content-primary -->
		
	</div><!-- .row -->
	
</div><!-- #main-content -->

<?php
get_footer();
?>
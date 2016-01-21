<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @author radii
 */

get_header(); ?>

<div id="main-content" class="container">

	<div class="row">

		<div id="content-primary" class="col-md-12">

			<header class="page-header">
				<h1 class="page-title">404 - <?php _e( 'Not Found', SITE_TEXT_DOMAIN ); ?></h1>
			</header>

			<div class="page-content">
				<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', SITE_TEXT_DOMAIN ); ?></p>

				<?php get_search_form(); ?>
			</div><!-- .page-content -->

		</div><!-- #content-primary -->
	
	</div><!-- .row -->
	
</div><!-- #main-content -->

<?php
get_footer();
?>
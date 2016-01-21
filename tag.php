<?php
/**
 * The template for displaying Tag pages
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @author radii
 */

get_header(); ?>

<div id="main-content" class="container">

	<div class="row">

		<div id="content-primary" class="col-md-9">

			<?php if ( have_posts() ) : ?>

			<header class="archive-header">
				<h1 class="archive-title"><?php printf( __( 'Tag Archives: %s', SITE_TEXT_DOMAIN ), single_tag_title( '', false ) ); ?></h1>

				<?php
					// Show an optional term description.
					$term_description = term_description();
					if ( ! empty( $term_description ) ) :
						printf( '<div class="taxonomy-description">%s</div>', $term_description );
					endif;
				?>
			</header><!-- .archive-header -->

			<?php
				// Start the Loop.
				while ( have_posts() ) : the_post();

					/*
					 * Include the post format-specific template for the content. If you want to
					 * use this in a child theme, then include a file called called content-___.php
					 * (where ___ is the post format) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );

				endwhile;
				// Previous/next page navigation.
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
<?php
/**
 * The template for displaying Archive pages
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
		<?php if ( have_posts() ) : ?>

		<header class="archive-header">
			<h1 class="archive-title">
				<?php
					if ( is_day() ) :
						printf( __( 'Daily Archives: %s', SITE_TEXT_DOMAIN ), get_the_date() );

					elseif ( is_month() ) :
						printf( __( 'Monthly Archives: %s', SITE_TEXT_DOMAIN ), get_the_date( _x( 'F Y', 'monthly archives date format', SITE_TEXT_DOMAIN ) ) );

					elseif ( is_year() ) :
						printf( __( 'Yearly Archives: %s', SITE_TEXT_DOMAIN ), get_the_date( _x( 'Y', 'yearly archives date format', SITE_TEXT_DOMAIN ) ) );

					else :
						_e( 'Archives', SITE_TEXT_DOMAIN );

					endif;
				?>
			</h1>
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
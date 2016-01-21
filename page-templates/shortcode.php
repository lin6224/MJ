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

<div id="super-banner-wrapper">

	<div id="super-banner" class="container">
		
		<h1><?php the_title(); ?></h1>
	
	</div>
	
</div>

<div id="main-content" class="container">

	<?php
	global $post;
	
	if(check_html_layout_shortcode($post->post_content)){
	
		//if htlm layout shortcode is detected, then build page content html structure by shortcode
		the_content();
		
	}else{
	
		//if html layout shortcode is not found, then use standard layout
		?>
		<div class="row">
	
			<div id="content-primary" class="col-md-8">
			
				<h1><?php the_title(); ?></h1>
			
				<div class="content-body"><?php the_content(); ?></div>

				<?php comments_template( '', true ); ?>
		
			</div><!-- content-primary -->
	
			<div id="content-sidebar" class="col-md-4">
		
				<?php get_sidebar(); ?>
			
			</div><!-- #content-sidebar -->

		</div><!-- .row -->
		<?php
	}
	?>
	
</div><!-- .container -->

<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>
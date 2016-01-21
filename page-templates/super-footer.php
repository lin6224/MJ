<?php
/**
 * Template Name: example with super banner
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @author radii
 */

get_header(); ?>

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


<div id="super-footer-wrapper">
	<div id="super-footer" class="container-12">
		<div class="row">
			<div class="grid-4">
				<h4>Footer 1</h4>
				<ul>
					<li><a href="#">Footer 1 Link a</a></li>
					<li><a href="#">Footer 1 Link b</a></li>
					<li><a href="#">Footer 1 Link c</a></li>
					<li><a href="#">Footer 1 Link d</a></li>
				</ul>
			</div>
			<div class="grid-4">
				<h4>Footer 2</h4>
				<ul>
					<li><a href="#">Footer 2 Link a</a></li>
					<li><a href="#">Footer 2 Link b</a></li>
					<li><a href="#">Footer 2 Link c</a></li>
					<li><a href="#">Footer 2 Link d</a></li>
				</ul>
			</div>
			<div class="grid-4">
				<h4>Footer 3</h4>
				<ul>
					<li><a href="#">Footer 3 Link a</a></li>
					<li><a href="#">Footer 3 Link b</a></li>
					<li><a href="#">Footer 3 Link c</a></li>
					<li><a href="#">Footer 3 Link d</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>

<?php
get_footer();
?>
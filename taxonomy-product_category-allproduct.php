<?php
get_header(); ?>
<!--
<?php get_template_part( 'super-banner' );?>
-->
<div id="main-content" class="container">

	<div class="row">

		<div id="content-sidebar" class="col-md-3">

			<?php get_sidebar(); ?>
			<p>this is sidebar information</p>
	
		<div id="content-primary" class="col-md-9">
			
			<?php
				//list terms in a given taxonomy
				$taxonomy = 'product_category';
				$tax_terms = get_terms($taxonomy);
			?>
			<ul>
				<?php
					foreach ($tax_terms as $tax_term) {
					echo '<li>' . '<a href="' . esc_attr(get_term_link($tax_term, $taxonomy)) . '" title="' . sprintf( __( "View all posts in %s" ), $tax_term->name ) . '" ' . '>' . $tax_term->name.'</a></li>';
					}
				?>
			</ul>
			<p>111111111111111</p>
			<?php
				$args=array(
  					'post_type'=>'product',
					);
				$the_query = new WP_Query( $args );
 
				if ( $the_query->have_posts() ) {
       				 echo '<ul>';
						while ( $the_query->have_posts() ) {
							$the_query->the_post();
							$link = the_permalink();
						echo '<li>' . get_the_title() . '</li>';
						echo '<li><a href="' . the_permalink() . '">'. get_the_title() .'</a></li>';					
					}
        			echo '</ul>';
					} else {
					}
					wp_reset_postdata();
					?>
		</div><!-- #content-sidebar -->
		
		<div class="clear"></div>
		
	</div><!-- .row -->
	
</div><!-- #main-content -->

<?php
get_footer();
?>
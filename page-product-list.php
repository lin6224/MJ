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

		<p>this is product list template(page-product-list.php), if you can see it . that means i know how to modify the page in the wordpress</p>
		
		<div id="content-sidebar" class="col-md-3">

			<?php
				$args = array(
  								'orderby' => 'count',
  								'number' => '5',
  								'order'   => 'DESC'
							);
				$terms = get_terms( 'product_category', $args );
 
				foreach( $terms as $term ){
 
  					echo 'term name: ' . $term->name . '<br />';
 
  					$post_args = array( 'tag_id' => $term->term_id, 'posts_per_page' => '2' );
  					$posts = get_posts( $post_args );
 
  					foreach( $posts as $post ){
    					echo 'post title: ' . $post->post_title . '<br />';
  					}
 
					}
			?>
			<?php
				$terms = get_terms( 'product_category' );

echo '<ul>';

foreach ( $terms as $term ) {

    // The $term is an object, so we don't need to specify the $taxonomy.
    $term_link = get_term_link( $term );
   
    // If there was an error, continue to the next term.
    if ( is_wp_error( $term_link ) ) {
        continue;
    }

    // We successfully got a link. Print it out.
    echo '<li><a href="' . esc_url( $term_link ) . '">' . $term->name . '</a></li>';
}

echo '</ul>';
			?>
			
		</div><!-- #content-sidebar -->		
	
		<div id="content-primary" class="col-md-9">

		<?php while ( have_posts() ) : the_post(); ?>

			<div class="col-md-4">
				<img src="<?php the_field('product_image');?>">
			</div>
			<div class="col-md-4">
				<p>Product Name</p><br>
				<p>Mode</p><br>
				<p>Size</p><br>
				<p>Lamp</p><br>
				<p>Filtration</p><br>
				<p>Volume</p><br>
				<p>Color</p>
			</div>
			<div class="col-md-4">
				<?php get_field('product_name'); ?>
				<?php get_field('model'); ?>
				<?php get_field('size'); ?>
				<?php get_field('lamp'); ?>
				<?php get_field('filtration'); ?>
				<?php get_field('volume'); ?>
				<?php get_field('color'); ?>
			</div>
		<?php endwhile; // end of the loop. ?>
		<!--taxmonoy information is start here-->
<!--111111111111111111111111111111111111111111111111111111111111111-->
		<?php
			$args = array('post_type' => 'product', 'posts_per_page' =>10 );
			$loop = new WP_Query( $args );
			while ($loop ->have_posts() ) : $loop->the_post();
			the_field('product_name');
			the_field('model');
			the_field('size');
			endwhile;
		 ?>

	</div><!-- .row -->
</div><!-- .container -->



<?php get_footer(); ?>
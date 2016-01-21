<?php
/**
 * The default template for displaying content
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @author radii
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php PostsHelper::theme_post_thumbnail(); ?>

	<header class="entry-header">
		<?php
			if ( is_single() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
			endif;
		?>

		<div class="entry-meta">
			<?php
				if ( 'post' == get_post_type() ){
					PostsHelper::theme_posted_on();
				}

				if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) :
			?>
			<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'rrtb' ), __( '1 Comment', SITE_TEXT_DOMAIN ), __( '% Comments', SITE_TEXT_DOMAIN ) ); ?></span>
			<?php
				endif;

				edit_post_link( __( 'Edit', SITE_TEXT_DOMAIN ), '<span class="edit-link">', '</span>' );
			?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php
			the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', SITE_TEXT_DOMAIN ) );
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', SITE_TEXT_DOMAIN ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<?php the_tags( '<footer class="entry-meta"><span class="tag-links">', '', '</span></footer>' ); ?>
</article><!-- #post-## -->

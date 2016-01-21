<?php

Class PostsHelper{
	
	/**
	 * Constructor
	 */
	public function __construct() {
		
	}
	
	/**
	 * Function: helper_get_the_excerpt_max_charlength - Get post content excerpt
	 * @Author: JF
	 * @Date: 2014 Jan
	 *
	 * @return excerpt value within maximum allowed characters
	 */
	public static function helper_get_the_excerpt_max_charlength($charlength) {
		$excerpt = get_the_excerpt();
		$charlength++;
		$excerpt_result = "";

		if ( strlen( $excerpt ) > $charlength ) {
			$subex = substr( $excerpt, 0, $charlength - 5 );
			$exwords = explode( ' ', $subex );
			$excut = - ( strlen( $exwords[ count( $exwords ) - 1 ] ) );
			if ( $excut < 0 ) {
				$excerpt_result .= substr( $subex, 0, $excut );
			} else {
				$excerpt_result .= $subex;
			}
			$excerpt_result .= '...';
		} else {
			//echo $excerpt;
			$excerpt_result = $excerpt;
		}
		return $excerpt_result;
	}


	/**
	 * Function: theme_content_nav - Displays navigation to next/previous pages when applicable in WP pagination
	 * @Author: JF
	 * @Date: 2014 Jan
	 *
	 * @return void
	 */
	public static function theme_content_nav( $html_id ) {
		global $wp_query;

		$html_id = esc_attr( $html_id );

		if ( $wp_query->max_num_pages > 1 ) : ?>
			<div id="<?php echo $html_id; ?>" class="row-fluid" role="navigation">
				<div class="span6"><?php next_posts_link( __( '<i class="icon-arrow-left"></i> Older posts', SITE_TEXT_DOMAIN ) ); ?></div>
				<div class="span6 text-right"><?php previous_posts_link( __( 'Newer posts <i class="icon-arrow-right"></i>', SITE_TEXT_DOMAIN ) ); ?></div>
			</div><!-- #<?php echo $html_id; ?> .navigation -->
		<?php endif;
	}


	/**
	 * Function: theme_post_nav - Display navigation to next/previous post when applicable.
	 * @Author: JF
	 * @Date: 2014 Jan
	 *
	 * @return void
	 */
	public static function theme_post_nav() {
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) {
			return;
		}
		?>
		<nav class="navigation post-navigation" role="navigation">
			<!--<h1><?php _e( 'Post navigation', SITE_TEXT_DOMAIN ); ?></h1>-->
			<div class="nav-links">
				<?php
				if ( is_attachment() ) :
					previous_post_link( '%link', __( '<span class="meta-nav">Published In</span>%title', SITE_TEXT_DOMAIN ) );
				else :
					previous_post_link( '%link', __( '<span class="meta-nav">Previous Post</span>%title', SITE_TEXT_DOMAIN ) );
					next_post_link( '%link', __( '<span class="meta-nav">Next Post</span>%title', SITE_TEXT_DOMAIN ) );
				endif;
				?>
			</div><!-- .nav-links -->
		</nav><!-- .navigation -->
		<?php
	}


	/**
	 * Function: theme_paging_nav - Display navigation to next/previous set of posts when applicable.
	 * @Author: JF
	 * @Date: 2014 Jan / Updated: 2015 Jan
	 *
	 * @return void
	 */
	public static function theme_paging_nav($links_type='plain', $pagination_title=false) {
		// Don't print empty markup if there's only one page.
		if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
			return;
		}

		$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
		$pagenum_link = html_entity_decode( get_pagenum_link() );
		$query_args   = array();
		$url_parts    = explode( '?', $pagenum_link );

		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}

		$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
		$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

		$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
		$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

		// Set up paginated links.
		$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $GLOBALS['wp_query']->max_num_pages,
		'current'  => $paged,
		'mid_size' => 1,
		'add_args' => array_map( 'urlencode', $query_args ),
		'type'	   => $links_type,
		'prev_text' => __( '&larr; Previous', SITE_TEXT_DOMAIN ),
		'next_text' => __( 'Next &rarr;', SITE_TEXT_DOMAIN ),
		) );

		if ( $links ) :
		?>
		<nav class="navigation paging-navigation" role="navigation">
			<?php
			if($pagination_title){
				?>
				<h1 class="screen-reader-text"><?php _e( 'Posts Navigation', SITE_TEXT_DOMAIN ); ?></h1>
				<?php
			}
			if($links_type == 'plain' || $links_type == 'list'){
			?>
			<div class="pagination loop-pagination">
				<?php echo $links; ?>
			</div><!-- .pagination in div -->
			<?php
			}else if($links_type == 'array'){ //use bootstrap pagination class to handle array ouput
			?>
			<ul class="pagination loop-pagination">
				<?php foreach($links as $each_link){ ?>
				<li><?php echo $each_link;?></li>
				<?php
				}?>
			</ul><!-- .pagination in ul -->	
			<?php
			}
			?>
		</nav><!-- .navigation -->
		<?php
		endif;
	}


	/**
	 * Function: theme_post_thumbnail - Display an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index
	 * views, or a div element when on single views.
	 *
	 * @Author: JF
	 * @Date: 2014 Jan
	 *
	 * @return void
	 */
	public static function theme_post_thumbnail() {
		if ( post_password_required() || ! has_post_thumbnail() ) {
			return;
		}
		if ( is_singular() ) :
		?>
		<div class="post-thumbnail">
		<?php
			the_post_thumbnail('large');
		?>
		</div>
		<?php else : ?>
		<a class="post-thumbnail" href="<?php the_permalink(); ?>">
		<?php
			the_post_thumbnail('large');
		?>
		</a>
		<?php endif; // End is_singular()
	}


	/**
	 * Function: theme_posted_on - Print HTML with meta information for the current post-date/time and author.
	 * @Author: JF
	 * @Date: 2014 Jan
	 *
	 * @return void
	 */
	public static function theme_posted_on() {
		if ( is_sticky() && is_home() && ! is_paged() ) {
			echo '<span class="featured-post">' . __( 'Sticky', SITE_TEXT_DOMAIN ) . '</span>';
		}

		// Set up and print post meta information.
		printf( '<span class="entry-date"><a href="%1$s" rel="bookmark"><time class="entry-date" datetime="%2$s">%3$s</time></a></span> <span class="byline"><span class="author vcard"><a class="url fn n" href="%4$s" rel="author">%5$s</a></span></span>',
			esc_url( get_permalink() ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			get_the_author()
		);
	}


	/**
	 * Function: custom_get_view_blog_btn - View Full Blog Listing button.
	 *
	 * @Author: JF
	 * @Date: May 29, 2014
	 *
	 * @return void
	 */
	public static function custom_get_view_blog_btn($btn_text='View Full Blog'){
		global $blog_url;
		?>
		<a class="btn blog-btn" href="<?php echo $blog_url; ?>"><?php echo __( 'View Blog', SITE_TEXT_DOMAIN ); ?></a>
		<?php
	}
	
	
	/**
	 * Function: cpt_adjust_offset_pagination_hook - action hook to adjust offset pagination
	 * @Author: JF
	 * @Note: This function only works with Custom Post Type
	 * @Date: 2014 Feb
	 *
	 * @return void
	 */
	function cpt_adjust_offset_pagination_hook(){
		add_action( 'found_posts', array($this,'cpt_adjust_offset_pagination'), 1, 2 );
	}
	

	/**
	 * Function: cpt_adjust_offset_pagination - Adjust post offset with pagination for custom post type
	 * @Author: JF
	 * @Note: This function only works with Custom Post Type
	 * @Date: 2014 Feb
	 *
	 * @return void
	 */
	function cpt_adjust_offset_pagination($found_posts, $query) {
		//Define our offset again...
		$offset = 1;

		//Ensure we're modifying the right query object...
		if ( isset($query->query_vars['post_type']) && $query->query_vars['post_type'] != 'post' && !is_post_type_archive('post') ){
			//Reduce WordPress's found_posts count by the offset... 
			return $found_posts - $offset;
		}
		return $found_posts;
	}
	

	/**
	 * Function: cpt_posts_per_page_hook - action hook to handle custom post type posts per page
	 * @Author: JF
	 * @Date: 2014 April
	 *
	 * @return void
	 */
	function cpt_posts_per_page_hook(){
		if ( !is_admin() ){
			add_filter( 'pre_get_posts', array($this,'cpt_posts_per_page') );
		}
	}
	
	/**
	 * Function: cpt_posts_per_page - update pagination and paged info for custom post type
	 * @Author: JF
	 * @Date: 2014 April
	 *
	 * @return void
	 */
	function cpt_posts_per_page( $query ) {
		if ( isset($query->query_vars['post_type']) && $query->query_vars['post_type'] != 'post' && !is_post_type_archive('post') ){
			$query->query_vars['posts_per_page'] = CUSTOM_POST_PER_PAGE;
		}
		return $query; 
	}
	
	
	/**
	 * Function: custom_comments_closed_on_pages_hook - action hook to close commenting on selected post type
	 * @Author: JR
	 * @Modified: JF
	 * @Date: May 30, 2014
	 *
	 * @return void
	 */
	function custom_comments_closed_on_pages_hook(){
		add_filter( 'comments_open', array($this,'custom_comments_closed_on_pages'), 10, 2 );
	}

	/**
	 * Function: custom_comments_closed_on_pages - Force to disable comment based on post type.
	 * @Author: JR
	 * @Modified: JF
	 * @Date: May 30, 2014
	 *
	 * @return void
	 */
	function custom_comments_closed_on_pages( $open, $post_id ) {
		$post = get_post( $post_id );
		if ( 'page' == $post->post_type ){
			$open = false;
		}
		return $open;
	}
}
?>
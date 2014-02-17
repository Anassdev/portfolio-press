<?php
/**
 * @package Portfolio Press
 */

/**
 * Outputs author information
 */
if ( ! function_exists( 'portfoliopress_postby_meta' ) ):
function portfoliopress_postby_meta() {

	printf( __( '<span class="meta-prep meta-prep-author">Posted </span><a href="%1$s" rel="bookmark"><time class="entry-date" datetime="%2$s" pubdate>%3$s</time></a> <span class="meta-sep"> by </span> <span class="author vcard"><a class="url fn n" href="%4$s" title="%5$s">%6$s</a></span>', 'portfoliopress' ),
		get_permalink(),
		get_the_date( 'c' ),
		get_the_date(),
		get_author_posts_url( get_the_author_meta( 'ID' ) ),
		sprintf( esc_attr__( 'View all posts by %s', 'portfoliopress' ), get_the_author() ),
		get_the_author()
	);
}
endif;

/**
 * Displays footer text
 */
if ( ! function_exists( 'portfoliopress_footer_meta' ) ):
function portfoliopress_footer_meta( $post ) {

	$post_type = $post->post_type;
	if ( ( 'portfolio' != $post_type ) && ( 'page' !=  $post_type ) )
		return;
	?>

	<footer class="entry-meta">

	<?php if ( 'portfolio' == $post_type ) {

		$cat_list = get_the_term_list( $post->ID, 'portfolio_category', '', ', ', '' );
		$tag_list = get_the_term_list( $post->ID, 'portfolio_tag', '', ', ', '' );
		$utility_text = '';
		if ( ( $cat_list ) && ( '' ==  $tag_list ) )
			$utility_text = __( 'This entry was posted in %1$s.', 'portfoliopress' );
		if ( ( '' != $tag_list ) && ( '' ==  $cat_list ) )
			$utility_text = __( 'This entry was tagged %2$s.', 'portfoliopress' );
		if ( ( '' != $cat_list ) && ( '' !=  $tag_list ) )
			$utility_text = __( 'This entry was posted in %1$s and tagged %2$s.', 'portfoliopress' );
		printf(
			$utility_text,
			$cat_list,
			$tag_list
		);

	} else {

		$format = get_post_format( $post );
		if ( false === $format ) {
			$format = 'standard';
		}
		?>

		<span class="entry-meta-icon icon-format-<?php echo $format ?>"></span>

		<span class="cat-links"><span class="entry-utility-prep entry-utility-prep-cat-links"><?php _e( 'Posted in ', 'portfoliopress' ); ?></span><?php the_category( ', ' ); ?></span>
		<?php the_tags( '<span class="meta-sep"> | </span><span class="tag-links">' . __( 'Tagged ', 'portfoliopress' ) . '</span>', ', ', '' ); ?>

		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="meta-sep"> | </span>
		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'portfoliopress' ), __( '1 Comment', 'portfoliopress' ), __( '% Comments', 'portfoliopress' ) ); ?></span>
		<?php endif; ?>

	<?php } ?>

	<?php edit_post_link( __( 'Edit', 'portfoliopress' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>

	</footer><!-- .entry-meta -->

<?php }
endif;

/**
 * Reusable navigation code for navigation
 * Display navigation to next/previous pages when applicable
 */
if ( ! function_exists( 'portfoliopress_content_nav' ) ):
function portfoliopress_content_nav( $query = false ) {
	global $wp_query;
	if ( $query ) {
		$temp_query = $wp_query;
		$wp_query = $query;
	}
	if (  $wp_query->max_num_pages > 1 ) :
		if (function_exists('wp_pagenavi') ) {
			wp_pagenavi();
		} else { ?>
        	<nav id="nav-below">
			<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'portfoliopress' ); ?></h1>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'portfoliopress' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'portfoliopress' ) ); ?></div>
			</nav><!-- #nav-below -->
    	<?php }
	endif;
	if ( isset( $temp_query ) ) {
		$wp_query = $temp_query;
	}
}
endif;
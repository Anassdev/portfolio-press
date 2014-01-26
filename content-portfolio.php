<?php
/**
 * This template displays portfolio post content
 *
 * @package Portfolio Press
 */

// Set the size of the thumbnails and content width
$fullwidth = false;

// If portfolio is displayed full width
if ( of_get_option( 'portfolio_sidebar' ) || is_page_template( 'full-width-portfolio.php' ) )
	$fullwidth = true;

// If portfolio is a 1-column layout
if ( of_get_option('layout','layout-2cr') ==  'layout-1col' )
	$fullwidth = true;

$thumbnail = 'portfolio-thumbnail';

if ( $fullwidth )
	$thumbnail = 'portfolio-thumbnail-fullwidth';

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
		<h3><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title() ?></a></h3>
		<a href="<?php the_permalink() ?>" rel="bookmark" class="thumb"><?php the_post_thumbnail( $thumbnail ); ?></a>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
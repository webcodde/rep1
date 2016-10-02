<?php
/**
 * The template for displaying search results pages
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>
	<div class="zurUbersicht-banner bannerHight">

	<h1 class="gold"><?php printf( __( 'Search Results for: %s', 'slitwp' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h1>
	</div> 
	<section class="zurUbersicht">
	<div class="row ">
	<div class="pageContent">
<?php if ( have_posts() ) : ?>
			<?php
			// Start the loop.
			while ( have_posts() ) : the_post(); ?>

			<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
	</header><!-- .entry-header -->


	<?php the_excerpt(); 


			// End the loop.
			endwhile;

			// Previous/next page navigation.
			the_posts_pagination( array(
				'prev_text'          => __( 'Previous page', 'slitwp' ),
				'next_text'          => __( 'Next page', 'slitwp' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'slitwp' ) . ' </span>',
			) );

		// If no content, include the "No posts found" template.
		else : ?>
				<header class="kochkurse-teamevent">
					<h2 class="page-title"><?php _e( 'We could not find a match :(', 'slitwp' ); ?></h2>
					X
				</header>

<?php endif;
		?>
</div>
</div>
</section>
<?php get_footer(); ?>

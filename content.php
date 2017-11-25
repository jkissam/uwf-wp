<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 */

if (is_single()) {
	 $post_image = get_the_post_thumbnail(get_the_ID(), 'tldr-full-width');
} else {
	 $post_image = get_the_post_thumbnail(get_the_ID());
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ($post_image): ?>
	<div class="post-thumbnail">
		<?php
			if (!is_single() && !is_page()) { echo '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">'; }
			echo $post_image;
			if (!is_single() && !is_page()) { echo '</a>'; }
		?>
	</div>
	<?php endif; ?>

	<header class="entry-header">
		<?php if ( in_array( 'category', get_object_taxonomies( get_post_type() ) ) ) : ?>
		<div class="entry-meta">
			<span class="cat-links"><?php echo get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'tldr' ) ); ?></span>
		</div>
		<?php
			endif;

			if ( is_single() || is_page() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
			endif;
		?>

		<div class="entry-meta">
			<?php
				if ( 'post' == get_post_type() ) : ?>
					<div class="post-date"><?php echo get_the_date(); ?></div>
				<?php
				endif; 
				if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) :
			?>
			<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'tldr' ), __( '1 Comment', 'tldr' ), __( '% Comments', 'tldr' ) ); ?></span>
			<?php
				endif;

				edit_post_link( __( 'Edit', 'tldr' ), '<span class="edit-link">', '</span>' );
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
			the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'tldr' ) );
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'tldr' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<?php the_tags( '<footer class="entry-meta"><span class="tag-links">', '', '</span></footer>' ); ?>
</article><!-- #post-## -->

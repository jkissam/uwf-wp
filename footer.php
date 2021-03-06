<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 */
?>

		</div><!-- #main -->
	</div>

	<?php if ( uwf_display_triptych() && is_active_sidebar( 'triptych' ) ) : ?>
	<div id="triptych-wrapper" class="section-wrapper">
		<div id="triptych" class="section widget-area clearfix container">
			<div id="triptych-inner" class="section-inner row">
				<?php dynamic_sidebar( 'triptych' ); ?>
			</div>
		</div>
	</div>
	<?php endif; ?>

	<?php if ( uwf_display_swaths() && is_active_sidebar( 'swaths' ) ) : ?>
	<div id="swaths-wrapper" class="widget-area">
		<?php dynamic_sidebar( 'swaths' ); ?>
	</div>
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'utility' ) ) : ?>
	<div id="utility-wrapper" class="section-wrapper">
		<div id="utility" class="section widget-area clearfix container">
			<div id="utility-inner" class="section-inner">
				<?php dynamic_sidebar( 'utility' ); ?>
			</div>
		</div>
	</div>
	<?php endif; ?>

	<div id="footer-wrapper">
		<footer id="footer" class="site-footer clearfix container" role="contentinfo">
			<div class="footer-inner">

			<?php if ( is_active_sidebar( 'footer' ) ): ?>
			<div id="footer-widget-area" class="footer-widget-area widget-area row" role="complementary">
				<?php dynamic_sidebar( 'footer' ); ?>
			</div><!-- #footer-widget-area -->
			<?php endif; ?>
			
			<?php uwf_the_site_credit(); ?>

			</div><!-- /.footer-inner -->
		</footer><!-- #footer -->
	</div><!-- /.footer-wrapper -->

</div><!-- #site-wrapper -->

<div id="modals-wrapper">
	<div id="modals" class="modals widget-area" role="complementary">
		<?php dynamic_sidebar( 'modals' ); ?>
		<div id="search" class="widget modal">
			<h2><?php _e('Search','uwf'); ?></h2>
			<div class="search-box">
				<?php get_search_form(); ?>
			</div>
		</div>
	</div><!-- #modals -->
</div>

	<?php wp_footer(); ?>
</body>
</html>

<?php
$onepress_news_id        = get_theme_mod( 'onepress_news_id', __('news', 'onepress') );
$onepress_news_disable   = get_theme_mod( 'onepress_news_disable' ) == 1 ? true : false;
$onepress_news_title     = get_theme_mod( 'onepress_news_title', __('Latest News', 'onepress' ));
$onepress_news_subtitle  = get_theme_mod( 'onepress_news_subtitle', __('The company blog', 'onepress' ));
$onepress_news_number    = get_theme_mod( 'onepress_news_number', '3' );
$onepress_news_more_link = get_theme_mod( 'onepress_news_more_link', '#' );
$onepress_news_more_text = get_theme_mod( 'onepress_news_more_text', __('Read Our Blog', 'onepress' ));
?>
<?php if ( ! $onepress_news_disable  ) : ?>
<section id="<?php if ( $onepress_news_id != '' ) echo $onepress_news_id; ?>" class="<?php echo apply_filters( 'onepress_section_class', 'section-padding section-news onepage-section', 'news' ); ?>">
	<?php do_action( 'onperess_before_section_inner', 'news' ); ?>
	<div class="container">
		<div class="section-title-area">
			<?php if ( $onepress_news_subtitle != '' ) echo '<h5 class="section-subtitle">' . esc_html( $onepress_news_subtitle ) . '</h5>'; ?>
			<?php if ( $onepress_news_title != '' ) echo '<h2 class="section-title">' . esc_html( $onepress_news_title ) . '</h2>'; ?>
		</div>
		<div class="section-content">
			<div class="row">
				<div class="col-sm-12">
					<div class="blog-entry wow slideInUp">
						<?php query_posts('showposts='.$onepress_news_number.''); ?>
						<?php if ( have_posts() ) : ?>

							<?php /* Start the Loop */ ?>
							<?php while ( have_posts() ) : the_post(); ?>
								<?php

									/*
									 * Include the Post-Format-specific template for the content.
									 * If you want to override this in a child theme, then include a file
									 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
									 */
									get_template_part( 'template-parts/content', 'list' );
								?>

							<?php endwhile; ?>
						<?php else : ?>
							<?php get_template_part( 'template-parts/content', 'none' ); ?>
						<?php endif; ?>

						<?php if ( $onepress_news_more_link != '' ) { ?>
						<div class="all-news">
							<a class="btn btn-theme-primary-outline btn-lg" href="<?php echo esc_url($onepress_news_more_link) ?>"><?php if ( $onepress_news_more_text != '' ) echo esc_html( $onepress_news_more_text ); ?></a>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>

		</div>
	</div>
	<?php do_action( 'onperess_after_section_inner', 'news' ); ?>
</section>
<?php endif; ?>

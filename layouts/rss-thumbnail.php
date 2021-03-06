<?php

if ( !function_exists( 'ucf_rss_display_thumbnail_before' ) ) {

	function ucf_rss_display_thumbnail_before( $content, $items, $args ) {
		ob_start();
	?>
		<div class="ucf-rss-feed ucf-rss-feed-thumbnail">
	<?php
		return ob_get_clean();
	}

	add_filter( 'ucf_rss_display_thumbnail_before', 'ucf_rss_display_thumbnail_before', 10, 3 );

}

if ( !function_exists( 'ucf_rss_display_thumbnail_title' ) ) {

	function ucf_rss_display_thumbnail_title( $content, $items, $args ) {
		$formatted_title = '';

		if ( $args['list_title'] ) {
			$formatted_title = '<h2 class="ucf-rss-title">' . $args['list_title'] . '</h2>';
		}

		return $formatted_title;
	}

	add_filter( 'ucf_rss_display_thumbnail_title', 'ucf_rss_display_thumbnail_title', 10, 3 );

}

if ( !function_exists( 'ucf_rss_display_thumbnail' ) ) {

	function ucf_rss_display_thumbnail( $content, $items, $args ) {
		if ( ! is_array( $items ) && $items !== false ) { $items = array( $items ); }
		ob_start();
	?>
		<?php if ( $items ): ?>
		<ul class="ucf-rss-items">
			<?php
			foreach ( $items as $item ):
				$thumbnail = UCF_RSS_Common::get_simplepie_thumbnail_or_fallback( $item );
				$url       = UCF_RSS_Common::get_simplepie_url( $item );
				$title     = UCF_RSS_Common::get_simplepie_title( $item );
				$desc      = UCF_RSS_Common::get_simplepie_description( $item );
			?>
			<li class="ucf-rss-item">
				<article class="ucf-rss-item-article">
					<div class="ucf-rss-item-details">
						<?php if ( $thumbnail ): ?>
						<a class="ucf-rss-item-link" href="<?php echo $url; ?>" tabindex="-1">
							<img class="ucf-rss-item-thumbnail" src="<?php echo $thumbnail; ?>" alt="">
						</a>
						<?php endif; ?>
						<div class="ucf-rss-item-pubdate">
							<?php echo $item->get_date( 'M j' ); ?>
						</div>
					</div>
					<div class="ucf-rss-item-body">
						<h3 class="ucf-rss-item-title">
							<a class="ucf-rss-item-link" href="<?php echo $url; ?>"
							title="<?php echo $item->get_date( 'j F Y | g:i a' ); ?>">
								<?php echo $title; ?>
							</a>
						</h3>
						<?php if ( $desc ): ?>
						<div class="ucf-rss-item-description">
							<?php echo $desc; ?>
							<a href="<?php echo $url; ?>" class="ucf-rss-item-link ucf-rss-item-continue">Continue reading &rsaquo;</a>
						</div>
						<?php endif; ?>
					</div>
				</article>
			</li>
			<?php endforeach; ?>
		</ul>
		<?php else: ?>
		<div class="ucf-rss-feed-error">No results found.</div>
		<?php endif; ?>
	<?php
		return ob_get_clean();
	}

	add_filter( 'ucf_rss_display_thumbnail', 'ucf_rss_display_thumbnail', 10, 3 );

}

if ( !function_exists( 'ucf_rss_display_thumbnail_after' ) ) {

	function ucf_rss_display_thumbnail_after( $content, $items, $args ) {
		ob_start();
	?>
		</div>
	<?php
		return ob_get_clean();
	}

	add_filter( 'ucf_rss_display_thumbnail_after', 'ucf_rss_display_thumbnail_after', 10, 3 );

}

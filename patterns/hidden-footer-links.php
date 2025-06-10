<?php
/**
 * Title: Footer links
 * Slug: llp/footer-links
 * Categories: text
 * Inserter: no
 *
 * @package llp
 * @since 1.0.0
 */

?>
<!-- wp:group {"align":"full","layout":{"type":"flex","justifyContent":"space-between"}} -->
<div class="wp-block-group alignfull">
	<!-- wp:group {"layout":{"type":"flex","allowOrientation":false}} -->
	<div class="wp-block-group">
		<!-- wp:paragraph {"fontSize":"extra-small"} --><p class="has-extra-small-font-size">
		<?php
		sprintf(
			'<a href="%1$s">%2$s</a>, LLP Vemmelev Aps © %3$s',
			esc_url( get_privacy_policy_url() ),
			esc_html__( 'Cookie- og privatlivspolitik', 'llp' ),
			esc_html( date_i18n( _x( 'Y', 'copyright date format', 'llp' ) ) )
		);
		?>
		</p>
		<!-- /wp:paragraph -->
	</div><!-- /wp:group -->
</div>
<!-- /wp:group -->

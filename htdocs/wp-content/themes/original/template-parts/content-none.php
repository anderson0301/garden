<?php
/**
 * The template part for displaying a message that posts cannot be found
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

<p><?php _e( 'Nothing Found', 'twentysixteen' ); ?></p>
<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
<?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'twentysixteen' ), esc_url( admin_url( 'post-new.php' ) ) ); ?>
<?php elseif ( is_search() ) : ?>
<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'twentysixteen' ); ?></p>
<?php else : ?>
<?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'twentysixteen' ); ?>
<?php endif; ?>
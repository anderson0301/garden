<?php
/**
 * The template part for displaying results in search pages
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>
<ul class="list-link-01"><li><?php the_title(sprintf( '<a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),'</a>');?>
</li></ul>
<?php if ( 'post' === get_post_type() ) : ?>
<?php else : ?>
<?php endif; ?>
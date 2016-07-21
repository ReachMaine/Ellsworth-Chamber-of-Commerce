<?php /*
* 30Jun16 zig - add thumbnail to beginning of title row. 
* 21Jul16 zig - format image similar to archive.
*/ ?>
<?php
$categories   = wp_get_post_terms(get_the_ID(), 'listing-item-category');
?>

<div class="eltd-listing-title-holder eltd-listing-part ">
	<?php /* zig 30Jun16 start */ ?>
	<?php if ( has_post_thumbnail() ) { 
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' ); ?>
		<div class="eltd-post-image"  style="background-image: url('<?php echo $image[0]; ?>'); ">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"></a>
			<?php /* the_post_thumbnail('thumbnail'); */?>
		</div>
	<?php } ?>
	<?php /* zig 30Jun16 end */ ?>
	<div class="eltd-listing-title-category">
		<?php search_and_go_elated_listing_get_info_part('categories'); ?>
		<h2 class="eltd-listing-title" itemprop="name">
			<?php the_title(); ?>
		</h2>
	</div>
	<div class="eltd-listing-rating-info clearfix">
		<?php
		//search_and_go_elated_listing_get_info_part('wishlist');//Different wishlist button html for single item
		search_and_go_elated_listing_get_info_part('rating');
		search_and_go_elated_listing_get_info_part('category-icons');
		?>
	</div>
</div>
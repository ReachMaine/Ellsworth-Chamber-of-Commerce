<?php 
$post_type_id = get_post_meta(get_the_ID(),'eltd_listing_item_type',true);

if(isset($post_type_id) && $post_type_id !== ''){
	
	$show_video = get_post_meta($post_type_id,'eltd_listing_type_show_video',true);
	$video_link = get_post_meta(get_the_ID(), 'eltd_listing_video', true);
	

	if ( ($show_video == 'yes')  && ($video_link) ) {  
		echo " video link is:  ". $video_link. "."; ?>
		
		<div class= "eltd-listing-part eltd-listing-video">

			<?php			

			/* $embed = wp_oembed_get( $video_link );
			print $embed;  */
			
			?>

			
		</div>
	<?php }
	
}

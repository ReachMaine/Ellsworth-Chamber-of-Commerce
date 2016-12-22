<?php /* mods
*  zig - 22Dec16
*/ ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="vc_row vc_row-fluid">

	<div class="eltd-post-content ecc-blog ">
		<div class="eltd-post-info eltd-top-section">
			<?php search_and_go_elated_post_info(array('category' => 'yes')) ?>
		</div>
		<div class = "wpb_column vc_column_container vc_col-sm-4">
			<div class="vc_column-inner">
			<?php search_and_go_elated_get_module_template_part('templates/lists/parts/image', 'blog'); ?>
			</div>
		</div> <!-- end column4 -->
		<div class = "wpb_column vc_column_container vc_col-sm-8">
			<div class="vc_column-inner">
				<?php search_and_go_elated_get_module_template_part('templates/lists/parts/title', 'blog'); ?>

			<div class="eltd-post-text">
				<div class="eltd-post-text-inner">
					<?php
					search_and_go_elated_excerpt($excerpt_length);
					$args_pages = array(
						'before'           => '<div class="eltd-single-links-pages"><div class="eltd-single-links-pages-inner">',
						'after'            => '</div></div>',
						'link_before'      => '<span>',
						'link_after'       => '</span>',
						'pagelink'         => '%'
					);

					wp_link_pages($args_pages);
					?>
					<div class="eltd-post-info">
						<?php search_and_go_elated_post_info(array(
							'date' => 'yes',
							'author' => 'no',
							'share' => $social_share_flag
						)) ?>
					</div>
					<?php
					search_and_go_elated_read_more_button();
					?>
				</div>
			</div> <!-- tend text -->
		</div > <!-- column inner -->
		</div> <!-- end column8 -->
	</div> <!-- end content -->
	</div><!-- end of row -->
</article>

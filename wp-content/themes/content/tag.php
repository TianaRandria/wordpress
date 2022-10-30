<?php 
/**
 * Archive page template
 */
get_header(); 
spicepress_breadcrumbs(); ?>
<!-- Blog & Sidebar Section -->
<div id="content">
<section class="blog-section">
	<div class="container">
		<div class="row">
		<div class="col-md-<?php echo ( !is_active_sidebar( 'sidebar-1' ) ? '12' :'8' ); ?> col-sm-<?php echo ( !is_active_sidebar( 'sidebar-1' ) ? '12' :'7' ); ?> col-xs-12">
			<div class="row site-content" id="blog-masonry">
				<?php 
					if ( have_posts() ) :
					// Start the Loop.
					while ( have_posts() ) : the_post();
						// Include the post format-specific template for the content. get_post_format
						echo '<div class="item">';
						get_template_part( 'content','');
						echo '</div>';
					endwhile;
				endif;
				?>	
			</div>
			<?php
			// Previous/next page navigation.
					the_posts_pagination( array(
						'prev_text'          => '<i class="fa fa-angle-double-left"></i>',
						'next_text'          => '<i class="fa fa-angle-double-right"></i>'
					) );
			?>
		</div>
		
		<?php get_sidebar();?>
		
		</div>
	</div>
</section>
</div>
<!-- /Blog & Sidebar Section -->

<?php get_footer(); ?>
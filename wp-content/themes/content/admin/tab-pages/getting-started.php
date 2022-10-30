<?php
/**
 * Getting started template
 */
?>
<div id="getting_started" class="content-tab-pane active">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h1 class="content-info-title text-center"><?php echo esc_html__('About the Content theme','content'); ?></h1>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="content-tab-pane-half content-tab-pane-first-half">
				<p><?php esc_html_e( 'This theme is ideal for creating corporate and business websites. There is no separate premium version of it, as Content is a child theme of the SpicePress WordPress theme. The premium version, SpicePress PRO has tons of features: a homepage with many sections where you can feature unlimited slides, portfolios, user reviews, latest news, services, calls to action and much more. Each section in the Homepage template is carefully designed to fit to all business requirements.','content');?></p>
				<p>
				<?php esc_html_e( 'You can use this theme for any type of activity. Content is compatible with popular plugins like WPML and Polylang. To help you create an effective and impactful web presence, Content has predefined versions of many pages: Contact, Services, Portfolios, About Us and Blog.', 'content'); ?>
				</p>
				<h1 style="margin-top: 73px !important; font-size:2em !important; background: #0085ba;border-color: #0073aa #006799 #006799; color: #fff; padding: 5px 10px; line-height: 40px;"><?php esc_html_e( "Getting Started", 'content' ); ?></h1>				<div>
				<p style="margin-top: 16px;">
				<?php esc_html_e( 'To take full advantage of all the features this theme has to offer, install and activate the SpiceBox plugin. Go to Customize and install the SpiceBox plugin.', 'content' ); ?>

				</p>
				<p><a target="_blank" href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="button button-primary" style="padding: 3px 15px;height: 40px; font-size: 16px;"><?php esc_html_e( 'Go to the Customizer','content');?></a></p>
				</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="content-tab-pane-half content-tab-pane-first-half">
				<img class="img-responsive" src="<?php echo esc_url( CONTENT_ST_TEMPLATE_DIR_URI ) . '/admin/img/content.png'; ?>" alt="<?php esc_attr_e( 'Content theme', 'content' ); ?>" />
				</div>
			</div>
		</div>
		<div class="row">
			<div class="content-tab-center">
				<h1><?php esc_html_e( "Useful Links", 'content' ); ?></h1>
			</div>
			<div class="col-md-6">
				<div class="content-tab-pane-half content-tab-pane-first-half">
					<a href="<?php echo esc_url('https://content.spicethemes.com/'); ?>" target="_blank"  class="info-block"><div class="dashicons dashicons-desktop info-icon"></div>
					<p class="info-text"><?php echo esc_html__('Lite Demo','content'); ?></p></a>
				</div>
			</div>
			<div class="col-md-6">
				<div class="content-tab-pane-half content-tab-pane-first-half">
					<a href="<?php echo esc_url('https://demo.spicethemes.com/?theme=spicepress'); ?>" target="_blank"  class="info-block"><div class="dashicons dashicons-desktop info-icon"></div>
					<p class="info-text"><?php echo esc_html__('PRO Demo','content'); ?></p></a>
				</div>
			</div>
			<div class="col-md-6">
				<div class="content-tab-pane-half content-tab-pane-first-half">
					<a href="<?php echo esc_url('https://wordpress.org/support/theme/content/'); ?>" target="_blank"  class="info-block"><div class="dashicons dashicons-sos info-icon"></div>
					<p class="info-text"><?php echo esc_html__('Theme Support','content'); ?></p></a>
				</div>
			</div>
			<div class="col-md-6">
				<div class="content-tab-pane-half content-tab-pane-first-half">
					<a href="<?php echo esc_url('https://wordpress.org/support/view/theme-reviews/content'); ?>" target="_blank"  class="info-block"><div class="dashicons dashicons-smiley info-icon"></div>
					<p class="info-text"><?php echo esc_html__('Your feedback is valuable to us','content'); ?></p></a>
				</div>
			</div>
			<div class="col-md-6">
				<div class="content-tab-pane-half content-tab-pane-first-half">
					<a href="<?php echo esc_url('https://spicethemes.com/spicepress/'); ?>" target="_blank"  class="info-block"><div class="dashicons dashicons-book-alt info-icon"></div>
					<p class="info-text"><?php echo esc_html__('Premium Theme Details','content'); ?></p></a>
				</div>
			</div>
			<div class="col-md-6">
				<div class="content-tab-pane-half content-tab-pane-first-half">
					<a href="<?php echo esc_url('https://spicethemes.com/content-changelog/'); ?>" target="_blank"  class="info-block"><div class="dashicons dashicons-portfolio info-icon"></div>
					<p class="info-text"><?php echo esc_html__('Changelog','content'); ?></p></a>
				</div>
			</div>
		</div>
	</div>
</div>
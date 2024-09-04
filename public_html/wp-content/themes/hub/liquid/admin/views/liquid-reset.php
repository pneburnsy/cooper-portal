<main>

	<div class="lqd-dsd-wrap lqd-page-reset" style="padding-top:4%">

		<div class="lqd-about-plugins-wrap lqd-row lqd-page-reset-grid" style="--lqd-about-bg: #F4F4F4">
			<div class="lqd-col">
				<h5 class="lqd-page-reset-title">
					<div class="icon-wrap">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
						</svg>
					</div>
					<?php esc_html_e( 'Reset', 'hub' ); ?>
				</h5>
				<p class="lqd-page-reset-desc"><?php esc_html_e( 'You can use Reset to delete your pages, posts, media and more in a few clicks.', 'hub' ); ?></p>
				<h6><?php esc_html_e( 'You\'ll lose these:', 'hub' ); ?></h6>
				<ul class="list list-minus">
					<li><?php esc_html_e( 'Pages, Posts, Custom Post Types', 'hub' ); ?></li>
					<li><?php esc_html_e( 'Media Files', 'hub' ); ?></li>
					<li><?php esc_html_e( 'Theme Settings, Sidebars, Widgets', 'hub' ); ?></li>
				</ul>
				<div class="divider"></div>
				<h6><?php esc_html_e( 'You\'ll keep:', 'hub' ); ?></h6>
				<ul class="list list-plus">
					<li><?php esc_html_e( 'Current Theme And Plugins', 'hub' ); ?></li>
					<li><?php esc_html_e( 'Theme License', 'hub' ); ?></li>
				</ul>
				<div class="divider"></div>

				<form id="liquid-reset-form" action="<?php echo esc_url(admin_url('admin.php?page=liquid-reset'))?>" method="post" style="pointer-events:auto">
					<div class="form-field-checkbox">
						<input type="checkbox" name="liquid_reset" id="liquid-reset" required>
						<label for="liquid-reset"><?php esc_html_e( 'I understand that my data will be lost.' , 'hub'); ?></label>
					</div>
					<button class="merlin__button plugin-detail thickbox open-plugin-details-modal" style="background:rgba(240, 10, 10, 0.85)!important;color:#fff!important" type="submit">Reset WordPress</button>
				</form>

			</div>
			
			<div class="lqd-col" style="justify-content:flex-start;margin-top:80px">
				<div class="notice-box-red">
					<?php
						printf( '%s <strong>%s</strong>', 
							esc_html__('Important: Please, keep in mind that it is not possible to recover your content once deleted.', 'hub'),
							esc_html__('Make sure to backup your site before resetting.', 'hub')
						);
					?>
				</div>
			</div>
		</div>

	</div>

	<script type="text/template" id="tmpl-lqd-reset-modules">
		<div id="lqd-progress-popup" class="lqd-imp-popup-wrap is-active">
			<div class="lqd-imp-progress">
				<h6><?php esc_html_e( 'Resetting the WordPress', 'hub' ); ?> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18"><path fill="none" d="M0 0h24v24H0z"/><path d="M3.055 13H5.07a7.002 7.002 0 0 0 13.858 0h2.016a9.001 9.001 0 0 1-17.89 0zm0-2a9.001 9.001 0 0 1 17.89 0H18.93a7.002 7.002 0 0 0-13.858 0H3.055z"/></svg></h6>
				<p><?php esc_html_e( 'This process may take a couple of minutes, do not close the page!', 'hub' ); ?></p>
			</div>
		</div>
	</script>

</main>

<style>
	@keyframes spinsvg {from {transform: rotate(0deg)} to{transform: rotate(360deg)}}
	.lqd-imp-progress h6{display:inline-flex;align-items:center;}
	.lqd-imp-progress h6 svg {margin-left:4px;animation: spinsvg 1s linear infinite;}
</style>

<script type="text/javascript">
	jQuery("#liquid-reset-form").submit( function (e) {
		
		
		jQuery(document.body).append(_.template(jQuery('#tmpl-lqd-reset-modules').html())({ }));
		

		jQuery.ajax({
			url: ajaxurl,
			type: 'POST',
			data: {
				action: 'liquid_reset_wordpress_before',
			},
			success: function() {
				jQuery.ajax({
					url: ajaxurl,
					type: 'POST',
					data: {
						action: 'liquid_reset_wordpress',
					},
					success: function() {
						window.location.href = '<?php echo admin_url( 'admin.php?page=liquid-setup' ); ?>';
					}
				});
			}
		});
		
		e.preventDefault();

	});
</script>
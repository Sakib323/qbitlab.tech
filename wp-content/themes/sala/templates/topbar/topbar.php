<?php
$type           = Sala_Global::get_topbar_type();
$topbar         = 'topbar-' . $type;
$topbar_content = get_option($topbar);

if ( '' === $type ) {
	return;
}
?>
	<?php if( empty($topbar_content['child']) ) { ?>

		<div class="site-topbar top-bar-<?php echo esc_attr($topbar); ?>" data-section="<?php echo esc_attr($topbar); ?>">
			<?php get_template_part( 'templates/topbar/topbar', $type ); ?>
		</div>

	<?php }else{ ?>

		<div class="site-topbar <?php echo esc_attr($topbar); ?>" data-section="<?php echo esc_attr($topbar); ?>">
			<div class="sala-builder">
				<?php foreach( $topbar_content['child'] as $row ) { ?>
					<div class="<?php echo esc_attr($row['class']); ?>" id="<?php echo esc_attr($row['id']); ?>">
						<?php foreach( $row['child'] as $wrap ) { ?>
							<?php
								$id = '';
								if( !empty($wrap['id']) ) {
									$id = ' id=' . $wrap['id'];
								}
								$col = '';
								if( !empty($wrap['col']) ) {
									$col = ' data-col=' . $wrap['col'];
								}
								$sm_col = '';
								if( !empty($wrap['sm_col']) ) {
									$sm_col = ' data-sm-col=' . $wrap['sm_col'];
								}
							?>
							<div class="<?php echo esc_attr($wrap['class']); ?>" <?php echo esc_attr($col); ?> <?php echo esc_attr($sm_col); ?> <?php echo esc_attr($id); ?>>
								<?php
								if ( ! empty($wrap['child']) ) {
									foreach ($wrap['child'] as $element) {
										$data_id = $element['data_id'];
										$data_id = str_replace('-', '_', $data_id); ?>
										<?php
											if ( ! empty($data_id) ) {
												echo Sala_Templates::$data_id();
											}
										?>
									<?php
									}
								}
								?>
							</div>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
		</div>

	<?php } ?>
<?php

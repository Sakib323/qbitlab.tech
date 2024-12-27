<?php
$type           = Sala_Global::get_header_type();
$header         = 'header-' . $type;
$header_content = get_option($header);

if ( '' === $type ) {
	return;
}

if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'header' ) ) {

	?>
		<?php if( empty($header_content['child']) ) { ?>

			<header class="<?php echo Sala_Helper::header_class($header); ?>" data-section="<?php echo esc_attr($header); ?>">
				<?php get_template_part( 'templates/header/header', $type );  ?>
			</header>

		<?php }else{ ?>

			<header class="<?php echo Sala_Helper::header_class($header); ?>" data-section="<?php echo esc_attr($header); ?>">
				<div class="sala-builder">
					<?php foreach( $header_content['child'] as $row ) { ?>
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
									$md_col = '';
									if( !empty($wrap['md_col']) ) {
										$md_col = ' data-md-col=' . $wrap['md_col'];
									}
									$sm_col = '';
									if( !empty($wrap['sm_col']) ) {
										$sm_col = ' data-sm-col=' . $wrap['sm_col'];
									}
								?>
								<div class="<?php echo esc_attr($wrap['class']); ?>" <?php echo esc_attr($col); ?> <?php echo esc_attr($md_col); ?> <?php echo esc_attr($sm_col); ?> <?php echo esc_attr($id); ?>>
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
			</header>

		<?php } ?>
	<?php

}else{

	if ( function_exists( 'elementor_theme_do_location' ) ) :

		elementor_theme_do_location( 'header' );

	endif;

}

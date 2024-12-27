<?php

namespace Sala_Elementor;

use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Typography as Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Core\Schemes\Color as Scheme_Color;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor countdown.
 *
 * Elementor widget that displays an eye-catching headlines.
 *
 * @since 1.0.0
 */
class Widget_Countdown extends Base {

	public function get_name() { 		//Function for get the slug of the element name.
		return 'sala-countdown';
	}

	public function get_title() { 		//Function for get the name of the element.
		return __( 'Countdown Timer', 'sala' );
	}

	public function get_icon() { 		//Function for get the icon of the element.
		return 'eicon-countdown';
	}

	public function get_categories() { 		//Function for include element into the category.
		return [ 'sala' ];
	}

    /*
	 * Adding the controls fields for the countdown timer
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'ctw_section',
			[
				'label' => __( 'Countdown', 'sala' ),
			]
		);
	    $this->add_control(
			'ctw_due_date',
			[
				'label' => __( 'Due Date', 'sala' ),
				'type' => Controls_Manager::DATE_TIME,
				'default' => date( 'Y-m-d H:i', strtotime( '+1 month' ) + ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS ) ),
				'description' => sprintf( __( 'Date set according to your timezone: %s.', 'sala' ), Utils::get_timezone_string() ),

			]
		);
		$this->add_control(
			'ctw_show_days',
			[
				'label' => __( 'Days', 'sala' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'sala' ),
				'label_off' => __( 'Hide', 'sala' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'ctw_show_hours',
			[
				'label' => __( 'Hours', 'sala' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'sala' ),
				'label_off' => __( 'Hide', 'sala' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'ctw_show_minutes',
			[
				'label' => __( 'Minutes', 'sala' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'sala' ),
				'label_off' => __( 'Hide', 'sala' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'ctw_show_seconds',
			[
				'label' => __( 'Seconds', 'sala' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'sala' ),
				'label_off' => __( 'Hide', 'sala' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'ctw_expire_section',
			[
				'label' => __( 'Countdown Expire' , 'sala' )
			]
		);
		$this->add_control(
			'ctw_expire_show_type',
			[
				'label'			=> __('Expire Type', 'sala'),
				'label_block'	=> false,
				'type'			=> Controls_Manager::SELECT,
                'description'   => __('Select whether you want to set a message or a redirect link after expire countdown', 'sala'),
				'options'		=> [
					'message'		=> __('Message', 'sala'),
					'redirect_link'		=> __('Redirect to Link', 'sala')
				],
				'default' => 'message'
			]
		);
		$this->add_control(
			'ctw_expire_message',
			[
				'label'			=> __('Expire Message', 'sala'),
				'type'			=> Controls_Manager::TEXTAREA,
				'default'		=> __('Sorry you are late!','sala'),
				'condition'		=> [
					'ctw_expire_show_type' => 'message'
				]
			]
		);
		$this->add_control(
			'ctw_expire_redirect_link',
			[
				'label'			=> __('Redirect On', 'sala'),
				'type'			=> Controls_Manager::URL,
				'condition'		=> [
					'ctw_expire_show_type' => 'redirect_link'
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'ctw_label_text_section',
			[
				'label' => __( 'Change Labels Text' , 'sala' )
			]
		);
        $this->add_control(
			'ctw_change_labels',
			[
				'label' => __( 'Change Labels', 'sala' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'sala' ),
				'label_off' => __( 'No', 'sala' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		$this->add_control(
			'ctw_label_days',
			[
				'label' => __( 'Days', 'sala' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Days', 'sala' ),
				'placeholder' => __( 'Days', 'sala' ),
				'condition' => [
					'ctw_change_labels' => 'yes',
					'ctw_show_days' => 'yes',
				],
			]
		);
		$this->add_control(
			'ctw_label_hours',
			[
				'label' => __( 'Hours', 'sala' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Hours', 'sala' ),
				'placeholder' => __( 'Hours', 'sala' ),
				'condition' => [
					'ctw_change_labels' => 'yes',
					'ctw_show_hours' => 'yes',
				],
			]
		);
		$this->add_control(
			'ctw_label_minuts',
			[
				'label' => __( 'Minutes', 'sala' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Minutes', 'sala' ),
				'placeholder' => __( 'Minutes', 'sala' ),
				'condition' => [
					'ctw_change_labels' => 'yes',
					'ctw_show_minutes' => 'yes',
				],
			]
		);
		$this->add_control(
			'ctw_label_seconds',
			[
				'label' => __( 'Seconds', 'sala' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Seconds', 'sala' ),
				'placeholder' => __( 'Seconds', 'sala' ),
				'condition' => [
					'ctw_change_labels' => 'yes',
					'ctw_show_seconds' => 'yes',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'ctw_style_section',
			[
				'label' => __( 'Box', 'sala' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
            'ctw_box_align',
                [
                    'label'         => esc_html__( 'Alignment', 'sala' ),
                    'type'          => Controls_Manager::CHOOSE,
                    'options'       => [
                        'left'      => [
                            'title'=> esc_html__( 'Left', 'sala' ),
                            'icon' => 'fa fa-align-left',
                            ],
                        'center'    => [
                            'title'=> esc_html__( 'Center', 'sala' ),
                            'icon' => 'fa fa-align-center',
                            ],
                        'right'     => [
                            'title'=> esc_html__( 'Right', 'sala' ),
                            'icon' => 'fa fa-align-right',
                            ],
                        ],
                    'toggle'        => false,
                    'default'       => 'center',
                    'selectors'     => [
                        '{{WRAPPER}} .countdown-timer-widget' => 'text-align: {{VALUE}};',
                        ],
                ]
        );
		$this->add_responsive_control(
			'ctw_box_spacing',
			[
				'label' => __( 'Box Gap', 'sala' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 10,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'body:not(.rtl) {{WRAPPER}} .countdown-items:not(:first-of-type)' => 'margin-left: calc( {{SIZE}}{{UNIT}}/2 );',
					'body:not(.rtl) {{WRAPPER}} .countdown-items:not(:last-of-type)' => 'margin-right: calc( {{SIZE}}{{UNIT}}/2 );',
					'body.rtl {{WRAPPER}} .countdown-items:not(:first-of-type)' => 'margin-right: calc( {{SIZE}}{{UNIT}}/2 );',
					'body.rtl {{WRAPPER}} .countdown-items:not(:last-of-type)' => 'margin-left: calc( {{SIZE}}{{UNIT}}/2 );',
				],
			]
		);
		$this->add_responsive_control(
			'ctw_digit_spacing',
			[
				'label' => __( 'Digit Gap', 'sala' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 300,
					],
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'size' => 200,
					'unit' => 'px',
				],
				'tablet_default' => [
					'size' => 150,
					'unit' => 'px',
				],
				'mobile_default' => [
					'size' => 100,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .countdown-items .ctw-digits' => 'height: calc( {{SIZE}}{{UNIT}}/2 );',
					'{{WRAPPER}} .countdown-items .ctw-digits' => 'line-height: calc( {{SIZE}}{{UNIT}}/2 );',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
	            'selector' => '{{WRAPPER}} .countdown-items',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'ctw_box_border_radius',
			[
				'label' => __( 'Border Radius', 'sala' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .countdown-items' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'ctw_digits_style_section',
			[
				'label' => __( 'Digits', 'sala' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'ctw_digits_color',
			[
				'label' => __( 'Color', 'sala' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ctw-digits' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'eac_digits_typography',
				'selector' => '{{WRAPPER}} .ctw-digits',
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'ctw_labels_style_section',
			[
				'label' => __( 'Labels', 'sala' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'ctw_label_color',
			[
				'label' => __( 'Color', 'sala' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ctw-label' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'eac_label_typography',
				'selector' => '{{WRAPPER}} .ctw-label',
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
			]
		);
		$this->add_control(
			'ctw_label_color_margin',
			[
				'label' => __( 'Margin', 'sala' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ctw-label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'ctw_finish_message_style_section',
			[
				'label' => __( 'Message', 'sala' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'ctw_message_color',
			[
				'label' => __( 'Color', 'sala' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .finished-message' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'eac_message_typography',
				'selector' => '{{WRAPPER}} .finished-message',
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
			]
		);
		$this->end_controls_section();
	}

	/**
	 * Render countdown timer widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings();

		$day = $settings['ctw_show_days'];
		$hours = $settings['ctw_show_hours'];
		$minute = $settings['ctw_show_minutes'];
		$seconds = $settings['ctw_show_seconds'];
		?>
		<div class="countdown-timer-widget">
		    <div id="countdown-timer-<?php echo esc_attr($this->get_id()); ?>" class="countdown-timer-init"></div>
			<div id="finished-message-<?php echo esc_attr($this->get_id()); ?>" class="finished-message"></div>
		</div>
		<script>
			jQuery(function(){
				jQuery('#countdown-timer-<?php echo esc_attr($this->get_id()); ?>').countdowntimer({
                    dateAndTime : "<?php echo preg_replace('/-/', '/', $settings['ctw_due_date']); ?>",
                    regexpMatchFormat: "([0-9]{1,3}):([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})",
      				regexpReplaceWith: "<?php if ($day == "yes"){?><div class='countdown-items'><span class='ctw-digits'><span>$1</span> :</span><span class='ctw-label'><?php echo $settings['ctw_label_days']; ?></span> </div><?php } ?><?php if ($hours == "yes"){?> <div class='countdown-items'><span class='ctw-digits'><span>$2</span> :</span><span class='ctw-label'><?php echo $settings['ctw_label_hours']; ?></span></div><?php } ?><?php if ($minute == "yes"){?><div class='countdown-items'> <span class='ctw-digits'> <span>$3</span> : </span><span class='ctw-label'><?php echo $settings['ctw_label_minuts']; ?></span> </div><?php } ?><?php if ($seconds == "yes"){?><div class='countdown-items'><span class='ctw-digits'> <span>$4</span></span><span class='ctw-label'><?php echo $settings['ctw_label_seconds']; ?></span></div><?php } ?>",
					<?php if( $settings['ctw_expire_show_type'] == "redirect_link"){ ?>
					expiryUrl : link_url,
					<?php } else { ?>
					timeUp : timeisUp,
					<?php } ?>
                });
                <?php if( $settings['ctw_expire_show_type'] == "redirect_link"){ ?>
					var ele_backend = jQuery('body').find('#elementor-frontend-css').length;

					if( ele_backend > 0 ) {
						jQuery(this).find('.countdown-timer-init').html( '<h1>You can not redirect url from elementor Editor!!</h1>' );

					} else {
						var link_url = '<?php echo $settings['ctw_expire_redirect_link']['url'] ?>';
						window.open("<?php echo $settings['ctw_expire_redirect_link']['url'] ?>", "<?php echo $target ?>");

					}
				<?php } else { ?>
					function timeisUp(){
						jQuery("#finished-message-<?php echo esc_attr($this->get_id()); ?>").html( "<span><?php echo $settings['ctw_expire_message'];?></span>" );
				    }
				<?php } ?>
			});

        </script>
		<?php
	}

    /**
	 * Render countdown widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @access protected
	 */
	protected function content_template() {

	}
}

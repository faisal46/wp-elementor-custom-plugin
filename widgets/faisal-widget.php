<?php

class Elementor_Faisal_Widget extends \Elementor\Widget_Base{
	public function get_name() {
		return 'FaisalWidget';
	}

	public function get_title() {
		return esc_html__( 'Custom Heading', 'elementorcustomaddon' );
	}

	public function get_icon() {
		return 'eicon-t-letter';
	}

	public function get_custom_help_url() {}

	public function get_categories() {
		return array( 'custom_basic_category' );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'elementorcustomaddon' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'heading',
			[
				'label' => esc_html__( 'Heading', 'elementorcustomaddon' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter your heading', 'elementorcustomaddon' ),
			]
		);

		$this->add_control(
			'heading_align',
			[
				'label' => esc_html__( 'Alignment', 'elementorcustomaddon' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left'  => esc_html__( 'Left', 'elementorcustomaddon' ),
					'right' => esc_html__( 'Right', 'elementorcustomaddon' ),
					'center' => esc_html__( 'Center', 'elementorcustomaddon' ),
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$heading = $settings['heading'];
		$heading_align = $settings['heading_align'];
        echo '<h1 style="text-align:'.esc_html__( $heading_align ).'">'.esc_html__( $heading ).'</h1>';
	}

	protected function content_template() {}
}
<?php

class Elementor_Faisal_Widget extends \Elementor\Widget_Base{
	public function get_name() {
		return 'FaisalWidget';
	}

	public function get_title() {
		return esc_html__( 'Faisal Heading', 'wpfee' );
	}

	public function get_icon() {
		return 'eicon-t-letter';
	}

	public function get_custom_help_url() {}

	public function get_categories() {
		return array( 'basic' );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'wpfee' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'heading',
			[
				'label' => esc_html__( 'Heading', 'wpfee' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter your heading', 'wpfee' ),
			]
		);

		$this->add_control(
			'heading_align',
			[
				'label' => esc_html__( 'Alignment', 'wpfee' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left'  => esc_html__( 'Left', 'wpfee' ),
					'right' => esc_html__( 'Right', 'wpfee' ),
					'center' => esc_html__( 'Center', 'wpfee' ),
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
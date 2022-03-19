<?php

class Elementor_Custom_Widget extends \Elementor\Widget_Base{
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
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'heading',
			[
				'label'       => esc_html__( 'Heading', 'elementorcustomaddon' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter your heading', 'elementorcustomaddon' ),
			]
		);
		$this->add_control(
			'description',
			[
				'label'       => esc_html__( 'Description', 'elementorcustomaddon' ),
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter your description', 'elementorcustomaddon' ),
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'position_section',
			[
				'label' => esc_html__( 'Position', 'elementorcustomaddon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'heading_align',
			[
				'label'      => esc_html__( 'Heading Alignment', 'elementorcustomaddon' ),
				'type'       => \Elementor\Controls_Manager::SELECT,
				'default'    => 'left',
				'options'    => [
					'left'   => esc_html__( 'Left', 'elementorcustomaddon' ),
					'right'  => esc_html__( 'Right', 'elementorcustomaddon' ),
					'center' => esc_html__( 'Center', 'elementorcustomaddon' ),
				],
				'selectors'  => [
					'{{WRAPPER}} h1.heading' => 'text-align: {{VALUE}}'
				],
			]
		);

		$this->add_control(
			'description_align',
			[
				'label'      => esc_html__( 'Description Alignment', 'elementorcustomaddon' ),
				'type'       => \Elementor\Controls_Manager::SELECT,
				'default'    => 'left',
				'options'    => [
					'left'   => esc_html__( 'Left', 'elementorcustomaddon' ),
					'right'  => esc_html__( 'Right', 'elementorcustomaddon' ),
					'center' => esc_html__( 'Center', 'elementorcustomaddon' ),
				],
				'selectors'  => [
					'{{WRAPPER}} p.description' => 'text-align: {{VALUE}}'
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'color_section',
			[
				'label' => esc_html__( 'Color', 'elementorcustomaddon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'heading_color',
			[
				'label'      => esc_html__( 'Heading Color', 'elementorcustomaddon' ),
				'type'       => \Elementor\Controls_Manager::COLOR,
				'default'    => '#000000',
				'selectors'  => [
					'{{WRAPPER}} h1.heading' => 'color: {{VALUE}}'
				],
			]
		);
		$this->add_control(
			'description_color',
			[
				'label'      => esc_html__( 'Description Color', 'elementorcustomaddon' ),
				'type'       => \Elementor\Controls_Manager::COLOR,
				'default'    => '#000000',
				'selectors'  => [
					'{{WRAPPER}} p.description' => 'color: {{VALUE}}'
				],
			]
		);
		$this->end_controls_section();
	}

	protected function render() {
		$settings      = $this->get_settings_for_display();
		$heading       = $settings['heading'];
		$heading_align = $settings['heading_align'];
		$description = $settings['description'];
        echo '<h1 class="heading">'.esc_html__( $heading ).'</h1>';
        echo '<p class="description">'.esc_html__( $description ).'</p>';
	}

	protected function content_template() {
		?>
		<#
           console.log(settings);
		#>
          <h1 class="heading">{{{settings.heading}}}</h1>
          <p class="description">{{{settings.description}}}</p>
		<?php
	}
}
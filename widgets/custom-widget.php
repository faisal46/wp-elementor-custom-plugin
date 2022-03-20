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

		// Image section start
		$this->start_controls_section(
			'image_section',
			[
				'label' => esc_html__( 'Image', 'elementorcustomaddon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'custom_image',
			[
				'label'      => esc_html__( 'Image', 'elementorcustomaddon' ),
				'type'       => \Elementor\Controls_Manager::MEDIA,
				'default'  => [
					'url'  => \Elementor\Utils::get_placeholder_image_src()
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name' => 'custom_image_size', 
				'default' => 'large',
			]
		);

		$this->end_controls_section();
		// Image section end
	}

	protected function render() {
		$settings      = $this->get_settings_for_display();
		$heading       = $settings['heading'];
		$heading_align = $settings['heading_align'];
		$description = $settings['description'];
		$this->add_inline_editing_attributes('heading', 'none');
		$this->add_render_attribute('heading', [
			'class' => 'heading'
		]);
		$this->add_inline_editing_attributes('description', 'none');
		$this->add_render_attribute('description', [
			'class' => 'description'
		]);
        echo "<h1 ".$this->get_render_attribute_string('heading').">".esc_html__( $heading )."</h1>";
        echo "<p ".$this->get_render_attribute_string('description').">".wp_kses_post( $description )."</p>";
		// echo wp_get_attachment_image( $settings['image']['id'], 'large' );
		echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'custom_image_size', 'custom_image' );
	}

	protected function content_template() {
		?>
		<#
           view.addInlineEditingAttributes('heading', 'none');
           view.addRenderAttribute('heading',{'class':'heading'}); 
		   
		   view.addInlineEditingAttributes('description', 'none');
           view.addRenderAttribute('description',{'class':'description'});

		  // Custom image output with image size. 
		   var customImage = {
			   id:settings.custom_image.id,
			   url:settings.custom_image.url,
			   size:settings.custom_image_size_size,
			   dimension:settings.custom_image_size_custom_dimension,
		   }
		   var customImageUrl = elementor.imagesManager.getImageUrl( customImage );
		#>
          <h1 {{{ view.getRenderAttributeString('heading') }}}>{{{ settings.heading }}}</h1>
          <p {{{ view.getRenderAttributeString('description') }}}>{{{ settings.description }}}</p>
		  <img src="{{{ customImageUrl }}}" alt="" />
		<?php
	}
}
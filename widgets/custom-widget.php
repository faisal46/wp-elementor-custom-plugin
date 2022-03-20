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
		
		// Select 2 section start
		$this->start_controls_section(
			'select2_section',
			[
				'label' => esc_html__( 'Select2', 'elementorcustomaddon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'select2',
			[
				'label'       => esc_html__( 'Select2', 'elementorcustomaddon' ),
				'type'        => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options'     => [
					'bangladesh' => esc_html__( 'Bangladesh', 'elementorcustomaddon' ),
					'indea'      => esc_html__( 'Indea', 'elementorcustomaddon' ),
					'america'    => esc_html__( 'America', 'elementorcustomaddon' ),
					'africa'     => esc_html__( 'Africa', 'elementorcustomaddon' ),
					'canada'     => esc_html__( 'Canada', 'elementorcustomaddon' ),
					'rasia'      => esc_html__( 'Rasia', 'elementorcustomaddon' ),
				]
			]
		);

		$this->end_controls_section();
		// Select 2 section end
		
		// Choose section start
		$this->start_controls_section(
			'choose_section',
			[
				'label' => esc_html__( 'Choose', 'elementorcustomaddon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'choose_one',
			[
				'label'       => esc_html__( 'Choose One', 'elementorcustomaddon' ),
				'type'        => \Elementor\Controls_Manager::CHOOSE,
				'label_block' => true,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'elementorcustomaddon' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'elementorcustomaddon' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'elementorcustomaddon' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justify', 'elementorcustomaddon' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'default' => 'center',
				'toggle' => true,
			]
		);

		$this->end_controls_section();
		// Choose section end
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
		
		// Select 2 data get & show
		$countries = $settings['select2'];
		foreach ( $countries as $country ) {
			echo '<div>' . $country . '</div>';
		}
		// Choose One Radio buttons styled as groups of buttons with icons.
		if ( $settings['choose_one'] ){ 
        ?>
		
		<div style="text-align: <?php echo esc_attr( $settings['choose_one'] ); ?>;">
		WordPress Elementor Addon plugin for custom widgets extend the functions. WordPress Elementor Addon for custom widgets extend the functions WordPress Elementor Addon plugin for custom widgets extend our the functions WordPress Elementor Addon plugin for custom widgets extend the functions are the best.vbnv
		</div>

		<?php
		}
	
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

		  <!-- Select2 value output. -->
		<ul>
		<# _.each( settings.select2,function( country ) { #>
			<li>{{{ country }}}</li>
		<# } ) #>
		</ul>

		<!-- Choose One Radio buttons styled as groups of buttons with icons. -->
		<div style="text-align: {{{ settings.choose_one }}}">
		  WordPress Elementor Addon plugin for custom widgets extend the functions. WordPress Elementor Addon for custom widgets extend the functions WordPress Elementor Addon plugin for custom widgets extend our the functions WordPress Elementor Addon plugin for custom widgets extend the functions are the best.vbnv
		</div>


		 

		<?php
	}
}
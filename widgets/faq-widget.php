<?php

class Elementor_Faq_Widget extends \Elementor\Widget_Base{
	/**
	 * Get widget name.
	 *
	 * Retrieve widget name.
	 *
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_name() {
		return 'FaqWidgets';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve widget title.
	 *
	 * @return string Widget title.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_title() {
		return esc_html__( 'Faq Widgets', 'elementorcustomaddon' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve widget icon.
	 *
	 * @return string Widget icon.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_icon() {
		return 'eicon-document-file';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * @return array Widget categories.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_categories() {
		return array( 'custom_basic_category' );
	}

	/**
	 * Register widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		$this->register_content_controls();
		$this->register_style_controls();
	}

	/**
	 * Register widget content ontrols.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	function register_content_controls() {
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'elementorcustomaddon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'title',
			[
				'label'       => esc_html__( 'Title', 'elementorcustomaddon' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
			]
		);
		
		$repeater->add_control(
			'description',
			[
				'label'       => esc_html__( 'Description', 'elementorcustomaddon' ),
				// 'type'        => \Elementor\Controls_Manager::WYSIWYG,
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
			]
		);

		$this->add_control(
			'faqs',
			[
				'label'       => esc_html__( 'FAQs', 'elementorcustomaddon' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ title }}}',
				'default'    => [
					[
						'title'   => 'Faq Title 1',
					    'description'   => 'Faq description 1',
					],
					
					[
						'title'   => 'Faq Title 2',
					    'description'   => 'Faq description 2',
					],
				],
			]
		);


		$this->end_controls_section();
	}

	/**
	 * Register widget style controls.
	 *
	 * Adds different input fields in the style tab to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_style_controls() {

		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Style', 'elementorcustomaddon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'color',
			[
				'label'     => __( 'Color', 'elementorcustomaddon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#ff0000',
				'selectors' => [
					'{{WRAPPER}} .dummy_text' => 'color: {{VALUE}}'
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'content_typography',
				'label'    => __( 'Typography', 'elementorcustomaddon' ),
			]
		);

		$this->end_controls_section();

	}
		

	/**
	 * Render widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings      = $this->get_settings_for_display();
		$faqs = $settings['faqs'];

		// print_r($faqs);
		if( $faqs ) {
			foreach ( $faqs as $index=>$faq ) { 
				$key = $this->get_repeater_setting_key("title", "faqs", $index);
				$this->add_inline_editing_attributes($key, 'none');
				echo "<h3 ".$this->get_render_attribute_string($key)." >".$faq['title']."</h3>";
				echo "<p>".$faq['description']."</p>";
			}
		}
		
	
	}

	/**
	 * Render widget output on the frontend.
	 *
	 * Written in JS and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function content_template() {
		?>
		<!-- Faq output. -->
		<div>
		<#
		if( settings.faqs.length ){
			_.each( settings.faqs, function( faq, index ) { 
				var key =  view.getRepeaterSettingKey('title', 'faqs', index);
				view.addInlineEditingAttributes('key', 'none');
				#>
				<h3 {{{ view.getRenderAttributeString(key) }}} >{{{ faq.title }}}</h3>
                <p>{{{ faq.description }}}</p>
			<# } )
		} #>
            
			
			
		</div>

		<?php
	}
}